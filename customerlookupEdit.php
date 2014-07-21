<?php 
if(isset($_POST['act'])){
	include("includes/admin.class.php");
	$bsiAdminMain->updateCustomerLookup();
	header("location:admin.php?page=cust-lookup"); 
	exit;
}

$update=mysql_real_escape_string($_GET['update']);
if(isset($update)){
	include("includes/conf.class.php");
	include("includes/admin.class.php");
	$row   = $bsiAdminMain->getCustomerLookup($update);
	$title = $bsiAdminMain->getTitle($row['title']);
}else{
	header("location:admin.php?page=cust-lookup");
}
 ?>

  <form action="<?php echo admin_url('admin.php?page=Customer-Lookup-Edit&noheader=true'); ?>" method="post" id="form1">
    <table cellpadding="5" cellspacing="2" border="0">
      <tr>
        <td><strong>Title:</strong></td>
        <td><?php echo $title;?></td>
      </tr>
      <tr>
        <td align="left"><strong>First Name:</strong></td>
        <td><input type="text" class="required" value="<?php echo $row['first_name'];?>" style="width:200px;" name="fname" id="fname"/></td>
      </tr>
      <tr>
        <td align="left"><strong>Last Name:</strong></td>
        <td><input type="text" class="required" value="<?php echo $row['surname'];?>" style="width:200px;" name="sname" id="sname"/></td>
      </tr>
      <tr>
        <td align="left"><strong>Street Address:</strong></td>
        <td><input type="text" class="required" value="<?php echo $row['street_addr'];?>" style="width:250px;" name="sadd" id="sadd"/></td>
      </tr>
      <tr>
        <td align="left"><strong>City:</strong></td>
        <td><input type="text" class="required" value="<?php echo $row['city'];?>"  name="city" id="city"/></td>
      </tr>
      <tr>
        <td align="left"><strong>Province:</strong></td>
        <td><input type="text" class="required" value="<?php echo $row['province'];?>"  name="province" id="province"/></td>
      </tr>
      <tr>
        <td align="left"><strong>Zip / Post code:</strong></td>
        <td><input type="text" class="required" value="<?php echo $row['zip'];?>"  name="zip" id="zip"/></td>
      </tr>
      <tr>
        <td align="left"><strong>Country:</strong></td>
        <td><input type="text" class="required" value="<?php echo $row['country'];?>"  name="country" id="country"/></td>
      </tr>
      <tr>
        <td align="left"><strong>Phone Number:</strong></td>
        <td><input type="text" class="required" value="<?php echo $row['phone'];?>"  name="phone" id="phone"/></td>
      </tr>
      <tr>
        <td align="left"><strong>Fax:</strong></td>
        <td><input type="text" value="<?php echo $row['fax'];?>"  name="fax" id="fax"/></td>
      </tr>
      <tr>
        <td align="left"><strong>Email Id:</strong></td>
        <td><input type="text" value="<?php echo $row['email'];?>"  name="email" id="email" style="width:250px;" readonly/>
          <input type="hidden" name="httpreffer" value="<?php echo $_SERVER['HTTP_REFERER'];?>" /></td>
      </tr>
      <input type="hidden" name="cid" value="<?php echo $row['client_id'];?>">
      <input type="hidden" name="act" value="1">
      <tr>
        <td  width="100px"></td>
        <td align="left"><input type="submit" value="Submit"  style="cursor:pointer; cursor:hand;"/></td>
      </tr> 
    </table>
  </form>
</div>
<script type="text/javascript">
	jQuery().ready(function() {
		jQuery("#form1").validate();
		
     });
         
</script> 

