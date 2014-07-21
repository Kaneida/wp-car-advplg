<?php 
include("includes/conf.class.php");
include("includes/admin.class.php");
if(isset($_POST['act_sbmt'])){
	$bsiAdminMain->global_setting_post();
	header("location:admin.php?page=global-list");
	exit;
}
$global_setting = $bsiAdminMain->global_setting();	
?>

<p>&nbsp;</p>
<div id="container-inside" style="width:1000px;"> <span style="font-size:16px; font-weight:bold">Global Setting</span>
  <hr />
  <form action="<?php echo admin_url('admin.php?page=global-list&noheader=true');?>" method="post" id="form1">
    <table cellpadding="5" cellspacing="2" border="0" width="100%"> 
      <tr>
        <td width="20%"><strong>Portal Name:</strong></td>
        <td width="80%"><input type="text" class="required" value="<?php echo $bsiCore->config['conf_portal_name'];?>" size="50" name="conf_portal_name" id="conf_portal_name"/></td>
      </tr>
      <tr>
        <td><strong>Street Address:</strong></td>
        <td><input type="text" class="required" value="<?php echo $bsiCore->config['conf_portal_streetaddr'];?>" size="50" name="conf_portal_streetaddr" id="conf_portal_streetaddr"/></td>
      </tr>
      <tr>
        <td><strong>City:</strong></td>
        <td><input type="text" class="required" value="<?php echo $bsiCore->config['conf_portal_city'];?>" size="30" name="conf_portal_city" id="conf_portal_city"/></td>
      </tr>
      <tr>
        <td><strong>State:</strong></td>
        <td><input type="text" class="required" value="<?php echo $bsiCore->config['conf_portal_state'];?>" size="30" name="conf_portal_state" id="conf_portal_state"/></td>
      </tr>
      <tr>
        <td><strong>Country:</strong></td>
        <td><input type="text" class="required" value="<?php echo $bsiCore->config['conf_portal_country'];?>" size="30" name="conf_portal_country" id="conf_portal_country"/></td>
      </tr>
      <tr>
        <td><strong>Zip / Post code:</strong></td>
        <td><input type="text" class="required" value="<?php echo $bsiCore->config['conf_portal_zipcode'];?>" size="10" name="conf_portal_zipcode" id="conf_portal_zipcode"/></td>
      </tr>
      <tr>
        <td><strong>Phone:</strong></td>
        <td><input type="text"  class="required" value="<?php echo $bsiCore->config['conf_portal_phone'];?>" size="15" name="conf_portal_phone" id="conf_portal_phone"/></td>
      </tr>
      <tr>
        <td><strong>Fax:</strong></td>
        <td><input type="text"  value="<?php echo $bsiCore->config['conf_portal_fax'];?>" size="15" name="conf_portal_fax" id="conf_portal_fax"/></td>
      </tr>
      <tr>
        <td><strong>Portal Email:</strong></td>
        <td><input type="text" class="required email" value="<?php echo $bsiCore->config['conf_portal_email'];?>" size="30" name="conf_portal_email" id="email"/></td>
      </tr>
      <tr><td colspan="2"><hr /></td></tr>
      <tr>
        <td><strong>Notification Email:</strong></td>
        <td valign="middle"><input type="text" name="conf_notification_email" id="conf_notification_email" value="<?php echo $bsiCore->config['conf_notification_email'];?>" class="required email" style="width:250px;" /></td>
      </tr>
      <tr>
        <td><strong>Terms & Condition Page Url: </strong></td>
        <td valign="middle"><input type="text" name="tc" id="top" value="<?php echo $bsiCore->config['conf_tos_url'];?>" class="required" style="width:250px;" /> 
        ( <i>With http://</i> )</td>
      </tr>
      <tr>
        <td><strong>Currency Code:</strong></td>
        <td><input type="text" name="conf_currency_code" id="conf_currency_code" value="<?php echo $bsiCore->config['conf_currency_code'];?>"  class="required" style="width:70px;"  /></td>
      </tr>
      
      <tr>
        <td><strong>Currency Symbol:</strong></td>
        <td><input type="text" name="conf_currency_symbol" id="conf_currency_symbol" value="<?php echo $bsiCore->config['conf_currency_symbol'];?>"  class="required" style="width:70px;"  /></td>
      </tr>
      <tr>
        <td><strong>Measurement Unit:</strong></td>
        <td><input type="text" name="conf_mesurment_unit" id="conf_mesurment_unit" value="<?php echo $bsiCore->config['conf_mesurment_unit'];?>"  class="required" style="width:70px;"  /></td>
      </tr>
      <tr>
        <td><strong>Booking Engine:</strong></td>
        <td><select name="select_booking_turn" id="select_booking_turn">
            <?php echo $global_setting['select_booking_turn'];?>
          </select></td>
      </tr>
      <tr>
        <td><strong>Portal Timezone:</strong></td>
        <td><select name="conf_portal_timezone" id="conf_portal_timezone">
            <?php echo $global_setting['select_timezone'];?>
          </select></td>
      </tr>
      <tr>
        <td><strong>Date Format:</strong></td>
        <td><select name="conf_dateformat" id="conf_dateformat">
            <?php echo $global_setting['select_dt_format'];?>
          </select></td>
      </tr>
      <tr>
        <td><strong>Car Block Time:</strong></td>
        <td><select name="conf_booking_exptime" id="conf_booking_exptime">
            <?php echo $global_setting['select_room_lock'];?>
          </select>
          <span style="font-size:10px">&nbsp;&nbsp;Note: Duration for customer selected Car will be lock when checkout redirect to payment gateway.</span></td>
      </tr>
      <tr>
        <td><strong>Taxes & Fees:</strong></td>
        <td><input type="text" name="conf_tax_amount" id="conf_tax_amount" size="6" class="required number" value="<?php echo $bsiCore->config['conf_tax_amount'];?>" />
          &nbsp;%</td>
      </tr>
    
      <tr>
        <td><strong>Car Block Interval:</strong></td>
        <td><select name="conf_interval_between_rent" id="conf_interval_between_rent">
            <?php echo $global_setting['select_blockinterval'];?>
          </select> <span style="font-size:10px">&nbsp;&nbsp;Note: Duration interval between drop-off & pick-up of a car. example: if set 2 hours, car drop-off time 9am, then that car available for booking from 11am.</span>
          </td>
      </tr>
      <tr>
        <td><strong>Pick-up Date Set:</strong></td>
        <td><select name="conf_booking_start" id="conf_booking_start">
            <?php echo $global_setting['select_conf_booking_start'];?>
          </select> <span style="font-size:10px">&nbsp;&nbsp;Note: example: set 2 days, so pick-up date will be after 2 days  from current date.</span>
          </td>
      </tr>
      <tr>
      <td><strong>Front-end Language:</strong></td>
      <td>
      	<select name="lang" id="lang">
        <?php echo $global_setting['lang_list'];?></select>
      </td>
      </tr>
      <tr>
        <td><input type="hidden" name="act_sbmt" value="1" /></td>
        <td><input type="submit" value="Submit" style="cursor:pointer; cursor:hand;"/></td>
      </tr>
    </table>
  </form>
</div>

<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("#form1").validate();
     });  
</script> 
