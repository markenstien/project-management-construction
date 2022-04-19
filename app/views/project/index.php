<?php build('content')?>
	<?php $isManagement = mIsManagement()?>
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Projects</h4>
		</div>

		<div class="card-body">
			<?php if($isManagement) :?>
				<a href="<?php echo _route('project:create')?>" class="btn btn-primary btn-sm">
					<i class="feather icon-plus-circle"></i> Add Project
				</a>
			<?php endif?>
			<div class="table-responsive">
				<table class="display table table-striped table-bordered dataTable">
					<thead>
						<th>#</th>
						<th>Title</th>
						<th>Type</th>
						<th>Classification</th>
						<th>Status</th>
						<th>Address</th>
						<th>Completion</th>
						<th>Actions</th>
					</thead>

					<tbody>
						<?php $counter = 0?>
						<?php foreach($projects as $key => $project) :?>
							<tr>
								<td><?php echo ++$counter?></td>
								<td><?php echo $project->title?></td>
								<td><?php echo $project->type?></td>
								<td><?php echo $project->classification?></td>
								<td><?php wBadge($project->status)?></td>
								<td>
									<p style="width:300px">
										<?php echo $project->address?>
									</p>
								</td>
								<td><?php echo $project->est_completion_date?></td>
								<td>
									<a href="<?php echo _route('project:show' , $project->id)?>" class="btn btn-primary btn-sm">
										<i class="feather icon-eye"></i> Show
									</a>
								</td>
							</tr>
						<?php endforeach?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
<?php endbuild()?>

<?php loadTo()?>