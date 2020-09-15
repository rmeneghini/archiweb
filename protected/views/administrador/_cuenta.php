<div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">      
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo($data["nro"]); ?>">        
        <?php echo CHtml::encode($data['nro']); ?>&nbsp;<?php echo CHtml::encode($data['descripcion']); ?>         
        </a>
         &nbsp;<b><?php echo CHtml::encode('Cuotas:'); ?></b>&nbsp;<?php echo CHtml::encode($data['cantidad_cuotas']); ?>        
        &nbsp;<b><?php echo CHtml::encode('Total:'); ?></b>&nbsp;$<?php echo CHtml::encode($data['importe_total']); ?>
      </h4>
    </div>
    <div id="collapse<?php echo($data["nro"]); ?>" class="panel-collapse collapse">
      <div class="panel-body">
        Detalle cuotas
        <?php $this->widget('booster.widgets.TbGridView', array(
                'type'=>'striped bordered condensed',
                'id'=>'deuda-grid-'.$data["nro"],
                'selectableRows'=>2,                
                'dataProvider'=> $cuotas,
                #'dataProvider'=>$equipos->search(),
                //'filter'=>$data->cuotas,
                'columns'=>array(
                         array('id'=>'chk','class' => 'CCheckBoxColumn', 'value'=>'$data["id"]'),
                               array('name'=>'anio','header'=>'Año'),
                               array('name'=>'numero','header'=>'Nro'),
                               array('name'=>'vencimiento','header'=>'Fecha de Vencimiento','value'=>'date("d-m-Y", strtotime($data->vencimiento))'),
                               array('name'=>'importe','value'=>'"$".$data->importe'),       
                ),
        ));  ?>  
      </div>
    </div>
</div>
