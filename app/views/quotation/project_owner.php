<?php build('content') ?>

<section class="full-height">
	<div class="col-md-4 mx-auto">
		<h4 class="text-center">Get your Quotation</h4>
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Contact</h4>
			</div>

			<div class="card-body">
				<?php
					Form::open([
						'method' => 'post',
						'action' => _route('quote:projectOwner'),
					]);
				?>

				<div class="row form-group">
					<div class="col">
						<?php
							Form::label('First name *');
							Form::text('first_name' , '' , [
								'class' => 'form-control',
								'required' => ''
							]);
						?>
					</div>

					<div class="col">
						<?php
							Form::label('Last name *');
							Form::text('last_name' , '' , [
								'class' => 'form-control',
								'required' => ''
							]);
						?>
					</div>
				</div>

				<div class="form-group">
					<?php
						Form::label('Email *');
						Form::email('email' , '' , [
							'class' => 'form-control',
							'required' => ''
						]);
					?>
				</div>

				<div class="form-group">
					<?php
						Form::label('Contact Number *');
						Form::text('mobile' , '' , [
							'class' => 'form-control',
							'required' => ''
						]);
					?>
				</div>

				<div class="form-group">
					<?php Form::submit('' , 'Finish' , [
						'class' => 'btn btn-primary'
					])?>
				</div>
				
				<?php if(isset($_GET['isEdit'])) :?>
					<a href="<?php echo _route('quote:create')?>">
						<i class="feather icon-corner-up-right"></i> Back to Quote</a>
				<?php endif?>

				<?php Form::close()?>
			</div>
		</div>
	</div>
</section>
<?php endbuild()?>


<?php loadTo('tmp/public')?>