<?php build('content')?>

	<?php divider()?>

	<div class="col-lg-8 mx-auto">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Add Expenses</h4>
				<?php wReturnLink( _route('project:show' , $expenses->project_id) )?>
			</div>

			<div class="card-body">
				<?php divider()?>
				<?php Flash::show()?>

				<?php
					Form::open([
						'action' => _route('expenses:edit' , $expenses->id),
						'method' => 'post'
					]);

					Form::hidden('id' , $expenses->id)
				?>

				<div class="form-group">
					<?php
						Form::label('Expenses');
						Form::text('expenses' , $expenses->expenses , [
							'class' => 'form-control',
							'required' => ''
						]);
					?>
				</div>


				<div class="form-group">
					<?php
						Form::label('Category');
						Form::select('sector_id' , $sectors , $expenses->sector_id  , [
							'class' => 'form-control',
							'required' => ''
						]);
					?>
				</div>

				<div class="row form-group">
					<div class="col">
						<?php
							Form::label('Amount');
							Form::text('amount' , $expenses->amount , [
								'class' => 'form-control',
								'required' => ''
							]);
						?>
					</div>

					<div class="col">
						<?php
							Form::label('Budget');
							Form::text('budget' , $expenses->budget , [
								'class' => 'form-control',
								'required' => ''
							]);
						?>
					</div>

					<div class="col">
						<?php
							Form::label('Max Budget');
							Form::text('max_budget' , $expenses->max_budget , [
								'class' => 'form-control',
								'required' => ''
							]);
						?>
					</div>
				</div>

				<div class="form-group">
					<?php
						Form::label('Description');
						Form::textarea('description' , $expenses->description  , [
							'class' => 'form-control',
							'rows'  => 3
						]);
					?>
				</div>
				
				<div class="form-group">
					<?php Form::submit('', 'Add Expenses') ?>
				</div>
				<?php Form::close()?>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>