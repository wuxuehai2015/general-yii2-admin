<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/8/1 Time: 上午11:31
//---------------------------------------------------------

namespace common\services;


use common\models\File;
use Yii;
use yii\base\BaseObject;
use yii\web\UploadedFile;

class UploadService extends BaseObject
{
    public $savePath = '/uploads/file/';

    public $maxSize = 200000000;

    public $allowExtension = ['jpg', 'jpeg', 'png', 'gif', 'docx', 'doc', 'pdf'];

    public function init()
    {
        if (!file_exists(Yii::$app->params['uploadPath'] . $this->savePath)) {
            mkdir(Yii::$app->params['uploadPath'] . $this->savePath);
        }
    }

    /**
     * @param string $fieldName
     * @return CallBackService
     */
    public function upload($fieldName = 'file')
    {
        $callBack = new CallBackService();

        try {

            $file = UploadedFile::getInstanceByName($fieldName);

            if (empty($file)) {
                throw new \Exception(Yii::t('app', 'upload file fail'));
            }

            if ($file->size > $this->maxSize) {
                throw new \Exception(Yii::t('app', 'file size max {maxSize}', ['maxsize' => $this->maxSize]));
            }

            if (!in_array($file->extension, $this->allowExtension)) {
                throw new \Exception(Yii::t('app', 'file suffix that is not allowed'));
            }

            if (!file_exists(Yii::$app->params['uploadPath'] . $this->savePath)) {
                mkdir(Yii::$app->params['uploadPath'] . $this->savePath, true);
            }

            //文件记录入库
            $fileModel = new File();
            $fileModel->name = $file->baseName;
            $fileModel->path = $this->savePath . md5($file->baseName) . '.' . $file->extension;
            $fileModel->extension = $file->extension;
            $fileModel->size = $file->size;
            $fileModel->md5 = md5(file_get_contents($file->tempName));
            $fileModel->identity_id = Yii::$app->user->id;
            $fileModel->identity_name = Yii::$app->user->identity->username;
            $fileModel->save(false);

            $fullPath = Yii::$app->params['uploadPath'] . $this->savePath . md5($file->baseName) . '.' . $file->extension;

            if (!$file->saveAs($fullPath)) {
                throw new \Exception(Yii::t('app', 'save file fail'));
            }

            $callBack->result(true, Yii::t('app', 'success'), [
                'path' => $this->savePath . md5($file->baseName) . '.' . $file->extension
            ]);

        } catch (\Exception $e) {
            $callBack->result(false, $e->getMessage());
        }

        return $callBack;
    }
}
