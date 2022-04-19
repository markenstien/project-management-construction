<?php build('content') ?>

<section class="full-height">
	<div class="col-md-4 mx-auto">
		<h4 class="text-center">Get your Quotation</h4>
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Project Sectors</h4>
			</div>

			<div class="card-body">
				<?php Flash::show()?>
				<?php
					Form::open([
						'method' => 'post',
						'action' => _route('quote:projectSector')
					]);
				?>

				<?php foreach( $sectors as $sectorKey => $sector ): ?>
					<div class="form-group">
						<div class="input-group mb-3">
						  <div class="input-group-prepend">
						    <div class="input-group-text">
						      <input type="checkbox" 
						      aria-label="Checkbox for following text input"
						      name="sectors[]"
						      value="<?php echo $sector->id?>">
						    </div>
						  </div>
						  <input type="text" class="form-control" aria-label="Text input with checkbox"
						   value="<?php echo $sector->sector?>" readonly ='true'>
						   <div class="input-group-append">
						    <span class="input-group-text">
						    	<i class="feather icon-info"></i>
						    </span>
						   </div>
						</div>
					</div>
				<?php endforeach?>

				<?php
					Form::submit('' , 'Next');
				?>
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