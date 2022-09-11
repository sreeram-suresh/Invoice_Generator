<?php
    $ppname=$_REQUEST['Costproduct'];
    $psd=$_REQUEST['value'];
    $con = mysqli_connect("localhost","root","","invoice");
    
    if(!$con)
    {
        die("Connection failed: ".mysqli_connect_error());
    }
    $sl="SELECT * FROM products WHERE pname like '$ppname' ";
    if($res=mysqli_query($con,$sl))
    {
        $ch=mysqli_fetch_assoc($res);
        if($ppname==$ch["pname"])
        {
            $sdc = "UPDATE products SET cost='$psd' WHERE pname like '$ppname'";
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