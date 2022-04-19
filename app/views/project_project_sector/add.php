<?php build('content')?>

	<?php divider()?>

	<div class="col-lg-8 mx-auto">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Add Project Sectors</h4>
				<?php wReturnLink(_route('project:show' , $project->id))?>
			</div>

			<div class="card-body">
				<?php Flash::show()?>
				<?php
					Form::open([
						'action' => _route('projectProjectSector:add' , $project->id),
						'method' => 'post'
					]);
					Form::hidden('project_id' , $project->id);
				?>

				<div class="form-group">
					<?php
						Form::label('Project Sector');
						Form::select('sector_id' , $sectors , '' , [
							'class' => 'form-control',
							'required' => ''
						]);
					?>
				</div>

				<div class="row form-group">
					<div class="col">
						<?php
							Form::label('Budget');
							Form::text('budget' , '' , [
								'class' => 'form-control',
								'required' => ''
							]);
						?>
					</div>

					<div class="col">
						<?php
							Form::label('Max Budget');
							Form::text('max_budget' , '' , [
								'class' => 'form-control',
								'required' => ''
							]);
						?>
					</div>
				</div>
				
				<div class="form-group">
					<?php Form::submit('', 'Add Sector') ?>
				</div>
				<?php Form::close()?>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>