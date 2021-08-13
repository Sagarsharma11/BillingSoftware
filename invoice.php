<!doctype html>
<html lang="en">

<?php
session_start();
error_reporting(0);
include "include/db.php";
?>

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="css/awt.css">
	<title>innovoice </title>
</head>

<style>
	.invoice {
		width: 580px;
		/* height: 842px; */
	}

	h2 {
		color: orangered;
	}

	@page {
		size: A4;
		margin: 0;
	}

	@media print {

		html,
		body {
			width: 210mm;
			height: 297mm;
		}

		/* ... the rest of the rules ... */
	}
</style>

<body>

	<section>

		<div class="container invoice border my-5">
			<h2 style="font-family: 'Dancing Script', cursive !important;
    		color: darkcyan;" class="text-center my-2">

				SAGAR OM ALANKAR


			</h2>
			<div class=" border-bottom border-5 row">
				<div class="col-sm-6">
					<h2 class=" py-5 px-1">INVOICE</h2>
					<h6 class="text-muted mx-2">
						GSTIN:

						<?php



						$CID =  $_SESSION["customer_id"];



						$gst_id = " select * from custmor where UID = '{$CID}';";
						$res_gst = mysqli_query($conn, $gst_id);
						$rowgst = $res_gst->fetch_assoc();
						$get_gst = $rowgst['gst'];

						if ($get_gst == "yes") {
							echo " 10BSAPK3465J1Z0";
						} else {
							echo "N/A";
						}


						?>

					</h6>

				</div>
				<div class="col-sm-6 mt-5">
					<p class="text-muted">Invoice Number <span class="mx-4 text-dark"><?php echo $_SESSION['customer_id']; ?></span> </p>
					<p class="text-muted">Invoice Date<span class="mx-4 text-dark"><?php echo date("d/m/Y") ?></span></p>
				</div>
			</div>
			<div class="  row border-bottom">
				<div class="col-sm-6">
					<h5 class="px-1 pt-2">Billing Information</h5>


					<h6 class="px-1 text-muted">Proprietor</h5>
						<p class="px-1">Sunny Kumar</p>
						<h6 class="px-1 text-muted">Address</h5>
							<p class="px-1">Garib Asthan Road, Sonapatti, Muzaffarpur (Bihar)</p>

							<h6 class="px-1 text-muted">Phone</h5>
								<p class="px-1">9334849298 , 7979007480</p>




				</div>
				<div class="col-sm-6">
					<h5 class="px-1 pt-2">Customer Information</h4>


						<h6 class="px-1 text-muted">Name
					</h5>
					<p class="px-1"><?php echo $_SESSION['customer_name']; ?></p>
					<h6 class="px-1 text-muted">Address</h5>
						<p class="px-1"><?php echo $_SESSION['customer_address']; ?></p>

						<h6 class="px-1 text-muted">Phone</h5>
							<p class="px-1"><?php echo $_SESSION['customer_phone']; ?></p>
				</div>
			</div>
			<div class="row">

				<table class="table rounded my-2">
					<thead>
						<tr>
							<th scope="col">sno.</th>
							<th scope="col">METAL</th>
							<th scope="col" class="text-center">ITEM</th>
							<th scope="col">QNT</th>
							<th scope="col">WEIGHT</th>
							<th scope="col">Making C</th>

							<th scope="col">TOTAL</th>
						</tr>
					</thead>
					<tbody>
						<?php

						$demo = 1;
						$customerid = $_SESSION['customer_id'];

						$bill = "SELECT * FROM bill where UID = '{$customerid}'";

						$resx = mysqli_query($conn, $bill);


						while ($rowx = $resx->fetch_assoc()) {



						?>
							<tr>
								<th scope="row"><?php echo $demo; ?></th>
								<td><?php echo $rowx['metal']; ?>
									<br>
									<p class="fw-bold text-success">
										<?php $metalprice = $rowx['metal'];

										$query = "select * from metal where metal = '{$metalprice}';";

										$myres = mysqli_query($conn, $query);

										$row = $myres->fetch_assoc();

										echo $row['price'];
										?> /gm
									</p>


								</td>
								<td>
									<?php echo strtoupper($rowx['item']); ?>
								</td>
								<td><?php echo $rowx['quantity']; ?>
								</td>
								<td><?php echo $rowx['weight'] . "gm"; ?></td>
								<td>
									<?php echo $rowx['makingcharge'] . "%"; ?>

								</td>

								<td>

									<?php

									$metalprice = $rowx['metal'];

									$query = "select * from metal where metal = '{$metalprice}';";

									$myres = mysqli_query($conn, $query);

									$row = $myres->fetch_assoc();



									$total = $row['price'] * $rowx['quantity'] * $rowx['weight'];
									$making_price = ($total * 10) / 100;

									$total = $total + $making_price;
									echo number_format((float)$total, 2, '.', '');



									$grandtotal = $grandtotal + $total;



									?>

								</td>


							</tr>

						<?php $demo++;
						} ?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>TOTAL</td>
							<td class="text-success fw-bold"><?php echo number_format((float)$grandtotal, 2, '.', '');  ?></td>

						</tr>

						<tr>
							<th scope="row"></th>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>
								GST
							</td>
							<td>

								<?php



								$CID =  $_SESSION["customer_id"];



								$gst_id = " select * from custmor where UID = '{$CID}';";
								$res_gst = mysqli_query($conn, $gst_id);
								$rowgst = $res_gst->fetch_assoc();
								$get_gst = $rowgst['gst'];

								if ($get_gst == "yes") {
									echo "3%";
								} else {
									echo "N/A";
								}


								?>



							</td>
						</tr>

						<tr>
							<th scope="row"></th>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>
								GRAND TOTAL
							</td>
							<td class="fw-bold text-success"><?php



																$CID =  $_SESSION["customer_id"];



																$gst_id = " select * from custmor where UID = '{$CID}';";
																$res_gst = mysqli_query($conn, $gst_id);
																$rowgst = $res_gst->fetch_assoc();
																$get_gst = $rowgst['gst'];

																if ($get_gst == "yes") {
																	$grandtotal_price = ($grandtotal * 3) / 100;
																	$grandtotal = $grandtotal_price + $grandtotal;
																	echo number_format((float)$grandtotal, 2, '.', '');

																} else {
																	echo number_format((float)$grandtotal, 2, '.', '');
																}


																?></td>
						</tr>


						</form>
					</tbody>
				</table>

			</div>
		</div>

		<h6 class="text-center">
			Payment done throungh <span class="text-muted ">
				<?php echo $_SESSION['customer_payment']; ?>

			</span>
		</h6>


	</section>

	<a href="index.php"> <--</a>


	<!-- Optional JavaScript; choose one of the two! -->

	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	<!-- Option 2: Separate Popper and Bootstrap JS -->
	<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>

<script>
	window.print();
</script>