<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
		text-decoration: none;
	}

	a:hover {
		color: #97310e;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
		min-height: 96px;
	}

	p {
		margin: 0 0 10px;
		padding:0;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>
<?php echo $this->session->flashdata('message'); ?>
<?php echo isset($session['name'])?'Hello '.$session['name']:''; ?> | <a href="http://localhost/ci-project/index.php/user/logout/">Logout</a>
<form name="book_frm" id="book_frm" method="post" enctype="multipart/form-data" action="http://localhost/ci-project/index.php/book/<?php echo isset($dataset->id)?'update':'insert'; ?>">
	<input type="hidden" id="<?php echo $this->security->get_csrf_token_name();?>" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">   
	<input type="hidden" name="todo" id="todo" value="save" />
	<input type="hidden" name="id" id="id" value="<?php echo isset($dataset->id)?$dataset->id:''; ?>" />
	<label>Book Name</lable>
	<input type="text" name="book_name" id="book_name" value="<?php echo isset($dataset->book_name)?$dataset->book_name:''; ?>" />
	<label>Book Price</lable>
	<input type="text" name="book_price" id="book_price" value="<?php echo isset($dataset->book_price)?$dataset->book_price:''; ?>" />
	<label>Book Publish Date</lable>
	<input type="date" name="book_pd" id="book_pd" value="<?php echo isset($dataset->book_pd)?$dataset->book_pd:''; ?>" />
	<label>Book Cover Photo</lable>
	<input type="file" name="book_pic[]" id="book_pic" />
	<button type="submit" name="book_save" id="book_save">Save</button>
</form>


<!-- <table width="100%">
	<thead>
		<tr>
			<th align="left" width="25%">Book Name</th>
			<th align="left" width="25%">Book Price</th>
			<th align="left" width="25%">Book Publish Date</th>
			<th align="left" width="25%">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
			// if($dataset){
			// 	foreach($dataset as $row){
		?>
		<tr>
			<td align="left" ><?php //echo $row->book_name; ?></td>
			<td align="left" ><?php //echo $row->book_price; ?></td>
			<td align="left" ><?php //echo $row->book_pd; ?></td>
			<td align="left" ><a href="http://localhost/ci-project/index.php/book/bookdetails/<?php //echo $row->id; ?>">Edit</a> | Delete</td>
        </tr>
		<?php //}
			//}
			?>
	</thead>
</table> -->

</body>
</html>
