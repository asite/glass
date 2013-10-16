<?php
$output = '<p>Выберите модификацию из списка:</p><div class="wrap" data-mark="'.$mark.'" data-model="'.$model.'">';

foreach ($data as $key => $value) {

	$output .= '<div class="brick"><strong>'.$model.'</strong><a class="modif" href="javascript: void(0);">'.$value['name'].'</a></div>';
}
	
$output .= '<div class="clear"></div></div>';

echo $output;