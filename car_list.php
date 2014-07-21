<?php

include("includes/conf.class.php");

include("includes/admin.class.php"); 

if(isset($_GET['delid'])){

	$bsiAdminMain->carDelete(mysql_real_escape_string($_GET['delid']));

	header("location:admin.php?page=car-list");

	exit;

}

?>

<?php 

	wp_enqueue_script( 'custom_script10', plugins_url().'/car/js/bsi_datatables.js');

	wp_enqueue_script( 'custom_script11', plugins_url().'/car/js/DataTables/jquery.dataTables.js');

	wp_enqueue_style('custom-style9', plugins_url().'/car/css/data.table.css');

	wp_enqueue_style('custom-style10', plugins_url().'/car/css/jqueryui.css');



?>

<script type="text/javascript">

function deletecarmas(delid){

	var approval = confirm('Do you want to delete this Car? Remember corresponding of its bookings will also be deleted.');

	if(approval){

		window.location = 'admin.php?page=car-list&noheader=true&delid='+delid;	

	}

}

</script>

<p>&nbsp;</p>

<div id="container-inside" style="width:1000px;"> <span style="font-size:16px; font-weight:bold">Car List</span>

  <input type="button" value="Add New Car" onClick="window.location.href='admin.php?page=add_car&cid=0'" style="background: #EFEFEF; float:right;"/>  

  <hr style="margin-top:14px;"/>

  <table class="display datatable" border="0">

    <thead>

      <tr>

        <th>SN.</th>

        <th>Car Type</th>

        <th>Car Vendor</th>

        <th>Car Model</th>

        <th>Total Car</th>

        <th>Fuel Type</th>

       

        <th>Status</th>

        <th>&nbsp;</th>

      </tr>

    </thead>

    <tbody>

     <?php echo $bsiAdminMain->getAllCardetailsRow();?>

    </tbody>

  </table>

</div>

<script type="text/javascript" src="<?php echo plugins_url()?>/car/js/DataTables/jquery.dataTables.js"></script> 

<script>

 jQuery(document).ready(function() {

	 	var oTable = jQuery('.datatable').dataTable( {

				"bJQueryUI": true,

				"sScrollX": "",

				"bSortClasses": false,

				"aaSorting": [[0,'desc']],

				"bAutoWidth": true,

				"bInfo": true,

				"sScrollY": "100%",	

				"sScrollX": "100%",

				"bScrollCollapse": true,

				"sPaginationType": "full_numbers",

				"bRetrieve": true,

				"oLanguage": {

								"sSearch": "Search:",

								"sInfo": "Showing _START_ to _END_ of _TOTAL_ entries",

								"sInfoEmpty": "Showing 0 to 0 of 0 entries",

								"sZeroRecords": "No matching records found",

								"sInfoFiltered": "(filtered from _MAX_ total entries)",

								"sEmptyTable": "No data available in table",

								"sLengthMenu": "Show _MENU_ entries",

								"oPaginate": {

												"sFirst":    "First",

												"sPrevious": "Previous",

												"sNext":     "Next",

												"sLast":     "Last"

											  }

							 }

	} );

} );

</script>
