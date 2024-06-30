<?php 

	class ProfileController extends Controller
	{

		public function __construct()
		{
			authRequired();

			$this->auth = whoIs();
			$this->userModel = model('UserModel');
		}

		public function index( $userId = null)
		{

			if( !is_null($userId) )
			{
				$user = $this->userModel->get( $userId );
			}else
			{
				$user = $this->userModel->get( $this->auth->id );
			}

			$data = [
				'title' => 'Profile',
				'user'  => $user,
				'isOwnerAuth' => false
			];

			if(whoIs('id') == $user->id) {
				$data['isOwnerAuth'] = true;
			}
			
			return $this->view('profile/index' , $data);
		}
	}