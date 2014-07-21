<?php 

include("includes/conf.class.php");

include("includes/admin.class.php");

if(isset($_POST['submitLocation'])){

	$bsiAdminMain->carLocationAddEdit($_POST['loc_id']);

	header("location:admin.php?page=car-location-list");

}

if(isset($_GET['lid'])){

	

	if($_GET['lid'] != 0){

		$getlocationrow=$bsiAdminMain->geteditLocationRowValue($_GET['lid']);

		

	}else{

		$getlocationrow=NULL;

	}

	

}

?>      

<?php 

	wp_enqueue_script( 'custom_script10', plugins_url().'/car/js/bsi_datatables.js');

	wp_enqueue_script( 'custom_script11', plugins_url().'/car/js/DataTables/jquery.dataTables.js');

	wp_enqueue_style('custom-style9', plugins_url().'/car/css/data.table.css');

	wp_enqueue_style('custom-style10', plugins_url().'/car/css/jqueryui.css');



?>



        <p>&nbsp;</p>

        <div id="container-inside" style="width:1000px;">

         <span style="font-size:16px; font-weight:bold">Location Add/Edit</span>

        <input type="button" value="Back To Location List" onClick="window.location.href='admin.php?page=car-location-list'" style="background: #EFEFEF; float:right; cursor:pointer; cursor:hand; "/>

        <hr style="margin-top:10px;"/>

           <form action="<?php echo admin_url('admin.php?page=add-edit-location&noheader=true');?>" method="post" id="form1">

          <table cellpadding="5" cellspacing="2" border="0">

          <input type="hidden" name="loc_id" value="<?php echo $_GET['lid'];?>"/>

            <tr>

              <td><strong>Location Title:</strong></td>

              <td><input type="text" name="location_title" value="<?php echo $getlocationrow['location_title'];?>" id="location_title" class="required" style="width:300px;" /></td>

            </tr>

            <tr><td></td><td><input type="submit" value="submit" name="submitLocation" style="background:#e5f9bb; cursor:pointer; cursor:hand;"/></td></tr>

            </table>

            </form>

        </div>



        <script type="text/javascript">

	jQuery().ready(function() {

		jQuery("#form1").validate();

		

     });

         

</script>
