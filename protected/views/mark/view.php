<?php
$this->breadcrumbs=array(
	'Marks'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Mark','url'=>array('index')),
	array('label'=>'Create Mark','url'=>array('create')),
	array('label'=>'Update Mark','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Mark','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Mark','url'=>array('admin')),
);
?>

<h1>View Mark #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
