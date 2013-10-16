<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
    
    <div class="span3">
        <div id="sidebar">
            <?php $this->widget('bootstrap.widgets.TbMenu', array(
                'type'=>'list',
                'items'=>array(
                    array('label'=>'Glass72'),
                    array('label'=>'Продажа', 'icon'=>'shopping-cart', 'url'=>'#'),
                    array('label'=>'Установка', 'icon'=>'wrench', 'url'=>'#'),
                    array('label'=>'Аксессуары', 'icon'=>'paperclip', 'url'=>'#'),
                    array('label'=>'Контакты', 'icon'=>'phone-alt', 'url'=>'#'),
                    array('label'=>'Оптовикам', 'icon'=>'plane', 'url'=>'#'),
                ),
            )); ?>
        </div><!-- sidebar -->
    </div>

    <div class="span9">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>

</div>
<?php $this->endContent(); ?>