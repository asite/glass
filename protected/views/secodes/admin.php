<?php
$this->pageTitle = Yii::app()->name.' - Управление записями secodes';

$this->breadcrumbs=array(
	'Secodes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Создать Secodes','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('secodes-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление записями</h1>

<p>
Можно опционально ввести оператор сравнения (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
или <b>=</b>) в начало поля для поиска.
</p>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'secodes-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
