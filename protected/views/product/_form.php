<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'code',array('class'=>'span5','maxlength'=>32)); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'eurocode',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'prodcode',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textFieldRow($model,'price',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'brand',array('class'=>'span5','maxlength'=>128)); ?>

	<?php echo $form->textAreaRow($model,'features',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php echo $form->textFieldRow($model,'available',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
