<?php build('content') ?>
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Quotations</h4>
		</div>

		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-stipped dataTable">
					<thead>
						<th>#</th>
						<th>Reference</th>
						<th>Name</th>
						<th>Address</th>
						<th>Date</th>
						<th>Status</th>
						<th>Action</th>
					</thead>

					<tbody>
						<?php $counter = 0?>
						<?php foreach($quotations as $key => $quote): ?>
						<?php
							$metaValue = $quote->meta_values;

							$owner = $metaValue->OWNER ?? '';
							$address = $metaValue->ADDRESS ?? '';

							if( empty($owner) || empty($address))
								continue;
						?>
							<tr>
								<td><?php echo ++$counter?></td>
								<td>#<?php echo $quote->reference?></td>
								<td><?php echo $metaValue->OWNER->first_name . ' '. $metaValue->OWNER->last_name?></td>
								<td><p style="width:300px;"><?php echo $metaValue->ADDRESS->address?></p></td>
								<td><?php echo $quote->created_at?></td>
								<td>
									<?php echo wBadge($quote->status)?>
								</td>
								<td>
									<a href="<?php echo _route('quote:show' , $quote->id , ['module' => 'quotation'])?>" class="btn btn-primary btn-sm">
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
<?php endbuild() ?>
<?php loadTo()?>