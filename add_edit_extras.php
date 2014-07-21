<?php 
include("includes/conf.class.php");
include("includes/admin.class.php");
if(isset($_POST['submitextrasdetails'])){	
	$bsiAdminMain->addeditExtras();
	header("location:admin.php?page=car-extra");
}
if(isset($_GET['extra_id'])){ 
	
	if($_GET['extra_id'] != 0){
		$getextrasrow=$bsiAdminMain->geteditableextrasRowValue(mysql_real_escape_string($_GET['extra_id']));	
	}else{
		$getextrasrow=NULL;
	}
	
}
?>

<p>&nbsp;</p>
<div id="container-inside" style="width:1000px;"> <span style="font-size:16px; font-weight:bold">Car Extras Add/Edit</span>
  <input type="button" value="Back Extras / Options List" onClick="window.location.href='admin.php?page=car-extra'" style="background: #EFEFEF; float:right; cursor:pointer; cursor:hand;"/>
  <hr style="margin-top:10px;"/>
  <form action="<?php echo admin_url('admin.php?page=add-extra&noheader=true');?>" method="post" id="form1">
    <table cellpadding="5" cellspacing="2" border="0">
      <input type="hidden" name="extra_id" value="<?php echo mysql_real_escape_string($_GET['extra_id']);?>"/>
      <tr>
        <td><strong>Car Extras:</strong></td>
        <td><input type="text" name="car_extras" value="<?php echo $getextrasrow['car_extras'];?>" id="car_extras" class="required" style="width:200px;" /></td>
      </tr>
      <tr>
        <td><strong>Price/Day:</strong></td>
        <td><input type="text" name="price" value="<?php echo $getextrasrow['price'];?>" id="price" class="required number" style="width:70px;" />
          &nbsp;
          <?php echo $bsiCore->config['conf_currency_code'];?></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" value="Submit" name="submitextrasdetails" style="cursor:pointer; cursor:hand;"/></td>
      </tr>
    </table>
  </form>
</div>

   <script type="text/javascript">
	jQuery().ready(function() {
		jQuery("#form1").validate();
     });
         
</script>
