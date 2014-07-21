<?php 

include("includes/conf.class.php");

include("includes/admin.class.php");

if(isset($_POST['submitFeatures'])){	

	$bsiAdminMain->carFeaturesAddEdit($_POST['features_id']);

	header("location:admin.php?page=car-features-list");

}

if(isset($_GET['fid'])){

	

	if($_GET['fid'] != 0){

		$getfeaturesrow=$bsiAdminMain->geteditFeaturesRowValue($_GET['fid']);

		

	}else{

		$getfeaturesrow=NULL;

	}

	

}

?>      



        <p>&nbsp;</p>

        <div id="container-inside" style="width:1000px;">

         <span style="font-size:16px; font-weight:bold">Feature Add/Edit</span>

        <input type="button" value="Back To Features List" onClick="window.location.href='admin.php?page=car-features-list'" style="background: #EFEFEF; float:right; cursor:pointer; cursor:hand; "/>

        <hr style="margin-top:10px;"/>

           <form action="<?php echo admin_url('admin.php?page=add_car_feature&noheader=true');?>" method="post" id="form1">

          <table cellpadding="5" cellspacing="2" border="0">

          <input type="hidden" name="features_id" value="<?php echo $_GET['fid'];?>"/>

            <tr>

              <td><strong>Features Title:</strong></td>

              <td><input type="text" name="features_title" value="<?php echo $getfeaturesrow['features_title'];?>" id="features_title" class="required" style="width:200px;" /></td>

            </tr>

            <tr><td></td><td><input type="submit" value="submit" name="submitFeatures" style="cursor:pointer; cursor:hand;"/></td></tr>

            </table>

            </form>

        </div>





        <script type="text/javascript">

	jQuery().ready(function() {

		jQuery("#form1").validate();

		

     });

         

</script>
