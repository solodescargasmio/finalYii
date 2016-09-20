<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css">
<?php 
if($_GET['mensage']){
	echo $_GET['mensage'];
}
     $nombre=$dato;

        $form=Form::model()->findAll('nombre="'.$nombre.'"');
         
      foreach ($form as $key => $formu) {
      	$id_form=$formu->id_form;
      //	
       // $estudio=$atr->traerAtributosForm($formu->id_form;  
        $sql="SELECT atributo.id_attributo,atributo.nombre,atributo.tabla,atributo.tipo FROM atributo,form_attr WHERE atributo.id_attributo=form_attr.id_attributo AND form_attr.id_form=".$id_form;
          $resultados=Atributo::model()->findAllBySql($sql);
          
           ?>


           <div id="registro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="top:200px;  background-color: #cccccc; width:50%;" >
               
               <form>
            <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">

                  <h4><font style="color: blue;">Utilizar este formulario :<?php echo '  Versión:'.$formu->version;?></font></h4>  
                  <p>Creado : <?php echo $formu->fecha_crea;?></p>
                  </div>
                <form >   
            <fieldset><legend><?php echo strtoupper($nombre); ?></legend></fieldset>
                  <div class="modal-body">
          <?php foreach ($resultados as $keys => $atte) {  ?> 
                 
            <input type="text" name="nomformulario" value="<?php echo $nombre; ?>" id="nomformulario" hidden="">
          <div class="form-group" style="border-width: 10px; background: #C8C0C0;">
               <label for="nombre" class="col-lg-2 control-label"><?php echo strtoupper($atte->nombre);?></label>
             <br>
  </div>
        
 <?php }  ?> 
                  </div>
                  <div class="modal-footer">
               <div class="form-group">  
                              <label  class="col-sm-8 control-label"></label>
                                 <div class="col-lg-10">
                               <a href=<?php echo Yii::app()->createUrl('ctrl_dinamico/recibeform', array('id_form' => $id_form, 'nombre' => $dato))?>><button type="button" class="btn btn-primary btn-group-justified">Trabajar con este formulario</button> </a>                                  
                                 </div>
                          </div>

                  </div>
              </div>
          </div>  
                </form>
       </div><br>
       <?php   }
       ?>
       </div>
