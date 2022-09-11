<?php
    $uname=$_REQUEST['username'];
    $pd=$_REQUEST['password'];
    $unumber=$_REQUEST['usercontact'];
    $con = mysqli_connect("localhost","root","","invoice");
    
    if(!$con)
    {
        die("Connection failed: ".mysqli_connect_error());
    }
    $sl="INSERT INTO user(uname,password,contact) VALUES('$uname','$pd','$unumber') ";
    if(mysqli_query($con,$sl))
    {
        header('Location: index.html');  
    }
    else
    {
        echo " Couldn't Register! ".mysqli_error($con);
    }
    mysqli_close($con);
?>