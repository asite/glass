<?php
$this->pageTitle = Yii::app()->name.' - Создание модели';

$this->menu=array(
	array('label'=>'Управление записями','url'=>array('admin')),
);
?>

<h1>Создание модели</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>