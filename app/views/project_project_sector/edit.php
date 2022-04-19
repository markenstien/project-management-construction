<?php build('content')?>

	<?php divider()?>

	<div class="col-lg-8 mx-auto">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Add Project Sectors</h4>
				<a href="<?php echo _route('project:show' , $projectSector->project_id)?>" class="btn btn-primary btn-sm">
					<i class="feather icon-eye"></i> Project
				</a>
			</div>

			<div class="card-body">
				<?php Flash::show()?>
				<?php
					Form::open([
						'action' => _route('projectProjectSector:edit' , $projectSector->id),
						'method' => 'post'
					]);
					Form::hidden('id' , $projectSector->id);
					Form::hidden('project_id' , $projectSector->project_id);
				?>

				<div class="form-group">
					<?php
						Form::label('Project Sector');
						Form::select('sector_id' , $sectors , $projectSector->sector_id , [
							'class' => 'form-control',
							'required' => ''
						]);
					?>
				</div>

				<div class="row form-group">
					<div class="col">
						<?php
							Form::label('Budget');
							Form::text('budget' , $projectSector->budget , [
								'class' => 'form-control',
								'required' => ''
							]);
						?>
					</div>

					<div class="col">
						<?php
							Form::label('Max Budget');
							Form::text('max_budget' , $projectSector->max_budget , [
								'class' => 'form-control',
								'required' => ''
							]);
						?>
					</div>
				</div>
				
				<div class="form-group">
					<?php Form::submit('', 'Update Sector') ?>
				</div>
				<?php Form::close()?>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>