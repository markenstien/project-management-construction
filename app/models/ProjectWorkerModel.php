<?php 

	class ProjectWorkerModel extends Model
	{
		public $table = 'project_workers';

		
		public function get($id)
		{
			$this->db->query(
				"SELECT work.* , first_name , last_name , email , phone FROM {$this->table} as work
					LEFT JOIN users as user 
					on work.user_id = user.id
					WHERE work.id = '$id' "
			);

			return $this->db->single();
		}
		
		public function addAndCreateWorker($projectId , $worker)
		{

			$this->userModel = model('UserModel');

			extract($worker);

			$workerId = $this->userModel->createWorker([
				'first_name' => $first_name,
				'last_name' => $last_name,
				'phone'     => $phone,
			]);

			if( !$workerId )
			{
				$this->addError($this->userModel->getErrorString());
				return false;
			}

			$res = parent::store([
				'project_id' => $projectId,
				'user_id' => $workerId,
				'role' => $role,
				'description' => $description,
				'on_board_date' => $on_board_date,
				'salary' => $salary,
			]);

			_notify('project' , [
				'href' => _route('project:show' , $projectId , ['page' => 'workers']),
				'message' => "{$first_name} has been onboarded to the project"
			], $project->id);

			return $res;
		}

		public function getByProject($projectId)
		{
			$this->db->query(
				"SELECT work.* , first_name , last_name , email , phone FROM {$this->table} as work
					LEFT JOIN users as user 
					on work.user_id = user.id
					WHERE project_id = '{$projectId}' "
			);

			return $this->db->resultSet();
		}
	}