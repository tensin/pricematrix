<?php
class FileController extends Controller
{

	public $layout='//layouts/column2';
	const FILE_SAVE_PATH = './protected/data/prices';
	
	/**
	 * Display all files downloaded by current user
	 */
	public function actionList()
	{
		$dataProvider=new CActiveDataProvider('UserFile', array(
			'criteria' => array(
				'order' => 'id DESC',
				'condition' => 'userId = ' . Yii::app()->user->id,
			),
			'pagination' => array(
				'pageSize' => 15,
			),
		));
		
		$this->render('list',array(
			'dataProvider'=>$dataProvider,
		));
	}
	public function actionCreate()
	{
		/**
		 * Зарегистрируем два сценария добавления файлов:
		 *
		 * 1. createByFile - загрузка файла пользователем через соотвествующую форму;
		 * 2. createByUrl - загрузка файла через url (http).
		 */
		
		$model = new UserFile();
		
		$uid = Yii::app()->getUser()->getId();
		
		$templates=Template::model()->findAllByUserId($uid);

		//print_r($templates);

		if(isset($_POST['UserFile']) && isset($_POST['UserFile']['uploadType']) && in_array($_POST['UserFile']['uploadType'], array('createByFile', 'createByUrl')))
		{
			/**
			 * Проверяем что было загружено пользователем: файл или url?
			 */
			 
			$model->scenario = $_POST['UserFile']['uploadType'];
			$model->file = CUploadedFile::getInstance($model,'file');
			$hash = md5_file($model->file->getTempName());
			$model->hash = $hash;
			$model->mime = $model->file->getType();
			$model->userId = $uid;
				
			//var_dump($model->validate());			
			//print_r($model->getErrors());
			
			
			if ($model->validate()) {
				/**
				 * check md5 hash trying to find similar files
				 */
				
				$alreadyExists = UserFile::model()->findByAttributes(compact('hash'));
				
				if(!is_null($alreadyExists)) {
					//  добавляем существующий файл в файлы пользователя
					$this->redirect( Yii::app()->createUrl('file/view',array('priceHash'=>$alreadyExists->hash,'templateId'=>$alreadyExists->templateId)));
					// die('Current file already exists');
				}
				
				
				
				$model->templateId = -1;
				$model->created = new CDbExpression('NOW()');
				copy($model->file->getTempName(), $newFilename = self::FILE_SAVE_PATH . '/' . $model->hash . '.' . $model->file->getExtensionName());
                chmod($newFilename, 0664);
                $model->save();
				
				$this->redirect( Yii::app()->createUrl('file/view',array('priceHash'=>$model->hash,'templateId'=>$model->templateId)));
						
			}
				
				
			$this->render('create', compact('model', 'templates'));
			Yii::app()->end();
			
			//if ($fileHarddisk === NULL) {
			//	Yii::app()->user->setFlash('warning', '<strong>Warning!</strong> You have to select file before continue.');
				
			//}



			//if (!is_null($file))var_dump(CUploadedFile::getInstance($model,'filename'));
			
            if (!empty($_POST['UserFile']))
            {
                $model->filename = CUploadedFile::getInstance($model,'filename');
                $model->templateId = 1;
                $model->hash = md5_file($model->filename->getTempName());
                $model->mime = $model->filename->getType();
                $model->userId = $uid;

                //допустимы только несколько форматов файлов
                if ($model->filename->getExtensionName()=="xls" or $model->filename->getExtensionName()=="xml" or $model->filename->getExtensionName()=="xlsx" or $model->filename->getExtensionName()=="csv")
                {
                    //проверяем, загружен ли уже идzентичный по md5 файл
                    if($model->validate($model->hash))
                    {
                        $model->created = new CDbExpression('NOW()');
                        copy($model->filename->getTempName(), $newFilename = self::FILE_SAVE_PATH . '/' . $model->hash . '.' . $model->filename->getExtensionName());
                        chmod($newFilename, 0664);
                        $model->save();
                        Yii::app()->user->setFlash('user-file-added','Your file is correctly saved, go to file\'s list and parse it');
                    }
                }

                else throw new CHttpException(404, 'На данный момент мы не располагаем данным функционалом.');

                $templateId=$_POST['UserFile']["templateId"];

                $this->redirect( Yii::app()->createUrl('user/readerpreview',array('priceHash'=>$model->hash,'templateId'=>$templateId)));
            }
            else
            {
                Yii::app()->user->setFlash('user-file-added','File error');
            }
		}
        else
        {
            $this->render('create',compact('model', 'templates'));
        }
	}
}