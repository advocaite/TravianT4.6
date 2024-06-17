<?php

namespace Controller\Ajax;

use function array_key_exists;
use Core\Session;
use Game\Hero\HeroFace;
use Core\Locale;
use Model\HeroFaceModel;

class heroEditor extends AjaxBase
{
    private function validate(HeroFace $f, $attribs)
    {
        if ($attribs['gender'] != "male" && $attribs['gender'] != "female") {
            return FALSE;
        }
        foreach ($attribs as $key => $value) {//validate
            if ($key == "uid" || $key == "gender") {
                continue;
            }
            if (!$f->isValid($value, $attribs['gender'], $key)) {
                if ($key != 'lastupdate') {
                    return FALSE;
                }
            }
        }

        return TRUE;
    }

    public function getImageButton($type, $html)
    {
        $translate = T("HeroFace", $type);

        return <<<HTML
<div class="info" id="{$type}"><div class="headline switchClosed"><a href="#" class="title">{$translate}</a><div class="clear"></div></div><div class="details">{$html}<div class="clear"></div></div></div>
HTML;
    }

    private function getInput($name, $default = null)
    {
        return array_key_exists($name, $_REQUEST) ? $_REQUEST[$name] : $default;
    }

    public function dispatch()
    {
        $f = new HeroFace();
        $attribs = (array)$this->getInput('attribs', []);
        $action = $this->getInput('action');
        switch ($action) {
            case "show":
                if (!$this->validate($f, $attribs)) {
                    return FALSE;
                }
                $this->response['data']['attributes'] = $attribs;
                $this->response['data']['html'] = $f->getHeroImageAsHTML($f->decodeAttribute($attribs));

                return TRUE;
                break;
            case "gender":
                if ($attribs['gender'] != "male" && $attribs['gender'] != "female") {
                    return FALSE;
                }
                $this->response['data']['attributesHtml'] = "";
                foreach ($f->getAllHeroFaceAttributes($attribs['gender']) as $key => $value) {
                    $this->response['data']['attributesHtml'] .= $this->getImageButton($key, $value);
                }
                $this->response['data']['attributes'] = $f->getRandomHeroFace($attribs['gender']);
                $this->response['data']['html'] = $f->getHeroImageAsHTML($f->decodeAttribute($this->response['data']['attributes']));

                return TRUE;
                break;
            case "random":
                $this->response['data']['attributes'] = $f->getRandomHeroFace($attribs['gender']);
                $this->response['data']['html'] = $f->getHeroImageAsHTML($f->decodeAttribute($this->response['data']['attributes']));

                return TRUE;
                break;
            case "save":
                if (!$this->validate($f, $attribs)) {
                    return FALSE;
                }
                $m = new HeroFaceModel();
                $m->modifyWholeHeroFace(Session::getInstance()->getPlayerId(), $f->decodeAttribute($attribs));
                $this->response['data']['attributes'] = $attribs;
                $this->response['data']['html'] = $f->getHeroImageAsHTML($f->decodeAttribute($this->response['data']['attributes']));
                return TRUE;
                break;
        }
        return false;
    }
} 