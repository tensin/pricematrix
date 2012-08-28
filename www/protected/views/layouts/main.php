<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="ru" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<style>
	<!--
	.subnav {
  font-size:12px;
  padding:9px 0;
  position:fixed;
  right:20px;
  top:60px;
  width:200px;
  z-index:1030;
  -webkit-border-radius:4px;
  -moz-border-radius:4px;
  border-radius:4px;
}
.subnav .label {
  font-size:0.8em;
  line-height:16px;
  vertical-align:top;
}
-->
	</style>
</head>
<body id='top' style='margin-top: 60px;'>
<?php $this->widget('bootstrap.widgets.TbNavbar', array(
    //'fixed'=>true,
    'brand'=>CHtml::encode(Yii::app()->name),
    'brandUrl'=>array('/site/index'),
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'Home', 'url'=>'#', 'active'=>true),
                array('label'=>'Link', 'url'=>'#'),
                array('label'=>'Dropdown', 'url'=>'#', 'items'=>array(
                    array('label'=>'Action', 'url'=>'#'),
                    array('label'=>'Another action', 'url'=>'#'),
                    array('label'=>'Something else here', 'url'=>'#'),
                    '---',
                    array('label'=>'NAV HEADER'),
                    array('label'=>'Separated link', 'url'=>'#'),
                    array('label'=>'One more separated link', 'url'=>'#'),
                )),
            ),
        ),
        //'<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Search"></form>',
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                array('label'=>'Link', 'url'=>'#'),
                '---',
                array('label'=>'Dropdown', 'url'=>'#', 'items'=>array(
                    array('label'=>'Action', 'url'=>'#'),
                    array('label'=>'Another action', 'url'=>'#'),
                    array('label'=>'Something else here', 'url'=>'#'),
                    '---',
                    array('label'=>'Separated link', 'url'=>'#'),
                )),
				((Yii::app()->user->isGuest) ? array('label'=>'Sign in', 'url'=>array('/user/auth')) : array('label'=>'Sign out (' . Yii::app()->user->name . ')' , 'url'=>array('/user/logout'))),
            ),
        ),
    ),
)); 


//var_dump(Yii::app()->user->name);
?>


<div class='container'>
	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				//array('label'=>'Home', 'url'=>array('/site/index')),
				//array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				//array('label'=>'Contact', 'url'=>array('/site/contact')),
                array('label'=>'Загрузка прайса', 'url'=>array('suser/fileadd')),
                array('label'=>'Поставщики', 'url'=>array('/supplier')),
                array('label'=>'Синонимы', 'url'=>array('/tireSynonym')),
                array('label'=>'Управление ценообразованием', 'url'=>array('rule/index')),
				array('label'=>'Вход', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Выход ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
	</div><!-- mainmenu -->
<?php echo $content; ?>
</div>

</body>