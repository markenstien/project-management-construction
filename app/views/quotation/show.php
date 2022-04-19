<?php build('content')?>
	
	<?php divider()?>

	<?php
		$classification = $quotation->meta_values->CLASSIFICATION;
		$address = $quotation->meta_values->ADDRESS;
		$size = $quotation->meta_values->SIZE;
		$sectors = $quotation->meta_values->SECTORS;
	?>

	<div class="row">
		<div class="col-md-6 offset-1">
			<div class="card">
				<div class="card-body">
					<div class="text-center">
						<h3>Quotation</h3>
						<h5>#<?php echo $quotation->reference?></h5>
						<p><strong><?php echo $classification->classification?> Project</strong> @ <br>
							<span style="width:400px"><?php echo $address->address?></span>
						</p>
					</div>

					<section>
						<h4 class="card-title">Owner</h4>

						<?php $owner = $quotation->meta_values->OWNER?>
						<table class="table table-bordered">
							<tr>
								<td>Name:</td>
								<td><?php echo $owner->first_name . ' '.$owner->last_name?></td>
							</tr>
							<tr>
								<td>Email:</td>
								<td><?php echo $owner->email?></td>
							</tr>
							<tr>
								<td>Contact Number:</td>
								<td><?php echo $owner->mobile?></td>
							</tr>
						</table>
					</section>

					<section>
						<h4 class="card-title">Project</h4>

						<?php $owner = $quotation->meta_values->OWNER?>
						<table class="table table-bordered">
							<tr>
								<td>Size:</td>
								<td><?php echo $size->size?> SQM</td>
							</tr>
							<tr>
								<td>Storey:</td>
								<td><?php echo $size->storey?></td>
							</tr>
							<tr>
								<td>Classification:</td>
								<td><?php echo $classification->classification?></td>
							</tr>
							<tr>
								<td>Type:</td>
								<td><?php echo $classification->type?></td>
							</tr>
						</table>

						<h4 class="card-title">Project Sectors</h4>

						<?php $totalCost = 0?>
						<table class="table table-bordered">
							<thead>
								<th>Sector</th>
								<th>Cost</th>
							</thead>

							<tbody>
								<?php foreach($sectors as $key => $sector) :?>
									<?php $totalCost += $sector->cost;?>
									<tr>
										<td><?php echo $sector->sector?></td>
										<td><?php echo toMoney($sector->cost)?></td>
									</tr>
								<?php endforeach?>
							</tbody>
						</table>
					</section>

					<section>
						<h4 class="card-title">Address</h4>
						<table class="table table-bordered">
							<tr>
								<td>Address: </td>
								<td>
									<address><?php echo $address->address?></address>
								</td>
							</tr>

							<tr>
								<td>Landmark: </td>
								<td><?php echo $address->landmark?></td>
							</tr>
						</table>
					</section>

					<section class="cost-amount-section">
						<h4 class="card-title">Project Cost Estimation : <?php echo toMoney($totalCost)?></h4>
					</section>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Commands</h4>
				</div>

				<div class="card-body">
					<?php Flash::show()?>

					<?php
						Form::open([
							'method' => 'post',
							'action' => _route('quote:sendToEmail')
						]);

						Form::hidden('id' , $quotation->id);
					?>

					<div class="form-group">
						<?php
							Form::label('Email');
							Form::text('email' , $owner->email , [
								'class' => 'form-control'
							])
						?>
					</div>
					<div class="form-group">
						<?php
							Form::submit('' , 'Send To Email' , [
								'class' => 'btn btn-primary'
							]);
						?>
					</div>
					<?php Form::close()?>
				</div>

				<div class="card-footer">
					<div class="controls">
						<div class="btn-group">
							<a href="#" class="btn btn-danger btn-sm">Archive</a>
							<a href="#" class="btn btn-primary btn-sm">Lead</a>
							<a href="<?php echo _route('project:createByQuote' , ['reference' => $quotation->reference])?>" class="btn btn-success btn-sm">Create Project</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
<?php endbuild()?>
<?php build('headers')?>
	<style type="text/css">
		.cost-amount-section{
			background: #eee;
			padding: 10px;
		}
	</style>
<?php endbuild()?>
<?php loadTo()?>