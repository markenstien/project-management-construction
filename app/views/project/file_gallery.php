<?php build('content') ?>
<?php $isManagement = mIsManagement()?>
<div class="card">
	<div class="card-header">
		<h4 class="card-title">Files</h4>
		<?php if($isManagement):?>
			<?php wFileUploadForm($project->id, 'PROJECT' , _route('file:uploadWithFolderCreate') , null , $_GET['folder'] ?? null)?>

			<?php wFolderAddForm( $project->id , 'PROJECT' , _route('folder:create') , null , $_GET['folder'] ?? null )?>

			<?php if(isset($folderFilesAndFolders)) :?>
				<?php wFolderDelete($folderFilesAndFolders->id , _route('project:show' , $project->id))?>
			<?php endif?>
		<?php endif?>
	</div>

	<div class="card-body">
		<?php Flash::show('folderAlert')?>
		<a href="<?php echo _route('project:show' , $project->id) ?>">Return</a>
		<?php if( isset($folderFilesAndFolders) ) :?>
			
			<section class="section">
				<h4>Photos</h4>
				<div class="row">
					<!-- files -->
					<?php foreach($folderFilesAndFolders->files as $fileKey => $file) :?>
						<?php
							$fileName = $file->name;
							$ext = explode('.' , $fileName);
							$ext = end($ext);
						?>
						<?php if( isEqual( $ext , ['png','gif','jpeg' , 'jpg']) ) :?>
                            <div class="col-lg-3 col-md-4 col-xs-6 thumb hover-show-delete mb-3">
				                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="<?php echo $file->display_name?>"
				                   data-image="<?php echo $file->url.'/'.$fileName?>"
				                   data-target="#image-gallery">
				                    <img class="img-thumbnail"
				                         src="<?php echo $file->url.'/'.$fileName?>"
				                         alt="Another alt text" style="height: 150px;">
				                </a>

				                <div class="hidden-delete-button">
									<a href="<?php echo _route('file:delete' , $file->id)?>" style="text-decoration: underline;">Delete</a>
								</div>
				            </div>
						<?php endif?>
					<?php endforeach?>
				</div>
			</section>
			<section class="section">
				<h4>Folders</h4>
				<div class="row">
					<!-- files -->
					<?php foreach($folderFilesAndFolders->folders as $folderKey => $folder) :?>
						<div class="col-md-4">
							<a href="?page=files&folder=<?php echo $folder->id?>">
								<i class="feather icon-folder" style="font-size: 70px;"></i>
								<div><label><?php echo $folder->folder?></label>(<?php echo count($folder->files ?? []) ?> files)</div>
							</a>
						</div>
					<?php endforeach?>
				</div>
			</section>

			<section class="section">
				<h4>Files</h4>
				<div class="row">
					<?php foreach($folderFilesAndFolders->files as $fileKey => $file) :?>
						<?php
							$fileName = $file->name;
							$ext = explode('.' , $fileName);
							$ext = end($ext);
						?>
						<?php if( !isEqual( $ext , ['png','gif','jpeg' , 'jpg']) ) :?>
							<div class="col-md-4 hover-show-delete mb-3">
								<a href="<?php echo _download( $file->full_path , $file->display_name)?>">
									<i class="feather icon-file-text" style="font-size: 70px;"></i>
									<div><label><?php echo $file->display_name?></label></div>
								</a>

								<div class="hidden-delete-button">
									<a href="<?php echo _route('file:delete' , $file->id)?>" style="text-decoration: underline;">Delete</a>
								</div>											
							</div>
						<?php endif?>
					<?php endforeach?>
				</div>
			</section>
		<?php endif?>

		<?php if( isset($filesAndFolders) ) :?>
			<?php if( ! is_null($filesAndFolders['files']) ) : ?>
				<div class="row">
					<!-- files -->
					<?php foreach($filesAndFolders['files'] as $fileKey => $file) :?>
						<?php
							$fileName = $file->name;
							$ext = explode('.' , $fileName);
							$ext = end($ext);
						?>
						<?php if( isEqual( $ext , ['png','gif','jpeg' , 'jpg']) ) :?>
							<div class="col-lg-3 col-md-4 col-xs-6 thumb hover-show-delete">
				                <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="<?php echo $file->display_name?>"
				                   data-image="<?php echo $file->url.'/'.$fileName?>"
				                   data-target="#image-gallery">
				                    <img class="img-thumbnail"
				                         src="<?php echo $file->url.'/'.$fileName?>"
				                         alt="Another alt text" style="height: 150px;">
				                </a>

				                <div class="hidden-delete-button">
									<a href="<?php echo _route('file:delete' , $file->id)?>" style="text-decoration: underline;">Delete</a>
								</div>
				            </div>
						<?php endif?>
					<?php endforeach?>
				</div>
			<?php endif?>

			<?php if( ! is_null($filesAndFolders['folders']) ) : ?>
			<div class="row">
				<!-- files -->
				<?php foreach($filesAndFolders['folders'] as $folderKey => $folder) :?>
					<div class="col-md-4">
						<a href="?page=files&folder=<?php echo $folder->id?>">
							<i class="feather icon-folder" style="font-size: 70px;"></i>
							<div><label><?php echo $folder->folder?></label>(<?php echo count($folder->files ?? []) ?> files)</div>
						</a>
					</div>
				<?php endforeach?>
			</div>
			<?php endif?>

		<?php endif?>
	</div>
</div>

<!--====== image gallery modal ======-->
<div class="container">
	<div class="row">
        <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="image-gallery-title"></h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                        </button>

                        <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<!--======////== image gallery modal ======-->
<?php endbuild()?>

<?php build('scripts')?>
	<script type="text/javascript">
		let modalId = $('#image-gallery');

		$(document)
		  .ready(function () {

		    loadGallery(true, 'a.thumbnail');

		    //This function disables buttons when needed
		    function disableButtons(counter_max, counter_current) {
		      $('#show-previous-image, #show-next-image')
		        .show();
		      if (counter_max === counter_current) {
		        $('#show-next-image')
		          .hide();
		      } else if (counter_current === 1) {
		        $('#show-previous-image')
		          .hide();
		      }
		    }

		    /**
		     *
		     * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
		     * @param setClickAttr  Sets the attribute for the click handler.
		     */

		    function loadGallery(setIDs, setClickAttr) {
		      let current_image,
		        selector,
		        counter = 0;

		      $('#show-next-image, #show-previous-image')
		        .click(function () {
		          if ($(this)
		            .attr('id') === 'show-previous-image') {
		            current_image--;
		          } else {
		            current_image++;
		          }

		          selector = $('[data-image-id="' + current_image + '"]');
		          updateGallery(selector);
		        });

		      function updateGallery(selector) {
		        let $sel = selector;
		        current_image = $sel.data('image-id');
		        $('#image-gallery-title')
		          .text($sel.data('title'));
		        $('#image-gallery-image')
		          .attr('src', $sel.data('image'));
		        disableButtons(counter, $sel.data('image-id'));
		      }

		      if (setIDs == true) {
		        $('[data-image-id]')
		          .each(function () {
		            counter++;
		            $(this)
		              .attr('data-image-id', counter);
		          });
		      }
		      $(setClickAttr)
		        .on('click', function () {
		          updateGallery($(this));
		        });
		    }
		  });

		// build key actions
		$(document)
		  .keydown(function (e) {
		    switch (e.which) {
		      case 37: // left
		        if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
		          $('#show-previous-image')
		            .click();
		        }
		        break;

		      case 39: // right
		        if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
		          $('#show-next-image')
		            .click();
		        }
		        break;

		      default:
		        return; // exit this handler for other keys
		    }
		    e.preventDefault(); // prevent the default action (scroll / move caret)
		  });
	</script>
<?php endbuild()?>

<?php build('headers')?>
	<style type="text/css">
		.hover-show-delete:hover .hidden-delete-button
		{
			display: block;
		}
		
		.hidden-delete-button
		{
			display: none;
		}
	</style>
<?php endbuild()?>

<?php loadTo('project/show' , $data)?>