<?php 
Yii::app()->clientScript->registerScript('miscrip', '
$(document).ready(function(){
var form=document.getElementById("nomformulario").value;
           if(form=="paciente"){  //si el formulario es paciente hago control

           $("#id_paciente").keypress(function(e){  //cuando escriba en el input con id id_paciente 
   e.preventDefault();
            var id=String.fromCharCode(e.which);
            if(id=="."||id==","||id==""){
        alert("No utilice PUNTOS, COMAS o GUIONES EJ:12345678");  
       return } else{
        var cadena=document.getElementById("id_paciente").value
        var total=cadena+String.fromCharCode(e.which);
        document.getElementById("id_paciente").value=total;
       }  
    });
        //Aqui se coge el elemento y con la propiedad .on que requiere dos  parametros : change (cuando el valor de ese id cambie, que es cuando se elige otra opcion en la desplegable)y ejecutar la siguiente funcion cuando se haga change
  $("#id_paciente").on("blur", function(){
  
            var id=$(this).val();
     datatypo="user="+id;//genero un array con indice
       $.ajax({
         url: "index.php?r=ctrl_dinamico/ajaxControlarAjax",//llamo a la pagina q hace el control
         type:"POST",//metodo por el cual paso el dato
         data:datatypo,
             success: function (data) { //funcion q recoge la respuesta de la pagina q hace el control
                  $("#respuestauser").fadeIn(1000).html(data); //imprimo el mensaje en el div      
}
     }); 
      
    });  
           //  datatypo="user="+user;//genero un array con indice
      

        }else{
     document.getElementById("id_paciente").value=document.getElementById("cont").value;
       $("input[name=id_paciente]").attr("hidden","hidden"); //si no es el form paciente, lo oculto ya q no aporta nada
        }
  //si el input es id_paciente agrego el placeholder     
 $("input[name=id_paciente]").attr("placeholder","Solo numeros, EJ:123.. ");    
   
            if($("input[name=altura]").length > 0){  //compruebo que el elemento existe       
   $("input[name=altura]").attr("placeholder","En centimetros, EJ: 165, NO introdusca comas(,) ");
     }

     $("#altura").keypress(function(e){  //cuando escriba en el input con id id_paciente 
   e.preventDefault();
            var id=String.fromCharCode(e.which);
            if(id=="."||id==","){
        alert("La altura en centimetros EJ:178");  
       return } else{
        var cadena=document.getElementById("altura").value
        var total=cadena+String.fromCharCode(e.which);
        document.getElementById("altura").value=total;
       }  
    });
      
        
  $("input[name=edad]").click(function(){
      
           var value=document.getElementById("datepicker").value;

          var dato=calcular_edad(value);
          document.getElementById("edad").value=dato;
    });
     if($("input[name=fecha_estudio]").length > 0){  //compruebo que el elemento existe       
   fecha_es();
     }
        $("#altura").blur(function(){
        var peso=document.getElementById("peso").value; 
        if(peso==""){
            alert("Por favor, rellene el campo peso");
        }else{  
        var altura=document.getElementById("altura").value;
        altura=(altura/100);
        var imc=calcular_imc(peso,altura);
        document.getElementById("imc").value=imc.toFixed(2);
        }
    });
$("input[name=edad]").attr("readonly","readonly");
$("input[name=imc]").attr("readonly","readonly");


    });//fin document ready



function fecha_es(){
       var fechaActual = new Date();
       var diaActual = fechaActual.getDate();
var mmActual = fechaActual.getMonth() + 1;
var yyyyActual = fechaActual.getFullYear();
    if(diaActual<10){
        var datof="0"+diaActual+"-"+mmActual+"-"+yyyyActual;
    }else
    if(mmActual<10)
    {
         var datof=diaActual+"-0"+mmActual+"-"+yyyyActual;
    }
    else
    if(mmActual<10 && diaActual<10)
    {
         var datof="0"+diaActual+"-0"+mmActual+"-"+yyyyActual;
    }


   document.getElementById("datepicker").value=datof;
              
    }

function vacio(e){
       ok=true;
       patron =/\w/;
       k=e.which;
       if (k==8 || k==0) return true;
       n = String.fromCharCode(k);
return patron.test(n);

    }

    
    
    function calcular_imc(peso,altura){
        var $indice=peso/(altura*altura);
        return $indice;
    }
    
    function calcular_edad(fecha) {
var fechaActual = new Date()
var diaActual = fechaActual.getDate();
var mmActual = fechaActual.getMonth() + 1;
var yyyyActual = fechaActual.getFullYear();
FechaNac = fecha.split("-");
var diaCumple = FechaNac[2];
var mmCumple = FechaNac[1];
var yyyyCumple = FechaNac[0];

//retiramos el primer cero de la izquierda
if (mmCumple.substr(0,1) == 0) {
mmCumple= mmCumple.substring(1, 2);
}
//retiramos el primer cero de la izquierda
if (diaCumple.substr(0, 1) == 0) {
diaCumple = diaCumple.substring(1, 2);
}
var edad = yyyyActual - yyyyCumple;

//validamos si el mes de cumpleaños es menor al actual
//o si el mes de cumpleaños es igual al actual
//y el dia actual es menor al del nacimiento
//De ser asi, se resta un año
if ((mmActual < mmCumple) || (mmActual == mmCumple && diaActual < diaCumple)) {
edad--;
}

return edad;
};



  function validarCampos(e){
  // Recorremos los inputs del formulario (uno a uno)
       patron =/[^A-Za-z,]/;
       k=e.which;
       if (k==8 || k==0) return true;
       n = String.fromCharCode(k);
return patron.test(n);
 
}
  ');
?>
 

<?php 
$id_paciente=Yii::app()->getsession()->get('id_paciente');
  if(!is_null($id_paciente)){ //esto lo hago por si agregan id_paciente a otro form, controlar q no pongan otro id
echo '<input type="text" id="cont" value='.$id_paciente.' hidden>'; //este campo lo uso para pasar el valor al input id_paciente
  }
  $idd=0;
  $dep=Yii::app()->db->createCommand("SELECT id FROM dependencia WHERE depende='".$nom_form."'")->queryRow();
$idd=$dep["id"]; // obtengo el numero del id, si es distinto q null existe una dependencia.

 if(is_null($idd)){ //esto es para controlar las dependencias del formulario 
?>

<div id="todo">
<?php 
 
  Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl .'/js/dateFechamio.js', CClientScript::POS_BEGIN);

 //Yii::app()->registerCssFile(Yii::app()->baseUrl .'/css/dateFechamio.css', CClientScript::POS_BEGIN);
 ?>

<h3>Formulario :  <?php echo CHtml::link('Otra version ','',array('onclick'=>'$("#mymodal").dialog("open"); return false;')); ?></h3>

<?php

$id_estudio=Yii::app()->getsession()->get('id_estudio'); 
$nombre=Yii::app()->getSession()->get('nombre_usuario');    
  
  $apellido=Yii::app()->getSession()->get('apellido_usuario');
  $nomcompl=$nombre." ".$apellido;
$sqle="SELECT DISTINCT form.id_form FROM form,estudio_atributo WHERE id_estudio=$id_estudio AND estudio_atributo.id_form=form.id_form AND form.nombre='$nom_form'";
 $estudio=Form::model()->findAllBySql($sqle); 
 $idform=0;
 $ok=false;
if(empty($estudio)){ //si estudio está vacio es q no hay datos para ese form
  //traigo el numero del ultimo form con nombre = $dato
   $sqle="SELECT id_form FROM form WHERE nombre='$nom_form' AND activo=1"; 
 $estudio=Form::model()->findAllBySql($sqle);
 foreach ($estudio as $key => $value) {
    $idform=$value->id_form; //obtengo el numero del form   
  }

}else{ //si no tengo lleno el form para ese estudio
  foreach ($estudio as $key => $value) {
    $idform=$value->id_form; 
    
  }
   $ok=true;
      }

  $obligatorio="";
  $tabla="";
     $sql="SELECT atributo.id_attributo,atributo.nombre,atributo.tipo,atributo.tabla FROM form,atributo,form_attr WHERE form_attr.id_attributo=atributo.id_attributo AND form.id_form=form_attr.id_form AND form.id_form=$idform";
 $estudio=Atributo::model()->findAllBySql($sql); ?>
  <div class="form" id="form">

  <form class="form" method="POST" enctype="multipart/form-data">
    <fieldset><legend><font style="font-size: x-large;"><?php echo ucwords($nom_form); ?></font></legend></fieldset>
 <div class="row">
 <input type="text" name="nomformulario" id="nomformulario" value="<?php echo $nom_form; ?>" hidden="hidden">
</div>
<div class="row">
 <input type="text" name="realizado_por" id="realizado_por" value="<?php echo $nomcompl; ?>" hidden="hidden">
</div>

 <?php 
 //////////////////////////////////////////////////////////////////////////////////////////// 
 //if(){ 
//SELECT DISTINCT form.nombre FROM form, estudio_atributo,estudio_paciente WHERE form.id_form=estudio_atributo.id_form AND estudio_atributo.id_estudio=estudio_paciente.id_estudio AND estudio_paciente.id_paciente=147278
 //esto es para controlar las dependencias del formulario //////////////////////////////////////////////////////////////////////////////////////////// 
 //////////////////////////////////////////////////////////////////////////////////////////// 
if(!$ok){

 foreach ($estudio as $key => $value) {
  $sqlob="SELECT obligatorio FROM form_attr WHERE id_form=$idform AND id_attributo=$value->id_attributo";
         $form_attr=FormAttr::model()->findAllBySql($sqlob); 
         foreach ($form_attr as $keyob => $valueob) {
        $obligatorio=$valueob->obligatorio;//obtengo el valor para comprobar si el campo es obligatorio para este form
         } ?>
           <div class="row">
        <label><?php if(strcmp($nom_form,"paciente")!=0){ //esto es para no mostrar el id_paciente en otro form
                                                   //para no permitir agregar un nuevo id_paciente desde otro form
          if(strcmp($value->nombre,"id_paciente")!=0){
          echo ucwords($value->nombre); 
          }
          } else{
            echo ucwords($value->nombre);
            } ?>
         <div id="respuestauser" style="float:rigth;"></div></label>

        <?php if ((strcmp($value->tipo,"file")!=0) && (strcmp($value->tipo,"date")!=0)) { 
               if($value->tabla==1){
                $tablas="SELECT * FROM tabla WHERE id_attributo=$value->id_attributo";
           $tabla=Tabla::model()->findAllBySql($tablas);  
                ?>
        <select name="<?php echo $value->nombre; ?>">
        <?php foreach ($tabla as $tabl => $tab) { ?>
          <option value="<?php echo $tab->opcion; ?>"><?php echo ucwords($tab->opcion); ?></option>
       <?php } ?>
          
        </select>  

               <?php }else{ ?>
<input type="<?php echo $value->tipo; ?>" name="<?php echo $value->nombre; ?>" id="<?php echo $value->nombre; ?>"<?php if ($obligatorio==1) {
  ?>required<?php
} ?>>
              <?php  } //fin if($value->tabla==1)
        ?>
        
      </div>
   <?php    } else if(strcmp($value->tipo,"date")==0){ //fin if ((strcmp($value->tipo,"file")!=0) && (strcmp($value->tipo,"date")!=0)) ?>
   <input type="<?php echo $value->tipo; ?>" name="<?php echo $value->nombre; ?>" id="datepicker" <?php if ($obligatorio==1) {
  ?>required<?php
} if(strcmp($value->nombre, "fecha_estudio")==0){ ?> value="<?php echo date('Y-m-d'); ?>" <?php } ?>>
 <?php  }else if(strcmp($value->tipo,"file")==0){ ?>
       <input type="<?php echo $value->tipo; ?>" name="archivo[]" id="<?php echo $value->nombre; ?>" <?php if ($obligatorio==1) {
  ?>required<?php
} ?>>
   <?php    } else { ?>
       <input type="<?php echo $value->tipo; ?>" name="<?php echo $value->nombre; ?>" id="<?php echo $value->nombre; ?>" <?php if ($obligatorio==1) {
  ?>required<?php
} ?>>
   <?php    }       
    }
?>
      <div class="row">
        <label></label>
        <input type="submit" value="Guardar Datos" id="guardar" onclick="return ejecutar();">
      </div>
    </form>
<?php }else{  //aca termina if(!ok) y empieza else

//si el form tiene datos, los muestro para modificarlos
?>
<div class="view">

<?php
  
 $this->redirect('index?r=Ctrl_dinamico/modificar/modificar&idform='.$idform); ?>

</div>

  <?php
echo CHtml::link(
                'El formulario ya fue competado, modificar datos', 
                Yii::app()->createUrl('ctrl_dinamico/modificar' , array('idform'=>$idform))

); }   //aca termina else de if(!ok) 

?>
</div>
<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(  //este es el modal q muestra las otras versiones del form
           'id'=>'mymodal',
           'options'=>array(
           'autoOpen'=>false,
           'width' => '100%',
  ),
 
  ));
?> 

<?php 
echo $this->renderPartial('elejirVersion',array('dato'=>$nom_form));
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
</div>
<script type="text/javascript">
var nav = navigator.userAgent.toLowerCase(); //obtengo el navegador del usuario
if(nav.search(/chrome/g) > 0){ //si la palabra chrome se encuentra en nav
  //si es chrome, que no muestre el calendario datepicker y no genere conflicto con el tipo date de chrome
}else{

       $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<<Ant    ',
 nextText: '     Sig>>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
 weekHeader: 'Sm',
 dateFormat: 'dd-mm-yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);
$(function () {
$("#datepicker").datepicker(
        {
firstDay: 1,
onSelect: function (date) {
},
} );

}); }
</script>
<?php 
} else{//Aca termina el control de dependenciadel formulario

   echo "<h3>El siguiente formulario depende de que otro este completo, verifique : "; 
  echo CHtml::link(CHtml::encode("Aquí"), array('dependencia/admin'));
   echo "</h3>";
}
 ?>