<?php build('content') ?>
<section class="full-height">
	<div class="col-md-4 mx-auto">
		<h4 class="text-center">Get your Quotation</h4>
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Project Classification</h4>
			</div>

			<div class="card-body">
				<?php Flash::show()?>
				<?php
					Form::open([
						'method' => 'post',
						'action' => _route('quote:projectClassification')
					]);
				?>
					<div class="form-group">
						<?php
							Form::label('Classification');
							Form::select('classification' , mProjectClassifications()  , '' , [
								'class' => 'form-control',
								'required' => ''
							]);
						?>
					</div>

					<div class="form-group">
						<?php
							Form::label('Type');
							Form::select('type' , mProjectTypes() , '' , [
								'class' => 'form-control',
								'required' => ''
							]);
						?>
					</div>

					<div class="form-group">
						<?php Form::submit('' , 'Next' , [
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