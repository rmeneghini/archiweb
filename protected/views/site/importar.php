<div id="wizard-bar" class="progress progress-striped active">
  <div class="progress-bar"  style="width: 0"></div>
</div>
<?php
/* @var $this SiteController */

$this->widget(
    'booster.widgets.TbWizard',
    array(
        'type' => 'tabs', // 'tabs' or 'pills'
        'pagerContent' => '<div style="float:right">
					<input type="button" class="btn button-next" name="next" value="Siguiente" />					
				</div>
				<div style="float:left">					
					<input type="button" class="btn button-previous" name="previous" value="Anterior" />
				</div><br /><br />',
        'options' => array(
            'nextSelector' => '.button-next',
            'previousSelector' => '.button-previous',
            'firstSelector' => '.button-first',
            'lastSelector' => '.button-last',
            'onTabShow' => 'js:function(tab, navigation, index) {
						var $total = navigation.find("li").length;
						var $current = index+1;
						var $percent = ($current/$total) * 100;
						$("#wizard-bar > .progress-bar").css({width:$percent+"%"});
			}',
            'onTabClick' => 'js:function(tab, navigation, index) {alert("Debe utilizar los botones Siguiente/Anterior para avanzar en el proceso de importación");return false;}',
        ),
        'tabs' => array(
            array(
                'label' => 'Contribuyentes',
                'content' => $this->renderPartial('contribuyente',array("model"=>$model,),true),
                'active' => ($tabActivo=='contribuyentes')
            ),
            array(
                'label' => 'Cuentas', 
                'content' => $this->renderPartial('cuentas',array("model"=>$model,),true),
                'active' => ($tabActivo=='cuentas')
                ),
            array(
                'label' => 'Cuotas/Deudas', 
                'content' => $this->renderPartial('cuotas',array("model"=>$model,),true),
                'active' => ($tabActivo=='cuotas')
                ),
        ),
    )
); ?>


