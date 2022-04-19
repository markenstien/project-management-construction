<?php build('content') ?>
	
	<?php divider()?>

	<div class="col-md-7 mx-auto">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Progress</h4>
			</div>

			<div class="card-body">

				<?php Flash::show()?>

				<?php
					Form::open([
						'method' => 'post',
						'action' => _route('progress:create' , $projectId)
					]);

					Form::hidden('project_id' , $projectId);
				?>

				<div class="form-group">
					<?php
						Form::label('Current Progress');
						Form::text('progress' , 45 , [
							'class' => 'form-control',
							'disabled' => true
						]);
					?>
				</div>
				<div class="form-group">
					<?php
						Form::label('Description');
						Form::textarea('description' , '' , [
							'class' => 'form-control',
							'rows'  => 4
						]);
					?>
				</div>

				<div class="form-group">
					<?php
						Form::label('Completion');
						Form::text('completion' , 45 , ['id' => 'progress']);
					?>
				</div>

				<div class="form-group">
					<?php
						Form::label('Date');
						Form::date('date' , today() , [
							'class' => 'form-control',
							'required' => ''
						]);
					?>
				</div>

				<div class="form-group">
					<?php
						Form::submit('' , 'Save Account');
					?>
				</div>
				<?php Form::close()?>
			</div>
		</div>
	</div>
<?php endbuild()?>

<?php build('scripts')?>
	<script src="<?php echo _path_tmp('plugins/ion-rangeSlider/ion.rangeSlider.min.js')?>"></script>

	<script type="text/javascript">
		$( document ).ready( function(evt) {
			 $("#progress").ionRangeSlider();
		});
	</script>
<?php endbuild()?>

<?php build('headers')?>
<link href="<?php echo _path_tmp('plugins/ion-rangeSlider/ion.rangeSlider.css')?>" rel="stylesheet" type="text/css">
<link href="<?php echo _path_tmp('css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
<link href="<?php echo _path_tmp('css/icons.css')?>" rel="stylesheet" type="text/css">
<link href="<?php echo _path_tmp('css/flag-icon.min.css')?>" rel="stylesheet" type="text/css">
<link href="<?php echo _path_tmp('css/style.css')?>" rel="stylesheet" type="text/css">
<?php endbuild()?>

<?php loadTo()?>