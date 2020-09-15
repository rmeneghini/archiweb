<?php /* @var $this Controller */ ?>

<?php $this->beginContent('//layouts/main'); ?>

<!--<div class="row">-->

    <!-- <article class="col-xs-11 col-sm-9 col-md-10"> -->
    <div class="col-md-9 columna-1">

            <?php echo $content; ?>
		</div>
    <!-- </article> -->

    <aside class="col-md-3 sidebar">

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