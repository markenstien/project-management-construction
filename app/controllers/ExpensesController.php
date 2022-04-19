<?php 	

	class ExpensesController extends Controller
	{
		public function __construct()
		{
			$this->expenses = model('ExpensesModel');
			$this->projectSector = model('ProjectSectorModel');
		}

		public function add($projectId)
		{

			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->expenses->store($post);

				if($res){
					Flash::set("Expenses added successfully");
					return redirect( _route('project:show' ,  $post['project_id'] , ['page' => 'Expenses']) );
				}else
				{
					Flash::set( $this->expenses->getErrorString()  , 'danger');
					return request()->return();
				}
			}

			$sectors = $this->projectSector->dbgetAssoc('sector');
			$sectors = arr_layout_keypair( $sectors , ['id' , 'sector']);

			$data = [
				'title'     => 'Add Expenses',
				'projectId' => $projectId,
				'sectors'   => $sectors
			];
			
			return $this->view('expenses/add' , $data);
		}

		public function delete($id)
		{
			$res = $this->expenses->delete($id);

			$req = request();

			Flash::set("Expenses Removed");

			if( empty($req->input('returnTo')) )
				return request()->return();

			return redirect( $req->input('returnTo') );
		}

		public function edit($id)
		{

			if( isSubmitted() )
			{
				$post = request()->posts();

				$res = $this->expenses->update($post , $post['id']);
				
				if($res){
					Flash::set("Expenses Updated");
					return request()->return();
				}
			}

			$expenses = $this->expenses->get($id);

			$sectors = $this->projectSector->dbgetAssoc('sector');
			$sectors = arr_layout_keypair( $sectors , ['id' , 'sector']);

			$data = [
				'title' => 'Exit Expenses',
				'expenses' => $expenses,
				'sectors' => $sectors
			];

			return $this->view('expenses/edit' , $data);
		}
	}