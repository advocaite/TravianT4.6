<?php

namespace Controller;

use Core\Helper\PageNavigator;
use Core\Session;
use Core\Village;
use Game\Formulas;
use Core\Locale;
use Model\CropFinderModel;
use resources\View\GameView;
use resources\View\PHPBatchView;

class CropfinderCtrl extends GameCtrl
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->hasGoldClub()) {
            $this->redirect("karte.php"); //wow ! you find it!
        }
        $this->view = new GameView();
        $this->view->vars['titleInHeader'] = T("cropFinder", "title");
        $this->view->vars['bodyCssClass'] = 'perspectiveResources';
        $this->view->vars['contentCssClass'] = 'cropfinder';
        $settings = new PHPBatchView("cropfinder/settings");
        if (isset($_REQUEST['typ']) && in_array($_REQUEST['typ'], ["all", 9, 15,])) {
            $settings->vars['typ'] = $_REQUEST['typ'];
        } else {
            $settings->vars['typ'] = 'all';
        }
        if (isset($_REQUEST['bonus_getreide']) && in_array($_REQUEST['bonus_getreide'],
                ["all", 25, 50, 75, 100, 125, 150,])) {
            $settings->vars['bonus_getreide'] = $_REQUEST['bonus_getreide'];
        } else {
            $settings->vars['bonus_getreide'] = '25';
        }
        if (isset($_REQUEST['only_free'])) {
            $settings->vars['only_free'] = (int)$_REQUEST['only_free'] === 1;
        } else {
            $settings->vars['only_free'] = FALSE;
        }
        if (isset($_REQUEST['x']) && isset($_REQUEST['y'])) {
            $settings->vars['x'] = filter_var($_REQUEST['x'], FILTER_SANITIZE_NUMBER_INT);
            $settings->vars['y'] = filter_var($_REQUEST['y'], FILTER_SANITIZE_NUMBER_INT);
        } else {
            $xy = Formulas::kid2xy(Village::getInstance()->getKid());
            $settings->vars['x'] = $xy['x'];
            $settings->vars['y'] = $xy['y'];
        }
        $this->view->vars['content'] .= $settings->output();
        if (isset($_REQUEST['bonus_getreide']) && isset($_REQUEST['x']) && isset($_REQUEST['y']) && isset($_REQUEST['typ'])) {
            $m = new CropFinderModel();
            $page = isset($_GET['page']) ? filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT) : 1;
            $croppers = $m->getCroppers($page,
                (int)$settings->vars['x'],
                (int)$settings->vars['y'],
                $settings->vars['typ'],
                $settings->vars['bonus_getreide'],
                $settings->vars['only_free']);
            $croplands = new PHPBatchView("cropfinder/table");
            $croplands->vars['tbody'] = '';
            $direction = strtolower(getDirection());
            while ($row = $croppers->fetch_assoc()) {
                $croplands->vars['tbody'] .= ' <tr>';
                $croplands->vars['tbody'] .= '<td class="dist">' . round($row['distance'], 1) . '</td>';
                $croplands->vars['tbody'] .= '<td class="coords"><a class="" href="karte.php?x=' . $row['x'] . '&amp;y=' . $row['y'] . '"><span class="coordinates coordinatesWrapper coordinatesAligned coordinates' . $direction . '"><span class="coordinateX">(' . $row['x'] . '</span><span class="coordinatePipe">|</span><span class="coordinateY">' . $row['y'] . ')</span></span>‎</a></td>';
                $croplands->vars['tbody'] .= '<td class="typ">' . ($row['fieldtype'] == 1 ? '9' : '15') . ' ' . T("cropFinder", "cropper") . '</td>';
                $croplands->vars['tbody'] .= '<td class="oase"><div class="inlineIconList resourceWrapper"><div class="inlineIcon resources"><i class="r4"></i><span class="value ">&#8237;+&#8237;'.$row['crop_percent'].'&#8236;%&#8236;</span></div></div></td>';
                $croplands->vars['tbody'] .= '<td class="owned"><a href="karte.php?d=' . $row['id'] . '">' . $m->getCroplandOccupiedBy($row) . '</a></td>';
                $croplands->vars['tbody'] .= '<td>' . $m->getAllianceTag($row) . '</td>';
            }
            if (!$croppers->num_rows) {
                $croplands->vars['tbody'] = '<tr><td colspan="6" class="noData">' . T("cropFinder", "noRows") . '</td></tr>';
            }
            $prefix = [];
            $prefix['x'] = $settings->vars['x'];
            $prefix['y'] = $settings->vars['y'];
            $prefix['bonus_getreide'] = $settings->vars['bonus_getreide'];
            $prefix['only_free'] = $settings->vars['only_free'];
            $prefix['typ'] = $settings->vars['typ'];
            $totalSize = $m->getTotalSize($settings->vars['typ'], $settings->vars['bonus_getreide'], $settings->vars['only_free']);
            $pages = new PageNavigator($page, $totalSize, 50, $prefix, "cropfinder.php");
            $croplands->vars['pages'] = $pages->get();
            $this->view->vars['content'] .= $croplands->output();
        }
    }
}