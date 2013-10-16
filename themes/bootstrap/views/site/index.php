<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$dataCount = sizeof($data);
$blockCount = floor($dataCount/5);
$block1Count = $blockCount+$dataCount%5;
$firstLetter = 'A';
?>

<p>Выберите марку из списка:</p>

<?
echo '<div id="marks" class="wrap"><div class="col">', '<div class="block"><span>', $firstLetter, '</span>';

foreach ($data as $key => $value) {

	if (!$key) { // первый раз
		echo '<a href="javascript: void(0);">', $value['name'], '</a>';
		continue;
	}

	if (($key == $block1Count) || ($key == $block1Count+$blockCount) || ($key == $block1Count+$blockCount*2) || ($key == $block1Count+$blockCount*3)) {
		
		echo '</div></div><div class="col"><div class="block">';
		
		if ($firstLetter != substr($value['name'], 0, 1)) {
			$firstLetter = substr($value['name'], 0, 1);
			echo '<span>', $firstLetter, '</span><a href="javascript: void(0);">', $value['name'], '</a>';
			continue;
		} else {
			echo '<a href="javascript: void(0);">', $value['name'], '</a>';
			continue;
		}
	}

	if ($firstLetter != substr($value['name'], 0, 1)) {
		$firstLetter = substr($value['name'], 0, 1);
		echo '</div><div class="block"><span>', $firstLetter, '</span><a href="javascript: void(0);">', $value['name'], '</a>';
	} else {
		echo '<br><a href="javascript: void(0);">', $value['name'], '</a>';
	}
}
	
echo '</div></div><div class="clear"></div></div>';
?>

<div id="models" data-url="<?php echo Yii::app()->createUrl('mark/models'); ?>"></div>
<div id="modifications" data-url="<?php echo Yii::app()->createUrl('mark/modifications'); ?>"></div>
<div id="products" data-url="<?php echo Yii::app()->createUrl('mark/products'); ?>"></div>