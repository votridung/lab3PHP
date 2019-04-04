<?php

	$hostname = "localhost";
	$username = "root";
	$password = "123456";
	$databasename = "ecommerce";

	$connect =  mysqli_connect($hostname, $username, $password, $databasename);
	$query = 'SELECT * FROM `category`';

	$result = mysqli_query($connect, $query);

	require_once("/Entities/product.class.php");
	require_once("/Entities/category.class.php");

	if(isset($_POST["btnsubmit"])){
		$productName = $_POST["txtName"];
		$cateID = $_POST["txtCateID"];
		$price = $_POST["txtPrice"];
		$quantity = $_POST["txtquantity"];
		$description = $_POST["txtdesc"];
		$picture = $_FILES["txtPic"];

		$newProduct = new Product($productName, $cateID, $price, $quantity, $description, $picture);

		$result = $newProduct->save();

		// if(!$result){
		// 	header("Location: add_product.php?failure");
		// }else{
		// 	header("Location: add_product.php?inserted");
		// }

	}

?>

<?php include_once("header.php"); ?>

<?php

	if(isset($_GET["inserted"])){
		echo "<h2>Them san pham thanh cong</h2>";
	}

?>

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	<div class="form-group">
		<div class="lbltitle">
			<label class="control-label col-sm-2">Ten San Pham</label>
		</div>
		<div class="lblinput">
			<input class="col-sm-6" type="text" name="txtName" value="<?php echo isset($_POST['txtName']) ? $_POST['txtName'] : "" ?>" />
		</div>
	</div>

	<div class="form-group">
		<div class="lbltitle">
			<label class="control-label col-sm-2" style="float: top; margin-top: -200px">Mo Ta San Pham</label>
		</div>
		<div class="lblinput">
			<textarea class="col-sm-6" id="comment" name="txtdesc" cols="5" rows="5" value="<?php echo isset($_POST['txtdesc']) ? $_POST['txtdesc'] : "" ?>"></textarea>
		</div>
	</div>

	<div class="form-group">
		<div class="lbltitle">
			<label class="control-label col-sm-2">So Luong San Pham</label>
		</div>
		<div class="lblinput">
			 <input class="col-sm-6" type="text" name="txtquantity" value="<?php echo isset($_POST['txtquantity']) ? $_POST['txtquantity'] : "" ?>" />
		</div>
	</div>

	<div class="form-group">
		<div class="lbltitle">
			<label class="control-label col-sm-2">Gia San Pham</label>
		</div>
		<div class="lblinput">
			 <input lass="col-sm-6" type="text" name="txtPrice" value="<?php echo isset($_POST['txtPrice']) ? $_POST['txtPrice'] : "" ?>" />
		</div>
	</div>

	<div class="form-group">
		<div class="lbltitle">
			<label class="control-label col-sm-2">Loai San Pham</label>
		</div>
		<div class="lblinput" style="width: 10%">
			 <select name="txtCateID" class="col-sm-6">
			 	<?php while($rows = mysqli_fetch_array($result)):;?>
			 		<option value="<?php echo $rows[0];?>"><?php echo $rows[1];?></option>
			 	<?php endwhile;?>
			 </select>
		</div>
	</div>

	<div class="form-group">
		<div class="lbltitle">
			<label class="control-label col-sm-2">Hinh San Pham</label>
		</div>
		<div class="lblinput">
			 <input class="col-sm-6" type="file" name="txtPic" accept=".PNG,.GIF,.JPG" />


		</div>
	</div>

	<div class="form-group" style="margin-top: 40px;">
		<div class="submit">
			<input class="btn btn-primary buttonAddproduct" style="display: block; margin:20px 0 0 500px;" type="submit" name="btnsubmit" value="Them san pham">
		</div>
	</div>
		<?php require_once("footer.php"); ?>
</form>
