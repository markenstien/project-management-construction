<?php 		

	class ProjectProjectSectorModel extends Model
	{
		public $table = 'project_project_sectors';


		public function all($where = null , $order_by = null , $limit = null)
		{
			$this->sector = model('ProjectSectorModel');

			$whereString = '';
			$orderByString = '';
			$limitString = '';

			if( ! is_null($where) ) 
				$whereString = ' WHERE ' .$this->conditionEqual($where);

			if( ! is_null($order_by) ) 
				$orderByString = ' ORDER BY ' .$order_by;

			if( ! is_null($limit) ) 
				$limitString = ' LIMIT ' .$limit;

			$this->db->query(
				"SELECT ps.* , sector.sector , price_per_sqmtr , sector.description
					FROM {$this->table} as ps
					LEFT JOIN {$this->sector->table} as sector 
					ON ps.sector_id = sector.id {$whereString} {$orderByString} {$limitString} "
			);

			return $this->db->resultSet();
		}

		// public function update($values , $id)
		// {
		// 	dd([$values , $id]);
		// }

		public function update($projectSectorSector , $id)
		{
			$res = parent::update($projectSectorSector, $id);

			_notify('project' , [
				'href' => _route('project:show', $projectSectorSector['project_id']),
				'message' => 'Project Sector has been updated'
			], $projectSectorSector['project_id']);

			return $res;
		}
	}