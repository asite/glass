<?php
$output = '<p class="title">Выберите модификацию из списка:</p><a id="show_modifications" href="javascript: void(0);"></a>';

$output .= $this->widget('bootstrap.widgets.TbButtonGroup', array(
    'toggle' => 'radio',
    'buttons' => array(
        array('label' => 'Популярное', 'active' => true),
        array('label' => 'Все'),
    ),
    'htmlOptions' => array('class' => 'modifications'),
), true);

$output .= '<div class="wrap" data-mark="'.$mark.'" data-model="'.$model.'">';

foreach ($data as $value) {

	if ($value['pop'] == '1') {
		$pops = 'pop';
	} else {
		$pops = 'unpop';
	}

	$output .= '<a class="modif brick '.$pops.'" href="javascript: void(0);" data-id="'.$value['id'].'"><strong>'.$model.'</strong><em>'.$value['name'].'</em></a>';
}
	
$output .= '<div class="clear"></div></div>';

echo $output;