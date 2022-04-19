<?php 	

	class DashboardController extends Controller
	{

		public function index()
		{
			authRequired();

			$this->project = model('ProjectModel');

			if( isEqual(whoIs('type') , 'customer'))
			{
				$projects = $this->project->getByCustomer( whoIs('id') );
			}else{
				$projects = $this->project->all();
			}
			

			$data = [
				'title' => 'DashboardController',
				'projects' => $projects
			];

			//group by status

			$groupedProjects = [
				'on-going' => [],
				'completed' => []
			];

			foreach($projects as $pKey => $project)
			{
				$key = $project->status;

				if( isEqual('on-going' , $key))
				{
					$groupedProjects['on-going'][] = $project;
				}

				if( isEqual('completed' , $key) )
				{
					$groupedProjects['completed'][] = $project;
				}
			}

			$summary = [
				'totalProject' => count($projects),
				'groupedProjects' => $groupedProjects
			];

			$data['summary'] = $summary;

			return $this->view('dashboard/index' , $data);
		}
	}