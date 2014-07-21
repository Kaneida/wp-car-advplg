<?php 
include("includes/conf.class.php");
include("includes/admin.class.php");
if(isset($_POST['submitFeatures'])){
	$bsiAdminMain->priceCalculationSave();
	header("location:admin.php?page=price-cal");
}
$pp_setting = $bsiAdminMain->priceCalculation();	
?>      

        <p>&nbsp;</p>
        <div id="container-inside">
         <span style="font-size:16px; font-weight:bold">Price Calculation Setup of Car</span>
       
       <hr/>
           <form action="<?php echo admin_url('admin.php?page=price-cal&noheader=true'); ?>" method="post" id="form1">
          <table cellpadding="5" cellspacing="2" border="0">
          <input type="hidden" name="features_id" value="<?php echo $_GET['fid'];?>"/>
            <tr>
              <td><strong>Price Calculated By:</strong></td>
              <td><select name="pp_setting"><?php echo $pp_setting;?></select></td>
            </tr>
            <tr><td></td><td><input type="submit" value="Submit" name="submitFeatures" style="cursor:pointer; cursor:hand;"/></td></tr>
            </table>
            </form><br /><br />
            <strong>Important Note for price setup(Must read):</strong><br />
            <p>You Must define price of Daily and Hourly in car add/edit. <br /><br />
           <strong>How different type of price setup  work?</strong>
            </p>
            <p><strong>Example</strong>:<br /><strong>Pick-up Date &amp; Time:</strong> 21/08/2012 9:00 AM <br /> <strong>Drop-off Date &amp; Time:</strong> 23/08/2012 3:00 PM</p>
            <p><strong>Daily</strong>: Price will be calculated of 3 days and that apply daily price. </p>
            <p><strong>Hourly</strong>: Price will be calculated of 54 hours and that apply hourly price. </p>
            <p><strong>Daily &amp; Hourly Combined.</strong>: Price will be calculated of  2 Day(s) 6 Hour(s) and that apply 2 days daily price + 6 hours hourly price. </p>
            
            
        </div>
        
        <script type="text/javascript">
	jQuery().ready(function() {
		jQuery("#form1").validate();
		
     });
         
</script>      
