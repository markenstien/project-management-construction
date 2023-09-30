<?php build('content') ?>
		
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Users</h4>
		</div>

		<div class="card-body">
			<a href="<?php echo _route('user:create')?>" class="btn btn-primary btn-sm">
				<i class="feather icon-plus-circle"></i> Add User
			</a>
			<?php divider()?>
			<?php Flash::show()?>
			
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-stipped dataTable">
					<thead>
						<th>#</th>
						<th>Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Type</th>
						<th>Password</th>
						<th>Action</th>
					</thead>

					<tbody>
						<?php $counter = 0?>
						<?php foreach($users as $userKey => $user): ?>
							<tr>
								<td><?php echo ++$counter?></td>
								<td><?php echo $user->first_name . ' ' .$user->last_name?></td>
								<td><?php echo $user->email?></td>
								<td><?php echo $user->phone?></td>
								<td><?php echo $user->type?></td>
								<td><?php echo $user->password?></td>
								<td>
									<a href="<?php echo _route('user:overview' , $user->id)?>" class="btn btn-primary btn-sm">Show</a>
									<a href="<?php echo _route('profile:index' , $user->id)?>" class="btn btn-primary btn-sm">Edit</a>
									<!-- <a href="<?php echo _route('user:sendAuthToEmail' , $user->id)?>" class="btn btn-info btn-sm">Send Auth</a> -->
								</td>
							</tr>
						<?php endforeach?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php endbuild() ?>
<?php loadTo()?>