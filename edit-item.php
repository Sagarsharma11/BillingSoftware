<?php

include 'include/Header.php';
include 'include/top-header.php';
include 'include/menu.php';
include 'include/db.php';


?>

<section class="main-section  page-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-sm-5 border py-5 px-5 mx-auto rounded">

            <?php 
            
            $id = $_GET['id'];
            $query= "SELECT * from item where id='{$id}'";
            $res = mysqli_query($conn, $query);

            $row = $res->fetch_assoc();
            
            ?>
				<form action="code.php" method="POST">
                <div class="mb-3">

                    <h4>
                        EDIT ITEM
                    </h4>
					
						<input style="display: none;" type="text" name="editid" value="<?php echo $id; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					</div>
					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">ADD ITEM</label>
						<input type="text" name="edititem" value="<?php echo $row['item']; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					</div>
					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">ADD CATEGORY</label>
						<input type="text" name="editcategory" value="<?php echo $row['category']; ?>"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
					</div>
				
					
					<button type="submit" name="edit" class="btn btn-primary mt-3">EDIT</button>
				</form>
			</div>
		</div>

		
	</div>
</section>





<?php

include 'include/footer.php';


?>