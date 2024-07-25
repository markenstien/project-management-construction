<?php
	
	/*
	*@param
	*$route = [name , method]
	*/
	/*
	*@param
	*$route = [name , method]
	*/
	function _route($routeParam , $parameterId = '' , $parameter = [])
	{

		$routeParam = explode(':' , $routeParam);

		$routeKey = '';
		$method  = '';

		if( count($routeParam) > 1) {
			list( $routeKey , $method) = $routeParam;
		}

		$parameterString = '';

		if( !empty($parameterId) )
		{
			if(is_array($parameterId))
			{
				$parameterString .= "?";

				$counter = 0;
				foreach($parameterId as $key => $row) 
				{
					if( $counter > 0)
						$parameterString .= "&";

					$parameterString .= "{$key}={$row}";
					$counter++;
				}
			}else{
				//parameter is id
				$parameterString = '/'.$parameterId.'?';
			}
		}

		if( is_array($parameter) && !empty($parameter))
		{
			if( empty($parameterString) )
				$parameterString .= '?';
			$counter = 0;
			foreach($parameter as $key => $row) 
			{
				if( $counter > 0)
					$parameterString .='&';
				$parameterString .= "{$key}={$row}";
				$counter++;
			}
		}

		$routesDeclared = Route::fetchRoutes();

		//check if exists

		$routesDeclaredKeys = array_keys($routesDeclared);


		if( !in_array($routeKey , $routesDeclaredKeys)  ){
			echo die("Route {$routeKey} doest not exists");
		}

		$calledRoute = $routesDeclared[$routeKey];

		$calledRouteKeys = array_keys($calledRoute);

		if( !in_array($method, $calledRouteKeys)){
			echo die("Route {$routeKey} doest not have {$method} method does not exist!");
		}
		
		return $calledRoute[$method].$parameterString;
	}
	

	function _download($fullPath , $downloadName)
	{
		$fPathExt = explode('.' , $fullPath);
		$dPath = explode('.' , $downloadName);

		if( !isEqual( end($dPath) , end($fPathExt) ) ){
			return false;
			// return _page_fatal_error("Download Name extension does not match the full path extension");
		}

		return _route('download:index' , [
			'param' => seal([
				'fullPath' => $fullPath,
				'downloadName' => $downloadName
			])
		]);
	}

	function _page_fatal_error($error = '')
	{
		print <<<EOF
			<div style="height:100vh; background:#000;">
				<div style="width:500px; margin:0px auto; background:#fff; color:#fff;"> 
					<h1> FATAL ERROR !</h1>
					<p>{$error}</p>
				</div>
			</div>
		EOF;
	}


	function _notify($metaKey , $content = [] , $receiver)
	{
		$metaKey = strtoupper($metaKey);

		$notify = model('NotificationModel');

		return $notify->store([
			'notification' => $content['message'],
			'link'   => $content['href'] ?? '',
			'meta_id' => $receiver,
			'meta_key' => $metaKey,
			'category' => $content['category'] ?? 'default'
		]);
	}


	function _api_response($data , $responseStatus = true)
	{
		$retVal = [
			'data' => $data,
			'status' => $responseStatus
		];
		
		return json_encode($retVal);
	}
?>