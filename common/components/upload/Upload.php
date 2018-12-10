<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/11/29 Time: 11:16 AM
//---------------------------------------------------------

namespace common\components\upload;

use yii\base\Exception;
use yii\web\UploadedFile;

class Upload extends \common\components\BaseComponents
{
    /**
     * @var int 最大上传大小
     */
    public $maxSize;

    /**
     * @var string 存储路径
     */
    public $savePath = '/uploads';

    /**
     * @var [] 允许的后缀
     */
    public $allowExtension = ['jpg', 'jpeg', 'gif', 'png'];

    /**
     * @var string body 字段名称
     */
    public $fileName = 'file';


    /**
     * @var string 上传驱动
     */
    public $handleClass = '';


    private $handler;

    public function exec()
    {
        $file = $this->getFile();
    }

    /**
     * 获取上传文件
     * @return null|UploadedFile
     * @throws Exception
     */
    public function getFile()
    {
        $uploadedFile = UploadedFile::getInstanceByName($this->fileName);

        if (!$uploadedFile) {
            throw new Exception('没有文件被上传');
        }

        return $uploadedFile;
    }

    public function validateFile($file)
    {
        if ($file instanceof UploadedFile) {
            $fileSize = $file->size;
            $extension = $file->getExtension();
        } else {
            $pathInfo = pathinfo($file);
            $extension = $pathInfo['extension'];
            $fileSize = filesize($file);
        }
    }
}
