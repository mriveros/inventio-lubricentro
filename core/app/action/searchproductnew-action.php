
<?php
$currency = ConfigurationData::getByPreffix("currency")->val;
//print_r($_GET);
?>
<?php if((isset($_GET["product_name"]) && $_GET["product_name"]!="") ):?>
<?php
$go = $_GET["go"];
$search  ="";
if($go=="code"){ $search=$_GET["product_code"]; 


}
else if($go=="name"){ $search=$_GET["product_name"]; }

$category = "";
if(isset($_GET["category_id"]) and $_GET["category_id"]!=""){
	$category = $_GET["category_id"];
}

$products = array();
if($category==""){
$products = ProductData::getLike($search);
}else{
$products = ProductData::getLikeCat($search,$category);

}

if(count($products)>0){
	?>


	<!---------------------------------------------------------->
<?php

$nproducts = count($products);
//print_r($products);
$filas = $nproducts/10;
$extra = $nproducts%10;
if($filas>1&& $extra>0){ $filas++; }
$n=0;
?>
<?php if(count($products)>0):?>

<?php for($i=0;$i<$filas;$i++):?>
  <div class="row">
<?php for($j=0;$j<10;$j++):
$p=null;
if($n<$nproducts){
$p = $products[$n];
}
?>
<?php if($p!=null):
	$q= OperationData::getQByStock($p->id,StockData::getPrincipal()->id);

$img = "admin/storage/products/".$p->image;
if($p->image==""){ $img = "res/default.png"; }
?>
  <div class="col-xs-1-10">

  	<div class="item">
  		<a href="#">
  			<?php if($p->kind==1):?>
			<span class="notify-badge"><?php echo $q; ?></span>
		<?php endif; ?>
      		<img src="<?php echo $img; ?>"  class="img-responsive">
		</a>
	</div>


  <h4 class="text-center"><?php echo $p->name; ?></h4>
<form autocomplete="off" method="post" action="index.php?view=addtocart" id="addtocart<?php echo $p->id;?>">
			<select class="form-control" name="price" required>
				<option value="<?php echo $p->price_out; ?>">Gs. <?php echo $p->price_out; ?></option>
				<option value="<?php echo $p->price_out2; ?>">Gs. <?php echo $p->price_out2; ?></option>
				<option value="<?php echo $p->price_out3; ?>">Gs. <?php echo $p->price_out3; ?></option>
			</select>
		<input type="hidden" name="p_id" value="<?php echo $p->id; ?>">
		<input type="hidden" name="product_id" value="<?php echo $p->id; ?>">

		<input type="" class="form-control" value="1" required id="sell_q<?php echo $p->id;?>" name="q" placeholder="Cantidad ...">
		<input type="hidden" class="form-control"  required id="sell_discount_<?php echo $p->id;?>" value="0" name="discount" placeholder="$ Descuento ...">
		<button type="submit" class="btn btn-primary btn-block"><i class="glyphicon glyphicon-plus-sign"></i> Agregar</button>



		</form>
		<script>
		$("#addtocart<?php echo $p->id;?>").on("submit",function(e){
		e.preventDefault();
			$.post("./?view=addtocart",$("#addtocart<?php echo $p->id;?>").serialize(),function(data){
				dx = null;
				$.get("./?action=cartofsellnew",null,function(data2){
					$("#cartofsell").html(data2);
					dx = data2;
				});
					$("#cartofsell").html(dx);

			});
		$("#sell_q<?php echo $p->id;?>").val("1");

	});
</script>
<?php 
$in_cart=false;
if(isset($_SESSION["cart"])){
  foreach ($_SESSION["cart"] as $pc) {
    if($pc["product_id"]==$p->id){ $in_cart=true;  }
  }
  }

  ?>
  <?php endif; ?>  </div>

<?php $n++; endfor; ?>
  </div>
<?php endfor; ?>
<?php endif; ?>
	<!---------------------------------------------------------->


	<?php
}else{
	echo "<br><p class='alert alert-danger'>No se encontro el producto</p>";
}
?>
<script>

</script>
<?php elseif( (isset($_GET["product_code"]) && $_GET["product_code"]!="")):
	$product = ProductData::getByBarcode($_GET["product_code"]);

?>
<?php if($product!=null):?>
<script>
	//	e.preventDefault();
			$.post("./?view=addtocart","product_id=<?php echo $product->id; ?>&q=1&discount=0&price=<?php echo $product->price_out; ?>",function(data){
				/* dx = null;
				$.get("./?action=cartofsellnew",null,function(data2){
					$("#cartofsellnew").html(data2);
					dx = data2;
				});
					$("#cartofsellnew").html(dx);
					*/
//console.log(data);
window.location = window.location.href;
			});
		//$("#sell_q<?php echo $product->id;?>").val("");

</script>
<?PHP endif; ?>
<?php else:
?>

<?php endif; ?>
