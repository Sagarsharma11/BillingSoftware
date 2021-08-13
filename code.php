<?php include "include/db.php";

session_start();


$item = $_POST['item'];
$category = $_POST['category'];

// echo $item;

// echo $category;

$query = "INSERT INTO item (`id`, `item`, `category`,`checked`) 
VALUES (NULL,'{$item}', '{$category}','no');";

if (isset($_POST['add'])) {

    $res = mysqli_query($conn, $query);

    if ($res) {
        header("Location: bills.php?action=yes");
    }
}

// to delete item 

$id = $_GET['delete'];
// echo $id;

if (isset($_GET['delete'])) {
    $query = "DELETE FROM item WHERE item.id = '{$id}'";

    $res = mysqli_query($conn, $query);
    if ($res) {
        header("Location:add-item.php?delete=yes");
    }
}

// to edit item

$editid = $_POST['editid'];
$edititem = $_POST['edititem'];
$editcategory = $_POST['editcategory'];

$query = "UPDATE item SET item = '{$edititem}', category = '{$editcategory}' WHERE id = '{$editid}';";

if (isset($_POST['edit'])) {
    $res = mysqli_query($conn, $query);
    if ($res) {
        header("Location: add-item.php?edit=yesEdit");
    }
}

// checked item

$products = array();

foreach ($_POST['myitem'] as $i) {
    $query = "UPDATE item SET checked = 'yes' WHERE item = '{$i}';";
    $res = mysqli_query($conn, $query);

    if ($res) {
        echo "<h1> update successfully";
        header("Location: bills.php?itemadd=added");
    }

    echo $i . " ";
}

// reset item that added by specific customer

if ($_GET['resetall'] == 'reset') {
    $query = "UPDATE item SET checked = 'no' ;";

    $res  = mysqli_query($conn, $query);

    if ($res) {
        session_destroy();
        header("Location:bills.php?resetall= reset all");
    }
}

// customer details

$cname = $_POST['cname'];
$caddress = $_POST['caddress'];
$cphone = $_POST['cphone'];
$payment = $_POST['payment'];
$GST = $_POST['GST'];

if(!$GST)
{
    $GST = "no";
}




//generating a random string 

function myuid()
{

    $length = 5;
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789#@)(+^%$';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }

    return $result;
}
$uid = myuid();
// echo $uid;



$date =  date("Y-m-d");

$query = "INSERT INTO custmor (`id`, `name`, `address`, `phone`, `UID`,`date`,`payment`,`gst`) VALUES
(NULL, 
'{$cname}',
'{$caddress}', 
'{$cphone}',
'{$uid}','{$date}','{$payment}','{$GST}');";



if (isset($_POST['customer'])) {
    $res = mysqli_query($conn, $query);
    if ($res) {
        $query3 = "SELECT * FROM item where checked = 'yes';";
        $res3 = mysqli_query($conn, $query3);
        $rows = mysqli_num_rows($res3);

        

        $_SESSION['customer_name']=$cname;
        $_SESSION['customer_address']=$caddress;
        $_SESSION['customer_phone']=$cphone;
        $_SESSION['customer_payment']=$payment;
       

        echo $rows;


        for ($i=0; $i<$rows; $i++)
        {


        $myitem = $_POST['mitem'][$i];
        $myquantity =$_POST['myquantity'][$i];
        $myweight= $_POST['myweight'][$i];
        $mymetal = $_POST['mymetal'][$i];
        $makingcharge = $_POST['makingcharge'][$i];

        echo "<h1>   $myitem</h1>";
        echo "<h2>   $myquantity</h1>";

        echo "<h3>   $myweight</h1>";

        echo "<h4>   $mymetal</h1>";

            $query = " INSERT INTO `bill` (`id`, `item`, `quantity`, `weight`, `metal`, `total`, `UID`,`date`,`makingcharge`) 
            VALUES (NULL,
            '{$myitem}',
            '{$myquantity}', 
            '{$myweight}',
            '{$mymetal}',
            '10000',
            '{$uid}',
            '{$date}',
            '{$makingcharge}'
            );";

            $res5 = mysqli_query($conn, $query);

            if(!$res5)
            {
                echo mysqli_error($conn);

            }

            if($res5)
            {
                $_SESSION['customer_id']=$uid;
                header("Location: bills.php");

            }

        }



    }
}

// today price 

$today_metal = $_POST['todaymetal'];
$today_price = $_POST['todayprice'];

$query = "INSERT INTO `metal` (`id`, `metal`, `price`) VALUES
(NULL,
'{$today_metal}',
'{$today_price}');";

if(isset($_POST['today_price']))
{
    $res= mysqli_query($conn,$query);

    if($res)
    {
        header("Location: add-today-price.php?additem=success");
    }

}


// to delete Metal

$id = $_GET['deletemetal'];
// echo $id;

if (isset($_GET['deletemetal'])) {
    $query = "DELETE FROM metal WHERE metal.id = '{$id}'";

    $res = mysqli_query($conn, $query);
    if ($res) {
        header("Location:add-today-price.php?delete=yes");
    }
}

// to edit Metal

$editid = $_POST['editidmetal'];
$editmetal = $_POST['editmetal'];
$editprice = $_POST['editprice'];

$query = "UPDATE metal SET metal = '{$editmetal}', price = '{$editprice}' WHERE id = '{$editid}';";

if (isset($_POST['editMetal'])) {
    $res = mysqli_query($conn, $query);
    if ($res) {
        header("Location: add-today-price.php?edit=yesEdit");
    }
}

//search throug invoice




// if(isset($_POST['searchinvoice']))
// {
//    header("Location:searchbill.php?id=" . $search);
// }