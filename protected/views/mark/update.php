<?php
$this->pageTitle = Yii::app()->name.' - Редактирование марки';

$this->menu=array(
	array('label'=>'Создать марку','url'=>array('create')),
	array('label'=>'Управлять записями','url'=>array('admin')),
);
?>

<h1>Редактировать запись id <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>