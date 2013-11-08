<?php
$this->pageTitle = Yii::app()->name.' - Редактирование secodes';

$this->breadcrumbs=array(
	'Secodes'=>array('index'),
	$model->name=>array('view','id'=>$model->name),
	'Update',
);

$this->menu=array(
	array('label'=>'Создание Secodes','url'=>array('create')),
	array('label'=>'Управление записями','url'=>array('admin')),
);
?>

<h1>Редактирование Secode <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>