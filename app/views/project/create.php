<?php build('content') ?>
	<div class="col-md-10 mx-auto">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Project Details</h4>
				<a href="<?php echo _route('project:index')?>" class="btn btn-primary btn-sm">
					<i class="feather icon-list"></i> Add Project Sector
				</a>
			</div>

			<div class="card-body">
				<?php
					Form::open([
						'method' => 'post',
						'action' => _route('project:create')
					]);
				?>
					<div class="form-group">
						<?php
							Form::label('Title');
							Form::text('title' , '' , [
								'class' => 'form-control',
								'placeholder' => 'Enter Project Title',
								'required' => ''
							]);
						?>
					</div>

					<div class="form-group">
						<?php
							Form::label('Project Description');
							Form::textarea('description' , '' , [
								'class' => 'form-control',
								'rows'  => 3,
								'required' => ''
							]);
						?>
					</div>

					<div class="form-section">
						<h3 class="form-section-title">Budget and Costing</h3>
						<div class="form-group">
							<div class="row">
								<div class="col">
									<?php
										Form::label('Cost');
										Form::text('cost' , $quotation['cost'] ?? null , [
											'class' => 'form-control',
											'required' => ''
										]);
									?>
								</div>
								<div class="col">
									<?php
										Form::label('Budget');
										Form::text('budget' , $quotation['budget'] ?? null , [
											'class' => 'form-control',
										]);
									?>
								</div>

								<div class="col">
									<?php
										Form::label('Max Budget');
										Form::text('max_budget' , $quotation['maxBudget'] ?? null , [
											'class' => 'form-control',
											'required' => ''
										]);
									?>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col">
								<?php
									Form::label('Start Date');
									Form::date('start_date' , '' , [
										'class' => 'form-control',
										'required' => ''
									]);
								?>
							</div>

							<div class="col">
								<?php
									Form::label('Est Completion Date');
									Form::date('est_completion_date' , '' , [
										'class' => 'form-control',
										'required' => ''
									]);
								?>
							</div>
						</div>
					</div>


					<div class="form-section">
						<div class="form-group">
							<div class="row">
								<div class="col">
									<?php
										Form::label('Classification');
										Form::select('classification' , mProjectClassifications() , $quotation['classification'] ?? '' , [
											'class' => 'form-control',
											'required' => ''
										]);
									?>
								</div>

								<div class="col">
									<?php
										Form::label('Type');
										Form::select('type' , mProjectTypes() , $quotation['type'] ?? '' , [
											'class' => 'form-control',
											'required' => ''
										]);
									?>
								</div>
							</div>
						</div>
					</div>

					<div class="form-group">
						<?php
							Form::label('Address');
							Form::textarea('address' , $quotation['address'] ?? ''  , [
								'class' => 'form-control',
								'rows'  => 3,
								'required' => ''
							]);
						?>
					</div>

					<div class="form-group">
						<?php
							Form::submit('create_project' , 'Create Project', [
								'class' => 'btn btn-primary'
							]);
						?>
					</div>
				<?php Form::close()?>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>