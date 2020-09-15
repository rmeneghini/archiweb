<?php
$this->breadcrumbs=array(
    'Oficinas'=>array('/contribuyente/index/'),
	'Cuentas',
);
$this->parametros=array(
	'titulo'=>'Cuentas',
);

$this->menu=array(
	array('label'=>'Cedulones Generados', 'url'=>array('/cedulon/index','tasa'=>$tasa)),
	//array('label'=>'Administrar Cuenta', 'url'=>array('admin')),
);
?>

<script type="text/javascript">
        function generarCedulones()
        {             
        		// recupera las ctas para luego recuperar los inputs   
        		var ctas= jQuery('#ctas').val();
        		var idsel = null;
        		var arregloCtas = ctas.split('-');
        		var e_select='';
        		for(i = 0; i < arregloCtas.length; i++){
        			idsel = jQuery.fn.yiiGridView.getChecked('deuda-grid-'+arregloCtas[i], 'chk');  
        			jQuery.each(idsel, function(key,val){
        				campos=val.split(',');                        
	                    e_select +=campos[0]+'+'+campos[4]+'-'; 
	                });
        		}
                //console.log(e_select);
                
                
                
                // controlo que haya al menos un usuario seleccionado
                if(e_select.length <= 0){
                    alert('Debe seleccionar al menos una cuota');
                }else{                               	
                    e_select=e_select.substr(0,e_select.length-1);                      
                    var parametros = {"cuotas_sel" : e_select,"tasa" : '<?php echo $tasa; ?>'};                   
                    //console.log(e_select);
                   // resultado nrocuota+nrocta-nrocuota+nrocta
                    jQuery.getJSON('<?php echo $this->createUrl("/cedulon/generar"); ?>',parametros, function(data) {
                        // recorro el rsultado y muestro los pdf
                        jQuery.each(data, function( key, value ) {
                            window.open(value, '_blank');                            
                        });
                       
                    }) .fail(function() {
                           alert('Ocurrio un error y no se pudo generar el cedulon');
                    });
                }
                return false;
        }
</script>

<h1>Cuentas</h1>
<?php if($dataProvider->data){
	$collapse = $this->beginWidget('booster.widgets.TbCollapse'); ?>
	<div class="panel-group" id="accordion">

		<?php 
		// voy a generar un input hidden con las ctas listadas
		$strHidden= array();
		foreach ($dataProvider->data as $cuenta) {
			// recupero las cuotas			
			$strHidden[]=$cuenta['nro'];
			$cuotas=new CActiveDataProvider('Cuota',array('pagination'=>array('pageSize'=>'12'),'criteria'=>array('condition'=>'id_cuenta= :cta AND tasa= :tasa','params'=>array(':cta'=>$cuenta['nro'],':tasa'=>$tasa))));
			$this->renderPartial('_cuenta',array('data' => $cuenta,'cuotas'=>$cuotas)); 
		}
		echo CHtml::hiddenField('ctas', implode('-',$strHidden));		
		?>
		
	</div>
<?php $this->endWidget(); 
}else{ echo('No se encontraron cuentas');} ?>

<?php $this->widget('booster.widgets.TbButton', array(
                         'icon'=>'glyphicon glyphicon-print',
                         'buttonType'=>'action', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                         'size'=>'normal', // null, 'large', 'small' or 'mini'
                         'label' => 'Generar Cedulones',
                          'htmlOptions'=>array('onClick'=>'generarCedulones()','title'=>'Asignar'),
                     )); ?>

