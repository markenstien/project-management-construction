<?php build('content')?>
	
	<div class="col-md-7 mx-auto">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Add Project Sector</h4>
			</div>

			<div class="card-body">

				<?php
					Form::open([
						'method' => 'post',
						'action' => _route('project:addSectors')
					]);

					Form::hidden('project_id' , $projectId);
				?>
				<?php foreach( $sectors as $sectorKey => $sector) :?>
					<div class="form-section" style="border: 1px solid #000;padding: 10px;">
						<h4 class="form-section-title"><?php echo $sector->sector?></h4>
						<div class="form-group">
							<?php
								Form::hidden("sector_id[$sectorKey]" , $sector->id);
							?>
						</div>

						<div class="row form-group">
							<div class="col">
								<?php
									Form::label('Budget');
									Form::text("budget[$sectorKey]" , $sector->cost , [
										'class' => 'form-control',
										'required' => ''
									]);
								?>
							</div>

							<div class="col">
								<?php
									Form::label('Max Budget');
									Form::text("max_budget[$sectorKey]" , $sector->cost - ($sector->cost * .40) , [
										'class' => 'form-control',
										'required' => ''
									]);
								?>
							</div>
						</div>

						<a href="#" class="btn btn-danger btn-sm btn-delete"> <i class="feather icon-trash"></i> Delete Sector</a>
					</div>
				<?php endforeach?>

				<div class="form-group">
					<?php Form::submit('' , 'Add Project Sector')?>
				</div>

				<?php Form::close()?>
			</div>
		</div>
	</div>
<?php endbuild()?>

<?php build('scripts')?>
	<script type="text/javascript">
		$( document ).ready( function ()
		{
			$('.btn-delete').click( function() 
			{
				$(this).parent().remove();
			});
		});
	</script>
<?php endbuild()?>

<?php loadTo()?>