<html>
    <head>
      <title>Details</title>
        <style>
          body 
          {
              background-color: khaki;
              text-decoration-color: darkred;
              text-align: center;
          }
          table
          {
            margin-left: auto;
            margin-right: auto;
          }
          tr
          {
            height:50px;
            width:150px;
          }
        </style>
    </head>
<?php

$con = mysqli_connect("localhost","root","","invoice");

if(!$con)
{
    die("Connection failed: ".mysqli_connect_error());
}
$selectSQL = "SELECT * FROM purchasedata order by datee desc";

  if( !($selectRes=mysqli_query($con,$selectSQL)))
  {
    echo "Retrieval of data from Database Failed. ".mysqli_error($con);
  }
  else
  {
    ?>
    <caption>Purchase Details</caption>
<table border="2">
    <tr>
      <th>Bill No</th>
      <th>GST Number</th>
      <th>Date</th>
      <th>Product</th>
      <th>Quantity</th>
      <th>Cost</th>
      <th>Pdf Download</th>
    </tr>
  <tbody>
    <?php
      if(mysqli_num_rows($selectRes)==0)
      {
        echo "<tr><td colspan='7'> ----No Data available---- </td></tr>";
      }
      else
      {
        while($row=mysqli_fetch_assoc($selectRes))
        {
          $gen="generatepdf.php?billno=";
          $gen.=$row['billno'];
          echo "<tr><td>{$row['billno']}</td><td>{$row['gstin']}</td><td>{$row['datee']}</td><td>{$row['pname']}</td><td>{$row['qty']}</td><td>{$row['cost']}</td><td><a href=$gen> Download Bill</a></td></tr>\n";
        }
      }
    ?>
  </tbody>
</table>
    <?php
  }
  mysqli_close($con);
?>
