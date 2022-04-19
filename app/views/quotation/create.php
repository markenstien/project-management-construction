<?php build('content')?>
	
	<?php divider()?>

	<?php
		$classification = $quotation->meta_values->CLASSIFICATION;
		$address = $quotation->meta_values->ADDRESS;
		$size = $quotation->meta_values->SIZE;
		$sectors = $quotation->meta_values->SECTORS;
	?>
	<div class="row offset offset-md-2">
		<div class="col-md-6">
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
						<a href="<?php echo _route('quote:projectOwner',['isEdit' => true])?>"><i class="feather icon-edit"></i> Edit</a>
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
								<td colspan="2">
									<a href="<?php echo _route('quote:projectSize',['isEdit' => true])?>"><i class="feather icon-edit"></i> Edit</a>
								</td>
							</tr>
							<tr>
								<td>Classification:</td>
								<td><?php echo $classification->classification?></td>
							</tr>
							<tr>
								<td>Type:</td>
								<td><?php echo $classification->type?></td>
							</tr>
							<tr>
								<td colspan="2">
									<a href="<?php echo _route('quote:projectClassification',['isEdit' => true])?>"><i class="feather icon-edit"></i> Edit</a>
								</td>
							</tr>
						</table>
						
					</section>

					<section>
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
										<td>****</td>
									</tr>
								<?php endforeach?>
							</tbody>
						</table>
						<a href="<?php echo _route('quote:projectSector',['isEdit' => true])?>"><i class="feather icon-edit"></i> Edit</a>
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
						<a href="<?php echo _route('quote:projectAddress',['isEdit' => true])?>"><i class="feather icon-edit"></i> Edit</a>
					</section>

					<section class="cost-amount-section">
						<h4 class="card-title">Project Cost Estimation : ****</h4>
					</section>
				</div>
			</div>


			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Attachments</h4>
					<a href="<?php echo _route('quote:projectAttachment',['isEdit' => true])?>"><i class="feather icon-edit"></i> Edit</a>
				</div>

				<div class="card-body">
					<div class="section">
						<h4 class="card-title">Image and Documents</h4>
						<?php 
							if( $attachments )
							{
								foreach($attachments as $key => $attachment)
								{
									$ext = explode('.', $attachment->name);
									$ext = end($ext);

									if( isEqual($ext , ['png' ,'jpg' , 'jpeg']) )
									{
										?> 
											<div class="hover-show-delete file">
												<img src="<?php echo $attachment->url.'/'.$attachment->name?>" style="width: 75px;">

												<div class="hidden-delete-button">
													<a href="<?php echo _route('file:delete' , $attachment->id)?>" style="text-decoration: underline;">Delete</a>
												</div>
											</div>
										<?php
									}
								}

								echo '<div> </div>';

								foreach($attachments as $key => $attachment)
								{
									$ext = explode('.', $attachment->name);
									$ext = end($ext);

									if( !isEqual($ext , ['png' ,'jpg' , 'jpeg']) )
									{
										?> 
											<div class="hover-show-delete file">
												<a href="#" >
													<div>
														<?php echo $attachment->display_name?>
													</div>
												</a>

												<div class="hidden-delete-button">
													<a href="<?php echo _route('file:delete' , $attachment->id)?>" style="text-decoration: underline;">Delete</a>
												</div>
											</div>
										<?php
									}
								}
							}
						?>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Send Quote to your email</h4>
				</div>

				<div class="card-body">
					<?php Flash::show()?>

					<?php
						Form::open([
							'method' => 'post',
							'action' => _route('quote:sendToEmail')
						]);

						Form::hidden('id' , $quotation->id);

						Form::hidden('returnTo' , _route('landing:quotationSent'));

						Form::hidden('sendToTheTeam' , true);

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
						<label>
							<?php Form::checkbox('' ,'' , ['required' => ''])?>
							I am aware that this information will be saved.
						</label>
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
			</div>
			
		</div>
	</div>
	
<?php endbuild()?>
<?php build('headers')?>
	<style type="text/css">
		section
		{
			margin: 30px 0px;
		}
		.cost-amount-section{
			background: #eee;
			padding: 10px;
		}

		.hover-show-delete:hover .hidden-delete-button
		{
			display: block;
		}
		
		.hidden-delete-button
		{
			display: none;
		}
		.file{
			margin-top: 20px;
			border: 1px solid #000;
			display: inline-block;
			width: 150px;
		}
	</style>
<?php endbuild()?>

<?php loadTo('tmp/public')?>