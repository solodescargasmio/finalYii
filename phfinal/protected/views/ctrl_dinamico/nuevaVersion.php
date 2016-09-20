     
            <script>
             
$(document).ready(function(){
  
    $('#miform').hide();
  	$("#mostrar").on( "click", function() {
                    dat=document.getElementById("nom_formulario").value;
    if(dat==""){
        alert("Seleccione un formulario de la tabla. Gracias");
        }else {
			$('#miform').show(); //muestro mediante id 
                        $('#formversion').hide(); //oculto mediante id 
     
		} });
		$("#ocultar").on( "click", function() {
                         $('#miform').hide();
                          $('#formversion').show(); //muestro mediante id 
		});
                
                
  });

   function vacio(e){
       ok=true;
       patron =/\w/;
       k=e.which;
       if (k==8 || k==0) return true;
       n = String.fromCharCode(k);
return patron.test(n);
 /*if((k < 97 || k > 122) && (k < 65 || k > 90) && (k !== 16||k !== 8||k !== 242)){
       alert("No agrege espacios en blanco ni caracteres raros \n si quiere escribir varias palabras unalas con guión bajo '_'");
ok=false; 
        }
return ok;*/
    } 

   
function agregar(valor1){
   	            var $fieldset = $('<fieldset>');    
    var $form = $("#my-dynamic-form");
        $fieldset.appendTo($form);
 var elem=valor1.split(',');
  $dato=elem[0];
  $id_att=elem[1];
  $dato1=elem[2];
  if($dato!="realizado_por"){
   	 da=recorrerDom($dato);
       if(da==0){ //si son distintos lo agrego
           gu="guardo";
           $("#my-dynamic-form input").remove("#"+gu+""); 
        $(' <div class="form-group" id="'+$dato +'" style="border-width: 10px; background:#C8C0C0;width:40%;">'+
                 '<label  class="col-sm-8 control-label">'+ capitalize($dato) +'</label>'+
    '<div class="col-lg-10">'+
    '<input type="text" id="'+$dato+'" name="'+$dato+'" value="'+$dato+'" hidden>'+
    '<input type="text" id="'+$id_att+'" name="'+$id_att+'" value="'+$id_att+'" hidden>'+
    '<input type="button" id="'+$dato+'" value="X" style="color: red;" name="eliminar" ident="'+$dato+'" onclick="eliminarElementoDom('+$id_att+')">Obligatorio<input type="checkbox" id="'+ $id_att +'" name="'+ $id_att +'"></div></div>').appendTo($fieldset);  
            $(' <div class="form-group">'+
    '<div class="col-lg-10">').appendTo($fieldset);
    $('<input type="submit" value="Guardar Formulario" ident="guardo" id="guardo" class="btn btn-primary btn-group-justified">').appendTo($fieldset);
      $('</div></div>').appendTo($fieldset);    
    $fieldset.appendTo($form);
        } //fin if(da==0)
    else{ //si son iguales mando el alert e impido que un boludo ingrese dos veces el mismo atributo
        alert('El atributo que intenta agregar, ya existe en el formulario.');
    }
        $("html, body").animate({scrollTop: 0}, 1000);
         }else{
          alert("Este atributo es agregado de forma automatica por el sistema.\n No es necesario agregar.");
        }                
}
        </script>
<script>
$(function(){
    $('.version1').click( function(){
            var $dato1= $(".formular",this).val(); //obtengo el nombre del formulario

        document.getElementById("nom_formulario").value=$dato1; 
     nomb_form=$dato1; //
      datatypo='formulario='+nomb_form;
         $.ajax({
         url:'index.php?r=ctrl_dinamico/cargarAttversion',//llamo a la pagina q hace el control
         type:'POST',//metodo por el cual paso el dato
         data:datatypo,
             success: function (data) { //funcion q recoge la respuesta de la pagina q hace el control
                  $("#poner").fadeIn(1000).html(data); //imprimo el mensaje en el div      
                
    }
     });
    });
    });
 function recorrerDom(valor) { 
 	
    va=0;
    //recorro todos los label y si alguno tiene el mismo texto no le permito ingresar el atributo
        $("#my-dynamic-form label").each(function (idx, el){
  //$(el).html() aca obtengo el texto en los labels que estan en mayuscula
  //capitalize(valor) convierto a mayuscula el nombre del atributo q quiero ingresar
         if($(el).html()==capitalize(valor)){  
         va=1;    
         }
     });
    return va;
    }
function eliminarElementoDom(id_att) {
	
 $("input[type='button']").on('click',function(){
     dat=$(this).attr('ident');

        $("#my-dynamic-form input").each(function (idx, el){
     if($(el).attr('name')==dat){
         va=$(el).attr('name');
         $("#my-dynamic-form input").remove("#"+va+"");
        $("#my-dynamic-form div").remove("#"+va+""); 
        $("#my-dynamic-form input").remove("#"+id_att+"");
     };
     });
// 
    }
            
     )};

 function validarFormulario(){
     var con=0;
     var ok=false;
        $("#my-dynamic-form input").each(function (idx, el){
   con++;
     });
    if(con>2){
        ok=true;
    }else{
        alert('Debe agregar al menos un atributo al formulario.\n Si no sabe como hacerlo, lea el manual de usuario');
        ok=false;
    }
     return ok;
 }
//function ver_data_estado() 
//{ 
//alert("boton presionado | ID: "+$(this).attr('ident')); 
//} 
function capitalize(s)//convierte minusculas a Mayusculas
{
    return s.toUpperCase();
}
  
        </script>     


    <div class="container-fluid">
          <div id="menus">
                <a href="#" onclick="mostrarDiv()"> <button id="mostrar"  class="btn btn-primary btn-group-sm">Agregar Atributo</button></a>
   <a href="#" onclick="mostrarDiv()"> <button id="ocultar"  class="btn btn-primary btn-group-sm">Ocultar Tabla de Atributos</button></a>
   
  <!-- Buscar atributo <input type="search" name="buscaratr" id="buscaratr">-->  
   <form id="miform" class="form-horizontal"  method="post" enctype="multipart/form-data">
      
<?php 
 $dataProvider=new CActiveDataProvider('Atributo',array(
    'pagination'=>array(
        'pageSize'=>10,
    ),
));

 $this->widget('zii.widgets.grid.CGridView', 
 	array('dataProvider' => $dataProvider,
 		'htmlOptions'=>array('style'=>'word-wrap:break-word; width:400px;'),
'columns'=>array(
		'nombre',
		'tipo',
		   array(
                'type'=>'raw',
                'value'=>'"<a onclick=\"agregar(\'".$data->nombre.",".$data->id_attributo.",".$data->tipo."\');\"><img src=\"./images/agregar.gif\" width=\"26%\" heigth=\"21%\" /></a>"',
        ),		),


     ));

?>
      </form>
          
                <div class="menu">    
    <form id="formversion" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
           <br> <table class="table-responsive" border="1">  
             <font style="font-weight: bold;">   <tr>
                  <td><font style="font-weight: bold;">Formularios en sistema:</font></td>
               </tr>
               <?php

               $sql="SELECT DISTINCT nombre FROM form";
          $resultados=Form::model()->findAllBySql($sql); 
          if($resultados!=null){
          foreach ($resultados as $key => $formulario) {?>
       <tr class="version1">
    <td class="formu">
    <a style="cursor:pointer;">   <input type="text" id="formular" name="formular" class="formular" value=" <?php echo $formulario->nombre; ?>" hidden="">
       
    <font style="font-weight: bold; color: red;"><?php echo strtoupper($formulario->nombre); ?>
    </font>
    </a></td>
    </td>                 
                   </tr>
          <?php   
          } //fin foreach($resultados as $key => $formulario)
          } //fin if($resultados!=null) ?>

           </table> </font>
           </form>    
                </div>    
          </div>
        <br><br>
         <div style="float: right;"><font style="font-weight: bold;">Para agregar atributo,<br> clic sobre Agregar</font> </div>
      <font style="font-weight: bold;">Para eliminar atributo agregado,<br> doble clic sobre el botón |<font style="color: red;">X</font>| 
      <div id="avizo"></div>
      
      <h3>Formulario</h3>
      <div class="form">
      <form id="my-dynamic-form" method="POST" onsubmit="return validarFormulario()" class="form"> 
       <div class="form-group" style="border-width: 10px; background:#C8C0C0;width:40%;">
                 <label >Nombre Formulario(<font style="color: red;">*</font>)</label>
    <div class="col-lg-8">
    <input type="text" name="nom_formulario" id="nom_formulario" onblur="control();" onkeypress="return vacio(event);" readonly="">
     </div></div>
     <br>
     <div id="poner"></div>
      </form>
        </div> 
       </div> 


