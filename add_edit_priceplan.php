<?php
if(isset($_REQUEST['Submit']))
{
	include("includes/db.conn.php");
	include("includes/conf.class.php");
	include("includes/admin.class.php");
	$bsiAdminMain->add_edit_priceplan();
	header('location: admin.php?page=price-plan&cid='.$_POST['car_id']);
	exit;
}
define('MON','Mon');
define('TUE','Tue');
define('WED','Wed');
define('THU','Thu');
define('FRI','Fri');
define('SAT','Sat');
define('SUN','Sun');
define('PP_REGULAR','Regular Price');
define('PP_CAPACITY','Price Type');
define('PRICE_AND_DAY','Price / Day');
define('PRICE_AND_HOUR','Price / Hour');
include("includes/conf.class.php");
include("includes/admin.class.php");
$car_id=$bsiCore->ClearInput($_GET['car_id']);
$daterastr='';
if($car_id){
	 $ppid_row=mysql_query("SELECT pp_id FROM `bsi_car_priceplan` WHERE `start_date`='".mysql_real_escape_string($_REQUEST['start_dt'])."' and `end_date`='".mysql_real_escape_string($_REQUEST['end_dt'])."' and  car_id='".$car_id."'");
				$ppid='';
				while($row77=mysql_fetch_assoc($ppid_row)){
					$ppid.=$row77['pp_id'].',';
				}
				$ppid=substr($ppid,0,-1);
	$row88=mysql_fetch_assoc(mysql_query("select date_format(start_date,'".$bsiCore->userDateFormat."') as start_date,date_format(end_date,'".$bsiCore->userDateFormat."') as end_date , default_price from bsi_car_priceplan where car_id='".$car_id."' and `start_date`='".mysql_real_escape_string($_REQUEST['start_dt'])."' and `end_date`='".mysql_real_escape_string($_REQUEST['end_dt'])."' "));
	$row44=mysql_fetch_assoc(mysql_query("select * from bsi_car_master where car_id=".$car_id));
	$carvendor=mysql_fetch_assoc(mysql_query("select * from bsi_car_vendor where id='".$row44['car_vendor_id']."'"));
	$carname=$carvendor['vendor_title'].' '.$row44['car_model'].'<input type="hidden" name="car_id" value="'.$car_id.'" /><input type="hidden" name="pp_id" value="'.$ppid.'" />';
	
	if($row88['default_price'] == 1){
		$daterastr.='<tr>
        <td><strong>Start Date</strong></td>
        <td>N/A</td>
     
      </tr>
      <tr>
       <td><strong>End Date</strong></td>
        <td>N/A</td>
      </tr>
	  ';
	}else{
		$daterastr.='<tr>
        <td><strong>Start Date</strong></td>
        <td><input  name="start_date" type="text" id="txtFromDate" size="10" maxlength="10" value="'.$row88['start_date'].'" /><img id="datepickerImage" src="'.plugins_url().'/car/images/month.png" height="18px" width="18px" /></a></td>
     
      </tr>
      <tr>
       <td><strong>End Date</strong></td>
        <td><input  name="end_date" type="text" id="txtToDate" size="10" value="'.$row88['end_date'].'"/><img id="datepickerImage1" src="'.plugins_url().'/car/images/month.png" height="18px" width="18px" /></a></td>
      
      </tr>';
	}
}else{
	$carcom=$bsiAdminMain->getCarcombo();
	$row88=NULL;
	$daterastr.='<tr>
        <td><strong>Start Date</strong></td>
        <td><input  name="start_date" type="text" id="txtFromDate" size="10" maxlength="10" value="" class="required"/><img id="datepickerImage" src="'.plugins_url().'/car/images/month.png"  height="18px" width="18px" /></a></td>
     
      </tr>
      <tr>
       <td><strong>End Date</strong></td>
        <td><input  name="end_date" type="text" id="txtToDate" size="10" value="" class="required"/><img id="datepickerImage1" src="'.plugins_url().'/car/images/month.png" height="18px" width="18px" /></a></td>
      </tr>';
}
?>
<script>
jQuery(document).ready(function(){
	
 jQuery.datepicker.setDefaults({ dateFormat: '<?php echo $bsiCore->config['conf_dateformat'];?>'});
    jQuery("#txtFromDate").datepicker({
        minDate: 0,
        maxDate: "+1095D",
        numberOfMonths: 2,
        onSelect: function(selected) {
    	var date = jQuery(this).datepicker('getDate');
         if(date){
            date.setDate(date.getDate() + 1);
          }
          jQuery("#txtToDate").datepicker("option","minDate", date)
        }
    });
 
    jQuery("#txtToDate").datepicker({ 
        minDate: 0,
        maxDate:"+1095D",
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
 <span style="font-size:16px; font-weight:bold">Car Price Plan Add/Edit</span>
  <input type="button" value="Back to Price Plan List" onClick="window.location.href='admin.php?page=price-plan'" style="background:#e5f9bb; cursor:pointer; cursor:hand; float:right; "/>
  <hr style="margin-top:10px;" />
  <form action="<?php echo admin_url('admin.php?page=add-edit-price-plan&noheader=true'); ?>" method="post" id="form1">
    <table width="100%" border="0" cellspacing="2" cellpadding="2">
    <input type="hidden" name="car_price" value="<?php echo $car_id;  ?>" />
    <?php
	if($car_id == 0){
    ?>
    <tr>
      <td width="10%"><strong>Select Car</strong>:</td>
      <td width="90%"><select name="car_id" id="c1" class="required">
          <?php echo $carcom;  ?>
        </select></td>
    </tr>
    <?php
	   }else{
	  ?>
    <tr>
      <td width="10%"><strong>Car Name</strong>:</td>
      <td width="90%"><?php echo $carname;  ?></td>
    </tr>
    <?php
	   }
	  ?>
    <?php echo $daterastr; ?>
    <tr><td colspan="2">&nbsp;</td></tr>
    <tr>
    <td colspan="2">
    <table cellpadding="3" cellspacing="0" border="0" style="font-family:Arial, Helvetica, sans-serif; font-size:12px;" width="750px;">
      <tr>
        <td width="85px" style="padding-left:5px;"><strong><?php echo PP_CAPACITY; ?></strong></td>
        <td width="80px" style="padding-left:10px;"><strong><?php echo SUN; ?></strong></td>
        <td width="80px" style="padding-left:10px;"><strong><?php echo MON; ?></strong></td>
        <td width="75px" style="padding-left:10px;"><strong><?php echo TUE; ?></strong></td>
        <td width="80px" style="padding-left:10px;"><strong><?php echo WED; ?></strong></td>
        <td width="80px" style="padding-left:10px;"><strong><?php echo THU; ?></strong></td>
        <td width="80px" style="padding-left:10px;"><strong><?php echo FRI; ?></strong></td>
        <td width="80px" style="padding-left:10px;"><strong><?php echo SAT; ?></strong></td>
      </tr>
      <tr>
        <td colspan="8"><hr/>
         </td>
      </tr>
      <?php
	  for($i=1;$i<=2;$i++){
		if(isset($_REQUEST['start_dt'])){
			$pp_row=mysql_fetch_assoc(mysql_query("SELECT * FROM `bsi_car_priceplan` WHERE `start_date`='".mysql_real_escape_string($_REQUEST['start_dt'])."' and `end_date`='".mysql_real_escape_string($_REQUEST['end_dt'])."' and car_id=".mysql_real_escape_string($car_id)." and price_type = ".$i.""));
			//echo  "SELECT * FROM `bsi_car_priceplan` WHERE `start_date`='".mysql_real_escape_string($_REQUEST['start_dt'])."' and `end_date`='".mysql_real_escape_string($_REQUEST['end_dt'])."' and car_id=".mysql_real_escape_string($car_id)." and price_type = ".$i."";
		}else{
			$pp_row=NULL;
		}
		
		if($bsiCore->config['conf_price_calculation_type']=='1' && $i==1){
				echo '<tr>
<td>'.(($i==1)? PRICE_AND_DAY : PRICE_AND_HOUR).'</td>
<td>'.$bsiCore->config['conf_currency_symbol'].'<input type="text" class="required number"  name="priceplan['.$i.'][sun]" id="priceplan['.$i.'][sun]"  size="4" value="'.$pp_row['sun'].'" /></td>
<td>'.$bsiCore->config['conf_currency_symbol'].'<input type="text" class="required number"  name="priceplan['.$i.'][mon]" id="priceplan['.$i.'][mon]"  size="4"  value="'.$pp_row['mon'].'"  /></td>
<td>'.$bsiCore->config['conf_currency_symbol'].'<input type="text" class="required number"  name="priceplan['.$i.'][tue]" id="priceplan['.$i.'][tue]"  size="4"  value="'.$pp_row['tue'].'"  /></td>
<td>'.$bsiCore->config['conf_currency_symbol'].'<input type="text" class="required number"  name="priceplan['.$i.'][wed]" id="priceplan['.$i.'][wed]"  size="4"  value="'.$pp_row['wed'].'"  /></td>
<td>'.$bsiCore->config['conf_currency_symbol'].'<input type="text" class="required number"  name="priceplan['.$i.'][thu]" id="priceplan['.$i.'][thu]"  size="4"  value="'.$pp_row['thu'].'"  /></td>
<td>'.$bsiCore->config['conf_currency_symbol'].'<input type="text" class="required number"  name="priceplan['.$i.'][fri]" id="priceplan['.$i.'][fri]"  size="4"  value="'.$pp_row['fri'].'"  /></td>
<td>'.$bsiCore->config['conf_currency_symbol'].'<input type="text" class="required number"  name="priceplan['.$i.'][sat]" id="priceplan['.$i.'][sat]"  size="4"   value="'.$pp_row['sat'].'"  /></td>
				</tr>';
				
		}elseif($bsiCore->config['conf_price_calculation_type']=='2' && $i==2){
			echo '<tr>
<td>'.(($i==1)? PRICE_AND_DAY : PRICE_AND_HOUR).'</td>
<td>'.$bsiCore->config['conf_currency_symbol'].'<input type="text" class="required number"  name="priceplan['.$i.'][sun]" id="priceplan['.$i.'][sun]"  size="4" value="'.$pp_row['sun'].'" /></td>
<td>'.$bsiCore->config['conf_currency_symbol'].'<input type="text" class="required number"  name="priceplan['.$i.'][mon]" id="priceplan['.$i.'][mon]"  size="4"  value="'.$pp_row['mon'].'"  /></td>
<td>'.$bsiCore->config['conf_currency_symbol'].'<input type="text" class="required number"  name="priceplan['.$i.'][tue]" id="priceplan['.$i.'][tue]"  size="4"  value="'.$pp_row['tue'].'"  /></td>
<td>'.$bsiCore->config['conf_currency_symbol'].'<input type="text" class="required number"  name="priceplan['.$i.'][wed]" id="priceplan['.$i.'][wed]"  size="4"  value="'.$pp_row['wed'].'"  /></td>
<td>'.$bsiCore->config['conf_currency_symbol'].'<input type="text" class="required number"  name="priceplan['.$i.'][thu]" id="priceplan['.$i.'][thu]"  size="4"  value="'.$pp_row['thu'].'"  /></td>
<td>'.$bsiCore->config['conf_currency_symbol'].'<input type="text" class="required number"  name="priceplan['.$i.'][fri]" id="priceplan['.$i.'][fri]"  size="4"  value="'.$pp_row['fri'].'"  /></td>
<td>'.$bsiCore->config['conf_currency_symbol'].'<input type="text" class="required number"  name="priceplan['.$i.'][sat]" id="priceplan['.$i.'][sat]"  size="4"   value="'.$pp_row['sat'].'"  /></td>
				</tr>';
		}elseif($bsiCore->config['conf_price_calculation_type']=='3'){
			echo '<tr>
<td>'.(($i==1)? PRICE_AND_DAY : PRICE_AND_HOUR).'</td>
<td>'.$bsiCore->config['conf_currency_symbol'].'<input type="text" class="required number"  name="priceplan['.$i.'][sun]" id="priceplan['.$i.'][sun]"  size="4" value="'.$pp_row['sun'].'" /></td>
<td>'.$bsiCore->config['conf_currency_symbol'].'<input type="text" class="required number"  name="priceplan['.$i.'][mon]" id="priceplan['.$i.'][mon]"  size="4"  value="'.$pp_row['mon'].'"  /></td>
<td>'.$bsiCore->config['conf_currency_symbol'].'<input type="text" class="required number"  name="priceplan['.$i.'][tue]" id="priceplan['.$i.'][tue]"  size="4"  value="'.$pp_row['tue'].'"  /></td>
<td>'.$bsiCore->config['conf_currency_symbol'].'<input type="text" class="required number"  name="priceplan['.$i.'][wed]" id="priceplan['.$i.'][wed]"  size="4"  value="'.$pp_row['wed'].'"  /></td>
<td>'.$bsiCore->config['conf_currency_symbol'].'<input type="text" class="required number"  name="priceplan['.$i.'][thu]" id="priceplan['.$i.'][thu]"  size="4"  value="'.$pp_row['thu'].'"  /></td>
<td>'.$bsiCore->config['conf_currency_symbol'].'<input type="text" class="required number"  name="priceplan['.$i.'][fri]" id="priceplan['.$i.'][fri]"  size="4"  value="'.$pp_row['fri'].'"  /></td>
<td>'.$bsiCore->config['conf_currency_symbol'].'<input type="text" class="required number"  name="priceplan['.$i.'][sat]" id="priceplan['.$i.'][sat]"  size="4"   value="'.$pp_row['sat'].'"  /></td>
				</tr>';
		}else{
			echo '<tr>
<td colspan="8"><input type="hidden" class="required number"  name="priceplan['.$i.'][sun]" id="priceplan['.$i.'][sun]"  size="4" value="'.$pp_row['sun'].'" /><input type="hidden" class="required number"  name="priceplan['.$i.'][mon]" id="priceplan['.$i.'][mon]"  size="4"  value="'.$pp_row['mon'].'"  /><input type="hidden" class="required number"  name="priceplan['.$i.'][tue]" id="priceplan['.$i.'][tue]"  size="4"  value="'.$pp_row['tue'].'"  /><input type="hidden" class="required number"  name="priceplan['.$i.'][wed]" id="priceplan['.$i.'][wed]"  size="4"  value="'.$pp_row['wed'].'"  /><input type="hidden" class="required number"  name="priceplan['.$i.'][thu]" id="priceplan['.$i.'][thu]"  size="4"  value="'.$pp_row['thu'].'"  /><input type="hidden" class="required number"  name="priceplan['.$i.'][fri]" id="priceplan['.$i.'][fri]"  size="4"  value="'.$pp_row['fri'].'"  /><input type="hidden" class="required number"  name="priceplan['.$i.'][sat]" id="priceplan['.$i.'][sat]"  size="4"   value="'.$pp_row['sat'].'"  /></td>
				</tr>';
		}
				
	  }
	  ?>
      </table>
        </td>
        </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" value="Submit" name="Submit" style="background:#e5f9bb; cursor:pointer; cursor:hand;"/>
        <td>
      </tr>
    </table>
  </form>
</div>
<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery("#form1").validate();
     });    
</script>
