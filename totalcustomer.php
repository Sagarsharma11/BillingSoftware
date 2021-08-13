<?php

include 'include/Header.php';
include 'include/top-header.php';
include 'include/menu.php';
include 'include/db.php';


?>

<section class="main-section  page-wrapper">
    <div class="container">


        <div class="row">
            <div class="col-sm-10 mx-auto">

                <?php
                $counter = 1;

                $query = "SELECT * FROM `custmor` ORDER by id DESC";
                $res = mysqli_query($conn, $query);

                while ($row = $res->fetch_assoc()) {


                ?>
                    <table class="table rounded">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Invoice Number</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php


                            ?>
                            <tr>
                                <th scope="row"><?php echo $counter; ?></th>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['address']; ?></td>
                                <td>
                                    <?php echo $row['phone']; ?>
                                </td>
                                <td class="text-center">
                                   <h2 class="text-center fw-bold"> <?php echo $row['UID']; ?></h2>
                                </td>
                                <td>
                                    <?php echo $row['date']; ?>
                                </td>
                                <td>
                                    <a class="btn btn-success" href="searchbill.php?UID=<?php echo $row['UID']; ?>">
                                        VIEW
                                    </a>
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