<?php 	

	class UserModel extends Model
	{
		public $table = 'users';


		public function createByAdmin($user)
		{
			$res = $this->store($user);

			if(!$res)
				return false;

			$verificationTest = $this->verifyUser($res);

			if(!$verificationTest)
				return false;
			
			return $res;
		}

		public function verifyUser($userId)
		{
			$res = parent::update([
				'is_verified' => 1
			] , $userId);

			if(!$res) {
				$this->addError("User verification failed!");
			}
			$this->addMessage("User has been verified");
			return $res;
		}
		public function store($user)
		{
			extract($user);

			$isExist = $this->getByEmail( $email );

			if($isExist)
			{
				$this->addError("Email is already in used.");
				return false;
			}

			$res = parent::store($user);

			if(!$res){
				$this->addError("User create failed");
				return false;
			}

			$this->addMessage("Customer Added");

			if( isEqual($type , 'customer') )
				$this->addMessage("Staff Added");

			return $res;
		}

		public function get($id)
		{
			$user = parent::get($id);
			
			if(!$user){
				$this->addError("User not found!");
				return false;
			}

			$user->full_name = $user->first_name . ' ' . $user->last_name;

			return $user;
		}

		public function getCustomers($params = [])
		{	
			$results = parent::dbgetAssoc('first_name', [
				'type' => 'customer'
			]);


			foreach($results as $key => $res)
			{
				$res->full_name = $res->first_name . ' ' . $res->last_name;
			}

			return $results;
		}


		public function createWorker($worker)
		{
			extract($worker);

			if( isset($worker['email']) && !empty($worker['email']))
			{
				$userExist = $this->getByEmail( $email );

				if( $userExist ){
					$this->addError("Email is already used.");
					return false;
				}
			}

			$password = random_number(4);

			$userId = parent::store([
				'first_name' => $first_name,
				'last_name'  => $last_name,
				'email' => $email ?? '',
				'type'  => 'management',
				'access' => 'staff',
				'phone'  => $phone,
				'password' => $password,
				'is_verified' => 1
			]);

			if( !$userId ){
				$this->addError("Creating Worker Failed!");
				return false;
			}

			return $userId;
		}	

		public function createCustomer($customer)
		{
			extract($customer);

			$userExist = $this->getByEmail( $email );

			if( $userExist ){
				$this->addError("Email is already used.");
				return false;
			}

			$password = random_number(4);

			$userId = parent::store([
				'first_name' => $first_name,
				'last_name'  => $last_name,
				'email' => $email,
				'type'  => 'customer',
				'access' => 'client',
				'phone'  => $phone,
				'password' => $password,
				'is_verified' => 1
			]);

			if( !$userId ){
				$this->addError("Creating Customer Failed!");
				return false;
			}

			$this->user = parent::get($userId);
			
			return $userId;
		}
		public function changePassword($id , $password)
		{
			$res = parent::update([
				'password' => $password
			], $id);

			if($res){
				$this->addMessage("Password has been udpated!");
				return true;
			}
			$this->addError("Password updated Failed!");
			return false;
		}

		public function changePasswordRequest($email)
		{
			$this->intent = model('IntentModel');

			$user = $this->getByEmail($email);

			if( !$user ){
				$this->addError("User {$email} doest not exists");
				return false;
			}

			$password = random_number(6);

			$intentId = $this->intent->create([
				'intent' => 'CHANGE_PASSWORD',
				'value'  => [
					'user_id' => $user->id,
					'new_password' => $password,
					'link'   => ''
				]
			]);
					
			$href = URL.DS.'intentController/takeAction/'.$intentId;

			$link ="<a href='{$href}'>link</a>";

			$message = "<p>";
			$message .= "Good day {$user->first_name}! <br/>";
			$message .= "You requested a change password to your account.<br/>";
			$message .= "{$password} will be your temporary password.<br/>";
			$message .= "Follow this {$link} to complete the request.<br/>";

			$emailTemplate = wEmailComplete( $message );

			return true;
		}

		public function register($post)
		{
			$today = now();

			$userWithSameEmail = $this->getByEmail($post['email']);

			if($userWithSameEmail){
				$this->addError("'{$post['email']}' is already taken.");
				return false;
			}

			$userId = parent::store([
				'first_name' => $post['first_name'],
				'last_name'  => $post['last_name'],
				'email'      => $post['email'],
				'password'      => $post['password'],
				'is_verified' => false,
				'created_at'  => $today
			]);

			$this->addMessage("User {$post['first_name']} successfully registered");

			return $userId;
		}

		public function getByEmail($email)
		{
			return parent::single([
				'email' => $email
			]);
		}


		public function updateType($type , $userId)
		{
			$res = parent::update([
				'type' => $type
			], $userId);

			if(!$res) {
				$this->addError("Something went wrong");
				return false;
			}
			
			$restartState = $this->restartState();

			$this->addMessage("User has been updated to {$type} ");
			return true;
		}

		/*
		*For now key is the email
		*/
		public function authenticate($key , $secret)
		{
			$user = $this->getByEmail($key);


			if(!$user) {
				$this->addError("User not found");
				return false;
			}

			if( !isEqual( $user->password , $secret ) )
			{
				$this->addError("Incorrect Password");
				return false;
			}

			$this->user = $user;


			return $this->startSession($user->id);
		}


		public function startSession($userId)
		{
			$user = $this->get($userId);

			$auth = new Auth();

			$auth->set($user);

			if( empty(whoIs()) ){
				$this->addError("Session did not start");
				return false;
			}

			return true;
		}


		public function restartState()
		{
			$userId = whoIs('id');

			return $this->startSession($userId);
		}


		public function updatePassword($userId , $password)
		{
			$res = parent::update([
				'password' => $password
			] , $userId);

			if($res){
				$this->addMessage("Password changed");
				return true;
			}
			$this->addError("Password update failed");
			return false;
		}

		public function sendAuthToEmail($userId)
		{
			$user = parent::get($userId);
			
			if( !$user){
				$this->addError("Invalid Username");
				return false;
			}

			$url = URL.DS.'SecurityController/login';

			$link = "<a href='{$url}'> ".COMPANY_NAME." </a>";

			$message ="<p>Good day {$user->first_name}!</p>";
			$message .="<p> Your account authentication for {$link}</p>";
			$message .= <<<EOF
				<table>
					<tr>
						<td>Username/Email : {$user->email}</td>
						<td>Password : {$user->password}</td>
					</tr>
				</table>
			EOF;

			$emailMessageHTML = wEmailComplete($message);

			_mail($user->email , 'ACCOUNT INFORMATION' , $emailMessageHTML);

			return true;
		}
	}