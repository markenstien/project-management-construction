<?php build('content') ?>
	
	<?php divider()?>

	<div class="col-md-5 mx-auto">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Forget Password</h4>
			</div>

			<div class="card-footer">
				<?php
					Form::open([
						'method' => 'post',
						'action' => _route('forget:send')
					]);
				?>

				<div class="form-group">
					<?php
						Form::label('Email');
						Form::text('email', '' , [
							'class' => 'form-control',
							'autocomplete' => 'off'
						]);
					?>
				</div>

				<div class="form-group">
					<?php
						Form::submit('' , 'Forget Password');
					?>
				</div>
				<?php Form::close()?>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo('tmp/public')?>