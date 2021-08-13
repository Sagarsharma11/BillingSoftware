<?php

include 'include/Header.php';
include 'include/top-header.php';
include 'include/menu.php';
include 'include/db.php';


?>

<section class="main-section  page-wrapper">
	<div class="container my-4">
		<div class="row">
			<div class="col-sm-5 border py-5 px-5 mx-auto rounded">
				<form action="code.php" method="POST">
					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Metal</label>
						<select class="form-select" name="todaymetal" aria-label="Default select example">
										<option selected>METAL</option>
										<option value="gold (24C)">GOLD (24C) </option>
										<option value="gold (22C)">GOLD (22C) </option>
										<option value="gold (18C)">GOLD (18C) </option>
									
										<option value="silver">SILVER</option>
										<option value="platinum">PLATINIUM</option>
									</select>					</div>
					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Today Price</label>
						<input type="number" placeholder="Add Price Per Gram" name="todayprice" step="any" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					</div>
				
					
					<button type="submit" name="today_price" class="btn btn-primary mt-3">ADD</button>
				</form>
			</div>
		</div>

		<div class="row my-4">
			<div class="col-sm-6 mx-auto">
			<table class="table rounded">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">ITEM</th>
							<th scope="col">CATEGORY</th>
							<th scope="col" >ACTION</th>
						
						</tr>
					</thead>
					<tbody>

					<?php 
			
						$query = "SELECT * FROM metal;";
			
						$res = mysqli_query($conn, $query);

						$counter = 1;

						while($row = $res->fetch_assoc())
						{
							
					?>
						<tr>
							<th scope="row"><?php echo $counter; ?></th>
							<td><?php echo $row['metal']; ?></td>
							<td><?php echo $row['price']; ?></td>
							<td>

							<a href="code.php?deletemetal=<?php echo $row['id'] ?>" class="btn btn-danger">DELETE</a>
							<a href="edit-metal.php?editmetal=<?php echo $row['id'] ?>" class="btn btn-primary mx-2">EDIT</a>

							</td>
					

						</tr>
					<?php
						$counter++;
						} ?>
				
				
				
					
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>





<?php

include 'include/footer.php';


?>