<?php 
if(isset($_POST['submitcardetails'])){
	include("includes/db.conn.php");
	include("includes/conf.class.php");
	include("includes/admin.class.php");
	$bsiAdminMain->carAddEdit(mysql_real_escape_string($_POST['car_id']));
	header("location:admin.php?page=car-list");
}
include("includes/conf.class.php");
include("includes/admin.class.php");
if(isset($_GET['cid'])){
$car_id=mysql_real_escape_string($_GET['cid']);	
	if($_GET['cid'] != 0){
		$getcardetailsrow = $bsiAdminMain->geteditCarRowValue(mysql_real_escape_string($_GET['cid']));
		$gettypecom = $bsiCore->getCartypeCombo($getcardetailsrow['car_type_id']);
		$vendercom = $bsiCore->getCarvendorCombo($getcardetailsrow['car_vendor_id']);
		$getfeatures = $bsiAdminMain->showAllFeatures(mysql_real_escape_string($_GET['cid']));
		
	}else{
		$getcardetailsrow = NULL;
		$gettypecom = $bsiCore->getCartypeCombo();
		$vendercom = $bsiCore->getCarvendorCombo();
		$getfeatures = $bsiAdminMain->showAllFeatures();
	}
	
}
?>      
        <div id="container-inside">
         <p style="font-size:16px; font-weight:bold">&nbsp;</p>
         <p style="font-size:16px; font-weight:bold">Car Add/Edit</p>
       
        <input type="button" value="Back to Car List" onClick="window.location.href='admin.php?page=car-list'" style="background: #EFEFEF; float:right; cursor:pointer; cursor:hand;"/><p><br />
       <hr style=" width:100%; margin-top:10px;"/>
           <form action="<?php echo admin_url('admin.php?page=add_car&noheader=true'); ?>" method="post" id="form1" enctype="multipart/form-data">
          <table cellpadding="5" cellspacing="2" border="0">
          <input type="hidden" name="car_id" value="<?php echo $_GET['cid'];?>"/>
            <tr> 
              <td><strong>Select Car Type Id:</strong></td>
              <td><?php echo $gettypecom;?></td>
            </tr>
             <tr>
              <td><strong>Select Car Vendor Id:</strong></td>
              <td><?php echo $vendercom;?></td>
            </tr>
             <tr>
              <td><strong>Car Model:</strong></td>
              <td><input type="text" name="car_model" value="<?php echo $getcardetailsrow['car_model'];?>" id="car_model" class="required" style="width:170px;" /></td>
            </tr>
            <tr>
              <td><strong>Total Car:</strong></td>
              <td><input type="text" name="total_car" value="<?php echo $getcardetailsrow['total_car'];?>" id="total_car" class="required" style="width:50px;" /></td>
            </tr>
            <tr>
            <td valign="top"><strong>Pick-up Location:</strong></td>
            <td>
            <select multiple="multiple" name="pickup[]" style="width:200px" class="required">
              <?php echo $bsiAdminMain->getPickupLocation($car_id); ?>
            </select>
            </td>
            </tr>
            <tr>
            <td valign="top"><strong>Drop-off Location:</strong></td>
            <td>
            <select multiple="multiple" name="dropoff[]" style="width:200px" class="required">
              <?php echo $bsiAdminMain->getDropoffLocation($car_id); ?>
            </select>
            </td>
            </tr>
             <tr>
              <td><strong>Fuel Type:</strong></td>
              <td><input type="text" name="fuel_type" value="<?php echo $getcardetailsrow['fuel_type'];?>" id="fuel_type" class="required" style="width:170px;" />&nbsp;&nbsp;example: Petrol, Gas etc.</td>
            </tr>
            <tr>
              <td><strong>Car Mileage/Day:</strong></td>
              <td><input type="text" name="car_mileage" value="<?php echo $getcardetailsrow['mileage'];?>" id="car_mileage" class="number" style="width:50px;" />&nbsp;<b><?php echo $bsiCore->config['conf_mesurment_unit'];?></b>&nbsp;&nbsp;<font color="#330099">(Leave blank for Unlimited.)</font></td>
            </tr>
             <tr>
              <td><strong>Car Image:</strong></td>
              <td><input type="file" name="car_img" id="car_img"/>
              <?php if($getcardetailsrow['car_img'] != ""){?>
          <span>&nbsp;&nbsp;&nbsp;&nbsp;<a rel="collection" href="<?php echo plugins_url(); ?>/car/front/gallery/<?php echo $getcardetailsrow['car_img'];?>" target="_blank"><strong>View Image</strong></a>&nbsp;&nbsp;&nbsp;&nbsp;<strong><font color="navy sky">Delete Image</font></strong><input type="checkbox" name="deleteimg"/></span><?php }else{ echo "&nbsp;&nbsp;&nbsp;&nbsp; <b>No Image</b>";} ?>
              </td>
            </tr>
            
            <tr>
                <td valign="top"><strong>Car Features:</strong>
                 </td><td><?php echo $getfeatures;?></td>
                </tr>
                
            <?php
			if($getcardetailsrow['status'] == 1){
			?>
             <tr>
              <td><strong>Status:</strong></td>
              <td><input type="checkbox" id="status" name="status" checked="checked"/></td>
            </tr>
            <?php
			}else{
			?>
            <tr>
              <td><strong>Status:</strong></td>
              <td><input type="checkbox" id="status" name="status"/></td>
            </tr>
            <?php
			}
			?>
            <tr><td></td><td><input type="submit" value="Submit" name="submitcardetails" style="background:#e5f9bb; cursor:pointer; cursor:hand;"/></td></tr>
            </table>
            </form>
        </div>
        
    <script type="text/javascript">
	jQuery().ready(function() {
		jQuery("#form1").validate();
     });
         
</script>
