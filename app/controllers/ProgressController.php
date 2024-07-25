<?php

use Mpdf\Shaper\Sea;

	class ProgressController extends Controller
	{

		public function __construct()
		{
			$this->progress = model('ProgressModel');
			$this->project  = model('ProjectModel');
			$this->file = model('FileModel');
		}
		public function create($projectId)
		{

			if( isSubmitted() )
			{
				$post = request()->posts();
				$res = $this->progress->add( $post );
				// $res = true;
				
				if($res) {
					$this->file->uploadWithFolderCreate('files' ,[
						'meta_id' => $res,
						'meta_key' => 'PROJECT_TASK',
						'folderName' => "TASK_PROGRESS_{$post['current']}",
						'unique_key_identifier' => seal($post['project_id'])
					]);
				}

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