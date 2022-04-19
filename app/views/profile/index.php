<?php build('content')?>
	<?php divider()?>

	<div class="col-md-5 mx-auto">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Profile</h4>
			</div>

			<div class="card-body">
				<?php Flash::show()?>
				<ul class="list-group">
					<li class="list-group-item">
						First Name : <?php echo $user->first_name?>
						<div>
							<a href="<?php echo _route('user:editSingle',$user->id,['field' => 'first_name'])?>"><i class="feather icon-edit"></i>Edit</a>
						</div>
					</li>
					<li class="list-group-item">
						Last Name : <?php echo $user->last_name?>
						<div>
							<a href="<?php echo _route('user:editSingle',$user->id,['field' => 'last_name'])?>"><i class="feather icon-edit"></i>Edit</a>
						</div>
					</li>
					<li class="list-group-item">
						Email : <?php echo $user->email?>
						<div>
							<a href="<?php echo _route('user:editSingle',$user->id,['field' => 'email'])?>"><i class="feather icon-edit"></i>Edit</a>
						</div>
					</li>
					<li class="list-group-item">
						Phone : <?php echo $user->phone?>
						<div>
							<a href="<?php echo _route('user:editSingle',$user->id,['field' => 'phone'])?>"><i class="feather icon-edit"></i>Edit</a>
						</div>
					</li>
					<li class="list-group-item">
						Password : ****
						<div>
							<a href="<?php echo _route('user:editSingle',$user->id,['field' => 'password'])?>"><i class="feather icon-edit"></i>Edit</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>