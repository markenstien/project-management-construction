<?php

	class ProjectModel extends Model
	{
		public $table = 'projects';



		public function getByCustomer($id)
		{
			return parent::all([
				'customer_id' => $id,
			], ' id desc');
		}

		public function update($project , $id)
		{
			$res = parent::update($project , $id);
			if(!$res)
			{
				$this->addError("Update failed!");
				return false;
			}

			$this->addMessage("Project has been updated");
			return true;
		}
		public function create($project)
		{
			extract($project);
			$reference = $this->generateReference();

			$res = parent::store([
				'reference' => $reference,
				'title' => $title,
				'budget' => $budget,
				'max_budget' => $max_budget,
				'cost'   => $cost,
				'start_date' => $start_date,
				'est_completion_date' => $est_completion_date,
				'type' => $type,
				'classification' => $classification,
				'sqm'    => $sqm,
				'address' => $address,
				'description' => $description
			]);

			if( !$res ){
				$this->addError("Project create fold");
				return false;
			}

			$this->addMessage("Project {$title} has been created!");

			$this->setInstance(parent::get($res));
			return $res;
		}


		public function addCustomer($customerId , $projectId)
		{

			$res = parent::update([
				'customer_id' => $customerId
			] , $projectId);

			if($res)
				$this->addMessage("Customer Added");

			return $res;
		}

		public function addCustomerCreate($customer , $projectId)
		{

			$userModel = model('UserModel');

			$userId = $userModel->createCustomer( $customer );

			if(!$userId)
			{
				extract($customer);

				$customerByEmail = $userModel->getByEmail($email);

				if( $customerByEmail )
				{
					$ahref = _route('project:addCustomer', [
						'customer_id' => $customerByEmail->id,
						'project_id'  => $projectId,
						'isPost'      => true
					]);

					$link = "<a href='{$ahref}'>click here</a>";

					$this->addError( "Customer is already saved in our database , would you like to use the customer? {$link}" );
				}else
				{
					$this->addError( $userModel->getErrorString() );
				}
				

				return false;
			}

			$res = parent::update([
				'customer_id' => $userId
			], $projectId);

			$this->addMessage("Customer Added");
			
			return $projectId;
		}

		private function generateReference()
		{
			$reference = null;

			while( is_null($reference) )
			{
				$reference = random_number('12');

				$isExist = parent::single([
					'reference' => $reference
				]);

				if( $isExist )
					$reference = null;
			}

			return $reference;
		}

		public function getFilesAndFolders( $id )
		{
			$folder = model('FolderModel');
			$file = model('FileModel');

			/*
			*Folders
			*/
			$folders = $folder->fetchWithFiles([
				'meta_id'   => $id,
				'meta_key'  => 'PROJECT',
			]);

			$files = $file->fetchFiles([
				'meta_id' => $id,
				'meta_key' => 'PROJECT',
				'folder_id' => 0
			]);

			return compact([
				'folders',
				'files'
			]);
		}

		/*projectId*/
		public function getOwner($id)
		{
			$project = parent::get($id);

			if(!$project){
				$this->addError("Project Not Found");
				return false;
			}

			$this->userModel = model('UserModel');

			$owner = $this->userModel->get($project->customer_id);

			if( !$owner ){
				$this->addError( $this->userModel->getErrorString() );
				return false;
			}

			return $owner;
		}

		public function addSector($projectSector)
		{
			$this->projectProjectSectorModel = model('ProjectProjectSectorModel');

			$projectSectorExist = $this->projectProjectSectorModel->single([
				'project_id' => $projectSector['project_id'],
				'sector_id' => $projectSector['sector_id'],
			]);

			if( $projectSectorExist )
			{
				$this->addError("Project Sector Already exist");
				return false;
			}

			$res = $this->projectProjectSectorModel->store( $projectSector );

			if(!$res){
				$this->addError( $this->projectSector->getErrorString());
				return false;
			}
			
			_notify('project' , [
				'href' => _route('project:show',$projectSector['project_id']),
				'message' => 'A project sector has been added'
			],0);
			$this->addMessage("Project Sector Added");

			return $res;
		}

		public function getSectors($id)
		{
			$this->projectProjectSectorModel = model('ProjectProjectSectorModel');

			$projectSectors = $this->projectProjectSectorModel->all([
				'project_id' => $id
			]);

			return $projectSectors;
		}

		public function getExpenses($id)
		{
			$this->expenses = model('ExpensesModel');

			return $this->expenses->getByProject($id);
		}

		public function getWorkers($id)
		{
			$this->worker = model('ProjectWorkerModel');

			return $this->worker->getByProject($id);
		}


		public function addSectorMultiple($projectSectorsArray , $projectId)
		{
			$errors = [];

			foreach($projectSectorsArray as $sectorIndex => $sector)
			{
				$budget = $sector['budget'];
				$maxBudget = $sector['max_budget'];

				if( !is_numeric($budget) ){
					$errors [] = " Invalid Budget ";
				}

				if( !is_numeric($maxBudget) ){
					$errors [] = " Invalid Max Budget";
				}

				// add project_id to sector
				$projectSectorsArray[$sectorIndex]['project_id'] = $projectId;
			}

			if(!empty($errors))
			{
				foreach($errors as $key => $err) {
					$this->addError( $err );
				}

				return false;
			}

			$this->projectProjectSectorModel = model('ProjectProjectSectorModel');

			$addedSectors = [];

			foreach($projectSectorsArray as $sectorIndex => $sector)
			{
				$addedSectors [] = $this->projectProjectSectorModel->store( $sector );
			}


			if( !$addedSectors ){
				$this->addError("Adding sector failed");
				return false;
			}

			$this->addMessage("Project Sectors added to the project");

			return true;
		}

		public function updateStatus($id , $status)
		{
			if( isEqual($status , 'delete') )
			{
				$res = $this->delete($id);

				if($res){
					$this->addMessage(" Update status successfull. ");
					return true;
				}

				return false;
			}else
			{
				$res = parent::update([
					'status' => $status
				],$id);


				if( isEqual($status , 'completed') )
				{
					$this->progressModel = model('ProgressModel');
					$this->progressModel->complete($id);
				}

				if(!$res) {
					$this->addError("Project update failed");
					return false;
				}

				$this->addMessage("Project updated successfully");

				return true;
			}
		}

		public function delete($id)
		{
			$project = parent::get($id);

			if(!$project){
				$this->addError("Project delete failed!");
				return false;
			}

			parent::delete($id);
			return true;
		}
	}