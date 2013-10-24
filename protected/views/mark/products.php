<?php
mb_internal_encoding("UTF-8");
function mb_ucfirst($text) {
    return mb_strtoupper(mb_substr($text, 0, 1)).mb_substr($text, 1);
}

$i = 1;
$name = $data[0]['name'];
$output = '<div class="wrap"><p class="title">Уровень качества:</p>';

$output .= $this->widget('bootstrap.widgets.TbButtonGroup', array(
    'toggle' => 'radio',
    'buttons' => array(
        array('label' => 'Любой', 'active' => true),
        array('label' => 'Эконом'),
        array('label' => 'Бизнес'),
        array('label' => 'Премиум'),
    ),
    'htmlOptions' => array('class' => 'products'),
), true);

$output .= '<table class="table"><caption>'.mb_ucfirst($name).':</caption><thead><tr><th>Производитель:</th><th>Характеристики:</th><th>Наличие:</th><th>Цена:</th><th>Заказать:</th></tr></thead><tbody>';

foreach ($data as $value) {

	if ($name != $value['name']) {
		$name = $value['name'];
		$output .= '</tbody></table><table class="table"><caption>'.mb_ucfirst($name).':</caption><thead><tr><th>Производитель:</th><th>Характеристики:</th><th>Наличие:</th><th>Цена:</th><th>Заказать:</th></tr></thead><tbody>';
	}

	if ($value['available'] == '1') {
		$available = 'available';
	} else {
		$available = '';
	}

	$output .= '<tr class="row'.$i++.'">
		<td class="first"><div><em class="cart"></em>'.$value['brand'].'</div></td>
		<td>'.$value['features'].'</td>
		<td class="'.$available.'"></td>
		<td>'.$value['price'].' руб.</td>
		<td><button data-toggle="modal" data-target="#cartModal">Заказать</button></td>
		</tr>';
}

$output .= '</tbody></table></div>';

echo $output;