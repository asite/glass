<?php
$this->pageTitle = Yii::app()->name.' - Создание secodes';

$this->breadcrumbs=array(
	'Secodes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Управление записями','url'=>array('admin')),
);
?>

<h1>Создание Secodes</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>