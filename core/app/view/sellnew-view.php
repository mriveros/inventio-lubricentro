<section class="content">
  <div class="row">
  <div class="col-md-3">
  <h1>Venta</h1>
</div>
<div class="col-md-9">
<br>
<!-- -->
  <form autocomplete="off" id="searchp">
    <div class="row">
      <div class="col-md-3">
        <input type="hidden" name="view" value="sell">
        <input type="text" id="product_name" name="product_name" class="form-control" placeholder="Nombre del Producto">
      </div>

      <div class="col-md-3">
        <input type="hidden" name="view" value="sell">
        <input type="text" id="product_code" name="product_code" class="form-control" placeholder="Codigo de Barra">
      </div>

      <div class="col-md-3">
   <select name="category_id" id="category_id" class="form-control">
    <option value="">-- SIN CATEGORIA --</option>
    <?php foreach(CategoryData::getAll() as $category):?>
      <option value="<?php echo $category->id;?>"><?php echo $category->name;?></option>
    <?php endforeach;?>
      </select> 
      </div>

      <div class="col-md-1">
      <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Buscar</button>
      </div>
      <div class="col-md-1">
      </div>

    </div>
    </form>
<!-- -->

</div>

</div>
  <div class="row">
    <div class="col-md-3">
      <div id="cartofsell"></div>

    </div>
    <div class="col-md-9">




<div id="show_search_results"></div>

    </div>
  </div>
</section>



<script>
//jQuery.noConflict();

$(document).ready(function(){
  $("#searchp").on("submit",function(e){
    e.preventDefault();

    code = $("#product_code").val();
    name = $("#product_name").val();
    if(name!=""){
    $.get("./?action=searchproductnew",$("#searchp").serialize()+"&go=name",function(data){
      $("#show_search_results").html(data);
      console.log(data);
    });
    $("#product_name").val("");
    $("#category_id").val("");
    }
    else if(code!=""){
    $.get("./?action=searchproductnew",$("#searchp").serialize()+"&go=code",function(data){
      $("#show_search_results").html(data);
    });
    $("#product_code").val("");
    $("#category_id").val("");
    }else {
      $("#show_search_results").html("");
    }

  });
  });

$(document).ready(function(){
    $("#product_code").keydown(function(e){
        if(e.which==17 || e.which==74){
            e.preventDefault();
        }else{
            console.log(e.which);
        }
    })
});
</script>
<script>
$(document).ready(function(){
$.get("./?action=cartofsellnew",null,function(data){
$("#cartofsell").html(data);
});
});
</script>