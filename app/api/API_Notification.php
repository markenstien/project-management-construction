<?php 	

	class API_Notification extends Controller
	{

		public function __construct()
		{
			$this->notification = model('NotificationModel');
		}

		public function getUserNotification()
		{
			$input = request()->inputs();
			
			$notifications = $this->notification->getAll([
				'meta_id' => whoIs('id'),
				'meta_key' => 'USER'
			],'id desc' , 10);

			echo _api_response( $notifications );
		}
	}