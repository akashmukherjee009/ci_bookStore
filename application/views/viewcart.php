<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Book Store</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<div class="container">
	<div class="row"><div class="col-md-12"><?php echo $this->cart->format_number($this->cart->total()); ?> (<?php echo $this->cart->format_number($this->cart->total_items()); ?>)  | <a href="<?php echo base_url(); ?>index.php/book/viewcart" target="_blank">View Cart</a></div></div>
	<table class="table">

<tr>
        <th>QTY</th>
        <th>Item Description</th>
        <th style="text-align:right">Item Price</th>
        <th style="text-align:right">Sub-Total</th>
</tr>

<?php $i = 1; ?>

<?php foreach ($this->cart->contents() as $items): ?>

   
        <input type="hidden" name="rowid[]" id="rowid_<?php echo $i; ?>" value="<?php echo $items['rowid']; ?>" />
        <tr>
                <td><?php //echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?>
				<input type="text" class="form-control" name="qty[]" id="qty_<?php echo $i; ?>" value="<?php echo $items['qty']; ?>" /> <button class="btn btn-warning" onclick="updateCart('<?php echo $items['rowid']; ?>',<?php echo $i; ?>)">Update Cart</button> <button class="btn btn-danger"  onclick="removeCart('<?php echo $items['rowid']; ?>',<?php echo $i; ?>)">Remove Cart</button></td>
                <td>
                        <?php echo $items['name']; ?>

                        <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

                                <p>
                                        <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

                                                <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

                                        <?php endforeach; ?>
                                </p>

                        <?php endif; ?>

                </td>
                <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
                <td style="text-align:right">$<?php echo $this->cart->format_number($items['subtotal']); ?></td>
        </tr>

<?php $i++; ?>

<?php endforeach; ?>

<tr>
        <td colspan="2"> </td>
        <td class="right"><strong>Total</strong></td>
        <td class="right">$<?php echo $this->cart->format_number($this->cart->total()); ?></td>
</tr>

</table>

	
	</div>
	</body>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script>
		function addToMyCart(itemId){
			document.location.href="<?php echo base_url('/index.php/book/addtocart/'); ?>"+itemId;
		}
		function updateCart(rowid,pos){
		var qty  = document.getElementById('qty_'+pos).value;
		document.location.href="<?php echo base_url(); ?>index.php/book/updatecart/"+rowid+"/"+qty
		}
		function removeCart(rowid,pos){
			document.location.href="<?php echo base_url(); ?>index.php/book/clearcart/"+rowid
		}
	</script>
</html>
