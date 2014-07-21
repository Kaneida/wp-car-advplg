<?php 
include("includes/conf.class.php");
include("includes/admin.class.php");
if(isset($_POST['block'])){
	$bookingId       = time();
	$sql = mysql_query("INSERT INTO bsi_bookings (booking_id,booking_time, pickup_datetime, dropoff_datetime, client_id, is_block, payment_success, block_name,pick_loc,drop_loc) values(".$bookingId.", NOW(),'". $_SESSION['sv_mcheckindate']."', '".$_SESSION['sv_mcheckoutdate']."', '0', 1, 1, '".mysql_real_escape_string($_POST['block_name'])."','". $bsiCore->getlocname($_SESSION['sv_pickup'])."','". $bsiCore->getlocname($_SESSION['sv_dropoff'])."')");	
	mysql_query("insert into bsi_res_data values(".$bookingId.", ".$bsiCore->ClearInput($_POST['choose']).")");
	header("location:admin.php?page=car-block-list");
	exit;
}
if(isset($_POST['submit'])){
	include ('includes/search.class.php');
	$bsisearch = new bsiSearch();
}
?>
<script type="text/javascript">
jQuery(document).ready(function(){
 jQuery.datepicker.setDefaults({ dateFormat: '<?php echo $bsiCore->config['conf_dateformat']?>' });
    jQuery("#txtFromDate").datepicker({
        minDate: 0,
        maxDate: "+365D",
        numberOfMonths: 2,
        onSelect: function(selected) {
    	var date = jQuery(this).datepicker('getDate');
         if(date){
            date.setDate(date.getDate());
          }
          jQuery("#txtToDate").datepicker("option","minDate", date)
        }
    });
 
    jQuery("#txtToDate").datepicker({ 
        minDate: 0,
        maxDate:"+365D",
        numberOfMonths: 2,
        onSelect: function(selected) {
           jQuery("#txtFromDate").datepicker("option","maxDate", selected)
        }
    });  
 jQuery("#datepickerImage").click(function() { 
    jQuery("#txtFromDate").datepicker("show");
  });
 jQuery("#datepickerImage1").click(function() { 
   jQuery("#txtToDate").datepicker("show");
  });
});
</script>
<p>&nbsp;</p>
<div id="container-inside" style="width:1000px;">
<span style="font-size:16px; font-weight:bold">Car Blocking Search</span>
<input type="button" value="Back To Car Block List" onClick="window.location.href='admin.php?page=car-block-list'" style="background: #EFEFEF; float:right; cursor:pointer; cursor:hand;"/>
<hr style="margin-top:14px;"/>
  <table cellpadding="4" width="100%">
    <tr>
      <td width="35%" valign="top"><form action="<?php echo admin_url('admin.php?page=car-block'); ?>" method="post" id="form1">
           <table cellpadding="0"  cellspacing="7" border="0"  align="left" style="text-align:left;">
     <td><strong>Car Type:</strong></td>   
     <td><?php echo $bsiCore->getCartypeCombobox();?></td> 
    </tr>
    <tr><td><strong>Pick-up Location:</strong></td>
     <td><select name="pickuploc" id="pickuploc"><option value="0"  selected="selected">-- Select Pick-up Location --</option><?php echo $bsiCore->getDroppickLocation(); ?></select></td>
    </tr>
    <tr><td><strong>Drop-off Location:</strong></td>
     <td><select name="dropoffloc" id="dropoffloc"><option value="0"  selected="selected">-- Select Drop-off Location --</option><?php echo $bsiCore->getDroppickLocation(); ?></td> 
    </tr>  
    <tr> 
     <td><strong>Pick-Up Date:</strong></td> 
     <td><input id="txtFromDate" name="pickup" style="width:68px" type="text" readonly />
      <span style="padding-left:0px;"><a id="datepickerImage" href="javascript:;"><img src="<?php echo plugins_url(); ?>/car/images/month.png" height="16px" width="16px" style=" margin-bottom:-4px;" border="0" /></a></span> <select name="pickUpTime"  style="width:90px;">  
 <option value="00:00:00">12:00 AM</option> 
 <option value="00:30:00">12:30 AM</option>
 <option value="01:00:00">1:00 AM</option>
 <option value="01:30:00">1:30 AM</option>
 <option value="02:00:00">2:00 AM</option>
 <option value="02:30:00">2:30 AM</option>
 <option value="03:00:00">3:00 AM</option>
 <option value="03:30:00">3:30 AM</option>
 <option value="04:00:00">4:00 AM</option>
 <option value="04:30:00">4:30 AM</option>
 <option value="05:00:00">5:00 AM</option>
 <option value="05:30:00">5:30 AM</option>
 <option value="06:00:00">6:00 AM</option>
 <option value="06:30:00">6:30 AM</option>
 <option value="07:00:00">7:00 AM</option>
 <option value="07:30:00">7:30 AM</option>
 <option value="08:00:00">8:00 AM</option>
 <option value="08:30:00">8:30 AM</option>
 <option value="09:00:00" selected="selected">9:00 AM</option>
 <option value="09:30:00">9:30 AM</option>
 <option value="10:00:00">10:00 AM</option>
 <option value="10:30:00">10:30 AM</option>
 <option value="11:00:00">11:00 AM</option>
 <option value="11:30:00">11:30 AM</option>
 <option value="12:00:00">12:00 PM</option>
 <option value="12:30:00">12:30 PM</option>
 <option value="13:00:00">1:00 PM</option>
 <option value="13:30:00">1:30 PM</option>
 <option value="14:00:00">2:00 PM</option>
 <option value="14:30:00">2:30 PM</option>
 <option value="15:00:00">3:00 PM</option>
 <option value="15:30:00">3:30 PM</option>
 <option value="16:00:00">4:00 PM</option>
 <option value="16:30:00">4:30 PM</option>
 <option value="17:00:00">5:00 PM</option>
 <option value="17:30:00">5:30 PM</option>
 <option value="18:00:00">6:00 PM</option>
 <option value="18:30:00">6:30 PM</option>
 <option value="19:00:00">7:00 PM</option>
 <option value="19:30:00">7:30 PM</option>
 <option value="20:00:00">8:00 PM</option>
 <option value="20:30:00">8:30 PM</option>
 <option value="21:00:00">9:00 PM</option>
 <option value="21:30:00">9:30 PM</option>
 <option value="22:00:00">10:00 PM</option>
 <option value="22:30:00">10:30 PM</option>
 <option value="23:00:00">11:00 PM</option>
 <option value="23:30:00">11:30 PM</option>
</select></td>
    </tr>
    <tr>
     <td><strong>Drop-Off Date:</strong></td>
     <td><input id="txtToDate" name="dropoff" style="width:68px" type="text" readonly/>
      <span style="padding-left:0px;"><a id="datepickerImage1" href="javascript:;"><img src="<?php echo plugins_url(); ?>/car/images/month.png" height="18px" width="18px" style=" margin-bottom:-4px;" border="0" /></a></span>  <select name="dropoffTime"  style="width:90px;">
 <option value="00:00:00">12:00 AM</option>
 <option value="00:30:00">12:30 AM</option>
 <option value="01:00:00">1:00 AM</option>
 <option value="01:30:00">1:30 AM</option>
 <option value="02:00:00">2:00 AM</option>
 <option value="02:30:00">2:30 AM</option>
 <option value="03:00:00">3:00 AM</option>
 <option value="03:30:00">3:30 AM</option>
 <option value="04:00:00">4:00 AM</option>
 <option value="04:30:00">4:30 AM</option>
 <option value="05:00:00">5:00 AM</option>
 <option value="05:30:00">5:30 AM</option>
 <option value="06:00:00">6:00 AM</option>
 <option value="06:30:00">6:30 AM</option>
 <option value="07:00:00">7:00 AM</option>
 <option value="07:30:00">7:30 AM</option>
 <option value="08:00:00">8:00 AM</option>
 <option value="08:30:00">8:30 AM</option>
 <option value="09:00:00" selected="selected">9:00 AM</option>
 <option value="09:30:00">9:30 AM</option>
 <option value="10:00:00">10:00 AM</option>
 <option value="10:30:00">10:30 AM</option>
 <option value="11:00:00">11:00 AM</option>
 <option value="11:30:00">11:30 AM</option>
 <option value="12:00:00">12:00 PM</option>
 <option value="12:30:00">12:30 PM</option>
 <option value="13:00:00">1:00 PM</option>
 <option value="13:30:00">1:30 PM</option>
 <option value="14:00:00">2:00 PM</option>
 <option value="14:30:00">2:30 PM</option>
 <option value="15:00:00">3:00 PM</option>
 <option value="15:30:00">3:30 PM</option>
 <option value="16:00:00">4:00 PM</option>
 <option value="16:30:00">4:30 PM</option>
 <option value="17:00:00">5:00 PM</option>
 <option value="17:30:00">5:30 PM</option>
 <option value="18:00:00">6:00 PM</option>
 <option value="18:30:00">6:30 PM</option>
 <option value="19:00:00">7:00 PM</option>
 <option value="19:30:00">7:30 PM</option>
 <option value="20:00:00">8:00 PM</option>
 <option value="20:30:00">8:30 PM</option>
 <option value="21:00:00">9:00 PM</option>
 <option value="21:30:00">9:30 PM</option>
 <option value="22:00:00">10:00 PM</option>
 <option value="22:30:00">10:30 PM</option>
 <option value="23:00:00">11:00 PM</option>
 <option value="23:30:00">11:30 PM</option>
</select></td>
    </tr>
    <tr>
              <td></td>
              <td><input type="submit" value="Search" name="submit" style=" cursor:pointer; cursor:hand;"/></td>
            </tr>
  </table>
        </form></td>
      <td valign="top"><?php if(isset($_POST['submit'])){  ?>
        <form name="adminsearchresult" id="adminsearchresult" method="post" action="<?php echo admin_url('admin.php?page=car-block&noheader=true'); ?>">
          <table cellpadding="4" cellspacing="2" border="0" style="font-family:Arial, Helvetica, sans-serif; font-size:12px; border:#999 solid 1px;" width="450px">
          <input type="hidden" name="pickup" value="<?php echo $_POST['pickup'];?>"/>
          <input type="hidden" name="dropoff" value="<?php echo $_POST['dropoff'];?>"/>
          <input type="hidden" name="pickUpTime" value="<?php echo $_POST['pickUpTime'];?>"/>
          <input type="hidden" name="dropoffTime" value="<?php echo $_POST['dropoffTime'];?>"/>
          <input type="hidden" name="car_type" value="<?php echo $_POST['car_type'];?>"/>
            <tr>
              <th align="left" colspan="2"><b>
                <?php echo 'Search Result';?>
                (
                <?php echo $_POST['pickup'];?> <?php echo date('g:i A',strtotime($bsiCore->getMySqlDate($_POST['pickup'])." ".mysql_real_escape_string($_POST['pickUpTime'])));?>
                <?php echo 'to';?>
                <?php echo $_POST['dropoff'];?> <?php echo date('g:i A',strtotime($bsiCore->getMySqlDate($_POST['dropoff'])." ".mysql_real_escape_string($_POST['dropoffTime'])));?>
                ) =
                <?php
				echo ceil((((strtotime($bsiCore->getMySqlDate($_POST['dropoff'])." ".mysql_real_escape_string($_POST['dropoffTime'])))-(strtotime($bsiCore->getMySqlDate($_POST['pickup'])." ".mysql_real_escape_string($_POST['pickUpTime']))))/60)/1440);
				// echo ceil($mins/1440);
				?>
                
                <?php echo 'Day(s)';?></b></th>
            </tr>
            <tr>
              <td align="left" >Name/Description</td>
              <td><input type="text" name="block_name" id="block_name"  style="width:230px !important;"/></td>
            </tr>
            <tr><td colspan="2"><hr /></td></tr>
            <tr>
              <th align="left">Car Name</th>
              <th align="left">Availablity</th>
            </tr>
             <tr><td colspan="2"><hr /></td></tr>
            <?php
	 	$gotSearchResult = false;		
				$apartment_result = $bsisearch->getAvailableCar();
				if(intval($apartment_result['roomcnt']) > 0) {
					$gotSearchResult = true;
					foreach($_SESSION['svars_details'] as $arr1){
						/*echo "<pre>";
						print_r($arr1);
						echo "<pre>";die;*/
						foreach($arr1 as $key=>$arr2){
							$carstring='';
						if(is_array($arr1[$key])){
							$cartype=mysql_fetch_assoc(mysql_query("select type_title from bsi_car_type where id=".$arr1[$key]['car_type_id']));
							$carvendor=mysql_fetch_assoc(mysql_query("select vendor_title from bsi_car_vendor where id=".$arr1[$key]['car_vendor_id']));
							$carstring=$cartype['type_title'].' '.$carvendor['vendor_title'].' '.$arr1[$key]['car_model'];
								
				 ?>
                    <tr>
                      <td><?php echo $carstring;?></td>
                      <td><input type="radio" value="<?php echo $arr1[$key]['car_id'];?>" name="choose"/></td>
                    </tr>
					<?php 
					         }
                           }
                                
                        }
                    
                      }  
			if($gotSearchResult){
				echo '<tr>
				  <td>&nbsp;</td>
				  <td><input type="submit" value="Block" name="block" style="cursor:pointer; cursor:hand;"/></td>
				</tr>';
			}else{
				echo '<tr>
				  <td colspan="2" align="center" style="color:red;"><b>Sorry no car available as your searching criteria.</b></td>
				</tr>';
			}
			?>
           </table>
        </form>
        <?php } ?></td>
    </tr>
  </table>
</div>
<script type="text/javascript">
	jQuery().ready(function() {
		jQuery("#form1").validate();
		
     });
         
</script>
