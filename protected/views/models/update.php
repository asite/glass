<?php
$this->breadcrumbs=array(
	'Models'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Models','url'=>array('index')),
	array('label'=>'Create Models','url'=>array('create')),
	array('label'=>'View Models','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Models','url'=>array('admin')),
);
?>

<h1>Update Models <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>