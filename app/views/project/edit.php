<?php build('content') ?>
	<div class="col-md-10 mx-auto">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Project Details</h4>
				<a href="<?php echo _route('project:show' , $project->id)?>">
					<i class="feather icon-corner-up-left"></i> Return
				</a>
			</div>

			<div class="card-body">

				

				<?php
					Form::open([
						'method' => 'post',
						'action' => _route('project:edit' , $project->id)
					]);

					Form::hidden('id', $project->id);
				?>
					<div class="form-group">
						<?php
							Form::label('Title');
							Form::text('title' , $project->title , [
								'class' => 'form-control',
								'placeholder' => 'Enter Project Title'
							]);
						?>
					</div>

					<div class="form-section">
						<h3 class="form-section-title">Budget and Costing</h3>
						<div class="form-group">
							<div class="row">
								<div class="col">
									<?php
										Form::label('Cost');
										Form::text('cost' , $project->cost , [
											'class' => 'form-control',
										]);
									?>
								</div>
								
								<div class="col">
									<?php
										Form::label('Budget');
										Form::text('budget' , $project->budget , [
											'class' => 'form-control',
										]);
									?>
								</div>

								<div class="col">
									<?php
										Form::label('Max Budget');
										Form::text('max_budget' , $project->max_budget , [
											'class' => 'form-control',
										]);
									?>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col">
								<?php
									Form::label('Start Date');
									Form::date('start_date' , $project->start_date , [
										'class' => 'form-control'
									]);
								?>
							</div>

							<div class="col">
								<?php
									Form::label('Est Completion Date');
									Form::date('est_completion_date' , $project->est_completion_date , [
										'class' => 'form-control'
									]);
								?>
							</div>
						</div>
					</div>


					<div class="form-section">
						<h3 class="form-section-title">Size And Location</h3>

						<div class="form-group">
							<div class="row">
								<div class="col">
									<?php
										Form::label('Classification');
										Form::select('classification' , ['Residence' , 'Commercial'] , $project->classification , [
											'class' => 'form-control'
										]);
									?>
								</div>

								<div class="col">
									<?php
										Form::label('Type');
										Form::select('type' , ['maintenance' => 'Maintenance / Renovation' , 'state_clean' => 'State Clean / New Project'] , $project->type , [
											'class' => 'form-control'
										]);
									?>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col">
									<?php
										Form::label('Storey / No. of floors');
										Form::text('storey',  $project->storey , [
											'class' => 'form-control'	
										]);
									?>
								</div>

								<div class="col">
									<?php
										Form::label('SQM');
										Form::text('sqm', $project->sqm , [
											'class' => 'form-control'	
										]);
									?>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="row">
								<div class="col">
									<?php
										Form::label('Address');
										Form::textarea('address' , $project->address  , [
											'class' => 'form-control',
											'rows'  => 3
										]);
									?>
								</div>

								<!-- <div class="col">
									<?php
										Form::label('Landmark');
										Form::text('landmark' , $project->landmark , [
											'class' => 'form-control',
											'rows'  => 3
										]);
									?>
								</div> -->
							</div>
						</div>
					</div>

					<div class="form-group">
						<?php
							Form::submit('' , 'Update Project', [
								'class' => 'btn btn-primary'
							]);
						?>
					</div>
				<?php Form::close()?>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>