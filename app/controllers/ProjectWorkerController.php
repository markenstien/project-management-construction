<?php 

	class ProjectWorkerController extends Controller
	{
		
		public function __construct()
		{
			$this->projectWorker = model('ProjectWorkerModel');
		}


		public function addExistingWorker()
		{

		}

		public function edit($id)
		{

			if( isSubmitted() )
			{
				$post = request()->posts();

				extract($post);

				$res = $this->projectWorker->update([
					'role' => $role,
					'description' => $description,
					'on_board_date' => $on_board_date,
					'salary' => $salary
				] , $id);

				if(!$res) {
					Flash::set("Project worker edit failed" , 'danger');
					return request()->return();
				}

				Flash::set("Worker Updated");
				return request()->return();
			}

			$worker = $this->projectWorker->get($id);

			$projectId = $worker->project_id;

			$data = [
				'title' => 'Add Worker',
				'projectId' => $projectId,
				'worker'    => $worker
			];

			return $this->view('project_worker/edit' , $data);
		}


		public function add($projectId)
		{

			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->projectWorker->addAndCreateWorker($post['project_id'] , $post);

				if(!$res){
					Flash::set( $this->projectWorker->getErrorString() , 'danger');
					return request()->return();
				}else{
					Flash::set("worker added");
					return redirect( _route('project:show' , $post['project_id']) );
				}
			}


			$data = [
				'title' => 'Add Worker',
				'projectId' => $projectId
			];

			return $this->view('project_worker/add' , $data);
		}

		public function delete($id)
		{
			$this->projectWorker->delete($id);

			Flash::set("Worker removed");

			return request()->return();
		}
	}