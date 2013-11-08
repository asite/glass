<?php
$this->pageTitle = Yii::app()->name.' - Редактирование модели';

$this->menu=array(
	array('label'=>'Создать модель','url'=>array('create')),
	array('label'=>'Управление записями','url'=>array('admin')),
);
?>

<h1>Редактировать модель id <?php echo $model->id; ?></h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'models-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>256)); ?>

	<?php echo $form->dropDownListRow(
		$model,
		'mark_id',
		CHtml::listData(
			Mark::model()->findAll(),
			'id',
			'name'
		),
		array(
			'data-url' => Yii::app()->createUrl('modification/models'),
			'name' => 'Models[mark_id]'
		)
	); ?>

	<?php echo $form->checkBoxRow($model, 'pop'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

<script>
	$('#Models_mark_id option[value="<?php echo $model->mark_id; ?>"]').attr('selected', 'selected');
</script>