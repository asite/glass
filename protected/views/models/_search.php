<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>10)); ?>

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
			'name' => 'Models[mark_id]'
		)
	); ?>

	<?php echo $form->checkBoxRow($model, 'pop'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Искать',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

<script>
	$('#Models_mark_id option:first').before('<option disabled selected>');
</script>