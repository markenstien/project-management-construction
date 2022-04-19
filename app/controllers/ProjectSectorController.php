<?php

	class ProjectSectorController extends Controller
	{

		public function __construct()
		{
			authRequired();
			
			$this->projectSector = model('ProjectSectorModel');
		}


		public function index()
		{
			$projectSectors = $this->projectSector->all();
			
			$data = [
				'title' => 'Project Sectors',
				'projectSectors' => $projectSectors
			];

			return $this->view('project_sector/index' , $data);
		}

		public function create()
		{
				
			if( isSubmitted() )
			{
				$post = request()->posts();

				extract($post);

				$res = $this->projectSector->store([
					'sector' => $sector,
					'price_per_sqmtr' => $price_per_sqmtr,
					'description' => $description,
				]);

				Flash::set("Project Sector create success!");

				if(!$res)
					Flash::set("Project Sector Create Failed");

				return redirect( _route('projectSector:index') );
			}

			$data = [
				'title' => 'Project Sectors',
			];

			return $this->view('project_sector/create' , $data);
		}


		public function edit($id)
		{

			if( isSubmitted() )
			{
				$post = request()->posts();

				extract($post);

				$this->projectSector->update([
					'sector' => $sector,
					'description' => $description,
					'price_per_sqmtr' => $price_per_sqmtr
				] , $id);
			}
			$sector = $this->projectSector->get($id);

			$data = [
				'title' => 'Project Sector',
				'projectSector' => $sector
			];

			return $this->view('project_sector/edit' , $data);
		}
	}