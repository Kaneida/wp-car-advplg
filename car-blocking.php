<?php 
include("includes/conf.class.php");
include("includes/admin.class.php"); 
if((isset($_GET['action'])) && ($_GET['action'] == "unblock")){	
	$booking_id  = $bsiCore->ClearInput($_GET['bid']);
	mysql_query("delete from bsi_bookings where booking_id=".$booking_id."");
	header("location:admin.php?page=car-block-list");
	exit;
}
	wp_enqueue_script( 'custom_script10', plugins_url().'/car/js/bsi_datatables.js');
	wp_enqueue_script( 'custom_script11', plugins_url().'/car/js/DataTables/jquery.dataTables.js');
	wp_enqueue_style('custom-style9', plugins_url().'/car/css/data.table.css');
	wp_enqueue_style('custom-style10', plugins_url().'/car/css/jqueryui.css');


?>

<p>&nbsp;</p>
<div id="container-inside" style="width:1050px;">
<span style="font-size:16px; font-weight:bold">Car Block List</span>
    <input type="button" value="Click Here To Block Car" onClick="window.location.href='admin.php?page=car-block'" style="background: #EFEFEF; float:right;"/>
<hr style="margin-top:14px;"/>
  <table class="display datatable" border="0">
    <thead>
      <tr>
        <th>Description/Name</th>
        <th>Car Type</th>
        <th>Car Vendor</th>
        <th>Model</th>
        <th>Date Range</th>
        <th>Pick-up Location</th>
        <th>Drop-off Location</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <?php echo $bsiAdminMain->getCarBlockDetails();?>
  </table>
</div>
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
