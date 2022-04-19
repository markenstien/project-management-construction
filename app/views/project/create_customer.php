<?php build('content') ?>
	<div class="col-md-10 mx-auto">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Add Customer</h4>
				<?php wReturnLink( _route('project:show' , $project->id) )?>
			</div>
			<div class="card-body">
				<?php if( isEqual($formView , 'new_customer')) :?>
					<a href="<?php echo _route('project:addCustomer' , $project->id , ['reference' => $project->reference , 'form_view' => 'customer_on_file'])?>"
							class="btn btn-primary btn-sm">Show Customers</a>
				<?php else:?>
					<a href="<?php echo _route('project:addCustomer' , $project->id , ['reference' => $project->reference , 'form_view' => 'new_customer'])?>" class="btn btn-primary btn-sm">New Customer</a>
				<?php endif?>

				<?php divider()?>

				<?php if( isEqual( $formView , 'new_customer') ) :?>
					<?php Flash::show()?>
					<?php
						Form::open([
							'method' => 'post',
							'action' => _route('project:addCustomerCreate')
						]);

						Form::hidden('id' , $project->id);
					?>
					<div class="row form-group">
						<div class="col">
							<?php
								Form::label('First name');
								Form::text('first_name' , $owner->first_name ?? '' , [
									'class' => 'form-control',
									'required' => ''
								]);
							?>
						</div>

						<div class="col">
							<?php
								Form::label('Last name');
								Form::text('last_name' , $owner->last_name ?? '' , [
									'class' => 'form-control',
									'required' => ''
								]);
							?>
						</div>
					</div>

					<div class="form-group">
						<?php
							Form::label('Email *');
							Form::text('email' , $owner->email ?? '' , [
								'class' => 'form-control',
								'required' => ''
							]);
						?>
					</div>

					<div class="form-group">
						<?php
							Form::label('Contact Number *');
							Form::text('phone' , $owner->phone ?? '' , [
								'class' => 'form-control',
								'required' => ''
							]);
						?>
					</div>

					<div class="form-group">
						<?php
							Form::label('Notes');
							Form::textarea('notes' , $notes ?? '' , [
								'class' => 'form-control',
							]);
							Form::small('tell us something about your project.');
						?>
					</div>

					<div class="form-group">
						<?php Form::submit('' , 'Finish' , [
							'class' => 'btn btn-primary'
						])?>
					</div>
					<?php Form::close()?>
				<?php endif?>

				<?php if( isEqual($formView , 'customer_on_file') ):?>
						<table class="table table-bordered dataTable">
							<thead>
								<th>#</th>
								<th>Name</th>
								<th>Email</th>
								<th>Contact</th>
								<th>Action</th>
							</thead>

							<tbody>
								<?php $counter = 0 ?>
								<?php foreach( $customers as $customerKey => $customer ):?>
									<tr>
										<td><?php echo ++$counter?></td>
										<td><?php echo $customer->full_name?></td>
										<td><?php echo $customer->email?></td>
										<td><?php echo $customer->phone?></td>
										<td>
											<?php
												Form::open([
													'method' => 'post',
													'action' => _route('project:addCustomer' , ['reference' => $project->reference])
												]);

												Form::hidden('project_id' , $project->id);
												Form::hidden('customer_id' , $customer->id);
											?>

											<div class="form-group">
												<?php Form::submit('' , 'Select Customer' , ['class' => 'form-verify btn btn-primary btn-sm'])?>
											</div>

											<?php Form::close()?>
										</td>
									</tr>
								<?php endforeach?>
							</tbody>
						</table>
				<?php endif?>
			</div>
		</div>
	</div>
<?php endbuild()?>
<?php loadTo()?>