<?php
$dataCount = sizeof($data);
$blockCount = floor($dataCount/3);
$block1Count = $blockCount+$dataCount%3;
$firstLetter = substr($data[0]['name'], 0, 1);

$output = '<p>Выберите модель из списка:</p><div class="wrap" data-mark="'.$mark.'"><div class="col"><div class="block"><span>'.$firstLetter.'</span>';

foreach ($data as $key => $value) {

	if (!$key) { // первый раз
		$output .= '<a href="javascript: void(0);">'.$value['name'].'</a>';
		continue;
	}

	if (($key == $block1Count) || ($key == $block1Count+$blockCount)) {
		
		$output .= '</div></div><div class="col"><div class="block">';
		
		if ($firstLetter != substr($value['name'], 0, 1)) {
			$firstLetter = substr($value['name'], 0, 1);
			$output .= '<span>'.$firstLetter.'</span><a href="javascript: void(0);">'.$value['name'].'</a>';
			continue;
		} else {
			$output .= '<a href="javascript: void(0);">'.$value['name'].'</a>';
			continue;
		}
	}

	if ($firstLetter != substr($value['name'], 0, 1)) {
		$firstLetter = substr($value['name'], 0, 1);
		$output .= '</div><div class="block"><span>'.$firstLetter.'</span><a href="javascript: void(0);">'.$value['name'].'</a>';
	} else {
		$output .= '<br><a href="javascript: void(0);">'.$value['name'].'</a>';
	}
}
	
$output .= '</div></div><div class="clear"></div></div>';

echo $output;