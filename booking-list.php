<?php 
include("includes/conf.class.php");
include("includes/admin.class.php")
?>    
<?php
	wp_enqueue_style('jquery-style', plugins_url().'/car/front/css/datepicker.css');
	
	wp_enqueue_script( 'custom_script10', plugins_url().'/car/js/bsi_datatables.js');
		wp_enqueue_script( 'custom_script11', plugins_url().'/car/js/DataTables/jquery.dataTables.js');
		wp_enqueue_style('custom-style9', plugins_url().'/car/css/data.table.css');
		wp_enqueue_style('custom-style10', plugins_url().'/car/css/jqueryui.css');
?>
<!-- ********************************************************************************************* -->
      <p>&nbsp;</p>
      <div id="container-inside" style="width:1000px;">
      <span style="font-size:16px; font-weight:bold">Booking List</span>
      <hr style="margin-top:14px;"/>
        <form action="<?php echo admin_url('admin.php?page=view-booking');?>" method="post" id="form1">
          <table cellpadding="5" cellspacing="2" border="0">
            <tr>
            <td valign="middle"><strong>Select Booking Type</strong>:</td>
            <td><select name="book_type" id="book_type"><option value="">---Select Type---</option><option value="1">Active Booking</option><option value="2">Booking History</option></select> </td>
            
            </tr>
            
           <tr><td><strong>Date Range(optional)</strong></td><td><input id="txtFromDate" name="fromDate" style="width:78px" type="text"/>
      <span style="padding-left:0px;"><a id="datepickerImage" href="javascript:;"><img src="<?php echo plugins_url();?>/car/images/month.png" height="16px" width="16px" style=" margin-bottom:-4px;" border="0" /></a></span>&nbsp;&nbsp;&nbsp;&nbsp; <strong>TO</strong> &nbsp;&nbsp;&nbsp;&nbsp;<input id="txtToDate" name="toDate" style="width:78px" type="text"/>
      <span style="padding-left:0px;"><a id="datepickerImage1" href="javascript:;"><img src="<?php echo plugins_url();?>/car/images/month.png" height="18px" width="18px" style=" margin-bottom:-4px;" border="0" /></a></span>&nbsp;&nbsp;&nbsp;&nbsp;<strong>By</strong>&nbsp;&nbsp;&nbsp;&nbsp;<select name="shortby"><option value="booking_time" selected="selected">Booking Date</option><option value="pickup_datetime">Pick-Up Date</option><option value="dropoff_datetime">Drop-Off Date</option></select></td></tr>
           <tr><td></td><td><input type="submit" value="Search" name="submit" id="submit" style="cursor:pointer; cursor:hand;"/></td></tr>
          </table>
        </form>
        <br /><br /><br />
         <span style="font-size:16px; font-weight:bold">Today Booking List</span>
     	 <hr />
          <table class="display datatable" border="0">
         <?php echo $bsiAdminMain->homewidget(1);?>
        </table>
         <br />
         
         <span style="font-size:16px; font-weight:bold">Today Pick-up List</span>
      	 <hr />
          <table class="display datatable" border="0">
         <?php echo $bsiAdminMain->homewidget(2);?>
        </table>
         <br />
         
         <span style="font-size:16px; font-weight:bold">Today Drop-off List</span>
         <hr />
          <table class="display datatable" border="0">
        <?php echo $bsiAdminMain->homewidget(3);?>
        </table>
         <br />
      </div>
<script type="text/javascript">
	jQuery().ready(function() {
		jQuery("#form1").validate();
		
     });
         
</script>      
<script type="text/javascript">
jQuery(document).ready(function(){
 jQuery.datepicker.setDefaults({ dateFormat: '<?php echo $bsiCore->config['conf_dateformat'];?>' });
    jQuery("#txtFromDate").datepicker({
		minDate:0,
        maxDate: "+365D",
        numberOfMonths: 2,
    });
 
    jQuery("#txtToDate").datepicker({ 
	    minDate:0,
        maxDate:"+365D",
        numberOfMonths: 2,
    });  
 jQuery("#datepickerImage").click(function() { 
    jQuery("#txtFromDate").datepicker("show");
  });
 jQuery("#datepickerImage1").click(function() { 
    jQuery("#txtToDate").datepicker("show");
  });
  disableInput("#submit");
		jQuery('#book_type').change(function(){
			if(jQuery('#book_type').val() != ""){
				enableInput("#submit");			
			}else{
				disableInput("#submit");
			}
		});
		//Enabling Disabling Function
		function disableInput(id){
			jQuery(id).attr('disabled', 'disabled');
		}
		function enableInput(id){
			jQuery(id).removeAttr('disabled');	
		}
});
</script>

<script>
 jQuery(document).ready(function() {
	 	var oTable = jQuery('.datatable').dataTable( {
				"bJQueryUI": true,
				"sScrollX": "",
				"bSortClasses": false,
				"aaSorting": [[0,'asc']],
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
