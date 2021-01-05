<?php $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id' => 'descargas-form',
    //'enableClientValidation' => true,
    'enableAjaxValidation' => true,
    'type' => 'horizontal',
    'htmlOptions' => array('class' => 'well'),
)); ?>
<p class="help-block">Los campos indicados con <span class="required">*</span> son requeridos.</p>
<?php echo $form->errorSummary($model); ?>
<?php
echo $form->datePickerGroup($model, 'fecha_carga', array('widgetOptions' => array('options' => array('format'=>'dd/mm/yyyy','endDate' => '-1Y', 'todayHighlight' => true), 'htmlOptions' => array()), 'prepend' => '<i class="glyphicon glyphicon-calendar"></i>',));
?>
<?php echo $form->textFieldGroup($model, 'carta_porte', array('widgetOptions' => array('htmlOptions' => array()))); ?>
<?php //echo $form->textFieldGroup($model, 'ctg', array('widgetOptions' => array('htmlOptions' => array('maxlength' => 8)))); ?>
<?php echo $form->datePickerGroup($model, 'fecha_carta_porte', array('widgetOptions' => array('options' => array('endDate' => '-1Y', 'todayHighlight' => true), 'htmlOptions' => array()), 'prepend' => '<i class="glyphicon glyphicon-calendar"></i>',)); ?>
<?php //echo $form->textFieldGroup($model,'cuit_titular',array('widgetOptions'=>array('htmlOptions'=>array()))); 
?>
<?php
// muestro el input para seleccionar el titular desde entidades        
$onClickbuscarTitular = "jQuery('#buscarTitular').dialog('open'); return false;";
echo $form->textFieldGroup($model, 'cuit_titular', array('widgetOptions' => array('htmlOptions' => array('readonly' => 'readonly')), 'prepend' => '<span id="nombre_titular"></span>', 'append' => '<i style="cursor:pointer;" class="glyphicon glyphicon-search" onclick="' . $onClickbuscarTitular . '"></i>'));

Yii::app()->clientScript->registerScript('sel_titular', "
            $('#Descargas_cuit_titular').change(function() {
                //console.log(this.value);                
                /*$.fn.yiiGridView.update('materia-grid', {
                        data: $(this).serialize()
                });*/            
                return false;
            });
        ");


// El siguiente código es para mostrar el visual assit        
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'buscarTitular',
    'options' => array(
        'title' => 'Seleccionar Titular',
        'width' => '52%',
        'height' => '470',
        'autoOpen' => false,
        'resizable' => true,
        'modal' => true,
        'overlay' => array(
            'backgroundColor' => '#000',
            'opacity' => '0.5'
        ),
        'buttons' => array(
            'OK' => 'js:function(){                                                       
									//$("#Descargas_cuit_titular").val(jQuery.fn.yiiGridView.getChecked("entidad-grid-titular", "chk"));
									$("#Descargas_cuit_titular").val(jQuery((jQuery("#entidad-grid-titular table tbody tr.selected").children()[1])).html());
                                    $("#nombre_titular").html(jQuery((jQuery("#entidad-grid-titular table tbody tr.selected").children()[2])).html());                                                                        
                                     //$("#Descargas_cuit_titular").change();
                                    $(this).dialog("close");
                                }',
            'Cancel' => 'js:function(){$(this).dialog("close");}',
        ),
    ),
));

$this->renderPartial('/entidad/_select', array('model' => $modelEntidadTitular, 'dataProvider' => $modelEntidadTitular->search('TITULAR'), 'filas' => 1,'grid_name'=>'entidad-grid-titular'));
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<?php $htmlOptions=array('ajax'=>array(
                            		'url'=>$this->createUrl('producto/calidadesPorProducto'),
                            		'type'=>'POST',
                            		'update'=>'#Descargas_calidad',
                        			),
								'class'=>'form-control',
                    );
                ?>
<?php echo $form->dropDownListGroup($model, 'producto', array('widgetOptions' => array('data' => Producto::getProductos('id'), 'htmlOptions' => $htmlOptions))); ?>

<?php
// muestro el input para seleccionar el corredor desde entidades        
$onClickbuscarCorredor = "jQuery('#buscarCorredor').dialog('open'); return false;";
echo $form->textFieldGroup($model, 'cuit_corredor', array('widgetOptions' => array('htmlOptions' => array('readonly' => 'readonly')), 'prepend' => '<span id="nombre_corredor"></span>', 'append' => '<i style="cursor:pointer;" class="glyphicon glyphicon-search" onclick="' . $onClickbuscarCorredor . '"></i>'));

// El siguiente código es para mostrar el visual assit        
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'buscarCorredor',
    'options' => array(
        'title' => 'Seleccionar Corredor',
        'width' => '52%',
        'height' => '470',
        'autoOpen' => false,
        'resizable' => true,
        'modal' => true,
        'overlay' => array(
            'backgroundColor' => '#000',
            'opacity' => '0.5'
        ),
        'buttons' => array(
            'OK' => 'js:function(){                                                       
									//$("#Descargas_cuit_corredor").val(jQuery.fn.yiiGridView.getChecked("entidad-grid-corredor", "chk"));
									$("#Descargas_cuit_corredor").val(jQuery((jQuery("#entidad-grid-corredor table tbody tr.selected").children()[1])).html());
                                    $("#nombre_corredor").html(jQuery((jQuery("#entidad-grid-corredor table tbody tr.selected").children()[2])).html());
                                   
                                    $(this).dialog("close");
                                }',
            'Cancel' => 'js:function(){$(this).dialog("close");}',
        ),
    ),
));

$this->renderPartial('/entidad/_select', array('model' => $modelEntidadCorredor, 'dataProvider' => $modelEntidadCorredor->search('CORREDOR'), 'filas' => 1,'grid_name'=>'entidad-grid-corredor'));
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>

<?php
// muestro el input para seleccionar el destino desde entidades        
$onClickbuscarDestino = "jQuery('#buscarDestino').dialog('open'); return false;";
echo $form->textFieldGroup($model, 'cuit_destino', array('widgetOptions' => array('htmlOptions' => array('readonly' => 'readonly')), 'prepend' => '<span id="nombre_destino"></span>', 'append' => '<i style="cursor:pointer;" class="glyphicon glyphicon-search" onclick="' . $onClickbuscarDestino . '"></i>'));

// El siguiente código es para mostrar el visual assit        
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'buscarDestino',
    'options' => array(
        'title' => 'Seleccionar Destino',
        'width' => '52%',
        'height' => '470',
        'autoOpen' => false,
        'resizable' => true,
        'modal' => true,
        'overlay' => array(
            'backgroundColor' => '#000',
            'opacity' => '0.5'
        ),
        'buttons' => array(
            'OK' => 'js:function(){                                                       
									//$("#Descargas_cuit_destino").val(jQuery.fn.yiiGridView.getChecked("entidad-grid-destino", "chk"));
									$("#Descargas_cuit_destino").val(jQuery((jQuery("#entidad-grid-destino table tbody tr.selected").children()[1])).html());
                                    $("#nombre_destino").html(jQuery((jQuery("#entidad-grid-destino table tbody tr.selected").children()[2])).html());
                                   
                                    $(this).dialog("close");
                                }',
            'Cancel' => 'js:function(){$(this).dialog("close");}',
        ),
    ),
));

$this->renderPartial('/entidad/_select', array('model' => $modelEntidadDestino, 'dataProvider' => $modelEntidadDestino->search('DESTINO FINAL'), 'filas' => 1, 'grid_name'=>'entidad-grid-destino'));
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<?php echo $form->textFieldGroup($model, 'chasis', array('widgetOptions' => array('htmlOptions' => array('maxlength' => 7)))); ?>
<?php echo $form->textFieldGroup($model, 'kg_brutos_destino', array('widgetOptions' => array('htmlOptions' => array(
    'onChange' => ' Descargas.calculoNeto();'
)))); ?>
<?php echo $form->textFieldGroup($model, 'kg_tara_destino', array('widgetOptions' => array('htmlOptions' => array(
    'onChange' => ' Descargas.calculoNeto();'
)))); ?>
<?php echo $form->textFieldGroup($model, 'kg_netos_destino', array('widgetOptions' => array('htmlOptions' => array(
    'onChange' => 'Descargas.calculoNetoApli();'
)))); ?>

<?php echo $form->textFieldGroup($model, 'porcentaje_humedad', array('widgetOptions' => array('htmlOptions' => array(
    'ajax' => array(
        'type' => 'POST', //request type				
        'url' => $this->createUrl('MermasHumedad/DefaultValor'), //url to call	
        'success' => 'js:function(data) { 
            let mer = Math.round(($("#Descargas_kg_netos_destino").val() * data)/100);            
            $("#Descargas_merma_humedad").val(mer); 
            Descargas.calculoNetoApli();
        }',
    ),
)))); ?>
<?php echo $form->textFieldGroup($model, 'merma_humedad', array('widgetOptions' => array('htmlOptions' => array(
    'onChange' => 'Descargas.calculoNetoApli();'
)))); ?>
<?php echo $form->textFieldGroup($model, 'porcentaje_zaranda', array('widgetOptions' => array('htmlOptions' => array()))); ?>
<?php echo $form->textFieldGroup($model, 'merma_zaranda', array('widgetOptions' => array('htmlOptions' => array(
    'onChange' => 'Descargas.calculoNetoApli();'
)))); ?>
<?php echo $form->textFieldGroup($model, 'otras_mermas', array('widgetOptions' => array('htmlOptions' => array(
    'onChange' => 'Descargas.calculoNetoApli();'
)))); ?>
<?php echo $form->textFieldGroup($model, 'neto_aplicable', array('widgetOptions' => array('htmlOptions' => array('readOnly' => true)))); ?>
<?php echo $form->switchGroup($model, 'fumigado', array(
    'widgetOptions' => array(
        'options' => array(
            'onText' => 'SI',
            'offText' => 'NO',
        ),
        'events' => array(
            'switchChange' => 'js:function(event, state) {
						  //console.log(this); // DOM element
						  //console.log(event); // jQuery event						  
						  //console.log(state); // true | false
						}'
        )
    )
)); ?>


<?php //echo $form->textFieldGroup($model, 'calidad', array('widgetOptions' => array('htmlOptions' => array('maxlength' => 3)))); ?>

    <?php echo $form->dropDownListGroup($model,'calidad',array('widgetOptions'=>array('data'=>Producto::getAnalisisCalidad(),'htmlOptions'=>array()))); ?>
    <?php echo $form->textFieldGroup($model, 'analisis', array('widgetOptions' => array('htmlOptions' => array('maxlength' => 110)))); ?>
    
    <?php //echo $form->textFieldGroup($model, 'kg_merma_total', array('widgetOptions' => array('htmlOptions' => array()))); ?>

<?php //echo $form->textFieldGroup($model, 'cod_postal', array('widgetOptions' => array('htmlOptions' => array('maxlength' => 6)))); ?>
<?php /*echo $form->textFieldGroup($model, 'kg_brutos_procedencia', array('widgetOptions' => array('htmlOptions' => array(
    'onChange' => ' jQuery("#Descargas_kg_netos_procedencia").val(jQuery("#Descargas_kg_brutos_procedencia").val()-jQuery("#Descargas_kg_tara_procedencia").val());'
))));  */ ?>
<?php /* echo $form->textFieldGroup($model, 'kg_tara_procedencia', array('widgetOptions' => array('htmlOptions' => array(
    'onChange' => ' jQuery("#Descargas_kg_netos_procedencia").val(jQuery("#Descargas_kg_brutos_procedencia").val()-jQuery("#Descargas_kg_tara_procedencia").val());'
)))); */ ?>
<?php //echo $form->textFieldGroup($model, 'kg_netos_procedencia', array('widgetOptions' => array('htmlOptions' => array('readOnly' => true))));  ?>

<?php //echo $form->textFieldGroup($model, 'acoplado', array('widgetOptions' => array('htmlOptions' => array('maxlength' => 7)))); ?>
<?php //echo $form->datePickerGroup($model, 'fecha_arribo', array('widgetOptions' => array('options' => array(), 'htmlOptions' => array()), 'prepend' => '<i class="glyphicon glyphicon-calendar"></i>',)); ?>
<?php //echo $form->datePickerGroup($model, 'fecha_descarga', array('widgetOptions' => array('options' => array(), 'htmlOptions' => array()), 'prepend' => '<i class="glyphicon glyphicon-calendar"></i>',)); ?>



<?php //echo $form->textFieldGroup($model, 'cuit_intermediario', array('widgetOptions' => array('htmlOptions' => array()))); ?>
<?php //echo $form->textFieldGroup($model, 'cuit_remitente_comercial', array('widgetOptions' => array('htmlOptions' => array()))); ?>


<div class="form-actions">
    <?php $this->widget('booster.widgets.TbButton', array(
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => $model->isNewRecord ? 'Crear' : 'Guardar',
    )); ?>
</div>
<?php $this->endWidget(); ?>