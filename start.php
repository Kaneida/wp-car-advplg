<?php
/*
Plugin Name: BSI CAR RENTAL SYSTEM
Plugin URI: http://www.bestsoftinc.com
Description: online car rental system
Version: 1.2
Author: Best Soft Inc
Author URI: http://www.bestsoftinc.com
*/
?>
<?php
function jal_install() {
   global $wpdb;	
 $sql = "CREATE TABLE `bsi_bookings` (
						  `booking_id` int(10) NOT NULL,
						  `booking_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
						  `pickup_datetime` datetime NOT NULL,
						  `dropoff_datetime` datetime NOT NULL,
						  `client_id` int(11) unsigned DEFAULT NULL,
						  `discount_coupon` varchar(50) DEFAULT NULL,
						  `total_cost` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
						  `payment_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
						  `payment_type` varchar(255) NOT NULL,
						  `payment_success` tinyint(1) NOT NULL DEFAULT '0',
						  `payment_txnid` varchar(100) DEFAULT NULL,
						  `paypal_email` varchar(500) DEFAULT NULL,
						  `special_id` int(10) unsigned NOT NULL DEFAULT '0',
						  `special_requests` text,
						  `is_block` tinyint(4) NOT NULL DEFAULT '0',
						  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
						  `block_name` varchar(255) DEFAULT NULL,
						  `pick_loc` varchar(255) DEFAULT NULL,
						  `drop_loc` varchar(255) DEFAULT NULL,
						  PRIMARY KEY (`booking_id`),
						  KEY `start_date` (`pickup_datetime`),
						  KEY `end_date` (`dropoff_datetime`),
						  KEY `booking_time` (`discount_coupon`)
						) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
$wpdb->query($sql);
					$sql = "CREATE TABLE `bsi_car_priceplan` (
					  `pp_id` int(10) NOT NULL auto_increment,
					  `car_id` int(10) NOT NULL,
					  `start_date` date NOT NULL,
					  `end_date` date NOT NULL,
					  `price_type` int(1) NOT NULL,
					  `mon` decimal(10,2) NOT NULL,
					  `tue` decimal(10,2) NOT NULL,
					  `wed` decimal(10,2) NOT NULL,
					  `thu` decimal(10,2) NOT NULL,
					  `fri` decimal(10,2) NOT NULL,
					  `sat` decimal(10,2) NOT NULL,
					  `sun` decimal(10,2) NOT NULL,
					  `default_price` tinyint(4) NOT NULL default '1',
					  PRIMARY KEY  (`pp_id`)
					) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
$wpdb->query($sql);
 $sql = "CREATE TABLE `bsi_car_extras` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `car_extras` varchar(255) NOT NULL,
					  `price` decimal(10,2) NOT NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
$wpdb->query($sql);
 $sql = "CREATE TABLE `bsi_car_features` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `features_title` varchar(255) NOT NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
$wpdb->query($sql);
 $sql = "CREATE TABLE `bsi_car_master` (
					  `car_id` int(11) NOT NULL AUTO_INCREMENT,
					  `car_type_id` int(11) NOT NULL,
					  `car_vendor_id` int(11) NOT NULL,
					  `car_model` varchar(255) NOT NULL,
					  `car_img` varchar(255) NOT NULL,
					  `mileage` varchar(50) NOT NULL,
					  `fuel_type` varchar(255) NOT NULL,
					  `total_car` int(11) NOT NULL,
					  `status` tinyint(1) NOT NULL,
					  PRIMARY KEY (`car_id`)
					) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
$wpdb->query($sql);
 $sql = "CREATE TABLE `bsi_car_type` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `type_title` varchar(255) NOT NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
$wpdb->query($sql);
$sql = "CREATE TABLE `bsi_car_vendor` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `vendor_title` varchar(255) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
$wpdb->query($sql);
$sql = "CREATE TABLE `bsi_clients` (
					  `client_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
					  `first_name` varchar(64) DEFAULT NULL,
					  `surname` varchar(64) DEFAULT NULL,
					  `title` varchar(16) DEFAULT NULL,
					  `street_addr` text,
					  `city` varchar(64) DEFAULT NULL,
					  `province` varchar(128) DEFAULT NULL,
					  `zip` varchar(64) DEFAULT NULL,
					  `country` varchar(64) DEFAULT NULL,
					  `phone` varchar(64) DEFAULT NULL,
					  `fax` varchar(64) DEFAULT NULL,
					  `email` varchar(128) DEFAULT NULL,
					  `additional_comments` text,
					  `ip` varchar(32) DEFAULT NULL,
					  `existing_client` tinyint(1) NOT NULL DEFAULT '0',
					  PRIMARY KEY (`client_id`),
					  KEY `email` (`email`)
					) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
$wpdb->query($sql);
$sql ="CREATE TABLE `bsi_close_date` (
						  `closedt` varchar(50) NOT NULL
						) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
$wpdb->query($sql);
$sql = "CREATE TABLE `bsi_configure` (
					  `conf_id` int(11) NOT NULL AUTO_INCREMENT,
					  `conf_key` varchar(100) NOT NULL,
					  `conf_value` varchar(500) DEFAULT NULL,
					  PRIMARY KEY (`conf_id`)
					) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
$wpdb->query($sql);
$sql = "INSERT INTO `bsi_configure` (`conf_id`, `conf_key`, `conf_value`) VALUES
						(1, 'conf_portal_name', 'Car Rental System'),
						(2, 'conf_portal_streetaddr', '99 xxxxx Road'),
						(3, 'conf_portal_city', 'Your City'),
						(4, 'conf_portal_state', 'Your State'),
						(5, 'conf_portal_country', 'Your Country'),
						(6, 'conf_portal_zipcode', '1111112'),
						(7, 'conf_portal_phone', '999999999'),
						(8, 'conf_portal_fax', '222'),
						(9, 'conf_portal_email', 'info@bestsoftinc.com'),
						(13, 'conf_currency_symbol', '$'),
						(14, 'conf_currency_code', 'USD'),
						(20, 'conf_tax_amount', '10'),
						(21, 'conf_dateformat', 'dd/mm/yy'),
						(22, 'conf_booking_exptime', '500'),
						(24, 'conf_enabled_discount', '1'),
						(25, 'conf_enabled_deposit', '1'),
						(26, 'conf_portal_timezone', 'America/New_York'),
						(27, 'conf_booking_turn_off', '0'),
						(28, 'conf_min_night_booking', ''),
						(30, 'conf_notification_email', 'sales@bestsoftinc.com'),
						(38, 'conf_pickup_location', '147 West 83rd Street, New York'),
						(39, 'conf_dropoff_location', 'same location'),
						(40, 'conf_interval_between_rent', '01:59:59'),
						(41, 'conf_price_calculation_type', '3'),
						(42, 'conf_booking_start', '0'),
						(43, 'conf_tos_url', 'wp page url'),
						(44, 'conf_mesurment_unit', 'Km'),
						(45, 'conf_language', 'en.php');";
$wpdb->query($sql);
$sql = "CREATE TABLE `bsi_deposit_duration` (
						  `id` int(11) NOT NULL AUTO_INCREMENT,
						  `day_from` int(11) NOT NULL,
						  `day_to` int(11) NOT NULL,
						  `deposit_percent` decimal(10,2) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
$wpdb->query($sql);
$sql = "CREATE TABLE `bsi_discount_duration` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `day_from` int(11) NOT NULL,
					  `day_to` int(11) NOT NULL,
					  `discount_percent` decimal(10,2) NOT NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
$wpdb->query($sql);
$sql = "CREATE TABLE `bsi_email_contents` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `email_name` varchar(500) NOT NULL,
					  `email_subject` varchar(500) NOT NULL,
					  `email_text` longtext NOT NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
$wpdb->query($sql);
$sql = "INSERT INTO `bsi_email_contents` (`id`, `email_name`, `email_subject`, `email_text`) VALUES
					(1, 'Confirmation Email', 'Confirmation of your successfull booking for that car.', 'Text can be chnage in admin Panel.'),
					(2, 'Cancellation Email ', 'Cancellation Email subject.', 'Text Can be changed from admin panel');";
$wpdb->query($sql);
$sql = "CREATE TABLE `bsi_invoice` (
					  `booking_id` int(10) NOT NULL,
					  `client_name` varchar(500) NOT NULL,
					  `client_email` varchar(500) NOT NULL,
					  `invoice` longtext NOT NULL,
					  PRIMARY KEY (`booking_id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
$wpdb->query($sql);
$sql = "CREATE TABLE `bsi_payment_gateway` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `gateway_name` varchar(255) NOT NULL,
					  `gateway_code` varchar(50) NOT NULL,
					  `account` varchar(255) DEFAULT NULL,
					  `enabled` tinyint(1) NOT NULL DEFAULT '0',
					  `ord` int(11) NOT NULL DEFAULT '0',
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
$wpdb->query($sql);
$sql = "INSERT INTO `bsi_payment_gateway` (`id`, `gateway_name`, `gateway_code`, `account`, `enabled`, `ord`) VALUES
					(4, 'PayPal', 'pp', 'phpdev_1330251667_biz@aol.com', 1, 1),
					(7, ' Call : 1800 000 000 for Payment', 'poa', NULL, 1, 3);";
$wpdb->query($sql);
$sql = "CREATE TABLE `bsi_res_data` (
					  `booking_id` int(11) NOT NULL,
					  `car_id` int(11) NOT NULL
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
$wpdb->query($sql);
$sql = "CREATE TABLE `bsi_selected_features` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `car_id` int(11) NOT NULL,
					  `features_id` int(11) NOT NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
$wpdb->query($sql);
$sql = "CREATE TABLE `bsi_car_location` (
					  `car_id` int(11) NOT NULL,
					  `loc_id` int(11) NOT NULL,
					  `loc_type` int(11) NOT NULL
					) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
$wpdb->query($sql);
$sql = "CREATE TABLE `bsi_all_location` (
					  `loc_id` int(11) NOT NULL AUTO_INCREMENT,
					  `location_title` varchar(500) NOT NULL,
					  PRIMARY KEY (`loc_id`)
					) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
$wpdb->query($sql);
}
register_activation_hook(__FILE__,'jal_install');
register_deactivation_hook(__FILE__ , 'bsi_uninstall');
add_action( 'admin_menu', 'my_plugin_menu' );
add_action( 'admin_enqueue_scripts', 'admin_f' ); 
add_action( 'init', 'wp29r01_date_picker' );
function bsi_uninstall()
{
	global $wpdb;
	$sql = "DROP TABLE `bsi_all_location`, `bsi_bookings`, `bsi_car_extras`, `bsi_car_features`, `bsi_car_location`, `bsi_car_master`, `bsi_car_type`, `bsi_car_vendor`, `bsi_clients`, `bsi_close_date`, `bsi_configure`, `bsi_deposit_duration`, `bsi_discount_duration`, `bsi_email_contents`, `bsi_invoice`, `bsi_payment_gateway`, `bsi_res_data`, `bsi_selected_features`, `bsi_car_priceplan`;";
	$wpdb->query($sql);	
}
function admin_f()
{
	wp_enqueue_script( 'jquery-ui-datepicker', array('jquery','jquery-ui-core'));
	wp_enqueue_style('jquery-style', plugins_url().'/car/front/css/datepicker.css');
	wp_enqueue_style('custom-style7', plugins_url().'/car/css/style.css');
	wp_enqueue_style('custom-style8', plugins_url().'/car/css/jquery.validate.css');
	wp_enqueue_script( 'jquery-validate', plugins_url().'/car/js/jquery.validate.js');
	
	
}
function wp29r01_date_picker() {
	//echo $date; die;	
	
    wp_enqueue_script( 'jquery-ui-datepicker', array('jquery','jquery-ui-core'));
	wp_enqueue_style('jquery-style', plugins_url().'/car/front/css/datepicker.css'); 
	wp_enqueue_style('jquery-style2', plugins_url().'/car/front/css/style.css');
}
if ( !session_id() ){
add_action( 'init', 'session_start' );
}
add_shortcode("bsi_car","dis_front_func"); 
function dis_front_func()
{
	if(!isset($_REQUEST['btn_room_search']) && !isset($_REQUEST['btn_room_search2']) && !isset($_REQUEST['btn_room_search3']) && !isset($_REQUEST['registerButton4']) && !isset($_REQUEST['amount']))
	{
		$dir=ABSPATH."wp-content/plugins/car/front/index.php";
		include($dir);	
	}
	if(isset($_REQUEST['btn_room_search']))
	{
 
		$dir=ABSPATH."wp-content/plugins/car/front/search-result.php";
		include($dir);			
	}
 	if(isset($_REQUEST['btn_room_search2']))		
	{
		$dir=ABSPATH."wp-content/plugins/car/front/rental-options.php";
		include($dir);		
	}
	
	if(isset($_REQUEST['btn_room_search3']))
	{
		$dir=ABSPATH."wp-content/plugins/car/front/booking-details.php";
		include($dir);				
	}
	
	if(isset($_REQUEST['registerButton4']))
	{
		$dir=ABSPATH."wp-content/plugins/car/front/booking-process.php";
		include($dir);	
	}
	
	if(isset($_REQUEST['amount']))
	{
		$dir=ABSPATH."wp-content/plugins/car/front/paypal.php";
		include($dir);		
	}
	
}
function my_plugin_menu() {
	$icon_url= plugins_url().'/car/images/plugin.ico';
	add_menu_page("BSI CAR RENTAL SYSTEM", "Car Manager", "manage_options", "car-manager", 'car_list',$icon_url );
	add_submenu_page("car-manager", "Car List", "Car List", "manage_options", "car-list", 'car_list');
	add_submenu_page('Add Car', 'Add Car','Add Car', 'manage_options', 'add_car', 'Add_edit_car'); 
	add_submenu_page("car-manager", "Car Vendors", "Car Vendors", "manage_options", "car-vendor", 'car_vendor_list');
	add_submenu_page('Add Vendor', 'Add Vendor','Add Vendor', 'manage_options', 'add_vendor', 'Add_edit_vendor'); 
	add_submenu_page("car-manager", "Car Types", "Car Types", "manage_options", "car-type-list", 'car_types_list');
	add_submenu_page('Add Type', 'Add type', 'Add type','manage_options', 'add_car_type', 'Add_edit_Type'); 
	add_submenu_page("car-manager", "Car Features", "Car Features", "manage_options", "car-features-list", 'car_features_list');
	add_submenu_page('Add Feature', 'Add Feature','Add Feature', 'manage_options', 'add_car_feature', 'Add_edit_feature'); 
	add_submenu_page("car-manager","Location Manager","Location Manager","manage_options","car-location-list","car_location_list");
	add_submenu_page("Add Location","Add Location","Add Location","manage_options","add-edit-location","add_edit_location");
	remove_submenu_page('car-manager','car-manager');
	add_menu_page("BSI CAR RENTAL SYSTEM", "Price Manager", "manage_options", "price-manager", 'price_list',$icon_url);
	add_submenu_page("price-manager", "Price Calculation Setup", "Price Calculation Setup", "manage_options", "price-cal", 'price_list');
	add_submenu_page("price-manager","Car Price Plan","Car Price Plan","manage_options","price-plan","price_plan");
	add_submenu_page("Add Edit Price Plan","Add Edit Price Plan","Add Edit Price Plan","manage_options","add-edit-price-plan","add_edit_price_plan");
	add_submenu_page("price-manager", "Prepaid Amount Setting", "Prepaid Amount Setting", "manage_options", "preamount-list", 'preamount_list');
	add_submenu_page("Add Deposit","Add Deposit","Add Deposit","manage_options","add-deposit","add_deposit");
	add_submenu_page("price-manager","Discount Upon Duration","Discount Upon Duration","manage_options","car-discount","discount_list");
	add_submenu_page("Add Discount","Add Discount","Add Discount","manage_options","car-adddiscount","add_new_discount");
	add_submenu_page("price-manager","Car Extras","Car Extras","manage_options","car-extra","extra_list");
	add_submenu_page("Add Extra","Add Extra","Add Extra","manage_options","add-extra","add_extra");
	remove_submenu_page('price-manager','price-manager');
	add_menu_page("BSI CAR RENTAL SYSTEM", "Booking Manager", "manage_options", "booking-manager", 'booking_list',$icon_url);
	add_submenu_page("booking-manager","Booking List","Booking List","manage_options","booking-list","booking_list");
	add_submenu_page("View Active Or Archive","View Active Or Archive","View Active Or Archive","manage_options","view-booking","view_active_archive");
	add_submenu_page("booking-manager","Customer Lookup","Customer Lookup","manage_options","cust-lookup","cust_lookup");
	add_submenu_page("Customer Lookup Edit","Customer Lookup Edit","Customer Lookup Edit","manage_options","Customer-Lookup-Edit","Customer_Lookup_Edit");
	add_submenu_page("Add Cust booking","Add Cust booking","Add Cust booking","manage_options","cust-booking","cust_booking");
	add_submenu_page("view details","View Details","View Details","manage_options","View-Details","View_Details");
	add_submenu_page("Add Edit Booking","Add Edit Booking","Add Edit Booking","manage_options","customer-lookup","customer_lookup");
	add_submenu_page("booking-manager","Car Blocking","Car Blocking","manage_options","car-block-list","car_block_list");
	add_submenu_page("Car Block","Car Block","Car Block","manage_options","car-block","car_block");
	remove_submenu_page('booking-manager','booking-manager');
	add_menu_page("BSI CAR RENTAL SYSTEM", "Car Settings", "manage_options", "setting", 'global_list',$icon_url);
	add_submenu_page("setting","Global Setting","Global Setting","manage_options","global-list","global_list");
	add_submenu_page("setting","Payment Gateway","Payment Gateway","manage_options","gateway-list","gateway_list");
	add_submenu_page("setting","Email Contents","Email Contents","manage_options","email-list","email_list");
	add_submenu_page("setting","Close Day Setting","Close Day Setting","manage_options","closeday-list","closeday_list");
	remove_submenu_page('setting','setting');
}
function add_edit_price_plan()
{
	include('add_edit_priceplan.php');	
}
function price_plan()
{
	include('priceplan_list.php');	
}
function View_Details()
{
	include('viewdetails.php');	
}
function customer_lookup()
{
	include('customer-lookup.php');	
}

function Customer_Lookup_Edit()
{
	include('customerlookupEdit.php');	
}
function car_list(){
	include("car_list.php");
}
function Add_edit_car(){
	include("add_edit_car.php");
}
function car_vendor_list(){
	include("car-vendors.php");
}
function Add_edit_vendor(){
	include("add_edit_vendor.php");
}
function car_types_list(){
	include("car-types.php");
}
function Add_edit_Type(){
	include("add_edit_type.php");
}
function car_features_list(){
	include("car-features.php");
}
function Add_edit_feature(){
	include("add_edit_feature.php");
}
function car_location_list(){
	include("location_list.php");
}
function add_edit_location(){
	include("location_add_edit.php");
}
function price_list(){
	include("price-calculation.php");
}
function preamount_list(){
	include("deposit-duration.php");
}
function add_deposit(){
	include("add_edit_deposit_duration.php");
}
function discount_list(){
	include("discount-duration.php");
}
function add_new_discount(){
	include("add_edit_discount_duration.php");
}
function extra_list(){
	include("car-extras.php");
}
function add_extra(){
	include("add_edit_extras.php");
}
function booking_list(){
	include("booking-list.php");
}
function view_active_archive(){
	include("view_active_or_archieve_bookings.php");
}
function cust_lookup(){
	include("customer-lookup.php");
}
function cust_booking(){
	include("customerbooking.php");
}
function car_block_list(){
	include("car-blocking.php");
}
function car_block(){
	include("block_car.php");
}
function global_list(){
	include("global-setting.php");
}
function gateway_list(){
	include("payment-gateway.php");
}
function email_list(){
	include("email-contents.php");
}
function closeday_list(){
	include("close_day.php");
}
function adminmenu_list(){
	include("adminmenu.list.php");
}
//************************************************** front functions end******************************************************
?>
