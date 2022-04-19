<?php 	

	class ForgetPasswordController extends Controller
	{
		public function index()
		{
			$data = [
				'title' => 'Forget Password'
			];

			return $this->view('forget_password/index' , $data);
		}

		public function sendRequest()
		{
			$this->intent  = model('IntentModel');

			$post = request()->posts();

			$req = $this->intent->forgetPasswordRequest( $post['email']);

			Flash::set("Password reset request succesfull");

			if( !$req )
			{
				Flash::set( $this->intent->getErrorString() , 'danger');
				return redirect( _route('sec:login') );
			} 

			return redirect( _route('sec:login') );
		}
	}