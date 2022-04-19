<?php build('content')?>
	<?php divider()?>
	<?php Flash::show()?>

	<?php $isManagement = mIsManagement() ?>

	<?php if( !$owner) :?>
		<div class="alert alert-danger">
			<div class="alert-body">
				<div class="text-center">
					<p class="alert-text">
						This project has no owner!
						<br><a href="<?php echo _route('project:addCustomer' , ['reference' => $project->reference])?>">Add Owner</a>
					</p>
				</div>
			</div>
		</div>
	<?php endif?>

	<div class="row">
		<div class="col-sm-12 col-md-2">
            <div class="card">
            	<div class="card-body">
            		<div class="nav flex-column nav-pills" 
            			role="tablist" aria-orientation="vertical">
		                <a class="nav-link <?php echo isEqual($page, 'overview') ? 'active' : ''?>"
		                href="<?php echo _route('project:show' , $project->id , ['page' => 'overview'])?>" 
		                role="tab" 
		                aria-selected="true">
		            	Home</a>

		                <a class="nav-link <?php echo isEqual($page, 'files') ? 'active' : ''?>"
		                href="<?php echo _route('project:show' , $project->id , ['page' => 'files'])?>" 
		                role="tab" 
		                aria-selected="false">
		            	File Gallery</a>
		            	<?php if( $isManagement ):?>
		            	<a class="nav-link <?php echo isEqual($page, 'expenses') ? 'active' : ''?>"
		                href="<?php echo _route('project:show' , $project->id , ['page' => 'expenses'])?>" 
		                role="tab" 
		                aria-selected="false">
		            	Expenses</a>
		            	<?php endif?>

		                <a class="nav-link <?php echo isEqual($page, 'progress') ? 'active' : ''?>" 
		                	href="<?php echo _route('project:show' , $project->id , ['page' => 'progress'])?>" 
		                	role="tab"
		                	aria-selected="false">
		                Progress</a>
		                <?php if( $isManagement ):?>
		                <a class="nav-link <?php echo isEqual($page, 'workers') ? 'active' : ''?>" 
		                	href="<?php echo _route('project:show' , $project->id , ['page' => 'workers'])?>" 
		                	role="tab"
		                	aria-selected="false">
		                Workers</a>
		                <?php endif?>
		            </div>
            	</div>

            	<div class="card-footer">
            		<?php if( $isManagement ):?>
	            		<?php if( isEqual($project->status , 'on-going') ) :?>
		            		<?php
		            			Form::open([
		            				'method' => 'post',
		            				'action' => _route('project:updateStatus')
		            			]);

		            			Form::hidden('id' , $project->id);
		            		?>

		            		<div class="form-group">
		            			<?php
		            				Form::label('Actions');
		            				Form::select('status' , [
		            					'Completed' => 'Complete',
		            					'Cancelled' => 'Cancelled',
		            					'Delete'    => 'Delete'
		            				] , '' , [
		            					'class' => 'form-control'
		            				]);
		            			?>
		            		</div>

		            		<div class="form-group">
		            			<?php Form::submit('' , 'Update Project' , ['class' => 'btn btn-primary btn-sm'])?>
		            		</div>
		            		<?php Form::close()?>
		            	<?php endif?>
	            	<?php endif?>

	            	<?php if( !isEqual($project->status , 'on-going') ) :?>
	            		<div class="badge badge-info"><?php echo $project->status?></div>
	            	<?php endif?>
            	</div>
            </div>
        </div>

        <div class="col-md-9">
        	<?php produce('content') ?>
        </div>
	</div>
<?php endbuild()?>
<?php loadTo()?>