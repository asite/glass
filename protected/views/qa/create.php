<?php
$this->breadcrumbs=array(
	'Qas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Qa','url'=>array('index')),
	array('label'=>'Manage Qa','url'=>array('admin')),
);
?>

<h1>Create Qa</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>