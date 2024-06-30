<?php build('content')?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Project Sector</h4>
			<a href="<?php echo _route('projectSector:index')?>" class="btn btn-primary btn-sm">
				<i class="feather icon-list"></i> Add Project Sector
			</a>
		</div>

		<div class="card-body">

			<?php Flash::show()?>
			
			<?php
				Form::open([
					'method' => 'post',
					'action' => _route('projectSector:create')
				]);
			?>

			<div class="form-group">
				<?php
					Form::label('Sector');
					Form::text('sector','' , [
						'class' => 'form-control',
						'required' => ''
					]);
				?>
			</div>

			<div class="form-group">
				<?php
					Form::label('Price Per meter');
					Form::text('price_per_sqmtr' , '' , [
						'class' => 'form-control',
						'required' => ''
					]);
					Form::small('For Automated Quotation Purposes..');
				?>
			</div>

			<div class="form-group">
				<?php
					Form::label('Description');
					Form::textarea('description' ,'',[
						'class' => 'form-control',
						'rows'  => 3
					]);
				?>
			</div>

			<div class="form-group">
				<?php Form::submit('' , 'Save Sector');?>
			</div>
			<?php Form::close()?>
		</div>
	</div>
<?php endbuild()?>

<?php loadTo()?>