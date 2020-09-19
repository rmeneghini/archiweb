<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'usuario-form',
	'enableAjaxValidation'=>false,
	'type' => 'horizontal',
	'htmlOptions' => array('class' => 'well','onSubmit' => ' return Usuario.procesar("#usuario-form")'),
)); ?>
<p class="help-block">Los campos indicados con <span class="required">*</span> son requeridos.</p>
<?php echo $form->errorSummary($model); ?>	
	<?php echo $form->textFieldGroup($model,'nombre',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>60)))); ?>
	<?php echo $form->passwordFieldGroup($model,'password',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>100)))); ?>
	<?php echo $form->textFieldGroup($model,'hash_activacion',array('widgetOptions'=>array('htmlOptions'=>array('maxlength'=>150,'disabled' => true)))); ?>
	<?php echo $form->radioButtonListGroup(	$model,	'estado',array('inline'=>true,'widgetOptions' => array('data' => array(0=>'Deshabilitado',1=>'Habilitado',)))); ?>	
	<div class="form-group">
		<label class="col-sm-3 control-label" for="Usuario_rol">Rol</label>
		<div class="col-sm-9">	
		<?php $roles=array('cliente'=>'Cliente','admin'=>'Usuario Administrador');
		if(Yii::app()->authManager->checkAccess('super',Yii::app()->user->id)){
			$roles['super']='Super usuario';
		}
		?>
		<?php echo CHtml::dropDownList('rol', $rol, array(
							'Roles'=>$roles,
							),array('class'=>'form-control'));?>
		</div>
	</div>
	<?php if(isset($persona)){echo CHtml::hiddenField('persona-asociar', $persona);} ?>
<div class="panel panel-default">
  <div class="panel-body">
  	<fieldset>
    	<legend>Empresas Asociadas </legend>    
  		<div id="list-empresas">
  		</div>  	
  	</fieldset>  	

  	<br/>
    <fieldset>
	    <legend>Buscar Empresa</legend>
	    <?php // grilla para buscar empresas
	    //con esta funcion recupero los datos de la empresa y agrego al usuario
	    $funcionSelectedRow ='function(id){
	        var mat = 0;
	        if($.fn.yiiGridView.getSelection(id).length == 1){
	            emp = $.fn.yiiGridView.getSelection(id)[0];
	            Usuario.asociarEmpresa(emp,jQuery((jQuery("#empresa-grid table tbody tr.selected").children()[1])).html());
	            //console.log(doc+"   "+jQuery((jQuery("#docente-grid table tbody tr.selected").children()[0])).html());
	            $.fn.yiiGridView.update("empresa-grid");
	        }
	        return;
	    }';
		$this->renderPartial('/empresa/_select',array('model'=>$empresas,'dataProvider'=>$empresas->getEmpresasNoAsociadas($model->id),'filas'=>1,'funcionSelectedRow'=>$funcionSelectedRow)); ?>
	</fieldset>		
  </div>
</div>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
</div>
<?php $this->endWidget(); ?>

<?php 
// si es un update recupero las empresas y lo muestro
if(!$model->isNewRecord){
	$datos=array();
		foreach ($empresas_asociadas as $dato) {
			$datos[]= array("idEmp"=>$dato->empresa,"razonSoc"=>$dato->empresa0->razon_social,"idUsuario"=>$dato->usuario);
			//echo(json_encode($dato->getAttributes(array('docente->idPersona->getSelectPersona()','id_mesa'))));
		}			
		//print_r($datos);exit();
		Yii::app()->getClientScript()->registerScript('cargar_empresas', "Usuario.cargarEmpresas(".json_encode($datos).");", CClientScript::POS_LOAD); 
}else{
	// limpio session
	Yii::app()->getClientScript()->registerScript('limpiar_empresas', "sessionStorage.clear();", CClientScript::POS_LOAD); 
}
?>