<?php
$this->pageTitle = Yii::app()->name.' - Создание марки';

$this->menu=array(
	array('label'=>'Управление записями','url'=>array('admin')),
);
?>

<h1>Создать марку</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>