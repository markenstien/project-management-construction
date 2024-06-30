<?php build('content')?>
<?php $isManagement = mIsManagement()?>
<div class="row">
	<div class="col-md-9">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Project</h4>
				<h2><?php echo $currentProgress->current ?? 0?>%</h2>

				<?php if( mIsManagement() ):?>
					<h2>Expenses : <?php echo toMoney($expensesTotal)?></h2>
					<table class="table table-bordered">
						<td>Budget</td>
						<td>Expenses</td>
						<tr>
							<td><?php echo toMoney($project->budget)?></td>
							<td><?php echo toMoney($expensesTotal) . ' ' . "(".round(($expensesTotal / $project->budget) * 100 , 2) . '%'.")"?></td>
						</tr>
					</table>
				<?php endif?>
			</div>

			<div class="card-body">
				<table class="table">
					<tr>
						<td>Name</td>
						<td><?php echo $project->title?></td>
					</tr>

					<tr>
						<td>Address</td>
						<td><?php echo $project->description?></td>
					</tr>

					<tr>
						<td>Classification</td>
						<td><?php echo $project->classification?></td>
					</tr>

					<tr>
						<td>Type</td>
						<td><?php echo $project->type?></td>
					</tr>

					<tr>
						<td><strong>Budget And Costing</strong></td>
					</tr>

					<tr>
						<td>Cost</td>
						<td><?php echo amountHTML($project->cost)?></td>
					</tr>

					<?php if( mIsManagement() ):?>
						<tr>
							<td>Budget</td>
							<td><?php echo amountHTML($project->budget)?></td>
						</tr>

						<tr>
							<td>Max Budget</td>
							<td><?php echo amountHTML($project->max_budget)?></td>
						</tr>
					<?php endif?>

					<tr>
						<td><strong>Completion</strong></td>
					</tr>

					<tr>
						<td>Start</td>
						<td><?php echo $project->start_date?></td>
					</tr>

					<tr>
						<td>Estimated Completion Date</td>
						<td><?php echo $project->est_completion_date?></td>
					</tr>
					<tr>
						<td>Address</td>
						<td><p style="width:350px"><?php echo $project->address?></p></td>
					</tr>
				</table>
			</div>

			<?php if($isManagement):?>
				<div class="card-footer">
					<a href="<?php echo _route('project:edit' , $project->id)?>"><i class="feather icon-edit"></i>Edit</a>
				</div>
			<?php endif?>
		</div>

		<?php divider()?>
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Project Owner</h4>
			</div>

			<div class="card-body">
				<?php if( $owner) :?>
				<table class="table table-bordered">
					<tbody>
						<tr>
							<td>Name</td>
							<td><?php echo $owner->full_name?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><?php echo $owner->email?></td>
						</tr>
						<tr>
							<td>Contact Number</td>
							<td><?php echo $owner->phone?></td>
						</tr>
					</tbody>
				</table>
				<?php else:?>
					<?php if($isManagement):?>
						<p>No Owner <a href="<?php echo _route('project:addCustomer' , ['reference' => $project->reference])?>">Add Owner</a></p>
					<?php endif?>
				<?php endif?>
			</div>

			<?php if( $owner) :?>
				<?php if($isManagement):?>
					<div class="card-footer">
						<a href="<?php echo _route('project:addCustomer', null ,['reference' => $project->reference , 'owner' => $owner->id])?>" class='btn btn-primary btn-sm'>Change Owner</a>

						<a href="<?php echo _route('profile:index', $owner->id)?>" class='btn btn-primary btn-sm'>Edit Owner Details</a>
					</div>
				<?php endif?>
			<?php endif?>
		</div>

		<?php divider()?>
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Project Sectors</h4>
			</div>

			<?php $isManagement = mIsManagement()?>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<th>Sector</th>
							<?php if( $isManagement ):?>
							<th>Budget</th>
							<th>Max Budget</th>
							<th>Action</th>
							<?php endif;?>
						</thead>

						<tbody>
							<?php foreach($projectSectors as $pKey => $projectSector) : ?>
								<tr>
									<td><?php echo $projectSector->sector?></td>
									<?php if($isManagement) :?>
									<td><?php echo amountHTML($projectSector->budget)?></td>
									<td><?php echo amountHTML($projectSector->max_budget)?></td>
										<td>
											<a href="<?php echo _route('projectProjectSector:edit' , $projectSector->id)?>"
												class="btn btn-primary btn-sm"><i class="feather icon-edit"></i> Edit</a>
											<a href="<?php echo _route('projectProjectSector:delete' , $projectSector->id)?>"
												class="btn btn-danger btn-sm"> 
												<i class="feather icon-trash form-verify"></i> Delete</a>
										</td>
									<?php endif?>
								</tr>
							<?php endforeach?>
						</tbody>
					</table>
				</div>
			</div>
			<?php if($isManagement):?>
				<div class="card-footer">
					<a href="<?php echo _route('projectProjectSector:add' , $project->id)?>">Add</a>
				</div>
			<?php endif?>
		</div>

		<?php divider()?>
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Workers</h4>
			</div>

			<div class="card-body">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<th>Name</th>
							<th>Role</th>
							<?php if($isManagement) :?>
							<th>Salary</th>
							<th>Action</th>
							<?php endif?>
						</thead>

						<tbody>
							<?php foreach($workers as $worker) :?>
								<tr>
									<td><?php echo $worker->first_name . ' ' .$worker->last_name?></td>
									<td><?php echo $worker->role?></td>
									<?php if($isManagement) :?>
									<td><?php echo amountHTML($worker->salary)?></td>
										<td>
											<a href="<?php echo _route('worker:edit' , $worker->id) ?>" class="btn btn-primary btn-sm">Edit</a>
											<a href="#" class="btn btn-danger btn-sm">Delete</a>
										</td>
									<?php endif?>
								</tr>
							<?php endforeach?>
						</tbody>
					</table>
				</div>
			</div>
			<?php if($isManagement):?>
				<div class="card-footer">
					<a href="<?php echo _route('worker:add' , $project->id)?>">Add</a>
				</div>
			<?php endif?>
		</div>

	</div>
</div>
<?php endbuild()?>

<?php loadTo('project/show')?>