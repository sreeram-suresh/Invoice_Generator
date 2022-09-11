<!-- php file to read data from purchaseform to enter into db -->
<?php
$cname=$_REQUEST['consumer'];
$bno=$_REQUEST['billno'];
$item=$_REQUEST['product'];
$qty=$_REQUEST['qty'];
$date = date('Y-m-d H:i:s');
$pdf='generatepdf.php?billno=';
$pdf.=$bno;


$con = mysqli_connect("localhost","root","","invoice");

if(!$con)
{
    die("Connection failed: ".mysqli_connect_error());
}

    $wq="SELECT gstin FROM consumer WHERE name like '$cname'";
    if($re=mysqli_query($con,$wq))
    {
        $c=mysqli_fetch_assoc($re);
        $gst=$c["gstin"];
        $sl="SELECT cost FROM products WHERE pname like '$item'";
    if($res=mysqli_query($con,$sl))
    {
        $ch=mysqli_fetch_assoc($res);
        $amt=$ch["cost"];
        $cost=$qty*$amt;
        $sql = "INSERT INTO purchasedata (billno,gstin,datee,pname,qty,cost) VALUES('$bno','$gst','$date','$item',$qty,$cost)";
        if(mysqli_query($con,$sql))
        {
            $sdc = "UPDATE purchasedata SET pdf='$pdf' WHERE billno like '$bno'";
            if(mysqli_query($con,$sdc))
            {
                header('Location: start.html');
            }
            else
            {
                echo "Couldn't register the purchase ".mysqli_error($con); 

            }
        }
        else
        {
            echo "Couldn't register the purchase ".mysqli_error($con);
        }
    }
    else
        {
            echo "Couldn't register the purchase ".mysqli_error($con);
        }
    }
mysqli_close($con);
?>

