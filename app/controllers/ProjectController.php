<?php 
	class ProjectController extends Controller
	{

		public function __construct()
		{
			authRequired();

			$this->project = model('ProjectModel');

			$this->auth = whoIs();
		}

		public function index()
		{
			if( isEqual($this->auth->type, 'customer') )
			{
				$projects = $this->project->all(['customer_id' => $this->auth->id] , 'id desc');
			}else
			{
				$projects = $this->project->all(null , 'id desc');
			}
			
			$data = [
				'projects' => $projects,
				'title'    => 'Project'
			];

			return $this->view('project/index' , $data);
		}

		public function createByQuote()
		{
			$req = request();

			$this->quotationModel = model('QuotationModel');

			$quotation = $this->quotationModel->single([
				'reference' => $req->input('reference')
			]);

			if(!$quotation){
				Flash::set("No Quotation found!" , 'danger');
				return redirect( _route('quote:index') );
			}

			$quotation = $this->quotationModel->getWithComputation($quotation->id);

			Session::set('QUOTE-CREATE' , $quotation);

			return redirect( _route('project:create','isQuotation') );
		}

		public function edit($id)
		{
			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->project->update($post , $post['id']);

				if(!$res) {
					Flash::set( $this->project->getErrorString() , 'danger');
					return request()->return();
				}

				Flash::set( $this->project->getMessageString() );

				return redirect( _route('project:show' , $post['id']) );
			}

			$project = $this->project->get($id);

			$data = [
				'title' => 'Project Edit',
				'project' => $project
			];

			return $this->view('project/edit' , $data);
		}
		public function create()
		{	

			$quotation = $this->isQuotationCreate();
			
			if( isSubmitted() )
			{
				$post = request()->posts();

				/*convert cash*/

				$post['cost'] = strConvertCashToDecimal( $post['cost'] );
				$post['budget'] = strConvertCashToDecimal( $post['budget'] );
				$post['max_budget'] = strConvertCashToDecimal( $post['max_budget'] );

				$res = $this->project->create( $post );
				
				Flash::set( $this->project->getMessageString());
				if(!$res)
					Flash::set( $this->project->getErrorString() , 'danger');


				if( $quotation )
				{
					$quotationModel = model('QuotationModel');

					$quotationModel->update([
						'status' => 'finished'
					], $quotation->id);
				}
				return redirect(_route('project:addCustomer' , ['reference' => $this->project->getInstance('reference') ]));
			}


			// $type = 'no_quotation';
			$userModel = model('UserModel');
			$customers = $userModel->getCustomers();

			$data = [
				'title' => 'Projects',
				'customers' => $customers
			];


			// if($quotation)
			// {
			// 	$cost = 0;
			// 	$budget = 0;
			// 	$maxBudget = 0;
			// 	$classification = null;
			// 	$type = null;
			// 	$address = null;
			// 	$landmark = null;


			// 	/*get project cost by sectors*/

			// 	$sectors = $quotation->meta_values->SECTORS;
			// 	$size = $quotation->meta_values->SIZE;
			// 	$classificationGroup = $quotation->meta_values->CLASSIFICATION;
			// 	$addressGroup = $quotation->meta_values->ADDRESS;

			// 	// dd($quotation);

			// 	foreach($sectors as $key => $sector) {
			// 		$cost += $sector->cost;
			// 	}	

			// 	$classification = $classificationGroup->classification;
			// 	$type = $classificationGroup->type;

			// 	$address = $addressGroup->address;
			// 	$landmark = $addressGroup->landmark;

			// 	$budget = toMoney($cost - ($cost * .50));
			// 	$maxBudget = toMoney($cost - ($cost * .30));
			// 	$cost = toMoney($cost);

			// 	$storey = $size->storey;
			// 	$sqm    = $size->size;

			// 	$data['quotation'] = compact([
			// 		'cost','budget','maxBudget',
			// 		'classification', 'type',
			// 		'address' , 'landmark',
			// 		'storey' , 'sqm'
			// 	]); 
			// }

			return $this->view('project/create' , $data);
		}


		private function isQuotationCreate()
		{

			$req = request();

			$module = $req->inputs();

			$referrer = strTextNumberOnly($req->referrer());

			$this->referrer = $referrer;

			$projectRoute = strTextNumberOnly(URL.DS._route('project:index'));



			if( isEqual( $referrer , $projectRoute) ){
				Session::remove('QUOTE-CREATE');
			}

			if( Session::check('QUOTE-CREATE') )
				return Session::get('QUOTE-CREATE');

			return false;
		}

		private function quotationCreateStop()
		{
			Session::remove('QUOTE-CREATE');
		}

		public function addCustomer()
		{	
			/*
			*If owner is selected is saved on our file
			*/
			if( isSubmitted() || request()->input('isPost') )
			{
				// $quotation = $this->isQuotationCreate();

				$req = request();

				$customerId = $req->input('customer_id');
				$projectId = $req->input('project_id');

				$res = $this->project->addCustomer($customerId , $projectId);

				Flash::set( "Customer added !");

				if(!$res){
					Flash::set("Something went wrong!");
					return redirect()->return();
				}

				// if($quotation)
				// {
				// 	$project = $this->project->get($projectId);
				// 	return redirect( _route('project:addSectors' , ['reference' => $project->reference]) );
				// }
				return redirect( _route('project:show' , $projectId) );
			}

			$params = request()->inputs();

			$project = $this->project->single([
				'reference' => $params['reference']
			]);

			$formView = $_GET['form_view'] ?? 'new_customer';

			$data = [
				'title' => ' Add Customer to project ' . $project->reference,
				'project' => $project,
				'formView'   => $formView
			];

			if( !isEqual($formView , ['new_customer' , 'customer_on_file']) )
				echo die("Invalid Request");

			if( isEqual($formView , 'customer_on_file') )
			{
				//load user model
				$userModel = model('UserModel');
				$data['customers'] = $userModel->getCustomers(['orderby' => 'first_name']);
			}

			/*
			*if creating from quotation
			*/
			$quotation = $this->isQuotationCreate();

			if( $quotation ){
				$data['owner'] = $quotation->meta_values->OWNER;
			}

			return $this->view('project/create_customer' , $data);
		}


		public function addSectors()
		{

			if( isSubmitted() )
			{
				$post = request()->posts();


				if( !isset($post['sector_id']) )
				{
					Flash::set("No Project Sector Found!");
					return request()->return();
				}

				$isErrors = [];


				$projectSectorsStructure = [];


				foreach($post['sector_id'] as $sectorIndex => $sectorId)
				{
					$budget = $post['budget'][$sectorIndex];
					$maxBudget = $post['max_budget'][$sectorIndex];

					$projectSectorsStructure[] = [
						'sector_id' => $sectorId,
						'budget'    => $budget,
						'max_budget'    => $maxBudget
					];
				}

				$this->project->addSectorMultiple($projectSectorsStructure , $post['project_id']);

				Flash::set("Welcome to your project overview");

				return redirect(_route('project:show' , $post['project_id']));
			}

			$params = request()->inputs();

			$project = $this->project->single([
				'reference' => $params['reference']
			]);

			$quotation = $this->isQuotationCreate();

			$data = [
				'sectors' => $quotation->meta_values->SECTORS,
				'projectId' => $project->id,
				'title'  => 'Add Project Sectors'
			];

			return $this->view('project/add_sector' , $data);

			// $formView = $_GET['form_view'] ?? 'new_customer';
		}
		public function addCustomerCreate()
		{
			$post = request()->posts();

			$res = $this->project->addCustomerCreate([
				'first_name' => $post['first_name'],
				'last_name' => $post['last_name'],
				'email' => $post['email'],
				'phone' => $post['phone'],
			], $post['id']);

			Flash::set( $this->project->getMessageString() );
			
			if(!$res){
				Flash::set( $this->project->getErrorString() , 'danger');
				return request()->return();
			}

			return redirect( _route('project:show' , $res) );
		}

		public function show($id)
		{
			$project = $this->project->get($id);
			$projectSectors = $this->project->getSectors( $id );
			$expenses = $this->project->getExpenses( $id );
			$workers = $this->project->getWorkers($id);
			$progress = $this->loadProgress($id);
			$expensesModel = model('ExpensesModel');
			$total = $expensesModel->getTotal($id);

			$data = [
				'title' => 'Project Overview',
				'owner' => $this->project->getOwner( $id ),
				'projectSectors' => $projectSectors,
				'expenses'  => $expenses,
				'expensesTotal' => $expensesModel->getTotal($id),
				'workers'  => $workers,
				'currentProgress' => $progress['currentProgress']
			];

			if( !isset($_GET['folder']) )
			{
				$filesAndFolders = $this->project->getFilesAndFolders( $id );
				$data['filesAndFolders'] = $filesAndFolders;
			}else
			{
				$folder = model('FolderModel');
				$folderFilesAndFolders = $folder->get($_GET['folder']);
				$data['folderFilesAndFolders'] = $folderFilesAndFolders;
			}
			
			$data['project'] = $project;

			$page = $_GET['page'] ?? 'overview';

			$data['page'] = $page;

			switch( strtolower($page) )
			{
				case 'files':
					return $this->view('project/file_gallery' , $data);
				break;
				
				case 'expenses':
					return $this->view('project/expenses' , $data);
				break;

				case 'sectors':
					return $this->view('project/sectors' , $data);
				break;


				case 'workers':
					return $this->view('project/workers' , $data);
				break;

				case 'progress':

					// $response = $this->loadProgress($id);

					$data['progress'] = $progress['progress'];

					$data['currentProgress'] = $progress['currentProgress'];

					return $this->view('project/progress' , $data);
				break;

			}

			return $this->view('project/overview' , $data);
		}

		private function loadProgress( $projectId )
		{
			$this->progressModel = model('ProgressModel');


			$currentProgress = $this->progressModel->getLatest($projectId);


			// dd([
			// 	'progress' => $this->progressModel->getAll( $projectId ),
			// 	'currentProgress' => $currentProgress
			// ]);

			return [
				'progress' => $this->progressModel->getAll( $projectId ),
				'currentProgress' => $currentProgress
			];
		}


		public function updateStatus()
		{
			$post = request()->posts();

			$status = $post['status'];
			
			$this->project->updateStatus( $post['id'] , $post['status']);

			Flash::set("Project status updated!");

			if( ! isEqual( $status , 'delete') )
				return redirect( _route('project:show' , $post['id']) );
			
			return redirect( _route('project:index') );
		}
	}