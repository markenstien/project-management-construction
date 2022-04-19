<?php build('content') ?>
	<?php $isManagement = mIsManagement()?>
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Progress</h4>

			<h2><?php echo $currentProgress->current ?? '0'?>%</h2>
		</div>

		<div class="card-body">
			<?php if($isManagement) :?>
				<button type="button" class="btn btn-primary" 
				data-toggle="modal" data-target="#updateProgressForm">
				  Update
				</button>
			<?php endif?>

			<?php divider()?>

			<table class="table">
				<thead>
					<th>#</th>
					<th>Date</th>
					<th>Completion</th>
					<th>Previous</th>
					<th>Remarks</th>
					<th>Date</th>
				</thead>

				<tbody>
					<?php $counter = 0?>
					<?php foreach( $progress as $progressKey => $progress) : ?>
						<tr>
							<td><?php echo ++$counter?></td>
							<td><?php echo $progress->date?></td>
							<td><?php echo $progress->current?>%</td>
							<td><?php echo $progress->old?>%</td>
							<td>
								<p style="width:350px"><?php echo $progress->description?></p>
							</td>
							<td><?php echo $progress->date?></td>
						</tr>
					<?php endforeach?>
				</tbody>
			</table>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="updateProgressForm" tabindex="-1" role="dialog" 
		aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="exampleStandardModalLabel">Progress Form</h5>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <div class="modal-body">
	                <?php
						Form::open([
							'method' => 'post',
							'action' => _route('progress:create' , $project->id)
						]);

						Form::hidden('project_id' , $project->id);
					?>

					<div class="form-group">
						<?php
							Form::label('Current Progress');
							Form::text('' , $currentProgress->current ?? 0 , [
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
							Form::text('current' , $currentProgress->current ?? 0 , ['id' => 'progress']);
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

<?php loadTo('project/show' , $data)?>