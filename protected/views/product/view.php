<?php
$this->menu=array(
	array('label'=>'Создать продукцию','url'=>array('create')),
	array('label'=>'Редактировать продукцию','url'=>array('update','id'=>$model->id)),
	array('label'=>'Удалить подукцию','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы действительно хотите удалить запись?')),
	array('label'=>'Управление записями','url'=>array('admin')),
);
?>

<h1>Просмотр записи id <?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'code',
		'name',
		'eurocode',
		'prodcode',
		'price',
		'brand',
		'features',
		'available',
	),
)); ?>