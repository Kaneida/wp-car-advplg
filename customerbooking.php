<?php
include("includes/conf.class.php");
include("includes/admin.class.php");
if(isset($_REQUEST['delete'])){
	$bsiAdminMain->booking_cencel_delete(2);
	$client = mysql_real_escape_string($_REQUEST['client']);
	header("location:admin.php?page=cust-booking&client=".$client);
	exit;
}
if(isset($_REQUEST['cancel'])){
	include("includes/mail.class.php");	
	$bsiAdminMain->booking_cencel_delete(1); 
	$client = $_REQUEST['client'];
	header("location:admin.php?page=cust-booking&client=".$client);
	exit;
}
if(isset($_GET['client'])){
	$client    = $_GET['client'];
	$delClient = $client;
	$htmlArr   = $bsiAdminMain->fetchClientBookingDetails($client);
	$html      = $htmlArr['html'];
}else{
	header("location:admin.php?page=Customerlookup");
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
function myPopup2(booking_id){
	var width = 730;
	var height = 650;
	var left = (screen.width - width)/2;
	var top = (screen.height - height)/2;
	var url='<?php echo plugins_url(); ?>/car/print_invoice.php?bid='+booking_id;
	var params = 'width='+width+', height='+height;
	params += ', top='+top+', left='+left;
	params += ', directories=no';
	params += ', location=no';
	params += ', menubar=no';
	params += ', resizable=no';
	params += ', scrollbars=yes';
	params += ', status=no';
	params += ', toolbar=no';
	newwin=window.open(url,'Chat', params);
	if (window.focus) {newwin.focus()}
	return false;
}
function cancel(bid){
	var answer = confirm ('Are you sure want to cancel Booking?');
	if (answer)
		window.location="admin.php?page=cust-booking&noheader=true&cancel="+bid+"&client="+<?php echo $delClient; ?>;
}
function booking_delete(delid){
	var answer = confirm ('Are you sure want to delete booking? Remember once booking deleted, it will be deleted forever from your database.')
	if (answer)
		window.location="admin.php?page=cust-booking&noheader=true&delete="+delid+"&client="+<?php echo $delClient;?>;
	}
</script>
<p>&nbsp;</p>
<div id="container-inside" style="width:1000px;"> <span style="font-size:16px; font-weight:bold">Booking List of
  <?php echo $htmlArr['clientName'];?>
  </span>
  <strong>
  <input type="submit" value="Back To Customer List" style="cursor:pointer; cursor:hand; float:right" onClick="javascript:window.location.href='admin.php?page=cust-lookup'"/>
  </strong><br /><br />
  <hr /><br />
  <table class="display datatable" border="0">
    <thead>
      <tr>
        <th width="8%" nowrap>Booking Id</th>
        <th width="15%" nowrap="nowrap">Pick Up Date &amp; Time</th>
        <th width="15%" nowrap>Drop Off Date &amp; Time</th>
        <th width="10%" nowrap>Amount</th>
        <th width="15%" nowrap>Booking Date</th>
        <th width="8%" nowrap="nowrap">Status</th>
        <th width="29%">&nbsp;</th>
      </tr>
    </thead>
    <?php echo $html;?>
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
