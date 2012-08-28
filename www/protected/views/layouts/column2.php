<?php $this->beginContent('//layouts/main'); ?>
<?php echo $content; ?>
<div class='subnav well'>
<?php
		//print_r($this->menu);
	$this->widget('bootstrap.widgets.TbMenu', array(
		'type'=>'list',
		'items'=>array_merge(array(
			array('label'=>'LIST HEADER'),
			array('label'=>'Home', 'icon'=>'home', 'url'=>'#', 'active'=>true),
			array('label'=>'Library', 'icon'=>'book', 'url'=>'#'),
			array('label'=>'Application', 'icon'=>'pencil', 'url'=>'#'),
			array('label'=>'ANOTHER LIST HEADER'),
			array('label'=>'Profile', 'icon'=>'user', 'url'=>'#'),
			array('label'=>'Settings', 'icon'=>'cog', 'url'=>'#'),
			array('label'=>'Help', 'icon'=>'flag', 'url'=>'#'),
			),$this->menu)
	)); 

?>
</div>
<?php $this->endContent(); ?>