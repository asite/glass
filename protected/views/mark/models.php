<?php
$colN = 1;
$firstLetter = substr($data[0]['name'], 0, 1);

$output = '<p class="title">Выберите модель из списка:</p><a id="show_models" href="javascript: void(0);"></a>';

$output .= $this->widget('bootstrap.widgets.TbButtonGroup', array(
    'toggle' => 'radio',
    'buttons' => array(
        array('label' => 'Популярное', 'active' => true),
        array('label' => 'Все'),
    ),
    'htmlOptions' => array('class' => 'models'),
), true);

$output .= '<div class="wrap" data-mark="'.$mark.'"><table><tbody><tr><td><div><span>'.$firstLetter.'</span>';

foreach ($data as $key => $value) {

	if ($value['pop'] == '1') {
		$pops = 'pop';
	} else {
		$pops = 'unpop';
	}

	if (!$key) { // первый раз
		$output .= '<a href="javascript: void(0);" class="'.$pops.'">'.$value['name'].'</a>';
		continue;
	}

	if ($firstLetter != substr($value['name'], 0, 1)) {
		$firstLetter = substr($value['name'], 0, 1);
		$colN++;

		if ($colN == 5) {
			$colN = 1;
			$output .= '</div></td></tr><tr><td><div><span>'.$firstLetter.'</span><a href="javascript: void(0);" class="'.$pops.'">'.$value['name'].'</a>';
			continue;
		}

		$output .= '</div></td><td><div><span>'.$firstLetter.'</span><a href="javascript: void(0);" class="'.$pops.'">'.$value['name'].'</a>';
		continue;
	}

	$output .= '<a href="javascript: void(0);" class="'.$pops.'">'.$value['name'].'</a>';
}
	
$output .= '<div></td></tr></tbody></table></div>';

echo $output;