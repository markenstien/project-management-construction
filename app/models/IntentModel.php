<?php 	

	class IntentModel extends Model
	{
		public $table = 'intents';

		public static $FORGET_PASSWORD = 'forget_password';

		public function forgetPasswordRequest($email)
		{

			$this->userModel = model('UserModel');


			$user = $this->userModel->getByEmail($email);

			if(!$user) {
				$this->addError("No user associated with this {$email} email.");
				return false;
			}


			$tmpPassword = random_number(4);

			$res = parent::store([
				'intent' => self::$FORGET_PASSWORD,
				'meta_key' => 'USER',
				'meta_id'  => $user->id,
				'value'    => $tmpPassword,
				'status'   => 'pending'
			]);

			$href = makeRequest(_route('intent:doAction',['action' => 'resetPassword' , 'intentID' => $res]));

			$link = "<a href='{$href}'>Reset Password Link</a>";

			$message = '<p>You have requested a password request</p>';
			$message .= "<p>Your temporary password will be <strong>{$tmpPassword}</strong></p>";
			$message .= "<p>Click this link  to reset your password {$link}</p>";
			$message .= "<p>Please ignore if you did not request reset password on your account</p>";

			$emailTMP = wEmailComplete($message);

			_mail($email , 'RESET PASSWORD' , $emailTMP);

			return true;
		}


		public function get($intentId)
		{
			$intent = parent::get($intentId);

			if(!$intent){
				$this->addError("Intent does not exists");
				return false;
			}

			return $intent;
		}
	}