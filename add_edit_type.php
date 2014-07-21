<?php 
include("includes/conf.class.php");

include("includes/admin.class.php");

if(isset($_POST['submitFeatures'])){

	$bsiAdminMain->carTypesAddEdit($_POST['type_id']);

	header("location:admin.php?page=car-type-list");

}

if(isset($_GET['tid'])){	

	if($_GET['tid'] != 0){

		$gettypesrow=$bsiAdminMain->geteditTypesRowValue(mysql_real_escape_string($_GET['tid']));

		

	}else{

		$gettypesrow=NULL;

	}

	

}

?>      



        <p>&nbsp;</p>

        <div id="container-inside" style="width:1000px;">

         <span style="font-size:16px; font-weight:bold">Car Type Add/Edit</span>

       <input type="button" value="Back To Car Type List" onClick="window.location.href='admin.php?page=car-type-list'" style="background: #EFEFEF; float:right; cursor:pointer; cursor:hand;"/><hr style="margin-top:10px;"/>

           <form action="<?php echo admin_url('admin.php?page=add_car_type&noheader=true'); ?>" method="post" id="form1">

          <table cellpadding="5" cellspacing="2" border="0">

          <input type="hidden" name="type_id" value="<?php echo mysql_real_escape_string($_GET['tid']);?>"/>

            <tr>

              <td><strong>Type Title:</strong></td>

              <td><input type="text" name="type_title" value="<?php echo $gettypesrow['type_title'];?>" id="type_title" class="required" style="width:200px;" /></td>

            </tr>

            <tr><td></td><td><input type="submit" value="submit" name="submitFeatures" style="background:#e5f9bb; cursor:pointer; cursor:hand;"/></td></tr>

            </table>

            </form>

        </div>





        <script type="text/javascript">

	jQuery().ready(function() {

		jQuery("#form1").validate();

		

     });

         

</script>
