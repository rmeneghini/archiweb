<?php 
$fpa = fopen('php://temp', 'w');
	$primero=true;
	foreach ($dataProvider->getData() as $data) {	
		//$data->exportado=1;
		//$data->save();
		if($data->analisis0){
			$this->renderPartial('_csv_analisis',array('data' =>$data,'primero'=>$primero ,'fpa'=>$fpa,'delimitador'=>$delimitador));
			$primero=false;
		}
	}
rewind($fpa);
Yii::app()->user->setState('export_analisisCSV',stream_get_contents($fpa));
fclose($fpa);
?>
