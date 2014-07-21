<?php 
include("includes/conf.class.php");
include("includes/admin.class.php");
if(isset($_REQUEST['update'])){
	header('location:admin.php?page=cust-lookup');
	exit;
}
$html = $bsiAdminMain->getCustomerHtml();
 ?>
<p>&nbsp;</p>
<div id="container-inside" style="width:1000px;"> <span style="font-size:16px; font-weight:bold">Customer List</span>
  <hr />
  <table class="display datatable" border="0">
    <thead>
      <tr>
        <th width="18%" nowrap="nowrap">Guset Name</th>
        <th width="27%" nowrap="nowrap">Street Address</th>
        <th width="15%" nowrap="nowrap">Phone Number</th>
        <th width="25%" nowrap="nowrap">Email Id</th>
        <th width="15%" nowrap="nowrap">&nbsp;</th>
      </tr>
    </thead>
    <tbody id="getcustomerHtml">
      <?php echo $html; ?>
    </tbody>
  </table>
</div>
<?php 
	wp_enqueue_script( 'custom_script10', plugins_url().'/car/js/bsi_datatables.js');
	wp_enqueue_script( 'custom_script11', plugins_url().'/car/js/DataTables/jquery.dataTables.js');
	wp_enqueue_style('custom-style9', plugins_url().'/car/css/data.table.css');
	wp_enqueue_style('custom-style10', plugins_url().'/car/css/jqueryui.css');
?>
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
