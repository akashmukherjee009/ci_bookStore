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
		<div class="row">
			<div class="col-md-3">
				<ul>
				<?php if($categories){ 
					foreach($categories as $cate){ ?>
						<li><a href="<?php echo base_url('/index.php/category/'); ?><?php echo $cate->id; ?>/<?php echo $cate->category_name_slug; ?>"><?php echo $cate->category_name; ?></a></li>
					<?php } 
					} ?>
					<li><a href="<?php echo base_url('/index.php/book/store/'); ?>">All Categories</a></li>
				</ul>
			</div>
			<div class="col-md-9">
				<div class="row">
				<?php if($books){ 
					foreach($books as $book){ ?>
						<div class="col-md-6">
							<a href="<?php echo base_url('/index.php/showbook/'); ?><?php echo $book->id; ?>/<?php echo $book->book_slug; ?>"><img src="<?php echo base_url().'/upload/'.$book->book_pic; ?>"  alt="<?php echo $book->book_name; ?>" width="50%" /><h5><?php echo $book->book_name; ?></h5><h6>Rs.<?php echo $book->book_price; ?></h6></a>
							<button class="btn btn-success" onclick="addToMyCart(<?php echo $book->id; ?>);">Add to Cart</button>
						</div>
					<?php } 
					} ?>
				</div>
			</div>
		</div>
	
	</div>
	</body>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script>
		function addToMyCart(itemId){
			document.location.href="<?php echo base_url('/index.php/book/addtocart/'); ?>"+itemId;
		}
	</script>
</html>
