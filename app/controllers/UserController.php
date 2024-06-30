<?php 	

	class UserController extends Controller
	{

		public function __construct()
		{
			$this->user = model('UserModel');
		}


		public function index()
		{
			authRequired();

			if(isEqual(whoIs('type'), 'customer')) {
				return redirect('DashboardController');
			}

			$users = $this->user->all( null , "FIELD(type, 'customer' , 'management') asc");
			$data = [
				'title' => 'Users',
				'users' => $users
			];

			return $this->view('user/index' , $data);
		}

		public function login()
		{
			$post = request()->posts();

			$user = $this->user->authenticate($post['email'] , $post['password']);

			if( !$user ){
				Flash::set( $this->user->getErrorString() , 'danger');
				return request()->return();
			}


			$user = whoIs();

			//temporary
			if( $user) 
				return redirect('DashboardController/');
		}

		public function register()
		{
			$post = request()->posts();

			$res = $this->user->register($post);

			Flash::set("Successfully registered!");

			if(!$res){
				Flash::set( $this->user->getErrorString() , 'danger');
				return request()->return();
			}

			return redirect("SecurityController/login");
		}

		public function editSingle($userId)
		{
			authRequired();
			
			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->user->update([
					$post['field'] => $post['value']
				] , $post['id'] );


				$this->user->restartState();
				
				Flash::set("Profile updated");

				return redirect( _route('profile:index' , $post['id']) );
			}

			$user = $this->user->get($userId);

			$field = request()->input('field');
			$id = $userId;

			$fieldValue = $user->$field;

			$fieldLabel = ucwords(str_replace('_' , ' ' , $field));

			if( isEqual($field , 'password') )
				$fieldValue = '';

			$data = [
				'title' => 'Edit Single field',
				'input' => [
					'field' => $field,
					'id'    => $id,
					'value' => $fieldValue,
					'fieldLabel' => $fieldLabel
				],

				'userId' => $userId
			];


			return $this->view('user/edit_single' , $data);
		}

		public function editProfile()
		{
			$user = whoIs();


			if( isSubmitted() )
			{
				$profileUpload = upload_image('profile' , PATH_UPLOAD);

				if( !isEqual( $profileUpload['status'] , 'success') )
				{
					Flash::set("Profile upload failed" , 'danger');
					return request()->return();
				}

				$this->user->update([
					'profile' =>  GET_PATH_UPLOAD.'/'.$profileUpload['result']['name']
				], $user->id);

				$this->user->restartState();

				return redirect('ProfileController');
			}
			$data = [
				'title' => $user->first_name,
				'user' => $user
			];

			return $this->view('user/edit_profile' , $data);
		}


		public function overview($userId)
		{
			$user = $this->user->get($userId);

			$data = [
				'title' => 'User Overview',
				'user' => $user
			];


			if( isEqual($user->type , 'customer') )
			{
				//load projects;

				$this->projectModel = model('ProjectModel');


				$projects = $this->projectModel->getByCustomer( $userId );

				$data['projects'] = $projects;
			}

			return $this->view('user/overview' , $data);
		}

		public function create()
		{

			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->user->store($post);

				if(!$res){
					Flash::set( $this->user->getErrorString() , 'danger');
					return request()->return();
				}

				Flash::set( $this->user->getMessageString() );
				return redirect( _route('user:index') );
			}

			$page = $_GET['staff'] ?? '';

			$data = [
				'title' => 'Create Account'
			];

			return $this->view('user/create' , $data);
		}

		public function createByAdmin()
		{
			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->user->createByAdmin($post);

				if(!$res){
					Flash::set( $this->user->getErrorString() , 'danger');
					return request()->return();
				}

				Flash::set( $this->user->getMessageString() );
				return redirect( _route('user:index') );
			}
		}

		public function sendAuthToEmail($userId)
		{
			$this->user->sendAuthToEmail($userId);

			Flash::set("User Authentication sent!");

			return request()->return();
		}
	}