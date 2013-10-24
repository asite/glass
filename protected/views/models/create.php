<?php
$this->breadcrumbs=array(
	'Models'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Models','url'=>array('index')),
	array('label'=>'Manage Models','url'=>array('admin')),
);
?>

<h1>Create Models</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>