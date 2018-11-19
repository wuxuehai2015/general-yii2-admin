<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/8/21 Time: 下午4:47
//---------------------------------------------------------

namespace common\services;

use common\models\Document\Document;
use yii\base\BaseObject;

class DocumentService extends BaseObject
{

    /**
     * 生成文档
     * @param $documentId
     * @return bool
     */
    public static function generateFiles($documentId)
    {
        $document = Document::findOne(['id' => $documentId]);
        $saveDir = Document::getDocumentSaveDir() . $document->md5 . '/';
        $tempFdfFileName = $saveDir . $document->re_name . '.pdf';

        if ($document->extension != 'pdf') {
            //生成PDF
            HelpService::officeFile2Pdf($saveDir . $document->re_name . '.' . $document->extension, $saveDir);

            if (!file_exists($tempFdfFileName)) {
                echo '文件转PDF失败';
                return false;
            }
        } else {

        }

        //获取pdf页数
        try {
            $pages = HelpService::getPdfPages($tempFdfFileName);

            for ($i = 1; $i <= $pages; $i++) {
                //生成svg文件
                HelpService::pdf2svg($tempFdfFileName, "{$saveDir}{$document->re_name}_{$i}.svg", $i);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }

        //优化svg文件
        HelpService::svgOptimization($saveDir);

        //封面为空时-默认第一张svg为封面
        if (empty($document->cover)) {
            HelpService::svg2png("{$saveDir}{$document->re_name}_1.svg", Document::getCoverSaveDir() . $document->re_name . '.png');
            $document->cover = Document::getCoverSaveDir(false) . $document->re_name . '.png';
        }

        $document->generate_status = Document::GENERATE_STATUS_FINISHED;
        $document->pages = $pages;
        $document->save(false);

        return true;
    }
}
