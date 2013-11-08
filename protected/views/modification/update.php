<?php
$this->pageTitle = Yii::app()->name.' - Редактирование модификации';

$this->menu=array(
	array('label'=>'Создать модификацию','url'=>array('create')),
	array('label'=>'Управление записями','url'=>array('admin')),
);
?>

<h1>Редактирование модификации id <?php echo $model->id; ?></h1>

<?php
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'modification-form',
	'enableAjaxValidation'=>false,
));
?>

	<?php
	echo $form->errorSummary($model);

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
			'data-model_id' => $model->model_id,
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
	$('#Modification_markname option[value="<?php echo Mark::model()->findByPk(Models::model()->findByPk($model->model_id)->mark_id)->id; ?>"]').attr('selected', 'selected');
	$('body').addClass('modification_update_form');
</script>