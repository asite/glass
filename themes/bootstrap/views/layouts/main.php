<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="ru">
	<?php Yii::app()->bootstrap->register(); ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css">
    <script src="//ajax.googleapis.com/ajax/libs/mootools/1.4.5/mootools-yui-compressed.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/script.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/cssfix.js"></script>
    <!--[if (gte IE 6)&(lte IE 8)]>
	  <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/selectivizr-min.js"></script>
	<![endif]-->
</head>

<body>

	<div class="container" id="page">

		<div id="header">
			<ul>
				<li>ул. Малыгина д.5<a href="#">Посмотреть на карте</a></li>
				<li class="phone"><span>Появились вопросы? Позвоните нам!</span>(3452) <em>55 44 22</em></li>
			</ul>
			<a href="<?php echo Yii::app()->baseUrl; ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logo.png" alt="Glass72.ru" id="logo"></a>
		</div><!--/header-->

		<div id="slider">
			<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/slide.jpg" alt="Автостекла">
		</div><!--/slider-->

		<div class="clear"></div>

		<?php echo $content; ?>

		<div class="clear"></div>

		<div id="footer">
			<img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logo.png" alt="Glass72.ru">
			<p>&copy; <?php echo date('Y'); ?> glass72.ru<br>Все права охраняются законом</p>
			<ul>
				<li><a href="#">Главная</a></li>
				<li><a href="#">Вопрос\ответ</a></li>
				<li><a href="#">Запись на установку</a></li>
				<li><a href="#">Прайслист</a></li>
			</ul>
		</div><!--/footer-->

	</div><!--/page-->

</body><!--zy-->
</html>
