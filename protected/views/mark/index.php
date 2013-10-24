<?php
$this->breadcrumbs=array(
	'Марки',
);

$this->menu=array(
	array('label'=>'Create Marks','url'=>array('create')),
	array('label'=>'Manage Marks','url'=>array('admin')),
);
?>

<h1>Марки</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
