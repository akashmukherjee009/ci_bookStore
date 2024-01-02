<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>


	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container">
	<a href="<?php echo base_url('/book/insert'); ?>">ADD NEW</a>
	<table class="table" width="100%">
		<thead>
			<tr>
				<th align="left" width="25%">Book Picture</th>
				<th align="left" width="25%">Book Name</th>
				<th align="left" width="25%"><a href="http://localhost/ci-project/index.php/book/index/book_price/<?php echo $orderby; ?>">Book Price</a></th>
				<th align="left" width="25%">Book Publish Date</th>
				<th align="left" width="25%">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
				if($dataset){
					foreach($dataset as $row){
			?>
			<tr>
				<td align="left" ><img src="<?php echo base_url().'/upload/'.$row->book_pic; ?>"  alt="<?php echo $row->book_name; ?>" width="100" /></td>
				<td align="left" ><?php echo $row->book_name; ?></td>
				<td align="left" ><?php echo $row->book_price; ?></td>
				<td align="left" ><?php echo date_setup($row->book_pd); ?></td>
				<td align="left" ><a href="http://localhost/ci-project/index.php/book/update/<?php echo $row->id; ?>">Edit</a> |<a href="http://localhost/ci-project/index.php/book/delete/<?php echo $row->id; ?>">Delete</a> </td>
			</tr>
			<?php }
				}
				?>
		</thead>
	</table>
			</div>
	</body>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
