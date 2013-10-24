<?php
$this->breadcrumbs=array(
	'Modifications'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Modification','url'=>array('index')),
	array('label'=>'Manage Modification','url'=>array('admin')),
);
?>

<h1>Create Modification</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>