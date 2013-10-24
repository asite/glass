<?php
$this->breadcrumbs=array(
	'Modifications'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Modification','url'=>array('index')),
	array('label'=>'Create Modification','url'=>array('create')),
	array('label'=>'View Modification','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Modification','url'=>array('admin')),
);
?>

<h1>Update Modification <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>