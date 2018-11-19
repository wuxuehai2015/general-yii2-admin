<?php
//---------------------------------------------------------
//               Buddha Bless, No Bug !
//         User: wuxuehai Date: 2018/7/31 Time: 上午11:24
//---------------------------------------------------------
namespace common\services;

use Yii;
use common\models\OperationLog;

class HelpService
{
    /**
     * 操作日志
     * @param $action
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
    public static function operationLog($action)
    {
        $identity = Yii::$app->user->identity;
        $operationLog = new OperationLog();
        $operationLog->action = $action;
        $operationLog->uri = Yii::$app->getRequest()->getUrl();
        $operationLog->ip = Yii::$app->getRequest()->getRemoteIP();
        $operationLog->identity_id = $identity->getId();
        $operationLog->identity_name = $identity->username;
        $operationLog->created_at = time();
        return $operationLog->save(false);
    }


    /**
     * 获取pdf页数
     * @param $path
     * @return int
     * @throws \Exception
     */
    public static function getPdfPages($path)
    {
        if (!file_exists($path)) {
            throw new \Exception('文件不存在');
        }
        if (!is_readable($path)) {
            throw new \Exception('文件不可读');
        }
        $pdfContent = file_get_contents($path);
        $pages = preg_match_all("/\/Page\W/", $pdfContent, $dummy);

        // 返回页数
        return $pages;
    }

    /**
     * office文件转pdf
     * @param $officeFile
     * @param $outDir
     */
    public static function officeFile2Pdf($officeFile, $outDir)
    {
        exec("/usr/bin/libreoffice6.1 --invisible --convert-to pdf {$officeFile} --outdir {$outDir}");
    }

    /**
     * pdf文件转svg
     * @param $pdfFile
     * @param $svgFile
     * @param string $page
     */
    public static function pdf2svg($pdfFile, $svgFile, $page = 'all')
    {
        //pdf2svg <input.pdf> <output.svg> [<pdf page no. or "all" >]
        exec("pdf2svg {$pdfFile} {$svgFile} {$page}");
    }

    public static function pdf2jpg($file_name)
    {
        $file_name = basename($file_name, '.pdf');
        $img = new \imagick($file_name . '.pdf');
        $img->setImageBackgroundColor('white');
        //$img = $img->flattenImages();
        $img->setResolution(300, 300);
        $num_pages = $img->getNumberImages();
        $img->setImageCompressionQuality(100);
        $imgs = array();
        for ($i = 0; $i < $num_pages; $i++) {
            $img->setIteratorIndex($i);
            $img->setImageFormat('jpeg');
            $img->writeImage($file_name . '-' . $i . '.jpg');
            $imgs[] = $file_name . '-' . $i . '.jpg';
        }
        $img->destroy();
        return $imgs;
    }

    /**
     * svg文件转png文件
     * @param $svgFile
     * @param $pngFile
     */
    public static function svg2png($svgFile, $pngFile)
    {
        //http://www.linuxfromscratch.org/blfs/view/stable/general/librsvg.html
        exec("rsvg-convert -o {$pngFile} {$svgFile}");
    }

    /**
     * 优化压缩svg
     * @param $dir
     */
    public static function svgOptimization($dir){
        exec("svgo -f {$dir}");
    }
}
