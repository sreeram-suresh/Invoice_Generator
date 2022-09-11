<?php
    $uname=$_REQUEST['username'];
    $psd=$_REQUEST['password'];
    $dial=$_REQUEST['usercon'];
    $con = mysqli_connect("localhost","root","","invoice");
    
    if(!$con)
    {
        die("Connection failed: ".mysqli_connect_error());
    }
    $sl="SELECT * FROM user WHERE username='$uname' ";
    if($res=mysqli_query($con,$sl))
    {
        $ch=mysqli_fetch_assoc($res);
        if($dial==$ch["contact"])
        {
            $sdc = "UPDATE user SET password='$psd' WHERE uname='$uname'";
            if(mysqli_query($con,$sdc))
            {
                header('Location: start.html');
            }
            else
            {
                echo "Couldn't reset password ".mysqli_error($con); 

            }  
        }
    }
    else
    {
        echo " Query error! ".mysqli_error($con);
    }
    mysqli_close($con);
?>