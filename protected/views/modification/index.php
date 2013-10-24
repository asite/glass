<?php
$this->breadcrumbs=array(
	'Modifications',
);

$this->menu=array(
	array('label'=>'Create Modification','url'=>array('create')),
	array('label'=>'Manage Modification','url'=>array('admin')),
);
?>
<div class="list-view">

	<h1>Модификации</h1>

	<?php foreach ($dataProvider as $value): ?>

	<div class="view">

		<b>id:</b>
		<?php echo CHtml::link($value['id'], array('view','id' => $value['id'])); ?><br />

		<b>Модификация:</b>
		<?php echo $value['modifname']; ?>
		<br />

		<b>ec:</b>
		<?php echo $value['secode']; ?>
		<br />

		<b>Модель:</b>
		<?php echo $value['modelname']; ?>
		<br />

		<b>Марка:</b>
		<?php echo $value['markname']; ?>
		<br />

		<b>Популярность:</b>
		<?php echo $value['pop']; ?>
		<br />

	</div>

	<?php endforeach; ?>

</div>