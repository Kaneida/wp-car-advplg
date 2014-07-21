<?php 
include("includes/conf.class.php");
include("includes/admin.class.php");
if(isset($_POST['submitdiscountdetails'])){
	$bsiAdminMain->addeditDiscount();
}
if(isset($_GET['disco_id'])){
	
	if($_GET['disco_id'] != 0){
		$getdiscountrow=$bsiAdminMain->geteditDiscountRowValue(mysql_real_escape_string($_GET['disco_id']));	
	}else{
		$getdiscountrow=NULL;
	}
	
}
?>      

        <p>&nbsp;</p>
        <div id="container-inside" style="width:1000px;">
         <span style="font-size:16px; font-weight:bold">Discount upon Duration Add/Edit</span>
       <input type="button" value="Back To Discount List" onClick="window.location.href='admin.php?page=car-discount'" style="background: #EFEFEF; float:right; cursor:pointer; cursor:hand;"/><hr style="margin-top:10px;"/>
           <form action="<?php echo admin_url('admin.php?page=car-adddiscount&noheader=true');?>" method="post" id="form1">
          <table cellpadding="5" cellspacing="2" border="0">
          <input type="hidden" name="disco_id" value="<?php echo $_GET['disco_id'];?>"/>
            <tr>
              <td><strong>Day From:</strong></td>
              <td><input type="text" name="day_from" value="<?php echo $getdiscountrow['day_from'];?>" id="day_from" class="required digits" style="width:70px;" /></td>
            </tr>
            <tr>
              <td><strong>Day To:</strong></td>
              <td><input type="text" name="day_to" value="<?php echo $getdiscountrow['day_to'];?>" id="day_to" class="required digits" style="width:70px;" /></td>
            </tr>
            <tr>
              <td><strong>Discount:</strong></td>
              <td><input type="text" name="discount_percent" value="<?php echo $getdiscountrow['discount_percent'];?>" id="discount_percent" class="required number" style="width:70px;" />&nbsp;%</td>
            </tr>
            <tr><td></td><td><input type="submit" value="Submit" name="submitdiscountdetails" style="cursor:pointer; cursor:hand;"/></td></tr>
            </table>
            </form>
        </div>


   <script type="text/javascript">
	jQuery().ready(function() {
		jQuery("#form1").validate();
     });
         
</script>
