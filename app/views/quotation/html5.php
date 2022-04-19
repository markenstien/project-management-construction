<?php
	$classification = $quotation->meta_values->CLASSIFICATION;
	$address = $quotation->meta_values->ADDRESS;
	$size = $quotation->meta_values->SIZE;
	$sectors = $quotation->meta_values->SECTORS;
	$owner = $quotation->meta_values->OWNER;
	$image = URL.DS.'public/logo_white.png';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<title></title>

	<style type="text/css">
		#quotation_document .header h1,
		h3, h3, h4 , h5 ,p
		{
			margin: 10px 0px;
		}

		#quotation_document
		{
			width: 800px;
			margin: 0px auto;
			font-family: tahoma , verdana , arial;
			background: #eee;
		}

		#quotation_document .header , 
		#quotation_document .footer{
			text-align: center;
			padding: 15px;
		}

		#quotation_document table {
			width: 100%;
		    border-spacing: 10px;
		    border-collapse: separate;
		    background: #fff;
		}

		#quotation_document .footer .contacts
		{
			margin: 0px;
			padding: 0px;
			text-align: center;
			list-style: none;
		}

		#quotation_document .text-center
		{
			text-align: center;
		}

		#quotation_document .body
		{
			background: #fff;
			padding: 10px;
		}
	</style>
</head>
<body>

	<div id="quotation_document">
		<div class="header">
			<div class="text-center">
				<img src="<?php echo $image?>" style="width:200px">
				<h3><?php echo COMPANY_NAME?></h3>
				<p>zone5 , gimenez park subdivision. conception pequena. naga city</p>
			</div>
		</div>

		<div class="body">
			<section class="section">

				<div class="text-center">
					<h4><?php echo $classification->classification?> Project Quotation</h4>
					<p>Reference : #<?php echo $quotation->reference?></p>
				</div>

				<table class="table">
					<tr>
						<td><h3>Owner</h3></td>
					</tr>

					<tr>
						<td>Name : </td>
						<td><?php echo $owner->first_name?></td>
					</tr>
					<tr>
						<td>Email : </td>
						<td><?php echo $owner->email?></td>
					</tr>
					<tr>
						<td>Contact : </td>
						<td><?php echo $owner->mobile?></td>
					</tr>

					<!--=== PROJECT === -->
					<tr>
						<td><h3>Project</h3></td>
					</tr>

					<tr>
						<td>Type : </td>
						<td><?php echo $classification->type?></td>
					</tr>
					<tr>
						<td>Classification : </td>
						<td><?php echo $classification->classification?></td>
					</tr>

					<tr>
						<td>Size : </td>
						<td><?php echo $size->size?> SQM</td>
					</tr>
					<tr>
						<td>Storey : </td>
						<td><?php echo $size->storey?></td>
					</tr>

					<!--=== PROJECT SECTORS === -->
					<tr>
						<td><h3>Project Sectors</h3></td>
					</tr>
					<?php $totalCost = 0?>
					<?php foreach($sectors as $key => $sector) :?>
						<?php $totalCost += $sector->cost;?>
						<tr>
							<td><?php echo $sector->sector?></td>
							<td>PHP <?php echo toMoney($sector->cost)?></td>
						</tr>
					<?php endforeach?>

					<!--=== ADDRESS === -->
					<tr>
						<td><h3>Address</h3></td>
					</tr>
					<tr>
						<td>Address: </td>
						<td>
							<address style="width:350px"><?php echo $address->address?></address>
						</td>
					</tr>

					<tr>
						<td>Landmark: </td>
						<td><?php echo $address->landmark?></td>
					</tr>

					<tr>
						<td colspan="2">
							<h3>Project Cost Estimation : PHP <?php echo toMoney($totalCost)?></h3>
						</td>
					</tr>
				</table>
			</section>
		</div>

		<div class="footer">
			<h3>Paintman Construction</h3>
			<div>
				<img src="<?php echo $image?>" style="width:150px">
			</div>
			<p>zone5 , gimenez park subdivision. conception pequena. naga city</p>

			<ul class="contacts">
				<li>Email : paintmanconstruction@gmail.com</li>
				<li>Tel : 054-8812109</li>
				<li>Mobile : +639465212272</li>
			</ul>
		</div>
	</div>
</body>
</html>