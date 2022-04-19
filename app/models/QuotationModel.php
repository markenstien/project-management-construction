<?php 	

	class QuotationModel extends Model
	{
		public $table = 'quotations';
		private $sessionName = 'QUOTE_MAKER';

		public function __construct()
		{
			parent::__construct();

			$this->intent = model('IntentModel');
		}


		public function stopQuotation()
		{
			Session::remove( $this->sessionName );

			/*
			*used to identify if quotation making
			*is already finished
			*/
			Session::remove( 'QUOTE_COMPLETE' );
				
		}


		public function getAll( $where  = null , $order_by = null )
		{
			$results = parent::all( $where , $order_by);

			foreach($results as $key => $row)
			{
				$row->meta_values = json_decode($row->meta_values);
			}

			return $results;
		}

		/*
		*pass array of sector ids
		*/
		public function saveSector( $sectors = [] )
		{
			$res = $this->save('SECTORS' ,$sectors);

			if(!$res){
				$this->addError("Saving Project Sector Failed!");
				return false;
			}

			$this->addMessage("Project Sector has been saved");
			return true;
		}

		public function saveProjectOwner( $projectOwner )
		{
			extract($projectOwner);

			$res = $this->save('OWNER' , [
				'first_name'      => $first_name,
				'last_name'       => $last_name,
				'email'           => $email,
				'mobile'  => $mobile,
				'notes'   => $notes
			]);

			if(!$res){
				$this->addError("Saving Project Owner Size Failed!");
				return false;
			}

			$this->addMessage("Project Owner has been saved");
			return true;
		}

		public function saveProjectAddress( $projectAddress )
		{
			extract($projectAddress);

			$res = $this->save('ADDRESS' , [
				'address' => $address,
				'landmark' => $landmark
			]);

			if(!$res){
				$this->addError("Saving Project Address Failed!");
				return false;
			}

			$this->addMessage("Project Address has been saved");
			return true;
		}

		public function saveProjectSize( $projectSize )
		{
			extract($projectSize);

			$res = $this->save('SIZE' , [
				'size' => $size,
				'storey' => $storey
			]);

			if(!$res){
				$this->addError("Saving Project Size Failed!");
				return false;
			}

			$this->addMessage("Project Size has been saved");
			return true;
		}

		public function saveClassification($projectClassification)
		{
			extract($projectClassification);

			$res = $this->save('CLASSIFICATION' , [
				'classification' => $classification,
				'type'           => $type
			]);

			if(!$res){
				$this->addError("Saving Project Classification Failed!");
				return false;
			}

			$this->addMessage("Classification has been saved");
			return true;
		}


		public function save($key , $value)
		{
			$quotation = $this->fetchInstance();

			/*
			*create if no instance of quotation
			*/
			if( !$quotation) 
			{
				$reference = $this->getInstanceReference();


				$metaValue = [
					"{$key}" => $value
				];

				parent::store([
					'reference' => $reference,
					'meta_values' => json_encode($metaValue),
					'status' => 'pending'
				]);
			}else
			{

				$newValue = $quotation->meta_values;
				$newValue->$key = $value;
				/*
				*update na lang
				*/
				parent::update([
					'meta_values' => json_encode($newValue)
				], $quotation->id);
			}

			return $this->fetchInstance();
		}


		public function getInstanceReference()
		{
			$session = Session::get($this->sessionName);

			if(!$session){
				$reference = $this->createReference();
				Session::set( $this->sessionName, $reference);
			}

			return Session::get( $this->sessionName );
		}
		/*
		*check if there is a instance of creating a quotation
		*/
		public function fetchInstance()
		{
			/*this will save and return a reference*/
			
			$instanceReference = $this->getInstanceReference();

			$quotation =  parent::single([
				'reference' => $instanceReference
			]);

			if(!$quotation)
				return false;

			$metaValue = $quotation->meta_values = json_decode($quotation->meta_values);

			if( isset($metaValue->SECTORS) )
			{
				$this->sectorModel = model('ProjectSectorModel');

				$sectors = $this->sectorModel->getWhereIn('id' , $metaValue->SECTORS );

				$metaValue->SECTOR_COSTS = $sectors;
			}

			return $quotation;
		}


		public function get($id)
		{

			$quotation =  parent::get($id);

			if(!$quotation)
				return false;

			$metaValue = $quotation->meta_values = json_decode($quotation->meta_values);

			if( isset($metaValue->SECTORS) )
			{
				$this->sectorModel = model('ProjectSectorModel');

				$sectors = $this->sectorModel->getWhereIn('id' , $metaValue->SECTORS );

				$metaValue->SECTORS = $sectors;
			}

			return $quotation;
		}


		public function single(array $where, $fields = '*' , $orderBy = null)
		{
			$quotation = parent::single($where, $fields, $orderBy);

			if(!$quotation)
				return false;

			$metaValue = $quotation->meta_values = json_decode($quotation->meta_values);

			if( isset($metaValue->SECTORS) )
			{
				$this->sectorModel = model('ProjectSectorModel');

				$sectors = $this->sectorModel->getWhereIn('id' , $metaValue->SECTORS );

				$metaValue->SECTORS = $sectors;
			}

			return $quotation;
		}

		public function createReference()
		{
			$reference = null;

			while( is_null($reference) )
			{
				$reference = random_number(12);

				$isExists = parent::single([
					'reference' => $reference
				]);

				//reset the exist if reference already exists
				if( $isExists)
					$reference = null;
			}

			return $reference;
		}

		public function getWithComputation($id)
		{
			$quotation = $this->get($id);

			$retVal = [
				'totalCost' => 0,
				'sectors'    => []
			];

			// dd($quotation);

			$totalCost = 0;

			if( isset($quotation->meta_values->SECTORS) )
			{
				$sectors = $quotation->meta_values->SECTORS;

				$size = $quotation->meta_values->SIZE;
				$classification = $quotation->meta_values->CLASSIFICATION;

				foreach($sectors as $sectorKey => $sector)
				{
					$cost = $this->computeSectorCostByFloorAndSQM(...[
						$sector->price_per_sqmtr , $size->size , $size->storey , 
						$classification->classification,$classification->type
					]);

					$sector->cost = $cost;

					$totalCost += $cost;
				}

				$quotation->totalCost = $totalCost;
			}

			return $quotation;
		}


		public function computeSectorCostByFloorAndSQM($pricePerSqm , $sqm , $storey , $classification , $type)
		{
			/*compute per sqm*/
			$perSqmPriceCost = floatval($pricePerSqm * $sqm);
			/*compute by floor*/
			$perSqmPriceCostPlusStrorey = $perSqmPriceCost * $storey;

			if( $storey > 1)
			{
				/*get discount*/
				$discountForFloors = $perSqmPriceCostPlusStrorey * .19;
			}else{
				$discountForFloors = 0;
			}
			
			$basePrice = $perSqmPriceCostPlusStrorey - $discountForFloors;

			if( isEqual($classification , 'Commercial') )
				$basePrice = ($basePrice * .8) + $basePrice;

		 	if ( !isEqual($type , 'state_clean') )
		 		$basePrice = $basePrice - ($basePrice * .25);

		 	return $basePrice;
		}

		public function addAttachment($fileName , $quoteId)
		{
			$this->fileModel = model('FileModel');

			return $this->fileModel->upload($fileName , [
				'metaKey' => 'QUOTATION',
				'metaId'  => $quoteId
			]);
		}

		public function saveAttachments($attachment)
		{
			extract($attachment);

			$res = $this->save('ATTACHMENT' , [
				'notes' => $notes,
			]);

			if(!$res){
				$this->addError("Saving Attachments Failed!");
				return false;
			}

			$this->addMessage("Attachments has been saved");
			return true;
		}

		public function getAttachments($id)
		{
			$this->fileModel = model('FileModel');

			$results = $this->fileModel->dbgetAssoc('display_name' , [
				'meta_key' => 'QUOTATION',
				'meta_id' => $id
			]);


			return $results;
		}


		public function sendWithEmail($id , $email)
		{
			$quotationWithComputation = $this->getWithComputation($id);

			if(!$quotationWithComputation){
				$this->addError("Quotation with computation does not exists.");
				return false;
			}

			//check email if valid

			if( !is_email($email) )
			{
				$this->addError("Invalid Email");
				return false;
			}

			$quotationEmail = $this->quotationHTML($quotationWithComputation);

			//prepare result to send on email
			$quotationEmailWrap = wEmailComplete( $quotationEmail );

			$owner = $quotationWithComputation->meta_values->OWNER;

			_mail($email , "Quotation" , $quotationEmailWrap , $owner->first_name);


			$sent = $quotationWithComputation->sent ?? 0;

			$isOk = parent::update([
				'sent' => ++$sent
			] , $quotationWithComputation->id);
			

			if(!$isOk){
				$this->addError("FATAL ERROR , SOMETHING WENT WRONG WITH OUR DATABASE!!");
				return false;
			}

			$this->addMessage("Email sent to : {$email} , quotation has been sent {$sent} times");
			return true;
		}


		public function sendToTeam($id)
		{
			$quotationWithComputation = $this->getWithComputation($id);

			if(!$quotationWithComputation){
				$this->addError("Quotation with computation does not exists.");
				return false;
			}

			$owner = $quotationWithComputation->meta_values->OWNER;

			$quotationEmail = $this->quotationHTML($quotationWithComputation);
			
			/*
			*Prepare Email for PAINTMAN TEAM
			*/

			$paintmanTeamEmail = "<p> Good day Paintman team!</p>";
			$paintmanTeamEmail .= "<p> <strong>We just have an inquiry!</trong> </p>";
			$paintmanTeamEmail .= "<p> Quotation has been requested by MR/MRS. {$owner->first_name} </p>";
			$paintmanTeamEmail .= "<h3>Check Out full details below.</h3>";
			$paintmanTeamEmail .= $quotationEmail;


			$paintmanTeamEmailWrapper = wEmailComplete($paintmanTeamEmail);

			$bcc = [];

			_mail(MAILER_AUTH['username'] , "Quotation Inquiry" , 
				$paintmanTeamEmailWrapper , null , null, $bcc);

			return true;
		}

		/*
		*Pass Object quotationWithComputation
		*/
		public function quotationHTML($quote)
		{

			if( !$quote )
				return '';

			$classification = $quote->meta_values->CLASSIFICATION;
			$address = $quote->meta_values->ADDRESS;
			$size = $quote->meta_values->SIZE;
			$sectors = $quote->meta_values->SECTORS;
			$owner = $quote->meta_values->OWNER;
			$image = URL.DS.'public/logo_white.png';


			$projectSetorsTRHTML = '';

			$projectSectorTotalCost = 0;

			foreach($sectors as $sectorKey => $sector)
			{
				$costHTML = toMoney($sector->cost);
				$projectSectorTotalCost += $sector->cost;

				$projectSetorsTRHTML .= <<<EOF
					<tr>
						<td>{$sector->sector}</td>
						<td>PHP {$costHTML}</td>
					</tr>
				EOF;
			}

			$totalCostHTML = toMoney($projectSectorTotalCost);

			$html = <<<EOF
				<div class="text-center" style="text-align: center;">
					<h4 style="margin: 10px 0px;">{$classification->classification} Project Quotation</h4>
					<p style="margin: 10px 0px;">Reference : #{$quote->reference}</p>
				</div>
				<table class="table" style="width: 100%;border-spacing: 10px;border-collapse: separate;background: #fff;">
					<tbody>
						<tr>
							<td><h3 style="margin: 10px 0px;">Owner</h3></td>
						</tr>
						<tr>
							<td>Name : </td>
							<td>{$owner->first_name} {$owner->last_name}</td>
						</tr>
						<tr>
							<td>Email : </td>
							<td>{$owner->email}</td>
						</tr>
						<tr>
							<td>Contact : </td>
							<td>{$owner->mobile}</td>
						</tr>
						<!--=== PROJECT === -->
						<tr>
							<td><h3 style="margin: 10px 0px;">Project</h3></td>
						</tr>
						<tr>
							<td>Type : </td>
							<td>{$classification->type}</td>
						</tr>
						<tr>
							<td>Classification : </td>
							<td>{$classification->classification}</td>
						</tr>
						<tr>
							<td>Size : </td>
							<td>{$size->size} SQM</td>
						</tr>
						<tr>
							<td>Storey : </td>
							<td>{$size->storey}</td>
						</tr>
						<!--=== PROJECT SECTORS === -->
						<tr>
							<td><h3 style="margin: 10px 0px;">Project Sectors</h3></td>
						</tr>
						{$projectSetorsTRHTML}
						<!--=== ADDRESS === -->
						<tr>
							<td><h3 style="margin: 10px 0px;">Address</h3></td>
						</tr>
						<tr>
							<td>Address: </td>
							<td>
								<address style="width:350px">{$address->address}</address>
							</td>
						</tr>
						<tr>
							<td>Landmark: </td>
							<td>{$address->landmark}</td>
						</tr>
						<tr>
							<td colspan="2">
								<h3 style="margin: 10px 0px;">Project Cost Estimation : PHP {$totalCostHTML}</h3>
							</td>
						</tr>
					</tbody>
				</table>
			EOF;

			return $html;
		}
	}