<?php

include 'include/Header.php';
include 'include/top-header.php';
include 'include/menu.php';
include 'include/db.php';


?>

<section class="main-section  page-wrapper">
	<div class="container my-5">
		<div class="row">
			<div class="col-sm-5 border py-5 px-5 mx-auto rounded">
				<form action="code.php" method="POST">
					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">ADD ITEM</label>
						<input type="text" name="item" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					</div>
					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">ADD CATEGORY</label>
						<input type="text" name="category" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					</div>
				
					
					<button type="submit" name="add" class="btn btn-primary mt-3">ADD</button>
				</form>
			</div>
		</div>

		<div class="row my-5">
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
			
						$query = "SELECT * FROM item;";
			
						$res = mysqli_query($conn, $query);

						$counter = 1;

						while($row = $res->fetch_assoc())
						{
							
					?>
						<tr>
							<th scope="row"><?php echo $counter; ?></th>
							<td><?php echo $row['item']; ?></td>
							<td><?php echo $row['category']; ?></td>
							<td>

							<a href="code.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger">DELETE</a>
							<a href="edit-item.php?id=<?php echo $row['id'] ?>" class="btn btn-primary mx-2">EDIT</a>

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