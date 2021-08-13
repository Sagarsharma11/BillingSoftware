<?php

include 'include/Header.php';

include 'include/db.php';
error_reporting(0);

$id = $_GET["id"];


?>



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





    <?php



    $query1 = "SELECT * FROM custmor where UID = '{$id}'";
    $query2 = "SELECT * FROM `bill` where UID = '{$id}'";
    $res1 = mysqli_query($conn, $query1);
    $resx = mysqli_query($conn, $query2);

    ?>


    <section>

        <div class="container invoice border my-5">
            <h2 class="text-center my-2">
                <u style="color: darkcyan;">
                    SAGAR OM ALANKAR

                </u>
            </h2>
            <div class=" border-bottom border-5 row">
                <?php while ($row = $res1->fetch_assoc()) { ?>
                    <div class="col-sm-6">
                        <h2 class=" py-5 px-1">INVOICE</h2>
                        <h6 class="text-muted mx-2">
                            GSTIN:

                            <?php






                            $gst_id = " select * from custmor where UID = '{$id}';";
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
                        <p class="text-muted">Invoice Number <span class="mx-4 text-dark"><?php echo $id; ?></span> </p>
                        <p class="text-muted">Invoice Date<span class="mx-4 text-dark"><?php echo $row['date']; ?></span></p>
                    </div>
            </div>
            <div class="  row border-bottom">

                <div class="col-sm-6">
                    <h5 class="px-1 pt-2">Billing Information</h5>
                    <h6 class="px-1 text-muted">Proprietor</h6>
                    <p class="px-1">Sunny Kumar</p>
                    <h6 class="px-1 text-muted">Address</h6>
                    <p class="px-1">Garib Asthan Road, Sonapatti, Muzaffarpur (Bihar)</p>

                    <h6 class="px-1 text-muted">Phone</h6>
                    <p class="px-1">9334849298 , 7979007480</p>




                </div>
                <div class="col-sm-6">
                    <h5 class="px-1 pt-2">Customer Information</h4>



                        <h6 class="px-1 text-muted">Name
                    </h5>
                    <p class="px-1"><?php echo $row['name']; ?></p>
                    <h6 class="px-1 text-muted">Address</h5>
                        <p class="px-1"><?php echo $row['address']; ?></p>

                        <h6 class="px-1 text-muted">Phone</h5>
                            <p class="px-1"><?php echo $row['phone']; ?></p>
                        <?php
                        $payment = $row['payment'];
                    } ?>
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
                                <td><?php echo $rowx['weight']; ?></td>
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
                            <td> <?php






                                    $gst_id = " select * from custmor where UID = '{$id}';";
                                    $res_gst = mysqli_query($conn, $gst_id);
                                    $rowgst = $res_gst->fetch_assoc();
                                    $get_gst = $rowgst['gst'];

                                    if ($get_gst == "yes") {
                                        echo "3%";
                                    } else {
                                        echo "N/A";
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
                                GRAND TOTAL
                            </td>
                            <td class="fw-bold text-success">

                                <?php






                                $gst_id = " select * from custmor where UID = '{$id}';";
                                $res_gst = mysqli_query($conn, $gst_id);
                                $rowgst = $res_gst->fetch_assoc();
                                $get_gst = $rowgst['gst'];

                                if ($get_gst == "yes") {
                                    $grandtotal_price = ($grandtotal * 3) / 100;
                                    $grandtotal = $grandtotal_price + $grandtotal;
                                } else {
                                    echo number_format((float)$grandtotal, 2, '.', '');
                                }


                                ?>

                            </td>
                        </tr>


                        </form>
                    </tbody>
                </table>

            </div>
            <h6 class="text-center">
                Payment done throungh <span class="text-muted ">
                    <?php echo $payment; ?>

                </span>
            </h6>
        </div>

    </section>

    <div class="col-sm-3 mx-auto">
        <a href="index.php">
            <-- </a>

    </div>












    <?php

    include 'include/footer.php';


    ?>

    <script>
        window.print();
    </script>