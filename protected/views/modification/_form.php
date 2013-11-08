<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'modification-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php
	echo $form->errorSummary($model);

	echo $form->dropDownListRow(
		$model,
		'markname',
		CHtml::listData(
			Mark::model()->findAll(),
			'id',
			'name'),
		array(
			'data-url' => Yii::app()->createUrl('modification/models'),
			'name' => 'Modification_markname'
		)
	);

	echo $form->dropDownListRow($model, 'modelname', array(), array('name' => 'Modification[model_id]'));

	echo $form->textAreaRow($model,'name',array('rows'=>6, 'cols'=>50, 'class'=>'span8'));

	echo $form->textFieldRow($model,'secode',array('class'=>'span5','maxlength'=>4));

	echo $form->checkBoxRow($model, 'pop');
	?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Создать' : 'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

<script>
	$('body').addClass('modification_form');
	$('#Modification_markname option:first').attr('selected', 'selected');
</script>