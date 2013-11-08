<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textAreaRow($model,'name',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'secode',array('class'=>'span5','maxlength'=>32)); ?>

	<?php
	echo $form->dropDownListRow(
		$model,
		'markname',
		CHtml::listData(
			Mark::model()->findAll(),
			'id',
			'name'
		),
		array(
			'data-url' => Yii::app()->createUrl('modification/models'),
			'name' => 'Modification_markname'
		)
	);

	echo $form->dropDownListRow($model, 'modelname', array(), array('name' => 'Modification[model_id]'));
	?>

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
	$('body').addClass('manage');
	$('#Modification_markname option:first').before('<option disabled selected>');
</script>