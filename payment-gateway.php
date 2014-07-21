<?php 
include("includes/conf.class.php");
include("includes/admin.class.php");
if(isset($_POST['act_sbmt'])){		
		$bsiAdminMain->payment_gateway_post();
		header("location:admin.php?page=gateway-list");
}
$payment_gateway_val = $bsiAdminMain->payment_gateway();
?>
<p>&nbsp;</p>
<div id="container-inside" style="width:1000px;"> <span style="font-size:16px; font-weight:bold">Payment Gateway Setting</span>
  <hr />
  <form action="<?php echo admin_url('admin.php?page=gateway-list&noheader=true');?>" method="post" id="form1">
    <table cellpadding="5" cellspacing="2" border="0">
      <thead>
        <tr>
          <th align="left">Enabled</th>
          <th align="left">Gateway</th>
          <th align="left">Title</th>
          <th align="left">Account Info</th>
        </tr>
        <tr>
          <th colspan="4"><hr /></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><input type="checkbox" value="pp" name="pp"  id="pp" <?php echo ($payment_gateway_val['pp_enabled']) ? 'checked="checked"' : ''; ?> /></td>
          <td><strong>PayPal:</strong></td>
          <td><input type="text" name="pp_title" id="pp_title" value="<?php echo $payment_gateway_val['pp_gateway_name'];?>" size="30" class="required"/></td>
          <td><input type="text" name="paypal_id" id="paypal_id" class="required email" value="<?php echo $payment_gateway_val['pp_account'];?>" size="40"/>
            (enter your PayPal Email.)</td>
        </tr>
        <tr>
          <td><input type="checkbox" value="poa" name="poa" id="poa" <?php echo ($payment_gateway_val['poa_enabled']) ? 'checked="checked"' : ''; ?> /></td>
          <td><strong>Manual:</strong></td>
          <td><input type="text"  name="poa_title" id="poa_title" value="<?php echo $payment_gateway_val['poa_gateway_name'];?>" class="required" size="30"/></td>
          <td></td>
        </tr>
        <tr>
          <td colspan="2"></td>
          <td colspan="2"><input type="hidden" name="act_sbmt" value="1" />
            <input type="submit" value="Update" style="background:#e5f9bb; cursor:pointer; cursor:hand;"/></td>
        </tr>
      </tbody>
    </table>
  </form>
</div>
<script type="text/javascript">
	jQuery().ready(function() {
		jQuery("#form1").validate();
		
     });
         
</script>
