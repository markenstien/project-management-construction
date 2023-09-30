<?php build('content')?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Project Sector</h4>
		</div>

		<div class="card-body">
			<?php Flash::show()?>
			<?php
				Form::open([
					'method' => 'post',
					'action' => _route('projectSector:edit' , $projectSector->id)
				]);

				Form::hidden('id' , $projectSector->id);
			?>

			<div class="form-group">
				<?php
					Form::label('Sector');
					Form::text('sector', $projectSector->sector , [
						'class' => 'form-control',
						'required' => ''
					]);
				?>
			</div>

			<div class="form-group">
				<?php
					Form::label('Description');
					Form::textarea('description' , $projectSector->description ,[
						'class' => 'form-control',
						'rows'  => 3
					]);
				?>
			</div>

			<div class="form-group">
				<?php Form::submit('' , 'Update Sector');?>
			</div>
			<?php Form::close()?>
		</div>
	</div>
<?php endbuild()?>

<?php loadTo()?>