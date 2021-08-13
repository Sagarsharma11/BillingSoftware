<?php

session_start();
error_reporting(0);

include 'include/Header.php';
include 'include/top-header.php';
include 'include/menu.php';
include 'include/db.php';


?>

<section class="main-section  page-wrapper">
	<div class="content">
		<div class="row">
			<h1 class="fw-bold text-center bg-primary text-white">
				Today Price
				</h4>
				<?php

				$query = "SELECT * FROM metal";

				$res = mysqli_query($conn, $query);

				while ($row = $res->fetch_assoc()) {

				?>
					<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3 ">



						<div class="dash-widget shadow-sm">
							<span style="background-color: orangered;" class="dash-widget-bg1 my-3"><i class="fad fa-treasure-chest"></i></span>
							<div class="dash-widget-info text-right">
								<h1 style="color:gold"><?php echo $row['metal']; ?></h1>
								<h3><?php echo $row['price']; ?>/g</h3>
								<span style="background-color: orangered;" class="widget-title1">Todays Price <i class="fa fa-check text-dark" aria-hidden="true"></i></span>
							</div>
						</div>
					</div>
				<?php } ?>


		</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-10 ">

				<form action="code.php" method="POST">
					<div class="row">

						<?php



						if ($_SESSION['customer_name']) { ?>

							<div class="col-sm-4">



								<input type="text" readonly name="cname" value="<?php echo $_SESSION['customer_name']; ?>" class="form-control col-sm-12 mb-2" placeholder="CUSTOMER NAME">


							</div>
							<div class="col-sm-4">

								<input type="text" readonly name="caddress" value="<?php echo $_SESSION['customer_address']; ?>" class="form-control col-sm-12 mb-2" placeholder="ADDRESS">


							</div>
							<div class="col-sm-2">

								<input type="text" readonly name="cphone" value="<?php echo $_SESSION['customer_phone']; ?>" id="phone" class="form-control col-sm-12 mb-2" placeholder="PHONE NUMBER">


							</div>
							<div class="col-sm-2">

								<input type="text" readonly name="cphone" value="<?php echo $_SESSION['customer_payment']; ?>" id="phone" class="form-control col-sm-12 mb-2" placeholder="PHONE NUMBER">



							</div>
						<?php } else { ?>

							<div class="col-sm-4">



								<input type="text" required name="cname" class="form-control col-sm-12 mb-2" placeholder="CUSTOMER NAME">


							</div>
							<div class="col-sm-4">

								<input type="text" required name="caddress" class="form-control col-sm-12 mb-2" placeholder="ADDRESS">


							</div>
							<div class="col-sm-2">

								<input type="text" required name="cphone" maxlength="10" id="phone" class="form-control col-sm-12 mb-2" placeholder="PHONE NUMBER">


							</div>
							<div class="col-sm-2">

								<select name="payment" required class="form-select" aria-label="Default select example">
									<option>Payment Method</option>
									<option value="cash">CASH</option>
									<option value="Creadit Card">CREADIT CARD</option>
									<option value="Debit Card">Debit Card</option>
									<option value="UPI">UPI</option>
									<option value="Other">OTHER</option>

								</select>

							</div>
						<?php } ?>
					</div>
					<?php

					$grandtotal = 0;


					if (isset($_SESSION['customer_id'])) { ?>
						<table class="table rounded">
							<thead>
								<tr>
									<th scope="col">s no</th>
									<th scope="col">METAL</th>

									<th scope="col">ITEM</th>
									<th scope="col">QNT</th>
									<th scope="col">WEIGHT</th>
									<th scope="col">MAKING CHARGE</th>
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
										<?php $currentmetal = $rowx['metal'];

										$querymetal = "SELECT * FROM `metal` where metal = '{$currentmetal}'";
										$resmetal = mysqli_query($conn, $querymetal);

										while ($rowmetal2 = $resmetal->fetch_assoc()) {

										?>
											<td class="mx-4 fw-bold text-uppercase"><?php echo $rowmetal2['metal'] . " : "; ?> <p class="text-success"> <?php echo $rowmetal2['price'] . " ₹/gm"; ?></p>
											</td>
										<?php } ?>
										<td>
											<input readonly type="text" name="mitem[]" value="<?php echo strtoupper($rowx['item']); ?>">
										</td>
										<td><input readonly type="number" name="myquantity[]" value="<?php echo $rowx['quantity']; ?>" placeholder="Select quantity"></td>

										<td class="fw-bold"><?php echo $rowx['weight'] . "gm"; ?></td>
										<td class="fw-bold"><?php echo $rowx['makingcharge'] . "%"; ?></td>

										<td class="fw-bold">

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
									<th scope="row"></th>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td class="fw-bold">
										Total
									</td>
									<td class="text-success fw-bold"><?php echo number_format((float)$grandtotal, 2, '.', '');  ?></td>
								</tr>
								<tr>
									<th scope="row"></th>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td class="fw-bold">
										GST
									</td>
									<td class="fw-bold">
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
									<td class="fw-bold">
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
								<tr>
									<th scope="row"></th>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td>

									</td>
									<td> <a href="invoice.php" class="btn btn-primary text-uppercase">invoice</a> </td>
								</tr>

				</form>
				</tbody>
				</table>
			<?php } else { ?>

				<table class="table rounded">
					<thead>
						<tr>
							<th scope="col">sno.</th>
							<th scope="col " class="text-center">METAL PRICE</th>
							<th scope="col" class="text-center">ITEM</th>
							<th scope="col">QNT</th>
							<th scope="col">WEIGHT</th>
							<th scope="col">Making Charge %</th>
							<th scope="col">Action</th>

							<th scope="col">TOTAL</th>
						</tr>
					</thead>
					<tbody>
						<?php

						$demo = 1;

						$query1 = "SELECT * FROM item where checked = 'yes';";

						$res1 = mysqli_query($conn, $query1);


						while ($row1 = $res1->fetch_assoc()) {



						?>
							<tr>
								<th scope="row"><?php echo $demo; ?></th>
								<td class="col-lg">
									<select id="mp<?php echo $demo; ?>" required class="form-select  fw-bold text-uppercase" name="mymetal[]">
										<option selected value="Metal ">SELECT METAL</option>

										<?php
										$cnt = 1;
										$querymetal = "SELECT * FROM `metal`";
										$resmetal = mysqli_query($conn, $querymetal);

										while ($rowmetal = $resmetal->fetch_assoc()) {



										?>
											<option id="gold<?php echo $cnt; ?>" class="fw-bold text-uppercase" data-rate="<?php echo $rowmetal['price'];  ?>" value="<?php echo $rowmetal['metal']; ?>"> <?php echo $rowmetal['metal'] . " : "; ?>
												<h2> <?php echo $rowmetal['price'] . "  ₹ " . "pre gm" ?> </h2>
											</option>
											<?php echo $rowmetal['price'];  ?>



										<?php
											$cnt++;
										}	?>
									</select>


								</td>
								<td>
									<input type="text" readonly name="mitem[]" required class="text-center" value="<?php echo strtoupper($row1['item']); ?>">
								</td>
								<td><input type="number" id="qnt<?php echo $demo; ?>" name="myquantity[]" required placeholder="Select quantity">
								</td>
								<td><input type="number" id="wt<?php echo $demo; ?>" name="myweight[]" step="any" required placeholder="Select Weight"></td>
								<td> <input type="number" id="mc<?php echo $demo; ?>" name="makingcharge[]" step="any" required placeholder="Making chareg"> <span>%</span>

								</td>
								<td>
									<button onclick="total<?php echo $demo; ?>()" class="btn btn-secondary" type="button">
										ADD
									</button>
								</td>
								<td>
									<p class="mytotal" id="total<?php echo $demo; ?>">

									</p>
								</td>

							</tr>

							<script>
								function total<?php echo $demo; ?>() {



									var mp = document.getElementById('mp<?php echo $demo; ?>');
									var opt = mp.options[mp.selectedIndex];
									var metalprice = opt.dataset.rate;
									// alert(opt.value);
									// alert(mp.selectedIndex);
									//  = document.getElementById("mp").dataset.rate;





									var qnt = document.getElementById("qnt<?php echo $demo; ?>").value;
									var wt = document.getElementById("wt<?php echo $demo; ?>").value;

									var mc = document.getElementById("mc<?php echo $demo; ?>").value;

									var total = wt * qnt * metalprice;
									var m_c = total * mc / 100;
									total = total + m_c;

									document.getElementById("total<?php echo $demo; ?>").innerHTML = total.toFixed(2);
								}
							</script>

						<?php $demo++;
						} ?>

						<tr>
							<th scope="row"></th>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td><button type="button" onclick="mytotal();">Total</button>

							</td>
							<td class="text-success" id="grand"></td>
						</tr>
						<script>
							function mytotal() {
								var grand = 0;
								var len = document.getElementsByClassName("mytotal").length;

								for (var i = 0; i < len; i++) {
									// alert(i);
									var grand = grand + parseFloat(document.getElementsByClassName("mytotal")[i].innerHTML);
									// alert(grand);
								}
								// alert(grand);

								document.getElementById("grand").innerHTML = grand.toFixed(2);
							}
						</script>
						<tr>
							<th scope="row"></th>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>
								<input class="form-check-input mx-5 border border-danger" id="gst_checkbox" name="GST" type="checkbox" value="yes">


								<button type="button" onclick="gst();">GST</button>
							</td>
							<td class="fw-bold"> 3%</td>
						</tr>
						<script>
							function gst() {

								var gst_checkbox = document.getElementById("gst_checkbox").checked = true;


								if (gst_checkbox == true) {
									alert("This Action Include GST On Total Bill. if you don't want GST please uncheck the small box near GST button");
								}
								var grand_total = 0;
								var gst = parseFloat(document.getElementById("grand").innerHTML);
								// alert(gst);

								grand_total = (gst * 3) / 100;
								//  alert(grand_total);

								gst = gst + grand_total;
								//   alert(g	st);
								document.getElementById("gst").innerHTML = gst.toFixed(2);
							}
						</script>
						<tr>
							<th scope="row"></th>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>Grand Total</td>
							<td class="text-success fw-bold" id="gst"></td>
						</tr>


						<tr>
							<th scope="row"></th>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>

							</td>
							<?php if ($_GET['itemadd'] == "added") { ?>
								<td> <button type="submit" name="customer" class="btn btn-primary">BILL</a> </td>
							<?php } ?>
						</tr>

						</form>
					</tbody>
				</table>
			<?php } ?>

			</div>
			<div class="col-sm-2 border rounded ">
				<h4 class="text-muted text-center my-2 border-bottom pb-3">ADD ITEM</h4>

				<form action="code.php" method="POST" enctype="multipart/form-data">

					<?php



					$query = "SELECT * FROM item;";

					$res = mysqli_query($conn, $query);



					while ($row = $res->fetch_assoc()) {



					?>


						<div class="form-check form-check-inline my-2 mx-4">
							<input class="form-check-input" onclick="myfun();" name="myitem[]" type="checkbox" value="<?php echo $row['item']; ?>">
							<label class="form-check-label" for="inlineCheckbox1"><?php echo $row['item']; ?> </label>
						</div>


					<?php
					} ?>


					<div class="col-sm-12 border-top my-5 mx-1 py-5">

						<button type="submit" name="check" id="check" class="btn btn-primary mx-4">ADD</button>

				</form>
				<a href="code.php?resetall=reset" class="btn btn-danger  my-3 mx-4">
					RESET
				</a>
			</div>



		</div>
	</div>
	</div>
</section>




<?php

include 'include/footer.php';


?>

<!-- Java Script  -->

<script>
	document.getElementById("check").disabled = true;

	function myfun() {
		document.getElementById("check").disabled = false;

	}
</script>