<section class="content"> 
<div class="row">
	<div class="col-md-12">

<?php 
if(isset($_SESSION["client_id"])):?>
		<h1><i class='glyphicon glyphicon-shopping-cart'></i> Mis Compras</h1>
<?php else:?>
<div class="btn-group pull-right">
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-download"></i> Descargar <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" role="menu">
  	    <?php if(Core::$user->kind==1):?>
    <li><a href="report/sells-word.php">Word 2007 (.docx)</a></li>
    <li><a href="report/sells-xlsx.php">Excel 2007 (.xlsx)</a></li>
<?php endif; ?>
<li><a onclick="thePDF()" id="makepdf" class="">PDF (.pdf)</a></li>
  </ul>
</div>
		<h1><i class='glyphicon glyphicon-shopping-cart'></i> Ventas</h1>
<?php endif;?>
		<div class="clearfix"></div>

<form autocomplete="off" id="filtersells">
	<input type="hidden" name="view" value="sells">
<div class="row">
	<div class="col-md-2">
		<label>Almacen</label>
		<select name="stock_id" class="form-control">
			<option value="">-- ALMACEN--</option>
			<?php foreach(StockData::getAll() as $stock):?>
				<option value="<?php echo $stock->id; ?>"><?php echo $stock->name; ?></option>
			<?php endforeach; ?>
		</select>
	</div>

	<div class="col-md-2">
		<label>Fecha inicio</label>
		<input type="date" name="start_at" value="<?php echo date('d-m-Y'); ?>" required class="form-control" >
	</div>
	<div class="col-md-2">
		<label>Fecha fin</label>
		<input type="date" name="finish_at" value="<?php echo date('d-m-Y'); ?>"  required class="form-control">
	</div>
	<div class="col-md-2">
		<label>Aplicar Filtro</label><br>
		<input type="submit" value="Aplicar Filtro" class="btn btn-primary">
	</div>

</div>
</form>


<div class="allfiltersells">
</div>


<script type="text/javascript">
	function formattedDate(d = new Date) {
	  let month = String(d.getMonth() + 1);
	  let day = String(d.getDate());
	  const year = String(d.getFullYear());
	  

	  if (month.length < 2) month = '0' + month;
	  if (day.length < 2) day = '0' + day;
	  return `${day}/${month}/${year}`;
	}

	$(document).ready(function(){
		$.get("./?action=filtersells",$("#filtersells").serialize(),function(data){
			$(".allfiltersells").html(data);
		});

		$("#filtersells").submit(function(e){
			e.preventDefault();
		$.get("./?action=filtersells",$("#filtersells").serialize(),function(data){
			$(".allfiltersells").html(data);
		});

		})
	});
</script>
	</div>
</div>
</section>
<script>
function obtenerFecha(e)
{

  var fecha = moment(e.value);
  console.log("Fecha original:" + e.value);
  console.log("Fecha formateada es: " + fecha.format("DD/MM/YYYY"));
}
</script>