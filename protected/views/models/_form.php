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
			'name'),
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
	$('#Models_mark_id').prepend('<option disabled selected>');
</script>