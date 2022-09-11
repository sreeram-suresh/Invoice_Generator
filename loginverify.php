<?php
    $uname=$_REQUEST['username'];
    $psd=$_REQUEST['password'];
    $con = mysqli_connect("localhost","root","","invoice");
    
    if(!$con)
    {
        die("Connection failed: ".mysqli_connect_error());
    }
    $sl="SELECT * FROM user WHERE uname='$uname' ";
    if($res=mysqli_query($con,$sl))
    {
        $ch=mysqli_fetch_assoc($res);
        if($psd==$ch["password"])
        {
            header('Location: start.html');  
        }
    }
    else
    {
        echo " Query error! ".mysqli_error($con);
    }
    mysqli_close($con);
?>