<?php 	

	class QuotationController extends Controller 
	{	
		private $view = 'quotation/';

		public function __construct()
		{
			$this->quote = model('QuotationModel');
		}

		public function index()
		{
			authRequired();

			$quotations = $this->quote->getAll(null , 'id desc');

			$data = [
				'title' => 'Quotation',
				'quotations' => $quotations
			];

			return $this->view('quotation/index' , $data);
		}

		public function show($id)
		{
			authRequired();
			
			$quotation = $this->quote->getWithComputation($id);

			$data = [
				'quotation' => $quotation,
				'title'     => 'Quotation'
			];

			return $this->view('quotation/show' , $data);
		}

		public function projectClassification()
		{
			if( isSubmitted() )
			{
				$post = request()->posts();

				$this->quote->saveClassification($post);

				return $this->redirect(_route('quote:projectSize'));
			}

			$data = [
				'title' => 'Project Quotation'
			];

			return $this->view( $this->view.'project_details' , $data);
		}

		public function projectSize()
		{
			if( isSubmitted() )
			{

				$post = request()->posts();

				if( !is_numeric($post['size']) || !is_numeric( $post['storey'] ) )
				{
					Flash::set("Size or storey field must be a valid number" , 'danger');
					return request()->return();
				}

				$this->quote->saveProjectSize( $post );

				return $this->redirect(_route('quote:projectAddress'));
			}

			$data = [
				'title' => 'Project Size'
			];

			return $this->view( $this->view.'project_size' , $data);
		}

		public function projectAddress()
		{

			if( isSubmitted() )
			{
				$post = request()->posts();

				$this->quote->saveProjectAddress( $post );

				return $this->redirect(_route('quote:projectSector'));
			}

			$data = [
				'title' => 'Project Address',
			];

			return $this->view( $this->view.'project_address' , $data);
		}

		public function projectSector()
		{

			if( isSubmitted() )
			{
				$sectors = request()->post('sectors');

				if( empty($sectors) ){
					Flash::set("You must select what construction sector you need on your project." , 'warning');
					return request()->return();
				}


				$this->quote->saveSector( $sectors );

				return $this->redirect(_route('quote:projectOwner'));
			}

			$sectorModel = model('ProjectSectorModel');

			$data = [
				'title' => 'Project Address',
				'sectors' => $sectorModel->dbgetAssoc('sector')
			];

			return $this->view( $this->view.'project_sector' , $data);
		}

		public function projectOwner()
		{

			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->quote->saveProjectOwner( $post );

				return $this->redirect(_route('quote:projectAttachment'));
			}

			$data = [
				'title' => 'Project Owner'
			];

			return $this->view( $this->view.'project_owner' , $data);
		}

		/*
		*Preview the quotation
		*has a function of send quotation to email
		*/
		public function create()
		{
			$quote = $this->quote->fetchInstance();
			
			$attachments = [];

			if( $quote ){
				$quote = $this->quote->getWithComputation( $quote->id);
				$attachments = $this->quote->getAttachments($quote->id);
			}

			$data = [
				'quotation' => $quote,
				'quoteDetail' => $quote->meta_values,
				'attachments' => $attachments
			];

			return $this->view( $this->view.'create' , $data);
		}

		public function projectAttachment()
		{	
			if( isSubmitted() )
			{
				$req = request();

				$quoteId = $req->post('id');
				$notes   = $req->post('notes');

				$isAttachedFile = $this->quote->addAttachment('attachments' ,$quoteId);

				$isAttachedImages = $this->quote->addAttachment('images' , $quoteId);

				$res = $this->quote->saveAttachments(['notes' => $notes , 'id' => $quoteId]);


				if($res){

					Session::set("QUOTE_COMPLETE" , true);

					Flash::set("Attachments saved");
					return $this->redirect(_route('quote:create'));
				}else{
					Flash::set("Something went wrong");
				}

			}

			$quote = $this->quote->fetchInstance();

			$data = [
				'title' => 'Project Attachments',
				'quote' => $quote
			];

			return $this->view( $this->view.'project_attachments' , $data);
		}


		public function sendToEmail()
		{

			if( isSubmitted() )
			{
				$post = request()->posts();

				$isSent = $this->quote->sendWithEmail($post['id'] , $post['email']);


				if( isset($post['sendToTheTeam']) && $post['sendToTheTeam'])
					$this->quote->sendToTeam($post['id']);

				if(!$isSent) 
				{
					Flash::set( $this->quote->getErrorString() , 'danger');
					return request()->return();
				}else
				{
					Flash::set( $this->quote->getMessageString() );

					$this->quote->stopQuotation();
					if( isset($post['returnTo']) )
						return redirect( $post['returnTo']);
					return request()->return();
				}
			}else
			{
				echo die("REQUEST ERROR.");
			}
			
		}

		/*
		*pass route
		*use _route function
		*/
		private function redirect( $route )
		{

			if( Session::check('QUOTE_COMPLETE') )
			{
				Flash::set("Quote updated!");
				return redirect( _route('quote:create') );
			}

			//return to next form
			return redirect( $route );
		}


	}