<?php build('content')?>
	
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Categories</h4>
		</div>

		<div class="card-body">
			<a href="<?php echo _route('projectSector:create')?>" class="btn btn-primary btn-sm">
				<i class="feather icon-plus-circle"></i> Add Categories
			</a>
			<div class="table-responsive">
				<table class="display table table-striped table-bordered dataTable">
					<thead>
						<th>#</th>
						<th>Sector</th>
						<th>Description</th>
						<th>Actions</th>
					</thead>

					<tbody>
						<?php $counter = 0?>
						<?php foreach($projectSectors as $key => $sector) :?>
							<tr>
								<td><?php echo ++$counter?></td>
								<td><?php echo $sector->sector?></td>
								<td><?php echo $sector->description?></td>
								<td>
									<a href="<?php echo _route('projectSector:edit' , $sector->id)?>" class="btn btn-primary btn-sm">
										<i class="feather icon-edit"></i> Edit
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