<?php
    $iname=$_REQUEST['delconsumer'];
    $con = mysqli_connect("localhost","root","","invoice");
    
    if(!$con)
    {
        die("Connection failed: ".mysqli_connect_error());
    }
    $sql="DELETE FROM consumer WHERE name='$iname' ";
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