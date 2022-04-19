<?php

	class NotificationModel extends Model
	{
		public $table = 'notifications';

		public function getAll($where , $orderBy , $limit)
		{
			$results = parent::all( $where , $orderBy , $limit);

			return $results;
		}
	}