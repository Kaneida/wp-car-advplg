<?php 
include("includes/conf.class.php");
include("includes/admin.class.php");
if(isset($_POST['submitdepositdetails'])){
		$bsiAdminMain->addeditDeposit();
	header("location:admin.php?page=preamount-list");
}
if(isset($_GET['depoid'])){
	
	if($_GET['depoid'] != 0){
		$getdepositrow=$bsiAdminMain->geteditDepositRowValue(mysql_real_escape_string($_GET['depoid']));	
	}else{
		$getdepositrow=NULL;
	}
	
}
?>    

  

        <p>&nbsp;</p>
        <div id="container-inside" style="width:1000px;">
         <span style="font-size:16px; font-weight:bold">Prepaid Amount(%) Add/Edit</span>
       <input type="button" value="Back To Prepaid Amount List" onClick="window.location.href='admin.php?page=preamount-list'" style="background: #EFEFEF; float:right; cursor:pointer; cursor:hand;"/><hr style="margin-top:10px;"/>
           <form action="<?php echo admin_url('admin.php?page=add-deposit&noheader=true');?>" method="post" id="form1">
          <table cellpadding="5" cellspacing="2" border="0">
          <input type="hidden" name="depo_id" value="<?php echo $_GET['depoid'];?>"/>
            <tr>
              <td><strong>Day From:</strong></td>
              <td><input type="text" name="day_from" value="<?php echo $getdepositrow['day_from'];?>" id="day_from" class="required digits" style="width:70px;" /></td>
            </tr>
            <tr>
              <td><strong>Day To:</strong></td>
              <td><input type="text" name="day_to" value="<?php echo $getdepositrow['day_to'];?>" id="day_to" class="required digits" style="width:70px;" /></td>
            </tr>
            <tr>
              <td><strong>Deposit:</strong></td>
              <td><input type="text" name="deposit_percent" value="<?php echo $getdepositrow['deposit_percent'];?>" id="deposit_percent" class="required number" style="width:70px;" />&nbsp;%</td>
            </tr>
            <tr><td></td><td><input type="submit" value="Submit" name="submitdepositdetails" style="cursor:pointer; cursor:hand;"/></td></tr>
            </table>
            </form>
        </div>


   <script type="text/javascript">
	jQuery().ready(function() {
		jQuery("#form1").validate();
     });
         
</script>
