<?php
$this->breadcrumbs=array(
	'Models'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Models','url'=>array('index')),
	array('label'=>'Create Models','url'=>array('create')),
	array('label'=>'Update Models','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Models','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Models','url'=>array('admin')),
);
?>

<h1>View Models #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'mark_id',
		'pop',
	),
)); ?>
