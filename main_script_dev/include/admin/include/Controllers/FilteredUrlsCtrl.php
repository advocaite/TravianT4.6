<?php

use Core\Caching\GlobalCaching;
use Core\Helper\WebService;
use Core\Session;

class FilteredUrlsCtrl
{
    private $cacheKey = 'filteredUrlsCache';
    private $fileName = 'filteredUrls.txt';
    public function __construct()
    {
        $params = [
            'urls' => isset($_POST['urls']) ? trim(filter_var($_POST['urls'])) : null
        ];
        if(!isServerFinished() && WebService::isPost() && Session::validateChecker()){
            ;
            if(!empty($params['urls'])){
                $current = $this->getFromCache();
                $add = array_map('trim', explode(",", $params['urls']));
                foreach($add as $value){
                    $current[] = $value;
                }
                $current = array_map('trim', $current);
                $current = array_map('strtolower', $current);
                $current = array_unique($current);
                $this->insertToFile(implode(",", $current));
                $params['error'] = 'urls added.';
            } else {
                $params['error'] = 'no urls to filter!';
            }
        } else {
            if(!isServerFinished() && isset($_GET['del']) && Session::validateChecker()){
                ;
                $current = $this->getFromCache();
                $_GET['del'] = (int)$_GET['del'];
                if(sizeof($current) > 1){
                    if(isset($current[$_GET['del']])){
                        unset($current[$_GET['del']]);
                    }
                    $this->insertToFile(implode(",", $current));
                }
            }
        }
        $params['content'] = $this->getFromCache();
        $params['total'] = sizeof($params['content']);
        Dispatcher::getInstance()->appendContent(Template::getInstance()->load($params, 'tpl/filteredUrls.tpl')->getAsString());
    }
    public function getFromCache(){
        $cache = GlobalCaching::getInstance();
        if(!($cached = $cache->get($this->cacheKey))){
            $cached = explode(",", file_get_contents(FILTERING_PATH . $this->fileName));
            $cache->set($this->cacheKey, $cached, 2*86400);
        }
        return $cached;
    }
    public function insertToFile($content){
        fclose(fopen(FILTERING_PATH . $this->fileName, 'w'));
        if(!empty($content)){
            file_put_contents(FILTERING_PATH . $this->fileName, $content) or die("File write failed.");
        }
        $this->expireCache();
    }
    public function expireCache(){
        GlobalCaching::getInstance()->delete($this->cacheKey);
        $this->getFromCache();
    }
}