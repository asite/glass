<?php
$this->pageTitle = Yii::app()->name.' - Управление записями модификаций';

$this->menu=array(
	array('label'=>'Создать модификацию','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('modification-grid', {
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

<?php
if (isset($markId)) {
	$dataProvider = $model->search($markId);
} else {
	$dataProvider = $model->search();
}

$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'modification-grid',
	'dataProvider'=>$dataProvider,
	//'filter'=>$model,
	'columns'=>array(
		'id',
		array('name' => 'name', 'header' => 'Наименование'),
		'secode',
		array('name' => 'Модель', 'value' => '$data->model->name'),
		array('name' => 'Марка', 'value' => '$data->model->mark->name'),
		array('name' => 'pop', 'header' => 'Популярность'),
		array(
			'class' => 'bootstrap.widgets.TbButtonColumn',
		),
	),
));