<?php 		

	class ProjectProjectSector extends Controller
	{

		public function __construct()
		{
			$this->project = model('ProjectModel');
			$this->projectSector = model('ProjectSectorModel');
			$this->projectProjectSectorModel = model('ProjectProjectSectorModel');
		}

		public function add($projectId)
		{	
			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->project->addSector([
					'project_id' => $post['project_id'],
					'sector_id' => $post['sector_id'],
					'budget' => $post['budget'],
					'max_budget' => $post['max_budget']
				]);

				if(!$res){
					Flash::set("Project sector add failed" , 'danger');
					return request()->return();	
				}

				Flash::set("Project Sector Added");
				return redirect( _route('project:show' , $post['project_id']) );
			}
			$project = $this->project->get($projectId);

			$sectors = $this->projectSector->dbgetAssoc('sector');

			$sectors = arr_layout_keypair( $sectors , ['id' , 'sector']);

			$data = [
				'project' => $project,
				'sectors' => $sectors
			];

			return $this->view('project_project_sector/add' , $data);
		}	

		public function edit($projectSectorId)
		{

			if( isSubmitted() )
			{
				$post = request()->posts();

				$update = $this->projectProjectSectorModel->update($post , $post['id']);

				if($update){
					Flash::set("Project Project Sector Updated!");
					return redirect( _route('projectProjectSector:edit' , $post['id']));
				}else{
					Flash::set("Something went wrong! update failed!");
					return request()->return();
				}
			}

			$projectSector = $this->projectProjectSectorModel->get( $projectSectorId );

			$sectors = $this->projectSector->dbgetAssoc('sector');

			$sectors = arr_layout_keypair( $sectors , ['id' , 'sector']);

			$data = [
				'projectSector' => $projectSector,
				'sectors' => $sectors
			];
			
			return $this->view('project_project_sector/edit' , $data);
		}

		public function delete($id)
		{
			$this->projectProjectSectorModel->delete($id);
			$req = request();

			Flash::set("Project Sector Removed!");
			if( !empty($req->input('returnTo')) )
			{
				return redirect( $req->input('returnTo') );
			}else{
				return request()->return();
			}
		}
	}