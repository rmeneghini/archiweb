<?php 
$fp = fopen('php://temp', 'w');
	$primero=true;
	foreach ($dataProvider->getData() as $data) {	
		//$data->exportado=1;
		//$data->save();
		$this->renderPartial('_csv',array('data' =>$data,'primero'=>$primero ,'fp'=>$fp,'delimitador'=>$delimitador));
		$primero=false;
	}
rewind($fp);
Yii::app()->user->setState('exportCSV',stream_get_contents($fp));
fclose($fp);
?>
