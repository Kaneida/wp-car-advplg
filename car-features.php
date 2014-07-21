<?php 
include("includes/conf.class.php");
include("includes/admin.class.php");
if(isset($_GET['delid'])){
	$bsiAdminMain->FeaturesrowDelete(mysql_real_escape_string($_GET['delid']));
	header("location:admin.php?page=car-features-list");
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
function deletecarfaci(delid){
	var approval = confirm('Do you want to delete this Feature? Remember corresponding of its data will also be deleted.');
	if(approval){
		window.location = 'admin.php?page=car-features-list&noheader=true&delid='+delid;	
	}
}
</script>
<p>&nbsp;</p>
<div id="container-inside" style="width:1000px;"> <span style="font-size:16px; font-weight:bold">Car Feature List</span>&nbsp;&nbsp;
<?php
if(isset($_SESSION['error2'])){
	echo '<font color="#FF0000">Already Exists...........</font>';
	unset($_SESSION['error2']);
}
?>
  <input type="button" value="Add New Feature" onClick="window.location.href='admin.php?page=add_car_feature&fid=0'" style="background: #EFEFEF; float:right;"/>  
  <hr style="margin-top:14px;"/>
  <table class="display datatable" border="0">
    <thead>
      <tr>
        <th>Feature</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
    <?php echo $bsiAdminMain->getAllFeaturesRow();?>
    </tbody>
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
