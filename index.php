<?php

include 'include/Header.php';
include 'include/top-header.php';
include 'include/menu.php';
include 'include/db.php';


?>

<div class="page-wrapper">
<div class="container my-4">
        <div class="row">
            <h1 class="title rounded btn shadow ">
                SAGAR OM ALANKAR
            </h1>
            <h2 class="text-uppercase text-secondary my-4 border py-5 text-center">proprietor :<span class="text-muted mx-5">SUNNY KUMAR</span> </h2>
          
         
        </div>
    </div>
    <div class="content my-4">
        <div class="row">
            <?php 
            
                $query = "SELECT * FROM metal";

                $res = mysqli_query($conn, $query);

                while($row = $res->fetch_assoc())
                {
            
            ?>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3 ">
                <div class="dash-widget shadow">
                    <span style="background-color: orangered;" class="dash-widget-bg1 my-3"><i class="fad fa-treasure-chest"></i></span>
                    <div class="dash-widget-info text-right">
                        <h1 style="color:gold"><?php echo $row['metal']; ?></h1>
                        <h3><?php echo $row['price']; ?>/g</h3>
                        <span style="background-color: orangered;" class="widget-title1">Todays Price <i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <?php } ?>
            <h3 class="text-uppercase text-secondary my-4 border py-5 text-center">
            <i class="fas fa-phone-square text-dark mx-2"></i>
            <span>
                9334849298 , 7979007480
            </span>
            </h3>
      
        </div>
    </div>
    
</div>







<?php

include 'include/footer.php';


?>