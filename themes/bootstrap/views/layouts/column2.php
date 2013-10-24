<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
    
    <div class="span3">

        <div>
            <?php
            $this->beginWidget('zii.widgets.CPortlet', array(
                'title'=>'Операции',
            ));
            $this->widget('bootstrap.widgets.TbMenu', array(
                'items'=>$this->menu,
                'htmlOptions'=>array('class'=>'operations'),
            ));
            $this->endWidget();
            ?>
        </div>

        <div id="sidebar">
            <?php $this->widget('bootstrap.widgets.TbMenu', array(
                'type'=>'list',
                'items'=>array(
                    array('label'=>'Главное меню'),
                    array('label'=>'Продажа автостекла', 'url'=>'#'),
                    array('label'=>'Установка автостекла', 'url'=>'#'),
                    array('label'=>'Аксессуары', 'url'=>'#'),
                    array('label'=>'Контакты', 'url'=>'#'),
                    array('label'=>'Оптовикам', 'url'=>'#'),
                ),
            )); ?>
        </div><!--/sidebar-->

        <div id="qform">

            <h2>Задать вопрос</h2>

            <?php
            $model = new Qa;

            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm');
            
            echo $form->textFieldRow($model, 'username', array('placeholder' => 'Ваше имя'));
            echo $form->textAreaRow($model, 'question', array('placeholder' => 'Вопрос', 'rows' => 5));
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'ajaxSubmit',
                'label' => 'Отправить',
                'url' => Yii::app()->createUrl('qa/create'),
                'ajaxOptions' => array(
                    'type' => 'post',
                    'cache' => false,
                    'beforeSend' => 'function() {
                        var username = $("#Qa_username").val();
                        var question = $("#Qa_question").val();

                        $("#Qa_username, #Qa_question").removeClass("error");

                        if (!(username && question)) {
                            alert("Необходимо заполнить поля!");
                            if (!username) {
                                $("#Qa_username").addClass("error");
                            }
                            if (!question) {
                                $("#Qa_question").addClass("error");
                            }
                            return false;
                        }
                    }',
                    'success' => 'function() {
                        alert("Ваш вопрос отправлен");
                        $("#Qa_username, #Qa_question").val("");
                    }',
                )
            ));
            
            $this->endWidget();
            ?>

        </div><!--/qform-->

        <div id="news">

            <h2>Новости</h2>

            <?php
            foreach (News::getLastNews() as $value) {
                echo '<div><span>', $value['date'], '</span><br><a href="#" class="preview">', $value['preview'], '</a></div>';
            }
            ?>            
            
            <a href="#" class="archive">Архив новостей</a>
        </div><!--/news-->

    </div>

    <div class="span9">

        <div id="content">
            <?php echo $content; ?>
        </div><!--/content-->

    </div>

</div>
<?php $this->endContent(); ?>