<?php
namespace Core\Templates;
class HTMLResponse
{
    public static function renderErrMessageDialog($title, $message)
    {
        $view = new PHPView();
        $view->vars['title'] = $title;
        $view->vars['message'] = $message;
        return $view->render('errorMessage');
    }

    public static function renderPackageDialog($providerName, $providerImage, $goldNum, $productName, $priceAndMoneyUnit, $order)
    {
        $view = new PHPView();
        $view->vars['providerName'] = $providerName;
        $view->vars['providerImage'] = $providerImage;
        $view->vars['goldNum'] = $goldNum;
        $view->vars['productName'] = $productName;
        $view->vars['priceAndMoneyUnit'] = $priceAndMoneyUnit;
        $view->vars['order'] = $order;
        return $view->render('onLoadProvider');
    }

    public static function renderLoadingDialog($providerName, $order, $isHTML)
    {
        $view = new PHPView();
        $view->vars['providerName'] = $providerName;
        $view->vars['isHTML'] = $isHTML;
        $view->vars['order'] = $order;
        return $view->render('preLoadProvider');
    }
}