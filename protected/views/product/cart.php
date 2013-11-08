<?php
mb_internal_encoding("utf-8");

// ucfirst для кириллицы
function mb_ucfirst($text) {
    return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
}

function getDates() {
	$days = array(
		'1' => 'Понедельник',
		'2' => 'Вторник',
		'3' => 'Среда',
		'4' => 'Четверг',
		'5' => 'Пятница',
		'6' => 'Суббота',
		'7' => 'Воскресенье'
	);
	$months = array(
		'01' => 'января',
		'02' => 'февраля',
		'03' => 'марта',
		'04' => 'апреля',
		'05' => 'мая',
		'06' => 'июня',
		'07' => 'июля',
		'08' => 'августа',
		'09' => 'сентября',
		'10' => 'октября',
		'11' => 'ноября',
		'12' => 'декабря',
	);

	for ($i = 0; $i < 7; $i++) { 
		$dates[date('d.m.Y', time()+($i*24*60*60))] = date('j', time()+($i*24*60*60)).' '.$months[date('m', time()+($i*24*60*60))].' <br />'.$days[date('N', time()+($i*24*60*60))];
	}

	$dates[date('d.m.Y', time())] = date('j', time()).' '.$months[date('m', time())].' <br />Сегодня';

	return $dates;
}

if (isset($_SESSION['orders'])) {
	$orders = $_SESSION['orders'];
}
?>

<h1>Ваш заказ: <a href="<?php echo Yii::app()->createUrl('product/clearcart'); ?>">очистить</a></h1>

<?php if (isset($orders)): ?>

	<table class="table" data-url="<?php echo Yii::app()->createUrl('product/removeitem'); ?>">

		<tfoot>
			<tr>
				<td></td>
				<td></td>
				<td class="total">Итого к оплате:<br /><span></span> руб.</td>
			</tr>
		</tfoot>

		<tbody>
			<?php foreach($orders as $value): ?>

				<?php
				$product = Product::getProd($value['pid']);
				$pids[] = $value['pid'];
				?>

				<tr data-pid="<?php echo $value['pid']; ?>" data-mid="<?php echo $value['modifid']; ?>">
					<td>
						<?php echo mb_ucfirst($product['name']); ?>,
						<?php echo $value['mark'], ' ', $value['model'], ' ', $value['modification']; ?>,
						производитетель: <strong><?php echo strtoupper($product['brand']); ?></strong>
						<a href="javascript: void(0);" class="remove">Удалить</a>
					</td>
					<td class="price">Стоимость стекла:<br /><span><?php echo $product['price']; ?></span> руб.</td>
					<td class="mounting_price">Стоимость установки:<br /><span>3000</span> руб. <a href="javascript: void(0);" class="without">Купить без установки</a></td>
				</tr>
			<?php endforeach; ?>
		</tbody>

	</table>

<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id' => 'cart_form',
	'type' => 'horizontal',
	'action' => Yii::app()->createUrl('product/addorder'),
	'enableAjaxValidation' => false,
));

Yii::app()->user->setFlash('error', 'Ошибка');
$this->widget('bootstrap.widgets.TbAlert', array(
    'alerts' => array(
        'error' => array(
        	'block' => true,
        	'closeText' => ''
        ),
    ),
));

echo $form->textFieldRow($model, 'clientname', array('maxlength' => 256));
echo $form->textFieldRow($model, 'phone', array('maxlength' => 32));
echo $form->checkBoxRow($model, 'mounting');
echo '<div class="address">', $form->textFieldRow($model, 'address', array('maxlength' => 512)), '</div>';
echo '<div class="date">', $form->radioButtonListInLineRow($model, 'date', getDates()), '</div>';
echo '<div class="time">', $form->radioButtonListInLineRow($model, 'time', array(
	'10:00' => '10:00',
	'12:00' => '12:00',
	'14:00' => '14:00',
	'16:00' => '16:00',
	'18:00' => '18:00',
	'20:00' => '20:00',
	'21:00' => '21:00'
)), '</div>';

foreach ($pids as $value) {
	echo CHtml::hiddenField('pid_'.$value, $value);
}

$this->widget('bootstrap.widgets.TbButton', array(
	'buttonType'=>'submit',
	'type'=>'primary',
	'label'=>'Оформить заказ',
));

$this->endWidget(); ?>

<?php else: ?>
	<p>Корзина пуста.</p>	
<?php endif; ?>

<script>
	$('body').addClass('cart');
</script>