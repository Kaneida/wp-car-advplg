<?php 
include("includes/conf.class.php");
?>
<style>

.ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active {
	background: #F8F7F6 url('images/ui-bg_fine-grain_10_f8f7f6_60x60.png') 50% 50% repeat;
}

/* begin: jQuery UI Datepicker moving pixels fix */
table.ui-datepicker-calendar {border-collapse: separate;}
.ui-datepicker-calendar td {border: 1px solid transparent;}
/* end: jQuery UI Datepicker moving pixels fix */

/* begin: jQuery UI Datepicker emphasis on selected dates */
.ui-datepicker .ui-datepicker-calendar .ui-state-highlight a {
	background: #743620 none;
	color: white;
}
/* end: jQuery UI Datepicker emphasis on selected dates */


/* begin: jQuery UI Datepicker hide datepicker helper */
#ui-datepicker-div {display:none;}
/* end: jQuery UI Datepicker hide datepicker helper */
</style>
<!-- loads jquery and jquery ui -->

<!-- script type="text/javascript" src="js/jquery.ui.datepicker-es.js"></script -->	
<!-- loads mdp -->
<?php 
	wp_enqueue_script( 'custom_script13', plugins_url().'/car/js/jquery-ui.multidatespicker.js');
	wp_enqueue_style('custom-style9', plugins_url().'/car/css/data.table.css');
	wp_enqueue_style('custom-style10', plugins_url().'/car/css/jqueryui.css');
?>
<!-- mdp demo code -->
<script type="text/javascript">
<!--	
jQuery(function() {
		// Version //
	jQuery('#custom-date-format').multiDatesPicker({
		dateFormat: "yy-mm-dd",
		numberOfMonths:[3,4],
		altField: '#textselectdate',
		<?php
		if($bsiCore->getcloseDate()){
			echo 'addDates: ['.$bsiCore->getcloseDate().'],';
		}
		?>		
		minDate:0
	});
	jQuery('#saveDate').click(function(){
	 var querystr='actioncode=2&selectdates='+jQuery('#textselectdate').val();
	 	jQuery.post("<?php echo plugins_url(); ?>/car/admin_ajax_processor.php", querystr, function(data){
		 	if(data.errorcode == 0){
				alert('Selected date successfully closed!');
			}
		 }, "json");
	 });
});
// -->
</script>

		<!-- loads some utilities (not needed for your developments) -->
		<link rel="stylesheet" type="text/css" href="<?php echo plugins_url(); ?>/car/css/pepper-ginder-custom.css">
		
<p>&nbsp;</p>
<div id="container-inside" style="width:1000px;">
<span style="font-size:16px; font-weight:bold">Close Date Setting of Pick-up &amp; Drop-off</span>
<input type="button" value="Click Here To Save Selected Date" id="saveDate" style="background: #EFEFEF; float:right"/>
      <hr style="margin-top:14px;"/>
  <div id="custom-date-format"  class="box" align="center"></div>
  <input type="hidden" id="textselectdate" >  
</div>
