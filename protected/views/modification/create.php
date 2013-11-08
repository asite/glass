<?php
$this->pageTitle = Yii::app().' - Создание модификации';

$this->menu=array(
	array('label'=>'Управление записями','url'=>array('admin')),
);
?>

<h1>Создание модификации</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>