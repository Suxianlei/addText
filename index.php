<?php
/**
 * 给图片添加文字
 *
 * @param string $strImg 图片文件名
 * @param string $strText 字符串内容
 * @param string $filePath 字体文件的相对地址
 * @param array $arrOpt ['r','g','b','x','y','fontsize','angle','savepath','ttf']
 */
function addText($strImg, $strText,$filePath, $arrOpt = array())
{
    //颜色值rgb
    $intR = isset($arrOpt['r']) ? $arrOpt['r'] : 255;
    $intG = isset($arrOpt['g']) ? $arrOpt['g'] : 255;
    $intB = isset($arrOpt['b']) ? $arrOpt['b'] : 255;
    //新添加的文字位于图片Y轴的距离
    $intY = isset($arrOpt['y']) ? $arrOpt['y'] : 1625;

    $intSize = isset($arrOpt['fontsize']) ? $arrOpt['fontsize'] : 36;
    $intAngle = isset($arrOpt['angle']) ? $arrOpt['angle'] : 0;


    $info = pathinfo($filePath);
    $trueFileName = $_SERVER['DOCUMENT_ROOT'].'/'.$info['dirname'].'/'.$info['basename'];
    $strFont = $trueFileName;


    $im = imagecreatefromjpeg($strImg);
    $width =imagesx($im);

    $color = imagecolorallocate($im, $intR, $intG, $intB);

    $fontBox = imagettfbbox($intSize, 0, $strFont, $strText);//文字水平居中实质
    imagettftext($im, $intSize, $intAngle, ceil(($width - $fontBox[2]) / 2), $intY, $color, $strFont, $strText);
    imagejpeg($im, $strImg);
    imagedestroy($im);
}



