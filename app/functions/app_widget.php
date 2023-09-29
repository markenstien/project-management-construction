<?php   

    function wBackgroundImage($parameters = [])
	{
		$size = $parameters['size'] ?? '100%';
		$margin = $parameters['margin'] ?? '15px 0px';
		$image = 'https://scontent.fmnl2-2.fna.fbcdn.net/v/t39.30808-6/302442644_484926753644709_2557463851700756466_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=gQMMxZai2-IAX-EThz3&_nc_ht=scontent.fmnl2-2.fna&oh=00_AfC5mYeVYH5Psp_nugZNH8NFwOqAi7tutxdvN0vIOBzvig&oe=635FFBC5';
		
		print <<<EOF
			<div style='{$margin}'>
				<img src="{$image}" style="width:{$size}">
			</div>
		EOF;
	}

	function divider()
	{
		print <<<EOF
			<div style='margin:30px 0px'>
			</div>
		EOF;
	}

	/*
	*metaId
	*metaKey
	*redirectTo
	*/
	function wFileUploadForm( $metaId , $metaKey , $route , $redirectTo = null , $folderId = null)
	{	
		$targetAndModalName = get_token_random_char(17 , 'MODAL');


		$folder = model('FolderModel');

		$folders = $folder->dbgetAssoc('folder' , [
			'meta_id' => $metaId,
			'meta_key' => $metaKey
		]);


		$foldersIdAndName = arr_layout_keypair( $folders , ['id' , 'folder'] );

		?>

		<button type="button" 
		class="btn btn-primary mt-1" 
		data-toggle="modal" 
		data-target=".<?php echo $targetAndModalName?>"> <i class="feather icon-file-plus"></i> </button>

		<div class="modal fade <?php echo $targetAndModalName?>" tabindex="-1" role="dialog" aria-hidden="true">
	        <div class="modal-dialog modal-lg">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h5 class="modal-title" id="exampleLargeModalLabel">Upload Files</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <div class="modal-body">
	                    <?php
	                    	Form::open([
	                    		'method' => 'post',
	                    		'action' => _route('file:upload'),
	                    		'enctype' => 'multipart/form-data'
	                    	]);

	                    	Form::hidden('meta_id' , $metaId);
	                    	Form::hidden('meta_key' , $metaKey);
	                    	Form::hidden('redirect_to' , $redirectTo);

	                    	if( !is_null($folderId) )
	                    		Form::hidden('folder_id' , $folderId);
	                    ?>

	                    <div class="form-group">
	                    	<?php
	                    		Form::label('Files');
	                    		Form::file('files[]' , [
	                    			'multiple' => true,
	                    			'class' => 'form-control'
	                    		]);
	                    	?>
	                    </div>

	                    <div class="form-group">
	                    	<?php
	                    		Form::label('Folder');

	                    		Form::text('folder_name' , '' ,[
	                    			'class' => 'form-control'
	                    		]);

	                    		Form::small("Leave folder name if you don't want sub-folder");
	                    	?>
	                    </div>

	                    <div class="form-group">
	                    	<?php
	                    		Form::submit('' , 'Upload File');
	                    	?>
	                    </div>
	                    <?php Form::close()?>
	                </div>
	            </div>
	        </div>
	    </div>
		<?php
	}

	function wFolderAddForm( $metaId , $metaKey , $route , $redirectTo = null , $parentId = null)
	{
		$targetAndModalName = get_token_random_char(17 , 'MODAL');
		?>
		<button type="button" 
		class="btn btn-primary mt-1" 
		data-toggle="modal" 
		data-target=".<?php echo $targetAndModalName?>"> <i class="feather icon-folder-plus"></i> </button>

		<div class="modal fade <?php echo $targetAndModalName?>" tabindex="-1" role="dialog" aria-hidden="true">
	        <div class="modal-dialog modal-lg">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <h5 class="modal-title" id="exampleLargeModalLabel">Create Folder</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <div class="modal-body">
	                    <?php
	                    	Form::open([
	                    		'method' => 'post',
	                    		'action' => $route,
	                    		'enctype' => 'multipart/form-data'
	                    	]);

	                    	Form::hidden('meta_id' , $metaId);
	                    	Form::hidden('meta_key' , $metaKey);

	                    	if( !is_null($redirectTo) ) 
	                    		Form::hidden('redirect_to' , $redirectTo);

	                    	if( !is_null($parentId) )
	                    		Form::hidden('parentId' , $parentId);
	                    ?>
	                    <div class="form-group">
	                    	<?php
	                    		Form::label('Folder');
	                    		Form::text('folder_name' , '' ,[
	                    			'multiple' => true,
	                    			'class' => 'form-control'
	                    		]);
	                    	?>
	                    </div>

	                    <div class="form-group">
	                    	<?php
	                    		Form::submit('' , 'Upload File');
	                    	?>
	                    </div>
	                    <?php Form::close()?>
	                </div>
	            </div>
	        </div>
	    </div>
		<?php
	}



	function wFolderDelete($folderId , $returnTo)
	{
		$deleteKey = seal("DELETE-{$folderId}");

		$folderDeleteRoute = _route('folder:delete' , $folderId, ['key' => $deleteKey , 'returnTo' => $returnTo]);

		print <<<EOF
			<a href="$folderDeleteRoute" class="btn btn-danger btn-sm form-verify" data-toggle="tooltip" data-placement="top" title="Delete Folder" style="height:35px">
				<i class="feather icon-trash" ></i>
			</a>
		EOF;
	}

	function wBackToPrev()
	{
		$referer = request()->referrer();

		if( $referer )
		{
			?>
				<a href="<?php echo $referer?>" class="history-button" data-role="previous" role="button"
	                    style="color: #000; text-decoration: underline;">Previous</a>
	        <?php
		}
	}


	function wReturnLink( $route )
	{
		print <<<EOF
			<a href="{$route}">
				<i class="feather icon-corner-up-left"></i> Return
			</a>
		EOF;
	}


	function wBadge($status , $text = '')
	{
		$success = ['success' , 'on-going','pending'];

		$info = ['warning','complete' , 'completed' , 'ok' , 'finished' , 'finish'];

		$danger   = ['removed' , 'delete' , 'deleted' , 'fatal' , 'error' , 'danger'];


		$text = empty($text) ? $status : $text;

		if( isEqual($status , $success) )
		{
			print <<<EOF
			<span class="badge badge-success"><?php echo $status?>{$text}</span>
			EOF;
		}

		if( isEqual($status , $info) )
		{
			print <<<EOF
			<span class="badge badge-info"><?php echo $status?>{$text}</span>
			EOF;
		}


		if( isEqual($status , $danger) )
		{
			print <<<EOF
			<span class="badge badge-danger"><?php echo $status?>{$text}</span>
			EOF;
		}

	}