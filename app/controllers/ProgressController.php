<?php 	

	class ProgressController extends Controller
	{

		public function __construct()
		{
			$this->progress = model('ProgressModel');

			$this->project  = model('ProjectModel');
		}
		public function create($projectId)
		{

			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->progress->add( $post );

				if(!$res) {
					Flash::set( $this->progress->getErrorString() , 'danger');
					return request()->return();
				}

				Flash::set("Project progress updated successfully");


				return request()->return();
			}

			$project = $this->project->get($projectId);

			$data = [
				'title' => 'Project Title',
				'project' => $project,
				'projectId' => $projectId
			];

			return $this->view('progress/create' , $data);
		}
	}