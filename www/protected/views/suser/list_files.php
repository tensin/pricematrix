<?php

$this->menu=array(
    array('label'=>'Мои поставщики', 'url'=>array('suppliers')),
    array('label'=>'Мои файлы', 'url'=>array('files')),
    array('label'=>'Загрузить новый прайс', 'url'=>array('fileadd')),
    //array('label'=>'Create TireSize', 'url'=>array('create')),
);

 $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		//'filename',
		'id', 'userId', 'templateId', 'mime', 'created',
		array(
			'header'=>'Actions',
			'class'=>'CLinkColumn',
			'label'=>'Preview',
			'urlExpression'=> 'Yii::app()->createUrl("user/readerpreview",array("priceHash" => $data->hash, "templateId"=>$data->templateId))',
		),
	),
	
	/*'columns'=>array(
        array(
			'name' => 'title',
			'value' => '$data->title',
			),
		array(
			'name' => 'kind_id',
			'value' => '$data->kind->title',
			),
		
		// ?????? ?????
		array(
            'class'=>'CButtonColumn',
            'template'=>'{up}',
            'buttons'=>array(
					'up' => array(
							'label' => '?????',
							'visible'=>'!(Excel::model()->bySortAsc()->find()->id == $data->id)',
							'imageUrl' => "{$basepath}/up.gif",
							'url'   => 'Yii::app()->controller->createUrl("excel/move", array("direction" => "up", "id" => $data->id))',
					),
			),
		),
		// ?????? ????
		array(
            'class'=>'CButtonColumn',
            'template'=>'{down}',
            'buttons'=>array(
					'down' => array(
							'label' => '????',
							'visible'=>'!(Excel::model()->bySortDesc()->find()->id == $data->id)',
							'imageUrl' => "{$basepath}/down.gif",
							'url' => 'Yii::app()->controller->createUrl("excel/move", array("direction" => "down", "id" => $data->id))',
					),
			),
		),

		// ?????? ???????
		array(
            'class'=>'CButtonColumn',
            'template'=>'{del}',
            'buttons'=>array(
					'del' => array(
							'label' => '???????',
							'imageUrl' => "{$basepath}/delete.gif",
							'url' => 'Yii::app()->controller->createUrl("excel/delete", array("id" => $data->id))',
							'click'=>'function(){return confirm("'.Yii::t('lan','?? ???????, ??? ?????? ??????? ?????? ????????').'");}',
					),
			),
		),
		
		),*/
)); ?>