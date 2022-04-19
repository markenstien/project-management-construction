<?php build('content')?>
	<?php divider()?>

	<div class="col-md-5 mx-auto">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Edit Profile</h4>
			</div>

			<div class="card-body">
				<?php Flash::show()?>
				<?php
					Form::open([
						'method' => 'post',
						'action' => _route('user:editSingle' , $userId)
					]);

					Form::hidden('id' , $userId);
					Form::hidden('field' , $input['field']);
				?>

				<div class="form-group">
					<?php
						Form::label($input['fieldLabel']);
						Form::text('value' , $input['value'] , [
							'class' => 'form-control'
						])
					?>
				</div>

				<div class="form-group">
					<?php
						Form::submit('' , 'Save Changes');
					?>
				</div>

				<?php Form::close()?>

				<a href="<?php echo _route('profile:index' , $userId)?>">
						<i class="feather icon-corner-up-right"></i> Return to Profile</a>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>