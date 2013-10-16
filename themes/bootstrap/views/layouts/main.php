<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="ru">
	<?php Yii::app()->bootstrap->register(); ?>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css">
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/script.js"></script>
</head>

<body>

	<div class="container" id="page">

		<div id="header">
			<ul>
				<li>Малыгина, 8/5<a href="#">Посмотреть на карте</a></li>
				<li class="phone">(3452) 55-44-22<a href="#">Заказать обратный звонок</a></li>
			</ul>
			<h1 id="logo">Glass72</h1>
			<h2 id="slogan">Продажа и установка автостекол</h2>
		</div><!--/header-->

		<div class="clear"></div>

		<?php echo $content; ?>

		<div class="clear"></div>

		<div id="footer">
			<p>Продажа и установка автостекол <?php echo date('Y'); ?> &copy;</p>
			<ul>
				<li><a href="#">Главная</a></li>
				<li><a href="#">Вопрос-ответ</a></li>
				<li><a href="#">Запись на установку</a></li>
				<li><a href="#">Прайслист</a></li>
			</ul>
		</div><!--/footer-->

	</div><!--/page-->

</body><!--zy-->
</html>
