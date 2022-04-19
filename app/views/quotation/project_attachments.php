<?php build('content') ?>

<section class="full-height">
	<div class="col-md-4 mx-auto">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Attachments</h4>
			</div>

			<div class="card-body">
				<?php Flash::show()?>

				<?php
					Form::open([
						'method' => 'post',
						'action' => _route('quote:projectAttachment'),
						'enctype' => 'multipart/form-data'
					]);

					Form::hidden('id' , $quote->id);
				?>

				<div class="form-group">
					<?php
						Form::label('Notes');
						Form::textarea('notes' , '' , [
							'class' => 'form-control',
							'rows'  => 4
						]);
						Form::small('tell us something about your project.');
					?>
				</div>

				<section class="form-section">
					<h4 class="form-section-title">Add Attachment for reference</h4>
					<div class="form-group">
						<div class="row">
							<div class="col">
								<?php 
									Form::label('Image Attachments');
									Form::file('images[]' , [
										'multiple' => true,
										'class' => 'form-control'
									]);
									Form::small('Attach an idea or the location of the project.');
								?>
							</div>
							<div class="col">
								<?php
									Form::label('Document attachments');
									Form::file('attachments[]' , [
										'multiple' => true,
										'class' => 'form-control'
									]);
									Form::small('txt , docx, pdf');
								?>
							</div>
						</div>
					</div>
				</section>
				

				<div class="form-group">
					<?php Form::submit('' , 'Add Attachments')?>
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