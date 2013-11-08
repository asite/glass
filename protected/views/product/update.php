<?php
$this->breadcrumbs=array(
	'Products'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Создать продукцию','url'=>array('create')),
	array('label'=>'Просмотр продукции','url'=>array('view','id'=>$model->id)),
	array('label'=>'Удалить подукцию','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы действительно хотите удалить запись?')),
	array('label'=>'Управление записями','url'=>array('admin')),
);
?>

<h1>Редактирование продукции id <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>