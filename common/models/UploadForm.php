<?php
/**
 * Created by PhpStorm.
 * User: GTT
 * Date: 2017/12/6 0006
 * Time: 15:23
 */
namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * UploadForm is the model behind the upload form.
 */
class UploadForm extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'], 'file', 'extensions' => 'jpg,png', 'mimeTypes' => 'image/jpeg,image/png'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'file' => '上传文件'
        ];
    }
}