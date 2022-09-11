<?php
    $cname=$_REQUEST['newconsumer'];
    $cadd=$_REQUEST['add'];
    $ccon=$_REQUEST['contact'];
    $cgst=$_REQUEST['gstin'];
    $con = mysqli_connect("localhost","root","","invoice");
    
    if(!$con)
    {
        die("Connection failed: ".mysqli_connect_error());
    }
    $sql="INSERT INTO consumer(name,address,contact,gstin) VALUES('$cname','$cadd','$ccon','$cgst')";
    if(mysqli_query($con,$sql))
    {
        header('Location: start.html');
    }
    else
    {
        echo " Query error! ".mysqli_error($con);
    }
    mysqli_close($con);
?>