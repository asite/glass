<?php
$this->breadcrumbs=array(
	'Modifications'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Modification','url'=>array('index')),
	array('label'=>'Create Modification','url'=>array('create')),
	array('label'=>'Update Modification','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Modification','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Modification','url'=>array('admin')),
);
?>

<h1>View Modification #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'secode',
		'model_id',
		'pop',
	),
)); ?>
