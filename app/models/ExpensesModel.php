<?php 	

	class ExpensesModel extends Model
	{
		public $table = 'expenses';



		public function store($expensesData)
		{
			extract($expensesData);

			$errors = [];

			if( ! is_numeric($amount) )
				$errors[] = " Invalid Amount ";

			if( ! is_numeric($budget) )
				$errors[] = " Invalid Budget ";

			if( ! is_numeric($max_budget) )
				$errors[] = " Invalid Max Budget ";


			if(!empty($errors))
			{
				$this->addError( implode(',' , $errors) );
				return false;
			}
			$res = parent::store($expensesData);

			//check amount validity
			if(!$res){
				$this->addError("Expenses update failed");
				return false;
			}

			_notify('project' , [
				'href' => _route('project:show' , $project_id , ['page' => 'expenses']),
				'message' => "Project expenses has been updated",
			] , $project_id);

			return $res;
		}
		public function getByProject($projectId)
		{
			$sector = model('ProjectSectorModel');

			$this->db->query(
				"SELECT ex.* , sector 
					FROM {$this->table} as ex 
					LEFT JOIN {$sector->table} as sector
					ON sector.id = ex.sector_id
					WHERE project_id = '{$projectId}' 
					order by ex.id desc"
			);

			return $this->db->resultSet();
		}

		public function update($expenses , $id)
		{
			dd($expenses);
		}

		public function getTotal($projectId)
		{
			$this->db->query(
				"SELECT SUM(amount) as total
					FROM {$this->table} 
					WHERE project_id = '{$projectId}' "
			);

			return $this->db->single()->total;
		}
	}