<?php 	

	class LandingController extends Controller
	{

		public function index()
		{
			$data = [
				'title' => 'Welcome to '.COMPANY_NAME
			];
			return $this->view('pages/landing' , $data);
		}

		public function quotationSent()
		{
			return $this->view('pages/quote_sent');
		}


		public function about()
		{
			$data = [
				'title' => 'About ' . COMPANY_NAME
			];

			return $this->view('pages/about' , $data);
		}

		public function portfolio()
		{
			$data = [
				'title' => 'Our Projects'
			];

			return $this->view('pages/portfolio' , $data);
		}

		public function services()
		{
			$data = [
				'title' => 'Our Services'
			];

			return $this->view('pages/services' , $data);
		}

		public function contact()
		{
			$data = [
				'title' => 'Contact',
				'page'  => 'contact'
			];

			return $this->view('pages/contact' , $data);
		}

		public function bot() {
			$data = [
				'title' => 'Contact',
				'page'  => 'contact'
			];

			return $this->view('pages/bot' , $data);
		}
	}