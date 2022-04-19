<?php 	

	class ProgressModel extends Model
	{
		public $table = 'progress';


		public function add($progress)
		{
			extract($progress);

			if( isEqual($current , 100))
				return $this->complete( $project_id );
				
			$lastProgress = $this->getLatest($project_id);

			$lastProjectCurrent = 0;

			if( $lastProgress )
				$lastProjectCurrent = $lastProgress->current;

			//check if lastproject current and current is match then not allowed.

			if( $lastProjectCurrent == $current )
			{
				$this->addError("No changes is progress");
				return false;
			}
			$latestId = parent::store([
				'project_id' => $project_id,
				'description' => $description,
				'current'     => $current,
				'old'         => $lastProjectCurrent,
				'date'        => $date
			]);

			if(!$latestId){
				$this->addError("Progress update failed!");
				return false;
			}

			if( intval($lastProjectCurrent) > intval($current) )
				$this->addMessage("Your progress is moving backwards.");
			/*
			*ABCD EFG project progress update.
			*/
			$projectModel = model('ProjectModel');

			$project  = $projectModel->get($project_id);

			$userMessage = "{$project->title} project , progress update";

			_notify('project' , [
				'message' => $userMessage,
				'href'    => _route('project:show' , $project->id),
				'category' => 'primary'
			], $project->id);


			/*alert owner*/

			if( $project->customer_id)
			{	
				$this->userModel = model('UserModel');
				//get email
				$user = $this->userModel->get($project->customer_id);
				$email = $user->email;

				_notify('user' , [
					'message' => $userMessage,
					'href'    => _route('project:show' , $project->customer_id),
					'category' => 'primary'
				], $project->customer_id);	

				$emailMessage = "<p> Good day! , {$user->first_name} {$user->last_name} </p>";
				$emailMessage .= "<p> Your Project <b>{$project->title}</b> Completion Progress  is updated to {$current}%</p>";
				$emailMessage .= "<p>Project Reference : #{$project->reference}</p>";

				$progressEmailHTML = wEmailComplete($emailMessage);

				// if( is_email($email) )
				// _mail($email , "Project Progress" , $progressEmailHTML);
			}
			

			$this->addMessage("Project Progress updated!");

			return $latestId;
		}

		public function getLatest($projectId)
		{
			return parent::single([
				'project_id' => $projectId
			] , '*' , 'id desc');
		}
		

		public function getAll($projectId)
		{
			$progress = parent::all([
				'project_id' => $projectId
			] , 'id desc');

			return $progress;
		}

		public function complete($project_id)
		{

			$lastProgress = $this->getLatest($project_id);

			$lastProjectCurrent = 0;

			if( $lastProgress )
				$lastProjectCurrent = $lastProgress->current;

			if( $lastProjectCurrent == 100 ){
				$this->addError("Project is already 100% complete");
				return false;
			}

			$latestId = parent::store([
				'project_id' => $project_id,
				'description' => $description,
				'current'     => 100,
				'old'         => $lastProjectCurrent,
				'date'        => $date
			]);

			if(!$latestId){
				$this->addError("Progress update failed!");
				return false;
			}


			/*
			*ABCD EFG project progress update.
			*/
			$projectModel = model('ProjectModel');

			$project  = $projectModel->get($project_id);

			$userMessage = "{$project->title} Has been set to complete";

			_notify('user' , [
				'message' => $userMessage,
				'href'    => _route('project:show' , $project->id),
				'category' => 'primary'
			], $project->customer_id);

			_notify('project' , [
				'message' => $userMessage,
				'href'    => _route('project:show' , $project->id),
				'category' => 'primary'
			], 0);


			$projectModel->update([
				'status' => 'completed'
			],$project->id);

			$this->addMessage("Project Progress updated!");
			
			return $latestId;

		}
	}