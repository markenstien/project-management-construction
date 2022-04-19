<?php build('content')?>
	<?php divider() ?>


	<div class="row">
		<div class="col-md-4 col-sm-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span class="action-icon badge badge-primary-inverse mr-0"><i class="feather icon-folder"></i></span>
                        </div>
                        <div class="col-7 text-right">
                            <h5 class="card-title font-14">Projects</h5>
                            <h4 class="mb-0"><?php echo $summary['totalProject']?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span class="action-icon badge badge-primary-inverse mr-0 text-info"><i class="feather icon-folder"></i></span>
                        </div>
                        <div class="col-7 text-right">
                            <h5 class="card-title font-14">Completed</h5>
                            <h4 class="mb-0"><?php echo count($summary['groupedProjects']['completed'])?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <span class="action-icon badge badge-primary-inverse mr-0 text-success"><i class="feather icon-folder"></i></span>
                        </div>
                        <div class="col-7 text-right">
                            <h5 class="card-title font-14">On-going</h5>
                            <h4 class="mb-0"><?php echo count($summary['groupedProjects']['on-going'])?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>

    <canvas id="chartjs-line-bar-mixed-chart"></canvas>
<?php endbuild()?>

<?php build('scripts')?>
<!-- Chart js -->
<script src="<?php echo _path_tmp('plugins/chart.js/chart.min.js')?>"></script>
<script src="<?php echo _path_tmp('plugins/chart.js/chart-bundle.min.js')?>"></script>
<script src="<?php echo _path_tmp('js/custom/custom-chart-chartjs.js')?>"></script>-
<?php endbuild()?>

<?php loadTo()?>