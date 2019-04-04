<?php

	require_once("/Entities/product.class.php");
	require_once("/Entities/category.class.php");
?>

<?php

	require_once("header.php");
	if (!isset($_GET["cateid"])) {
		// code...
			$prods = Product::list_product();
	}else {

		$cateid =$_GET["cateid"];
		$prods = Product::list_product_by_cateid($cateid);

	}
	$cates = Category::list_category();

?>

<div class="container text-center">
	<div class="col-sm-12">
		<div class="row">

		<div class="col-sm-3 panel panel-heading">
		<h3>Danh Muc SP</h3>
		<ul class="list-group">
			<?php
				foreach ($cates as $item) {
					// code...
					echo "<li class='list-group-item'><a href=/LAB3/list_product.php?cateid=",$item["CateID"].">".$item["CategoryName"]."</a></li>";
				}
			 ?>
		</ul>
		</div>
	<div class="col-sm-9">

		<h3>Sản phẩm cửa hàng</h3><br>
		<div class="row">
			<?php
				foreach ($prods as $item) {
					?>
					<div class="col-sm-4">
						<img src="<?php echo "/LAB3/".$item["Picture"];?>" class="img-responsive" style="width: 100%" alt="Image" />
						<a href="/LAB3/product_detail.php?id= <?php echo $item["ProductID"]; ?>"><p class="text-danger"><?php echo $item["ProductName"]; ?></p></a>
						<p class="text-info"><?php echo $item["Price"]; ?></p>
						<p>
                <button type="button" class="btn btn-primary" onclick="location.href='/LAB3/shopping_cart.php?id=<?php echo $item["ProductID"]; ?>'" >Mua hàng</button>
            </p>
					</div>
				<?php } ?>
			</div>
	</div>
	</div>
	</div>
	<?php require_once("footer.php"); ?>
</div>
