<?php
	class CustomerController extends Controller
	{

		public function __construct()
		{
			$this->user = model('UserModel');
		}	


		public function create()
		{

			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->user->createCustomer( $post );

				if( !$res )
					Flash::set( $this->user->getErrorString() , 'danger');
			}


			$data = [
				'title' => 'Customer'
			];

			return $this->view('customer/create' , $data);
		}
	}