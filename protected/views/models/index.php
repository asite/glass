<?php
$this->breadcrumbs=array(
	'Models',
);

$this->menu=array(
	array('label'=>'Create Models','url'=>array('create')),
	array('label'=>'Manage Models','url'=>array('admin')),
);
?>

<h1>Models</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
