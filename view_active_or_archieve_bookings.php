<?php 
include("includes/conf.class.php");
include("includes/admin.class.php");
if(isset($_REQUEST['delete'])){	
	$bsiAdminMain->booking_cencel_delete(2);
	header("location:admin.php?page=view-booking&book_type=".$_GET['book_type']);
	exit;
}
if(isset($_REQUEST['cancel'])){
	include("includes/mail.class.php");	
	$bsiAdminMain->booking_cencel_delete(1); 
	header("location:admin.php?page=view-booking&book_type=".$_GET['book_type']);
	exit;
}
if(isset($_GET['book_type'])){
	$book_type = $bsiCore->ClearInput($_GET['book_type']);
	
}else{
	$book_type = $bsiCore->ClearInput($_POST['book_type']);
	$_SESSION['book_type'] = $book_type;
	$_SESSION['fromDate']=$bsiCore->ClearInput($_POST['fromDate']);
	$_SESSION['toDate']=$bsiCore->ClearInput($_POST['toDate']);
	$_SESSION['shortby']=$bsiCore->ClearInput($_POST['shortby']);
}
if($_SESSION['fromDate'] !="" and $_SESSION['toDate'] != ""){
$condition=" and (DATE_FORMAT(".$_SESSION['shortby'].", '%Y-%m-%d') between '".$bsiCore->getMySqlDate($_SESSION['fromDate'])."' and '".$bsiCore->getMySqlDate($_SESSION['toDate'])."')";
$shortbyarr=array("booking_time"=>"Booking Date", "pickup_datetime"=>"Pick-up Date", "dropoff_datetime"=>"Drop-off Date");
$text_cond="( ".$_SESSION['fromDate']."  To ".$_SESSION['toDate']."  By ".$shortbyarr[$_SESSION['shortby']]." )";
}else{
$condition="";
$text_cond="";
}

$query = $bsiAdminMain->getBookingInfo($book_type, $clientid=0, $condition);

$html  = $bsiAdminMain->getBookingDetailsHtml($book_type, $query);
$title_hr = array(1=>"Active Booking List", 2=>"Booking History List");
?>   
<?php 

	wp_enqueue_script( 'custom_script10', plugins_url().'/car/js/bsi_datatables.js');
	wp_enqueue_script( 'custom_script11', plugins_url().'/car/js/DataTables/jquery.dataTables.js');
	wp_enqueue_style('custom-style9', plugins_url().'/car/css/data.table.css');
	wp_enqueue_style('custom-style10', plugins_url().'/car/css/jqueryui.css');

?>
<script type="text/javascript">
	function cancel(bid){
		var answer = confirm ('Are you sure want to cancel Booking?');
		if (answer)
			window.location="admin.php?page=view-booking&noheader=true&cancel="+bid+"&book_type="+<?php echo $book_type;?>;
	}
	
	function deleteBooking(bid){
		var answer = confirm ('Are you sure want to delete Booking?');
		if (answer)
			window.location="admin.php?page=view-booking&noheader=true&delete="+bid+"&book_type="+<?php echo $book_type;?>;
	}
		
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
</script> 
      <p>&nbsp;</p>
      <div id="container-inside" style="width:1000px;">
      <span style="font-size:16px; font-weight:bold"><?php echo $title_hr[$book_type];?>  <?php echo $text_cond;?></span>
      <input type="submit" value="Modify Search Input" style=" cursor:pointer; cursor:hand; float:right" onClick="javascript:window.location.href='admin.php?page=booking-list&'"/>
      <hr style="margin-top:12px;"/>
        <table class="display datatable" border="0">
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
