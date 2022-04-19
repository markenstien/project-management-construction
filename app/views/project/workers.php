<?php build('content')?>
	<?php $isManagement = mIsManagement()?>
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
						<th>Salary</th>
						<th>Action</th>
					</thead>

					<tbody>
						<?php foreach($workers as $worker) :?>
							<tr>
								<td><?php echo $worker->first_name . ' ' .$worker->last_name?></td>
								<td><?php echo $worker->role?></td>
								<td><?php echo amountHTML($worker->salary)?></td>
								<td>
									<a href="<?php echo _route('worker:edit' , $worker->id) ?>" class="btn btn-primary btn-sm">Edit</a>
									<a href="<?php echo _route('worker:delete' , $worker->id) ?>" class="btn btn-danger btn-sm">Delete</a>
								</td>
							</tr>
						<?php endforeach?>
					</tbody>
				</table>
			</div>
		</div>
		<?php if($isManagement) :?>
			<div class="card-footer">
				<a href="<?php echo _route('worker:add' , $project->id)?>">Add</a>
			</div>
		<?php endif?>
	</div>
<?php endbuild()?>

<?php loadTo('project/show')?>