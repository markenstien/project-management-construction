<?php build('content') ?>
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Create Customer</h4>
		</div>

		<div class="card-body">
			<?php Flash::show()?>
			<?php
				Form::open([
					'method' => 'post',
					'action' => _route('customer:create')
				]);
			?>

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

			<div class="form-group">
				<?php
					Form::label('Email *');
					Form::text('email' , '' , [
						'class' => 'form-control',
					]);
				?>
			</div>

			<div class="form-group">
				<?php
					Form::label('Contact Number *');
					Form::text('phone' , '' , [
						'class' => 'form-control',
					]);
				?>
			</div>

			<div class="form-group">
				<?php Form::submit('' , 'Save Customer' , [
					'class' => 'btn btn-primary'
				])?>
			</div>

			<?php Form::close()?>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>