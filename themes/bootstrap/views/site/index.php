<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$colN = 1;
$firstLetter = 'A';

$content = '<p class="title small">Подбор автостекла по:</p>';

$content .= $this->widget('bootstrap.widgets.TbButtonGroup', array(
    'toggle' => 'radio',
    'buttons' => array(
        array('label' => 'Автомобилю', 'active' => true),
        array('label' => 'Параметрам'),
        array('label' => 'Производителю'),
    ),
    'htmlOptions' => array('class' => 'small'),
), true);

$content .= '<br><p class="title">Выберите марку из списка:</p><a id="show_marks" href="javascript: void(0);"></a>';

$content .= $this->widget('bootstrap.widgets.TbButtonGroup', array(
    'toggle' => 'radio',
    'buttons' => array(
        array('label' => 'Популярное', 'active' => true),
        array('label' => 'Все'),
    ),
    'htmlOptions' => array('class' => 'marks'),
), true);

$content .= '<div id="marks" class="wrap"><table><tbody><tr><td><div><span>'.$firstLetter.'</span>';

foreach ($data as $key => $value) {

	if ($value['pop'] == '1') {
		$pops = 'pop';
	} else {
		$pops = 'unpop';
	}

	if (!$key) { // первый раз
		$content .= '<a href="javascript: void(0);" class="'.$pops.'">'.$value['name'].'</a>';
		continue;
	}

	if ($firstLetter != substr($value['name'], 0, 1)) {
		$firstLetter = substr($value['name'], 0, 1);
		$colN++;

		if ($colN == 5) {
			$colN = 1;
			$content .= '</div></td></tr><tr><td><div><span>'.$firstLetter.'</span><a href="javascript: void(0);" class="'.$pops.'">'.$value['name'].'</a>';
			continue;
		}

		$content .= '</div></td><td><div><span>'.$firstLetter.'</span><a href="javascript: void(0);" class="'.$pops.'">'.$value['name'].'</a>';
		continue;
	}

	$content .= '<a href="javascript: void(0);" class="'.$pops.'">'.$value['name'].'</a>';
}
	
$content .= '</tbody></table></div>
	<div id="models" data-url="'.Yii::app()->createUrl('mark/models').'"></div>
	<div id="modifications" data-url="'.Yii::app()->createUrl('mark/modifications').'"></div>
	<div id="products" data-url="'.Yii::app()->createUrl('mark/products').'" data-cart="'.Yii::app()->createUrl('product/cart').'"></div>';

$this->widget('bootstrap.widgets.TbTabs', array(
    'type'=>'tabs',
    'tabs'=>array(
        array('label'=>'Товары', 'content'=>$content, 'active'=>true),
        array('label'=>'Услуги', 'content'=>'Пусто'),
    ),
));

$this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'cartModal')); ?>
 
<div class="modal-body">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Товар успешно добавлен в корзину</h4>
    <p>One fine body...</p>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Оформить заказ',
        'url'=>Yii::app()->createUrl('product/cart'),
    ));
    $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Оформить позже',
        'url'=>'#',
        'htmlOptions'=>array('data-dismiss'=>'modal'),
    ));
    ?>
</div>
 
<?php $this->endWidget();