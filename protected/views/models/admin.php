<?php
$this->pageTitle = Yii::app()->name.' - Управление записями моделей';

$this->menu=array(
	array('label'=>'Создать модель','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('models-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление записями</h1>

<?php echo CHtml::link('Поиск','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!--/search-form-->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'models-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		//'mark_id',
		array('name' => 'Марка', 'value' => '$data->mark->name'),
		'pop',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
