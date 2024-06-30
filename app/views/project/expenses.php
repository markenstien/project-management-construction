<?php build('content')?>
    <?php $isManagement = mIsManagement()?>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Expenses</h4>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Budget</th>
                        <th>Max Budget</th>
                        <th><span title="Budget Percentage (Amount % Budget)">Budg%</span></th>
                        <th>Sector</th>
                        <th>Description</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        <?php $total = 0?>
                        <?php foreach($expenses as $expense) :?>
                            <?php 
                                $total += $expense->amount;
                                $percentage = ($expense->amount / $expense->budget) * 100;
                            ?>
                            <tr>
                                <td><?php echo $expense->expenses?></td>
                                <td><?php echo toMoney($expense->amount)?></td>
                                <td><?php echo toMoney($expense->budget)?></td>
                                <td><?php echo toMoney($expense->max_budget)?></td>
                                <td>
                                    <?php if(($percentage) > 100) : ?>
                                        <span class="badge badge-danger" style="over budget"> <?php echo $percentage.'%'?>Over Budg.</span>
                                    <?php else:?>
                                        <span class="badge badge-success"> <?php echo $percentage.'%'?> Good</span>
                                    <?php endif?>
                                </td>
                                <td><?php echo $expense->sector?></td>
                                <td>
                                    <p style="width:350px"><?php echo $expense->description?></p>
                                </td>
                                <td><a href="<?php echo _route('expenses:edit' , $expense->id)?>" 
                                    class="btn btn-sm btn-primary">Edit</a> 
                                    <a href="<?php echo _route('expenses:delete' , $expense->id)?>" 
                                        class="btn btn-sm btn-danger">Delete</a></td>
                            </tr>
                        <?php endforeach?>
                </table>
            </div>

            <h5>Expenses Total : <?php echo toMoney($total)?></h5>
        </div>

        <?php if($isManagement) :?>
            <div class="card-footer">
                <a href="<?php echo _route('expenses:add' , $project->id)?>">Add</a>
            </div>
        <?php endif?>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Expenses Summary</h4>

        </div>

        <div class="card-body">
            <h4 class="card-subtitle" style="color:blue">Expenses grouped by sector</h4>

            <?php
                $totalExpenses = 0;
                $sectors = [];
                $sectorColors = [];
            ?>

            <?php
                foreach($expenses as $expenseKey => $expense)
                {
                    $sector = $expense->sector;
                    $amount = $expense->amount;

                    if( !isset( $sectors[$sector]) )
                        $sectors[$sector] = 0;

                    $sectors[$sector] += $amount;
                    $totalExpenses += $amount;
                }


                foreach($sectors as $color) {
                    $sectorColors[] = '#'.random_color();
                }

                $sectorsValues = [];

                foreach( array_values($sectors) as $sectorVal ){
                    $sectorsValues[] = round(($sectorVal / $totalExpenses) * 100 , 2);
                }
            ?>

            <canvas id="expensesChart" class="chartjs-chart" style="min-width: 150x;"></canvas>

            <table class="table">
                <tr>
                    <td>Expenses</td>
                    <td>Amount</td>
                    <td>Percentage</td>
                </tr>

                <?php foreach($sectors as $key => $val) :?>
                    <?php $percentage = round(($val / $totalExpenses) * 100 , 2);?>
                    <tr>
                        <td><?php echo $key?></td>
                        <td><?php echo toMoney($val)?></td>
                        <td><?php echo $percentage.'%'?></td>
                    </tr>
                <?php endforeach?>
                <tr>
                    <td>Expenses</td>
                    <td><?php echo toMoney( $totalExpenses )?></td>
                    <td>100%</td>
                </tr>
            </table>
        </div>
    </div>
<?php endbuild()?>

<?php build('scripts')?>
<!-- Chartist Chart JS -->
    <script src="<?php echo _path_tmp('plugins/chartist-js/chartist.min.js')?>"></script>
    <script src="<?php echo _path_tmp('plugins/chartist-js/chartist-plugin-tooltip.min.js')?>"></script>

    <script src="<?php echo _path_tmp('plugins/chart.js/chart.min.js')?>"></script>
    <script src="<?php echo _path_tmp('plugins/chart.js/chart-bundle.min.js')?>"></script>

    <?php
        $sectorColorsString = implode('","' , $sectorColors);
        $sectorKeysString = implode('","' , array_keys($sectors));
        $sectorValuesString = implode(',' , $sectorsValues);

        // dump([
        //     $sectorKeysString,
        //     $sectorValuesString
        // ]);
        print <<<EOF
            <script type="text/javascript" defer>
                $( document ).ready( function() 
                {
                    var pieChartID = document.getElementById("expensesChart").getContext('2d');
                    var pieChart = new Chart(pieChartID, {
                        type: 'pie',
                        data: {
                            datasets: [{
                                data: [{$sectorValuesString}],
                                borderColor: 'transparent',
                                backgroundColor: ["{$sectorColorsString}"],
                                label: 'Dataset 1'
                            }],
                            labels: ["{$sectorKeysString}"]
                        },
                        options: {
                            responsive: true
                        }
                    });
                }); 
            </script>
        EOF;
    ?>
    
<?php endbuild()?>
<?php loadTo('project/show')?>