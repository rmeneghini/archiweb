<?php ?>
<table>
<?php 
	$primero=true;
	foreach ($dataProvider->getData() as $data) {	
		/*$data->exportado=1;
		$data->save();*/
		$this->renderPartial('_viewExcel',array('data' =>$data,'primero'=>$primero ));
		$primero=false;
	}
?>
</table>
