<?php 	

	class SecurityController extends Controller
	{

		public function index()
		{
			$this->login();
		}

		public function login()
		{
			$data = [
				'title' => 'Sign-in'
			];

			return $this->view('security/login' , $data);
		}

		public function register()
		{	
			$data = [
				'title' => 'Sign-up'
			];

			if(isset( $_GET['isInvited'] ))
			{
				$this->invitation = model('ProjectInvitationModel');

				$invitation = $this->invitation->get( unseal($_GET['isInvited']) );
				
				if($invitation){
					$data['email'] = $invitation->email;
				}
				
			}


			return $this->view('security/register' , $data);
		}


		public function logout()
		{
			$auth = new Auth();


			$res = $auth->stop();

			if($res){
				Flash::set("Logged out!");
				return redirect("SecurityController/login");
			}else{
				Flash::set("Logout failed!");
				return request()->return();
			}
		}
	}