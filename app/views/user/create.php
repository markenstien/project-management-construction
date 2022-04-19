<?php build('content') ?>
	
	<?php divider()?>

	<div class="col-md-7 mx-auto">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Add Account</h4>
			</div>

			<div class="card-body">
				<a href="<?php echo _route('user:index')?>" class="btn btn-primary btn-sm">
					<i class="feather icon-list"></i> Users
				</a>
				<?php divider()?>

				<?php Flash::show()?>

				<?php
					Form::open([
						'method' => 'post',
						'action' => _route('user:createByAdmin')
					]);
				?>

				<div class="row">
					<div class="col">
						<div class="form-group">
							<?php
								Form::label('First Name');
								Form::text('first_name' , '' , [
									'class' => 'form-control',
									'required' => ''
								]);
							?>
						</div>
					</div>

					<div class="col">
						<div class="form-group">
							<?php
								Form::label('Last Name');
								Form::text('last_name' , '' , [
									'class' => 'form-control',
									'required' => ''
								]);
							?>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col">
						<div class="form-group">
							<?php
								Form::label('email');
								Form::text('email' , '' , [
									'class' => 'form-control'
								]);
							?>
						</div>	
					</div>

					<div class="col">
						<div class="form-group">
							<?php
								Form::label('phone');
								Form::text('phone' , '' , [
									'class' => 'form-control'
								]);
							?>
						</div>
					</div>
				</div>

				<div class="form-group">
					<?php
						Form::label('Password');
						Form::text('password', '', [
							'class' => 'form-control'
						]);
					?>
				</div>

				<div class="form-group">
					<?php
						Form::label('Customer');
						Form::select('type',['customer' , 'management'] , '', [
							'class' => 'form-control'
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
<?php loadTo()?>