<?php

/* @var $this SiteController */

/* @var $error array */



$this->pageTitle=Yii::app()->name . ' - Error';

$this->breadcrumbs=array(

	'Error',

);

?>

<h2>Atencion</h2>

<div class="error">

<?php echo CHtml::encode($message); 
	echo "<br><br><br><p>Cod. ".$code."</p>";
?>

</div>