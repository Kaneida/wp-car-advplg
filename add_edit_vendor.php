<?php
include("includes/conf.class.php");

include("includes/admin.class.php");

if(isset($_POST['submitVendorss'])){

	$bsiAdminMain->carVendorsAddEdit($_POST['vendors_id']);

	header("location:admin.php?page=car-vendor");

	exit;

} 

if(isset($_GET['vid'])){

	

	if($_GET['vid'] != 0){

		$getvendorrow=$bsiAdminMain->geteditVendorssRowValue(mysql_real_escape_string($_GET['vid']));

		

	}else{

		$getvendorrow=NULL;

	}

	

}

?>      



        <p>&nbsp;</p>

        <div id="container-inside" style="width:1000px;">

         <span style="font-size:16px; font-weight:bold">Vendor Add/Edit</span>

        <input type="button" value="Back To Vendor List" onClick="window.location.href='admin.php?page=car-vendor'" style="background: #EFEFEF; float:right; cursor:pointer; cursor:hand;"/>

       <hr style="margin-top:10px;"/>

           <form action="<?php echo admin_url('admin.php?page=add_vendor&noheader=true'); ?>" method="post" id="form1">

          <table cellpadding="5" cellspacing="2" border="0">

          <input type="hidden" name="vendors_id" value="<?php echo $_GET['vid'];?>"/>

            <tr>

              <td><strong>Vendor Title:</strong></td>

              <td><input type="text" name="vendor_title" value="<?php echo $getvendorrow['vendor_title'];?>" id="vendor_title" class="required" style="width:200px;" /></td>

            </tr>

            <tr><td></td><td><input type="submit" value="submit" name="submitVendorss" style="cursor:pointer; cursor:hand;"/></td></tr>

            </table>

            </form>

        </div>





        <script type="text/javascript">

	jQuery().ready(function() {

		jQuery("#form1").validate();

		

     });

         

</script> 
