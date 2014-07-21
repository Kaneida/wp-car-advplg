<?php 
include("includes/conf.class.php");
include("includes/admin.class.php");	
if(isset($_POST['c_update'])){
	$bsiAdminMain->updateEmailContent();
	header("location:admin.php?page=email-list");
	exit;
}
$emaillist = $bsiAdminMain->getEmailContents();	
?>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#update_con').validate();
	jQuery('#email_id').change(function(){
		if(jQuery('#email_id').val()!= 0){
			jQuery("#submit:button").removeAttr("disabled");
			var selectid=jQuery('#email_id').val();
			var querystr='actioncode=1&choiceid='+jQuery('#email_id').val();
			jQuery.post("<?php echo plugins_url(); ?>/car/admin_ajax_processor.php", querystr, function(data){						 
				if(data.errorcode == 0){
					//alert(data.viewcontent);
					jQuery('#email_sub').val(data.viewcontent);
					jQuery('#c_update').val(data.viewcontent1);
					jQuery('#email_con').val(data.viewcontent2);
				}else{
					jQuery('#email_sub').val('');
					jQuery('#email_con').val('');
				}
			}, "json");
		}else{
			jQuery('#email_sub').val('');
			jQuery('#email_con').val('');
		}
	});
});	
</script>
<p>&nbsp;</p>
<div id="container-inside" style="width:1000px;">
<span style="font-size:16px; font-weight:bold">Email Content Setting</span>
      <hr />
  <form action="<?php echo admin_url('admin.php?page=email-list&noheader=true');?>" method="post" id="form1">
    <table cellpadding="5" cellspacing="2" border="0">
    <thead>
    <tr>
      <th align="left"><strong>Select Email Type</strong></th><th align="left"><select id="email_id" name="email_id"><?php echo $emaillist; ?></select></th>
    </tr>
    </thead>
    <tbody>
      <tr>
        <td><input type="hidden" id="c_update" name="c_update" /></td>
      </tr>
      <tr>
        <td ><strong>Email Subject:</strong></td>
        <td><input  type="text" id="email_sub" name="email_sub" class="required" style="width:700px !important;" /></td>
      </tr>
      <tr>
        <td valign="top"><strong>Email Content:</strong></td>
        <td><textarea name="email_con" id="email_con"  style="width:700px; height:250px;" class="required"></textarea></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" value="Update" style="cursor:pointer; cursor:hand;"/></td>
      </tr>
      </tbody>
    </table>
  </form>
</div>
<script src="<?php echo plugins_url(); ?>/car/js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
	jQuery().ready(function() {
		jQuery("#form1").validate();
		
     });        
</script>
