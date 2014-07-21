<?php
if(isset($_GET['pln_del']))
{
	include("includes/conf.class.php");
	include("includes/admin.class.php");
	$selected= $bsiAdminMain->price_del($_GET['pln_del']);
}
include("includes/conf.class.php");
include("includes/admin.class.php");
?>
<script>
	jQuery(document).ready(function(){
		
		 jQuery('#c1').change(function() { 
		 //alert("test");
			getPriceplan();
		 });
		 if(jQuery('#c1').val() > 0){
			 getPriceplan();
		 }
		 function getPriceplan(){
			 if(jQuery('#c1').val() != 0){
				  jQuery('#ppidimg').html('<img src="<?php echo plugins_url();?>/car/images/ajax-loader.gif" />')
				var querystr = 'actioncode=3&c1='+jQuery('#c1').val();
				//alert(querystr)
				jQuery.post("<?php echo plugins_url(); ?>/car/admin_ajax_processor.php", querystr, function(data){					 
					if(data.errorcode == 0){ 
					
						jQuery('#getpriceplanHtml').html(data.strmsg)
						jQuery('#ppidimg').html('')
					}else{
						jQuery('#getpriceplanHtml').html('<tr><td colspan="12">No available Data found!</td></tr>')
					}
					
				}, "json");
			}
			if(jQuery('#c1').val() == 0){
				jQuery('#getpriceplanHtml').html('<tr><td colspan="12">Please Select A car first!</td></tr>')
			}
		 }
	});
</script>
<div id="container-inside" style="width:85%;">
<p>
<span style="font-size:16px; font-weight:bold">Car Price Plan List</span>
<input type="button" value="Add New Price Plan" onClick="window.location.href='admin.php?page=add-edit-price-plan&car_id=0'" style="background:#e5f9bb; cursor:pointer; cursor:hand; float:right; " /><br />
<hr style="margin-top:10px;" />
    <table width="100%"><tr><td width="80%" align="left"><?php if(isset($_SESSION['date_err'])){ echo '<font color="#FF0000">Daterange already exists </font>'; 
	unset($_SESSION['date_err']);}?></td><td align="right"></td></tr></table>
  
    <table cellpadding="5" cellspacing="0" border="0" width="100%">
      <thead>
        <tr>
          <th nowrap="nowrap" width="15%" align="left">Please select  car :</th>
          <th  colspan="7" align="left">
            <select name="car_id" id="c1">
             <?php if(isset($_GET['cid'])){echo $bsiAdminMain->getCarcombo(mysql_real_escape_string($_GET['cid']));}else{echo $bsiAdminMain->getCarcombo(); } ?>                      
          </select></th><th  id="ppidimg"></th>
                            
        </tr>
        <tr><th colspan="9"><hr /></th></tr>
      </thead>
      <tbody id="getpriceplanHtml">
     <tr><td colspan="9">Please select a car first !</td></tr>
      </tbody>
    </table>
</div>
<script type="text/javascript">
	jQuery().ready(function() {
		jQuery("#form1").validate();
		
     });
         
</script> 
