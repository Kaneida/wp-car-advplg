<?php 
include("includes/conf.class.php");	
include("includes/admin.class.php");
if(!isset($_GET['booking_id'])){
	  header("location:admin.php?page=cust-lookup");	
}
$bookingid = $bsiCore->ClearInput($_GET['booking_id']);
$viewdetailsquery = mysql_query("select bc.*, bb.* from bsi_bookings as bb, bsi_clients as bc where  bb.client_id=bc.client_id and booking_id=".$bookingid);
$rowviewdetails = mysql_fetch_assoc($viewdetailsquery);	 
?>
<p>&nbsp;</p>
<div id="container-inside"> <span style="font-size:16px; font-weight:bold">Booking Details :
  <?php echo $bookingid; ?>
  </span>
  <hr style="margin-top:10px;" />
  <table style="font-family:Verdana, Geneva, sans-serif; font-size: 12px; background:#999999; width:700px; border:none;" cellpadding="4" cellspacing="1">
    <tr>
      <td align="left" style="font-weight:bold; font-variant:small-caps; background:#eeeeee;" colspan="2"><b>CUSTOMER DETAILS</b></td>
    </tr>
    <tr>
      <td align="left" style="background:#ffffff;" width="150px">Name</td>
      <td align="left" style="background:#ffffff;"><?php echo $rowviewdetails['title'];?>
        <?php echo $rowviewdetails['first_name'];?>
        <?php echo $rowviewdetails['surname'];?></td>
    </tr>
    <tr>
      <td align="left" style="background:#ffffff;">Address</td>
      <td align="left" style="background:#ffffff;"><?php echo $rowviewdetails['street_addr'];?></td>
    </tr>
    <tr>
      <td align="left" style="background:#ffffff;">City</td>
      <td align="left" style="background:#ffffff;"><?php echo $rowviewdetails['city'];?></td>
    </tr>
    <tr>
      <td align="left" style="background:#ffffff;">State</td>
      <td align="left" style="background:#ffffff;"><?php echo $rowviewdetails['province'];?></td>
    </tr>
    <tr>
      <td align="left" style="background:#ffffff;">Country</td>
      <td align="left" style="background:#ffffff;"><?php echo $rowviewdetails['country'];?></td>
    </tr>
    <tr>
      <td align="left" style="background:#ffffff;">Zip / Postal Code</td>
      <td align="left" style="background:#ffffff;"><?php echo $rowviewdetails['zip'];?></td>
    </tr>
    <tr>
      <td align="left" style="background:#ffffff;">Phone</td>
      <td align="left" style="background:#ffffff;"><?php echo $rowviewdetails['phone'];?></td>
    </tr>
    <tr>
      <td align="left" style="background:#ffffff;">Fax</td>
      <td align="left" style="background:#ffffff;"><?php echo $rowviewdetails['fax'];?></td>
    </tr>
    <tr>
      <td align="left" style="background:#ffffff;">Email</td>
      <td align="left" style="background:#ffffff;"><?php echo $rowviewdetails['email'];?></td>
    </tr>
  </table>
   <br />
  <?php echo $bsiAdminMain->paymentDetails($rowviewdetails['payment_type'], $bookingid);?>
  <br />
  <table style="font-family:Verdana, Geneva, sans-serif; font-size: 12px; background:#999999; width:700px; border:none;" cellpadding="4" cellspacing="1">
    <tr>
      <td align="left" style="font-weight:bold; font-variant:small-caps; background:#eeeeee;" colspan="2"><b>BOOKING STATUS</b></td>
    </tr>
    <tr>
      <?php
		$status='';
		$curdate = time();
		$rowviewdetails['is_deleted'];
		$dropoffTime = strtotime($rowviewdetails['dropoff_datetime']);
		if($rowviewdetails['is_deleted'] == 0 && $dropoffTime < $curdate ){
			$status="Departed";
			echo '<td align="left" style="background:#ffffff;color:blue;"><strong>'.$status.'</strong></td>';	
		}else if($rowviewdetails['is_deleted']==0 && $dropoffTime > $curdate){
			$status="Active";
			echo '<td align="left" style="background:#ffffff;color:green;"><strong>'.$status.'</strong></td>';	
		}else if($rowviewdetails['is_deleted']==1){
			$status="Cancelled";
			echo '<td align="left" style="background:#ffffff;color:red;"><strong>'.$status.'</strong></td>';	
		}
		?>
    </tr>
  </table>
</div>
