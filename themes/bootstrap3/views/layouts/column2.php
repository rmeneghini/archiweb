<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<!--<div class="row">-->
    <article class="col-xs-11 col-sm-9 col-md-10">
            <?php echo $content; ?>
    </article>
    <aside class="col-xs-11 col-sm-3 col-md-2">
        <?php
            $this->beginWidget('zii.widgets.CPortlet', array(
                'title'=>'Operaciones',
            ));
            $this->widget('booster.widgets.TbMenu', array(
                'type' => 'list',
                'items'=>$this->menu,
                'htmlOptions'=>array('class'=>'operations'),
            ));
           $this->endWidget();
        ?>
    </aside>
<!--</div>-->
<?php $this->endContent(); ?>