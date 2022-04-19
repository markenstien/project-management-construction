<?php

	class DownloadController extends Controller
	{
		/*
		*Accepts
		*Path
		*Download Name
		*/
		public function index()
		{	

			$param = request()->input('param');

			if( empty($param) )
			{
				Flash::set("Invalid Download");
				return request()->return();
			}

			$param = unseal( $param );

			$fullPath = $param['fullPath'];
			$downloadName = $param['downloadName'];

			if (file_exists($fullPath)) {
			    header('Content-Description: File Transfer');
			    header('Content-Type: application/octet-stream');
			    header('Content-Disposition: attachment; filename="'.basename($downloadName).'"');
			    header('Expires: 0');
			    header('Cache-Control: must-revalidate');
			    header('Pragma: public');
			    header('Content-Length: ' . filesize($fullPath));
			    readfile($fullPath);
			    exit;
			}

			Flash::set("File downloaded");
		}
	}