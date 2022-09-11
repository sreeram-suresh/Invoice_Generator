<?php
require_once __DIR__ . '/vendor/autoload.php';
$billnumber=$_GET['billno'];
$con = mysqli_connect("localhost","root","","invoice");

if(!$con)
{
    die("Connection failed: ".mysqli_connect_error());
}
//get purchase details from bill number
$selectSQL = "SELECT * FROM purchasedata WHERE billno='$billnumber'";

  if( !($selectRes=mysqli_query($con,$selectSQL)))
  {
    echo "Retrieval of data from Database Failed. ".mysqli_error($con);
  }
  else
  {
    if(mysqli_num_rows($selectRes)==0)
    {
        echo "No Such Bill Available.";
    }
    else
    {
        while($row=mysqli_fetch_assoc($selectRes))
        {
            $gstin=$row['gstin'];
            $datee=$row['datee'];
            $pname=$row['pname'];
            $quantity=$row['qty'];
            $total=$row['cost'];
        }
    }
 }
 //get consumer details
$selectSQ = "SELECT * FROM consumer WHERE gstin='$gstin'";

  if( !($selectRe=mysqli_query($con,$selectSQ)))
  {
    echo "Retrieval of data from Database Failed. ".mysqli_error($con);
  }
  else
  {
    if(mysqli_num_rows($selectRe)==0)
    {
        echo "No Such Consumer available.";
    }
    else
    {
        while($ro=mysqli_fetch_assoc($selectRe))
        {
            $cname=$ro['name'];
            $caddress=$ro['address'];
            $ccontact=$ro['contact'];
        }
    }
 }
//get product cost
$selectR = "SELECT * FROM products WHERE pname='$pname'";
if( !($selectR=mysqli_query($con,$selectR)))
{
    echo "Retrieval of data from Database Failed. ".mysqli_error($con);
}
else
{
    if(mysqli_num_rows($selectR)==0)
    {
        echo "No Such Consumer available.";
    }
    else
    {
        while($r=mysqli_fetch_assoc($selectR))
        {
            $percost=$r['cost'];
        }
    }
}
//retailer details
$rgstin="29ERPFS5036R1Z5";
$raddress="BANGALORE";
$rcon="8861658061";
$rname="SREE AGENCIES";

?>
<?php
        $html='<table><tr><td style="padding-left: 85%;">Orignal copy</td></tr>';
        $html.='</table>';
        $html.='<table style="width:100%; marging-left:auto; margin-right:auto;">';
                $html.='<tr><td><img src="epic.png" style="border: 1px solid #ddd;border-radius: 4px;padding: 5px;width: 150px;"></td>';
                $html.='<td style="display: inline-block; width: 90%; text-align: right;">Invoice #:'.$billnumber.'<br/>Created:'.$datee.'<br/></td></tr>';
                $html.='</table>';
                
                $html.='<hr><table style="width:100%; marging-left:auto; margin-right:auto;border: 1px solid black;">';
                $html.='<tr style="border: 1px solid black;">
                    <td>
                        <label>Retailer:</label><br/>
                        Name:'.$rname.'<br/>
                        Contact:'.$rcon.'<br/>
                        Address:'.$raddress.'<br/>
                        GSTIN:'.$rgstin.'<br/>
                    </td>

                    <td style="padding-left: 185px;">
                        <label>Consignee:</label><br/>
                        Name:.'.$cname.'<br/>
                        Contact:'.$ccontact.'<br/>
                        Address:'.$caddress.'<br/>
                        GSTIN:'.$gstin.'<br/>
                    </td>
                </tr>';
                $html.='</table>';
                $html.='<hr><table style="width:100%; marging-left:auto; margin-right:auto;border: 1px solid black;">';
                $html.='<tr style="border: 1px solid black;">
                        <td style="border: 1px solid black;">Item</td>
                        <td style="border: 1px solid black;">Qty</td>
                        <td style="border: 1px solid black;">Cost</td>
                        <td style="border: 1px solid black;">Total</td>
                    </tr>
                <tr style="border: 1px solid black;">
                    <td style="border: 1px solid black;">'.$pname.'</td>
                    <td style="border: 1px solid black;">'.$quantity.'</td>
                    <td style="border: 1px solid black;">'.$percost.'</td>
                    <td style="border: 1px solid black;">'.$total.'</td>
                </tr>
                <tr><td>
                    <br><br>
                    <td align="right" colspan="2"><label>Total amount to be paid:</label></td>
                    <td>'.$total.'</td>
                </tr>';
                $html.='</table>';
                $html.='<br><br>';
                $html.='<table>';
                $html.='<tr>
                    <td>
                        <label> </label><br/>
                        <label> </label><br/>
                        <label> </label><br/>
                        <label> </label><br/>
                        <label> Retailer Signature</label><br/>
                    </td>

                    <td style="display: inline-block; width: 80%; text-align: right;">
                        <label> </label><br/>
                        <label> </label><br/>
                        <label> </label><br/>
                        <label> </label><br/>
                        <label>Consignee Signature</label><br/>
                    </td>
                </tr>';
                $html.='</table>';
$mpdf = new \Mpdf\Mpdf();
$mpdf->writeHTML($html);
$file=time().'.pdf';
$mpdf->output($file,'D');
?>