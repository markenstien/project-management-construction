<?php 	

	class IntentController extends Controller
	{

		public function __construct()
		{
			$this->intent = model('IntentModel');
		}


		public function doAction()
		{
			$req = request();

			$action = $req->input('action');

			$intentId = $req->input('intentID');

			switch($action)
			{
				case 'resetPassword':
					/*do reset password*/

					$this->user = model('UserModel');

					$intent = $this->intent->get( $intentId );
					
					if($intent) {
						$res = $this->user->updatePassword($intent->meta_id , $intent->value);
						Flash::set("Password updated!");
						return redirect( _route('sec:login') );
					}
				break;
			}
		}
	}