<?php
$this->pageTitle = Yii::app()->name.' - Управление записями марок';

$this->menu=array(
	array('label'=>'Создать марку','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('mark-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление записями</h1>

<p>
Можно опционально ввести оператор сравнения (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
или <b>=</b>) в начало поля поиска.
</p>

<?php echo CHtml::link('Форма поиска','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!--/search-form-->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'mark-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
