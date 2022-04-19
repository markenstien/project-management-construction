<?php build('content') ?>
	
	<section class="col-md-8 mx-auto">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Create Worker</h4>
				<?php wReturnLink( _route('project:show' , $projectId) )?>
			</div>

			<div class="card-body">
				<?php Flash::show()?>
				<?php
					Form::open([
						'method' => 'post',
						'action' => _route('worker:add' , $projectId)
					]);

					Form::hidden('project_id' , $projectId);
				?>

				<section class="form-section">
					<h4 class="form-section-title">Worker Personal</h4>
					<div class="row form-group">
						<div class="col">
							<?php
								Form::label('First name');
								Form::text('first_name' , '' , [
									'class' => 'form-control',
								]);
							?>
						</div>

						<div class="col">
							<?php
								Form::label('Last name');
								Form::text('last_name' , '' , [
									'class' => 'form-control',
								]);
							?>
						</div>
					</div>

					<div class="row">
						<div class="col">
							<div class="form-group">
								<?php
									Form::label('Contact Number *');
									Form::text('phone' , '' , [
										'class' => 'form-control',
									]);
								?>
							</div>
						</div>

						<div class="col">
							<div class="form-group">
								<?php
									Form::label('Email (optional)');
									Form::text('email' , '' , [
										'class' => 'form-control',
									]);
								?>
							</div>
						</div>
					</div>

				</section>

				<section class="form-section">
					<h4 class="form-section-title">Work Details</h4>

					<div class="form-group">
						<?php
							Form::label('Role');
							Form::text('role' , '' , [
								'class' => 'form-control'
							])
						?>
					</div>

					<div class="form-group">
						<?php
							Form::label('Description');
							Form::textarea('description' , '' , [
								'class' => 'form-control',
								'rows'  => 3
							])
						?>
					</div>

					<div class="form-group">
						<?php
							Form::label('On boarding date');
							Form::date('on_board_date' , '' , [
								'class' => 'form-control'
							])
						?>
					</div>

					<div class="form-group">
						<?php
							Form::label('Salary');
							Form::text('salary' , '' , [
								'class' => 'form-control'
							])
						?>
					</div>

				</section>

				<div class="form-group">
					<?php Form::submit('' , 'Save Worker' , [
						'class' => 'btn btn-primary'
					])?>
				</div>

				<?php Form::close()?>
			</div>
		</div>
	</section>
<?php endbuild()?>
<?php loadTo()?>