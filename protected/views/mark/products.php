<?php
$output = '<div class="wrap"><table class="table"><thead><tr><th>Наименование</th><th>Производитель</th><th>Характеристики</th><th>Код</th><th>Цена</th><th></th></tr></thead><tbody>';

foreach ($data as $value) {

	$output .= '<tr><td>'.$value['name'].'</td><td>'.$value['brand'].'</td><td>'.$value['features'].'</td><td>'.$value['eurocode'].'</td><td>'.$value['price'].'</td><td><button class="btn">Заказать</button></td></tr>';
}

$output .= '</tbody></table></div>';

echo $output;