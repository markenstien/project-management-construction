<?php build('content') ?>
	
	<?php divider()?>

	<div class="col-md-8 mx-auto">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Account Overview</h4>
			</div>

			<div class="card-body">
				<?php Flash::show()?>
				<h5 style="color:black" class="card-subtitle"><?php echo strtoupper($user->type)?></h5>
				<ul class="list-group">
					<li class="list-group-item">
						<div class="row">
							<div class="col">
								<div class="list-tile">
									<div class="title"><?php echo $user->first_name?></div>
									<div class="subtitle">First Name</div>
								</div>
							</div>

							<div class="col">
								<div class="list-tile">
									<div class="title"><?php echo $user->last_name?></div>
									<div class="subtitle">Last Name</div>
								</div>
							</div>
						</div>
					</li>

					<li class="list-group-item">
						<div class="row">
							<div class="col">
								<div class="list-tile">
									<div class="title"><?php echo $user->email?></div>
									<div class="subtitle">Email</div>
								</div>
							</div>

							<div class="col">
								<div class="list-tile">
									<div class="title"><?php echo $user->phone ?? 'N/A'?></div>
									<div class="subtitle">Contact Number</div>
								</div>
							</div>
						</div>
					</li>

					<li class="list-group-item">
						<a href="<?php echo _route('user:sendAuthToEmail' , $user->id)?>">Send Auth</a>
					</li>
				</ul>

				<?php if( isset($projects)) :?>
					<section class="form-section">
						<h4 class="form-section-title">Projects</h4>
							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<th>#</th>
										<th>Reference</th>
										<th>Title</th>
										<th>Cost</th>
										<th>Classification</th>
										<th>Status</th>
										<th>Date</th>
									</thead>	

									<tbody>
										<?php $counter = 0?>
										<?php foreach($projects as $projectKey => $project) :?>
											<tr>
												<td><?php echo ++$counter?></td>
												<td>
													<a href="<?php echo _route('project:show' , $project->id)?>"><?php echo $project->reference?></a>
												</td>
												<td><?php echo $project->title?></td>
												<td><?php echo $project->cost?></td>
												<td><?php echo $project->classification?></td>
												<td><?php echo $project->status ?? 'N/A'?></td>
												<td><?php echo $project->completion_date ?? 'N/A'?></td>
											</tr>
										<?php endforeach?>
									</tbody>
								</table>
							</div>
					</section>
				<?php endif?>
			</div>
		</div>
	</div>

<?php endbuild()?>
<?php loadTo()?>