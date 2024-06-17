<?php

namespace Controller;

use Core\Config;
use Core\Database\DB;
use Core\Helper\BBCode;
use Core\Helper\PageNavigator;
use Core\Helper\TimezoneHelper;
use Core\Helper\WebService;
use Core\Session;
use Model\AllianceModel;
use Model\ForumModel;
use resources\View\PHPBatchView;

class AllianceForum extends AnyCtrl
{
    /** @var \Model\ForumModel */
    private $model;
    private $selectedAllianceID;

    public function __construct($selectedAllianceID)
    {
        parent::__construct();
        $this->selectedAllianceID = $selectedAllianceID;
        $this->model = new ForumModel();
        $this->view = new PHPBatchView("empty");
        $this->view->vars['content'] = '';
        if (isset($_REQUEST['switch_admin']) && $this->session->hasAlliancePermission(AllianceModel::MANAGE_FORUM) && $this->session->getAllianceId() == $this->selectedAllianceID) {
            $_SESSION[WebService::fixSessionPrefix('FORUM_ADMIN')] = !(isset($_SESSION[WebService::fixSessionPrefix('FORUM_ADMIN')]) && $_SESSION[WebService::fixSessionPrefix('FORUM_ADMIN')]);
        }
        $isAdmin = isset($_SESSION[WebService::fixSessionPrefix('FORUM_ADMIN')]) && $_SESSION[WebService::fixSessionPrefix('FORUM_ADMIN')] && $this->session->hasAlliancePermission(AllianceModel::MANAGE_FORUM) && $this->session->getAllianceId() == $this->selectedAllianceID;
        if (isset($_REQUEST['pid']) && isset($_REQUEST['ac'])) {
            if ($_REQUEST['ac'] == 'editpost') {
                if (!$this->editPost($isAdmin)) {
                    return;
                }
            }
        }
        $adminAction = FALSE;
        if (isset($_REQUEST['admin']) && $this->session->hasAlliancePermission(AllianceModel::MANAGE_FORUM) && $this->session->getAllianceId() == $this->selectedAllianceID) {
            if (isset($_REQUEST['newforum'])) {
                if (!$this->newForum()) {
                    return;
                }
            }
            if (isset($_REQUEST['tid']) && isset($_REQUEST['deltopic'])) {
                $done = $this->model->deleteTopic((int)$_REQUEST['tid'], $this->session->getAllianceId());
                if ($done) {
                    $_REQUEST['fid'] = $done;
                    if (!$this->showForum($isAdmin)) {
                        return;
                    }
                }
            }
            if (isset($_REQUEST['tid']) && isset($_REQUEST['edittopic'])) {
                if (!$this->editTopic($isAdmin)) {
                    return;
                }
            }
            if (isset($_REQUEST['tid']) && isset($_REQUEST['pid']) && isset($_REQUEST['delpost'])) {
                $topic = $this->model->getTopic((int)$_REQUEST['tid']);
                if ($topic === FALSE) {
                    return;
                }
                $forum = $this->model->getForum($this->selectedAllianceID,
                    $this->session->getAllianceId(),
                    $topic['forumId']);
                if ($forum === FALSE || $forum['aid'] != $this->session->getAllianceId()) {
                    return;
                }
                $answers = $this->model->getTopicAnswersCount($topic['id']);
                if ($answers <= 0) {
                    if (!$this->showTopic($isAdmin)) {
                        return;
                    }
                } else {
                    $this->model->deletePost((int)$_REQUEST['pid']);
                }
            }
            if (isset($_REQUEST['fid']) && isset($_REQUEST['pos'])) {
                $adminAction = TRUE;
                $_REQUEST['fid'] = (int)$_REQUEST['fid'];
                $_REQUEST['pos'] = $_REQUEST['pos'] == 1 ? 1 : -1;
                $this->model->changeForumPosition($this->session->getAllianceId(),
                    $_REQUEST['fid'],
                    $_REQUEST['pos']);
            } else if (isset($_REQUEST['fid']) && isset($_REQUEST['editforum'])) {
                $adminAction = TRUE;
                if (!$this->editForum()) {
                    return;
                }
            } else if (isset($_REQUEST['fid']) && isset($_REQUEST['delforum'])) {
                $adminAction = TRUE;
                $forum = $this->model->getForum($this->selectedAllianceID,
                    $this->session->getAllianceId(),
                    (int)$_REQUEST['fid']);
                if ($forum === FALSE || $forum['aid'] <> $this->session->getAllianceId()) {
                } else {
                    $this->model->deleteForum($_REQUEST['fid'], $this->session->getAllianceId());
                }
            } else {
                $adminAction = FALSE;
            }
        }
        if ($this->session->getAllianceId() == $this->selectedAllianceID && $this->session->hasAlliancePermission(AllianceModel::MANAGE_FORUM) && isset($_REQUEST['fid']) && isset($_REQUEST['ac'])) {
            if ($_REQUEST['ac'] == 'newtopic') {
                if (!$this->newTopic()) {
                    return;
                }
            }
        }
        if (isset($_REQUEST['tid'])) {
            if (isset($_POST['vote'])) {
                $topic = $this->model->getTopic((int)$_REQUEST['tid']);
                if ($topic === FALSE) {
                    goto finalize;
                }
                $forum = $this->model->getForum($this->selectedAllianceID,
                    $this->session->getAllianceId(),
                    $topic['forumId']);
                if ($forum === FALSE || $forum['aid'] <> $this->session->getAllianceId()) {
                    goto finalize;
                }
                if ($topic['close'] && $forum['area'] == 3) {
                    $topic['close'] = $this->model->isTopicOpenedForUser($forum['id'],
                        $this->session->getPlayerId());
                }
                $finished = $topic['end_time'] > 0 && time() > $topic['end_time'];
                $vote_option = (int)$_POST['vote_option'];
                if (!$finished && !$topic['close'] && $this->model->voteOptionExists($topic['id'], $vote_option)) {
                    if (!$this->model->haveIVoted($topic['id'], $this->session->getPlayerId())) {
                        $this->model->vote($this->session->getPlayerId(), $topic['id'], $vote_option);
                    }
                    if (!$this->showTopic($isAdmin)) {
                        return;
                    }
                }
            } else if ($this->session->hasAlliancePermission(AllianceModel::MANAGE_FORUM) && (isset($_REQUEST['lock']) || isset($_REQUEST['unlock']) || isset($_REQUEST['pin']) || isset($_REQUEST['unpin'])) || isset($_REQUEST['ac'])) {
                $topic = $this->model->getTopic((int)$_REQUEST['tid']);
                if ($topic === FALSE) {
                    goto finalize;
                }
                $forum = $this->model->getForum($this->selectedAllianceID,
                    $this->session->getAllianceId(),
                    $topic['forumId']);
                if ($forum === FALSE || $forum['aid'] <> $this->session->getAllianceId()) {
                    goto finalize;
                }
                if (isset($_REQUEST['lock'])) {
                    $this->model->lockTopic($topic['id']);
                } else if (isset($_REQUEST['unlock'])) {
                    $this->model->unlockTopic($topic['id']);
                } else if (isset($_REQUEST['pin'])) {
                    $this->model->stickTopic($topic['id']);
                } else if (isset($_REQUEST['unpin'])) {
                    $this->model->unstickTopic($topic['id']);
                } else if (isset($_REQUEST['ac']) && $_REQUEST['ac'] == 'newpost') {
                    if ($topic['close'] && $forum['area'] == 3) {
                        $topic['close'] = $this->model->isTopicOpenedForUser($forum['id'],
                            $this->session->getPlayerId());
                    }
                    $topic['close'] = $isAdmin ? FALSE : $topic['close'];
                    if (!$topic['close'] && (!$this->session->isSitter() || $forum['sitter'] == 1)) {
                        if (isset($_POST['a']) && $_POST['a'] == 1 && $_POST['checkstr'] == $this->getChecksum()) {
                            $this->changeChecksum();
                            $this->model->addPost($this->session->getPlayerId(),
                                $this->session->getAllianceId(),
                                $forum['id'],
                                $topic['id'],
                                filter_var($_POST['text'], FILTER_SANITIZE_STRING),
                                $this->session->isSitter(),
                                $this->session->hasAlliancePermission(AllianceModel::MANAGE_FORUM));
                            if (!$this->showTopic($isAdmin)) {
                                return;
                            }
                        } else {
                            if (!$this->newPost($topic, $forum)) {
                                return;
                            }
                        }
                    }
                }
                $_REQUEST['fid'] = $forum['id'];
                if (!$this->showForum($isAdmin)) {
                    return;
                }
            } else {
                if (!$this->showTopic($isAdmin)) {
                    return;
                }
            }
        }
        if (isset($_REQUEST['fid']) && !$adminAction) {
            if (!$this->showForum($isAdmin)) {
                return;
            }
        }
        finalize:
        $this->showForumRoot($isAdmin);
    }

    private function changeMd5Checksum()
    {
        $_SESSION[WebService::fixSessionPrefix('FORUM_MD5_CHECKSUM')] = sha1(time() . get_random_string(12));
    }

    private function getMd5CheckSum()
    {
        if (!isset($_SESSION[WebService::fixSessionPrefix('FORUM_MD5_CHECKSUM')])) {
            $this->changeMd5Checksum();
        }
        return $_SESSION[WebService::fixSessionPrefix('FORUM_MD5_CHECKSUM')];
    }

    private function changeChecksum()
    {
        $_SESSION[WebService::fixSessionPrefix('FORUM_CHECKSUM')] = get_random_string(3);
    }

    private function getChecksum()
    {
        if (!isset($_SESSION[WebService::fixSessionPrefix('FORUM_CHECKSUM')])) {
            $this->changeChecksum();
        }
        return $_SESSION[WebService::fixSessionPrefix('FORUM_CHECKSUM')];
    }


    private function editPost($isAdmin)
    {
        $post = $this->model->getPost((int)$_REQUEST['pid']);
        if ($post === FALSE) {
            return TRUE;
        }
        $topic = $this->model->getTopic($post['topicId']);
        if ($topic === FALSE) {
            return TRUE;
        }
        $forum = $this->model->getForum($this->selectedAllianceID,
            $this->session->getAllianceId(),
            $topic['forumId']);
        if ($forum === FALSE) {
            return TRUE;
        }
        if ($forum['aid'] <> $this->session->getAllianceId() && in_array($forum['area'], [2, 3,])) {
            return TRUE;
        }
        if ($post['uid'] != $this->session->getPlayerId()) {
            if (!$this->session->hasAlliancePermission(AllianceModel::MANAGE_FORUM) || $forum['aid'] <> $this->selectedAllianceID) {
                return TRUE;
            }
        }
        if (WebService::isPost() && $_POST['a'] == 1 && !empty($_POST['text']) && $_POST['checkstr'] == $this->getChecksum()) {
            $this->changeChecksum();
            $this->model->editPost($post['id'],
                $this->session->getPlayerId(),
                filter_var($_POST['text'], FILTER_SANITIZE_STRING));
            $_REQUEST['tid'] = $topic['id'];
            $this->showTopic($isAdmin);
            return FALSE;
        }
        $view = new PHPBatchView("alliance/newPost");
        $view->vars['topicName'] = $topic['thread'];
        $view->vars['tid'] = $topic['id'];
        $view->vars['pid'] = $post['id'];
        $view->vars['new'] = FALSE;
        $view->vars['aid'] = $this->selectedAllianceID;
        $view->vars['checkstr'] = $this->getChecksum();
        $view->vars['text'] = isset($_POST['text']) ? filter_var($_POST['text'],
            FILTER_SANITIZE_STRING) : $post['post'];
        $this->view->vars['content'] .= $view->output();
        return FALSE;
    }

    private function newPost($topic, $forum)
    {
        $view = new PHPBatchView("alliance/newPost");
        $view->vars['topicName'] = $topic['thread'];
        $view->vars['tid'] = $topic['id'];
        $view->vars['aid'] = $this->selectedAllianceID;
        $view->vars['new'] = TRUE;
        $view->vars['checkstr'] = $this->getChecksum();
        $view->vars['text'] = isset($_POST['text']) ? filter_var($_POST['text'], FILTER_SANITIZE_STRING) : '';
        $this->view->vars['content'] .= $view->output();
        return FALSE;
    }

    private function editTopic($isAdmin)
    {
        $topic = $this->model->getTopic((int)$_REQUEST['tid']);
        if ($topic === FALSE) {
            return TRUE;
        }
        $forum = $this->model->getForum($this->selectedAllianceID,
            $this->session->getAllianceId(),
            $topic['forumId']);
        if ($forum === FALSE) {
            return TRUE;
        }
        if ($forum['aid'] <> $this->session->getAllianceId()) {
            return TRUE;
        }
        if (WebService::isPost() && !empty($_POST['thema'])) {
            if (strlen($_POST['thema']) > 45) {
                return TRUE;
            }
            $this->model->editTopic($topic,
                $this->session->getAllianceId(),
                filter_var($_POST['thema'], FILTER_SANITIZE_STRING),
                (int)$_POST['fid']);
            $_REQUEST['fid'] = $forum['id'];
            $this->showForum($isAdmin);
            return FALSE;
        }
        $view = new PHPBatchView("alliance/editTopic");
        $view->vars['tid'] = $topic['id'];
        $view->vars['name'] = $topic['thread'];
        $view->vars['options'] = '';
        $db = DB::getInstance();
        $forums = $db->query("SELECT id, name FROM forum_forums WHERE aid=" . $this->session->getAllianceId());
        while ($row = $forums->fetch_assoc()) {
            $view->vars['options'] .= '<option value="' . $row['id'] . '"' . ($row['id'] == $forum['id'] ? ' selected' : '') . '>' . $row['name'] . '</option>';
        }
        $this->view->vars['content'] .= $view->output();
        return FALSE;
    }

    private function newTopic()
    {
        $forum = $this->model->getForum($this->selectedAllianceID,
            $this->session->getAllianceId(),
            $_REQUEST['fid']);
        if ($forum === FALSE) {
            return TRUE;
        }
        $view = new PHPBatchView("alliance/new_topic");
        if (WebService::isPost() && $_POST['checkstr'] == $this->getMd5CheckSum()) {
            //$this->changeMd5Checksum();
            if (!empty($_POST['text']) && !empty($_POST['thema'])) {
                $options = [];
                if (isset($_POST['umfrage_thema'])) {
                    if (!empty(filter_var($_POST['umfrage_thema'], FILTER_SANITIZE_STRING))) {
                        for ($i = 1; $i <= 8; ++$i) {
                            $x = filter_var($_POST['option_' . $i], FILTER_SANITIZE_STRING);
                            if (strlen($x) > 60) {
                                continue;
                            }
                            $options[] = $x;
                        }
                    }
                }
                if (!sizeof($options)) {
                    $_POST['umfrage_thema'] = '';
                }
                $ends = 0;
                if (isset($_POST['year'])) {
                    $ends = TimezoneHelper::strtotime("{$_POST['year']}-{$_POST['month']}-{$_POST['day']} {$_POST['hour']}:{$_POST['minute']}");
                }
                $_POST['umfrage_thema'] = isset($_POST['umfrage_thema']) ? $_POST['umfrage_thema'] : '';
                if (strlen($_POST['thema']) > 35) {
                    return TRUE;
                }
                if (strlen($_POST['umfrage_thema']) > 60) {
                    return TRUE;
                }
                $tid = $this->model->addTopic($this->session->getPlayerId(),
                    $this->session->getAllianceId(),
                    $forum['id'],
                    filter_var($_POST['thema'], FILTER_SANITIZE_STRING),
                    filter_var($_POST['text'], FILTER_SANITIZE_STRING),
                    filter_var($_POST['umfrage_thema'], FILTER_SANITIZE_STRING),
                    $options,
                    $ends);
                $this->redirect("allianz.php?aid={$this->selectedAllianceID}&s=2&fid={$forum['id']}&tid=$tid");
            }
        }
        $view->vars['checkstr'] = $this->getMd5CheckSum();
        $view->vars['fid'] = $forum['id'];
        $view->vars['aid'] = $this->selectedAllianceID;
        for ($i = 1; $i <= 8; ++$i) {
            $view->vars['option_' . $i] = isset($_POST['option_' . $i]) ? filter_var($_POST['option_' . $i],
                FILTER_SANITIZE_STRING) : '';
        }
        $view->vars['Survey'] = isset($_POST['umfrage_thema']) ? filter_var($_POST['umfrage_thema'],
            FILTER_SANITIZE_STRING) : '';
        $view->vars['thema'] = isset($_POST['thema']) ? filter_var($_POST['thema'], FILTER_SANITIZE_STRING) : '';
        $view->vars['text'] = isset($_POST['text']) ? filter_var($_POST['text'], FILTER_SANITIZE_STRING) : '';
        $view->vars['days'] = '';
        $view->vars['month'] = '';
        $view->vars['year'] = '';
        $view->vars['hour'] = '';
        $view->vars['minute'] = '';
        $config = Config::getInstance();
        $finish = TimezoneHelper::strtotime(TimezoneHelper::date("Y-m-d H:i:s",
            $config->game->start_time + $config->game->round_length * 86400),
            'Y-m-d H:i:s');
        $cur_year = TimezoneHelper::date("Y");
        $finishYear = TimezoneHelper::date("Y", $finish);
        for ($i = $cur_year; $i <= $finishYear; ++$i) {
            $year = $i[2] . $i[3];
            $view->vars['year'] .= '<option value="' . $year . '" ' . ($i == TimezoneHelper::date("Y") ? "selected" : "") . '>' . $year . '</option>';
        }
        $days = 31;
        for ($i = 1; $i <= $days; ++$i) {
            $day = $i;
            if ($day < 10) {
                $day = '0' . $day;
            }
            $view->vars['days'] .= '<option value="' . $day . '" ' . ($day == TimezoneHelper::date("d") ? "selected" : "") . '>' . $day . '</option>';
        }
        $mons = [
            1  => "Jan",
            2  => "Feb",
            3  => "Mar",
            4  => "Apr",
            5  => "May",
            6  => "Jun",
            7  => "Jul",
            8  => "Aug",
            9  => "Sep",
            10 => "Oct",
            11 => "Nov",
            12 => "Dec",
        ];
        $month = TimezoneHelper::date("m");
        if ($month[0] == '0') {
            $month = $month[1];
        }
        for ($i = 1; $i <= 12; ++$i) {
            $view->vars['month'] .= '<option value="' . $mons[$i] . '" ' . ($mons[$i] == $mons[$month] ? "selected" : "") . '>' . $mons[$i] . '</option>';
        }
        for ($i = 0; $i <= 23; ++$i) {
            if ($i < 10) {
                $i = '0' . $i;
            }
            $view->vars['hour'] .= '<option value="' . $i . '" ' . ($i == TimezoneHelper::date("H") ? "selected" : "") . '>' . $i . '</option>';
        }
        for ($i = 0; $i <= 59; ++$i) {
            if ($i < 10) {
                $i = '0' . $i;
            }
            $view->vars['minute'] .= '<option value="' . $i . '" ' . ($i == TimezoneHelper::date("i") ? "selected" : "") . '>' . $i . '</option>';
        }
        $this->view->vars['content'] .= $view->output();
        return FALSE;
    }

    private function showTopic($isAdmin)
    {
        $topic = $this->model->getTopic($_REQUEST['tid']);
        if ($topic === FALSE) {
            return TRUE;
        }
        $forum = $this->model->getForum($this->selectedAllianceID,
            $this->session->getAllianceId(),
            $topic['forumId']);
        if ($forum === FALSE) {
            return TRUE;
        }
        $isAdmin = $isAdmin && $forum['aid'] == $this->session->getAllianceId();
        if ($topic['close']) {
            $topic['close'] = $forum['area'] == 1 ? $this->model->isTopicOpenedForUser($forum['id'],
                $this->session->getPlayerId()) : $topic['close'];
        }
        if ($forum['aid'] <> $this->session->getAllianceId() && in_array($forum['area'], [2, 3,])) {
            return TRUE;
        }
        $view = new PHPBatchView("alliance/showTopic");
        $view->vars['areaName'] = T("Alliance",
            ['public_forum', 'conf_forum', 'alliance_forum', 'closed_forum',][$forum['area']]);
        $view->vars['aid'] = $this->selectedAllianceID;
        $view->vars['forumName'] = $forum['name'];
        $view->vars['thread'] = $topic['thread'];
        $view->vars['fid'] = $forum['id'];
        $view->vars['tid'] = $topic['id'];
        $view->vars['showReplyButton'] = !$topic['close'] || $isAdmin;
        $view->vars['end_time'] = sprintf(T("Alliance", "This survey ends on x"),
            TimezoneHelper::autoDate($topic['end_time'], TRUE));
        $view->vars['ends'] = $topic['end_time'] > 0;
        $view->vars['close'] = $topic['close'];
        $view->vars['results'] = $topic['close'] || isset($_POST['vote_ergebnis']) && $_POST['vote_ergebnis'] == 1 || ($topic['end_time'] > 0 && time() > $topic['end_time']);
        $view->vars['finished'] = $topic['end_time'] > 0 && time() > $topic['end_time'];
        $view->vars['content'] = $view->vars['adminSwitchButton'] = '';
        $view->vars['nav'] = '';
        if ($this->session->hasAlliancePermission(AllianceModel::MANAGE_FORUM) && $forum['aid'] == $this->session->getAllianceId()) {
            $view->vars['adminSwitchButton'] = $this->getAdminSwitchButton($isAdmin, $forum['id'], $topic['id']);
        }
        $view->vars['showVotes'] = !empty($topic['Survey']);
        if ($view->vars['showVotes']) {
            $view->vars['voted'] = $this->model->haveIVoted($topic['id'], $this->session->getPlayerId());
            $view->vars['SurveyName'] = $topic['Survey'];
            $view->vars['SurveyDate'] = TimezoneHelper::autoDate($topic['SurveyStartTime'], TRUE);
            $view->vars['options'] = $this->renderOptions($topic['id'],
                $topic['close'] || $view->vars['voted'] || isset($_POST['vote_ergebnis']) && $_POST['vote_ergebnis'] == 1 || ($topic['end_time'] > 0 && time() > $topic['end_time']));
        }
        $view->vars['content'] = $this->renderAnswers($topic['id'], $isAdmin, $view);
        $this->view->vars['content'] .= $view->output();
        return FALSE;
    }

    private function renderAnswers($id, $isAdmin, PHPBatchView &$view)
    {
        $total_posts = $this->model->getTotalPostsCount($id);
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : 1;
        if ($page == 'max') {
            $page = floor(($total_posts - 1) / 10) + 1;
        }
        $page = (int)filter_var($page, FILTER_SANITIZE_NUMBER_INT);
        if ($page > $page = floor(($total_posts - 1) / 10) + 1) {
            $page = $page = floor(($total_posts - 1) / 10) + 1;
        } else if ($page < 1) {
            $page = 1;
        }
        $prefix = [];
        $prefix['s'] = 2;
        $prefix['aid'] = $this->selectedAllianceID;
        $prefix['tid'] = $id;
        $p = new PageNavigator($page, $total_posts, 10, $prefix, "allianz.php");
        $view->vars['nav'] = $p->get();
        $posts = $this->model->getPosts($id, $page);
        $HTML = '';
        while ($row = $posts->fetch_assoc()) {
            $HTML .= '<tr>';
            $HTML .= '<td class="pinfo">';
            $data = $this->model->getPlayerRow($row['uid'], "aid, name, race, total_pop, total_villages");
            $alliance = $this->model->getAllianceNameAndTag($data['aid']);
            $HTML .= '<a class="name" href="spieler.php?uid=' . $row['uid'] . '">' . $data['name'] . '</a>';
            $HTML .= '<br /><img class="avatarHead" title="' . $data['name'] . '" alt="' . $data['name'] . '" src="hero_head.php?uid=' . $row['uid'] . '&amp;size=forum" border="0" />';
            $HTML .= '<br />' . ($data['aid'] > 0 ? '<a href="allianz.php?aid=' . $data['aid'] . '">' : '') . $alliance['name'] . ($data['aid'] > 0 ? '</a>' : '') . '<br />';
            $HTML .= T("Alliance", "Posts:") . ' ' . $this->model->getPlayerPostsCount($this->selectedAllianceID,
                    $row['uid']) . '<br />';
            $HTML .= '<br />';
            $HTML .= T("Alliance", "pop") . ': ' . $data['total_pop'] . '<br />';
            $HTML .= T("Alliance", "Villages") . ': ' . $data['total_villages'] . '<br />';
            $HTML .= T("Global", "races." . $data['race']);
            $HTML .= '</td>';
            $HTML .= '<td class="pcontent">';
            $HTML .= '<div class="posted">' . T("Alliance", "created") . ': ' . TimezoneHelper::autoDate($row['time'],
                    TRUE) . '</div>';
            $HTML .= '<div class="admin">';
            $options = [];
            if ($isAdmin) {
                $options[] = '<a class="edit" href="allianz.php?s=2&amp;aid=' . $this->selectedAllianceID . '&amp;pid=' . $row['id'] . '&amp;ac=editpost&amp;seite=1"><img src="img/x.gif" title="' . T("Alliance",
                        "edit") . '" alt="' . T("Alliance", "edit") . '" /></a>';
                if ($total_posts > 1) {
                    $options[] = '<a class="fdel" href="allianz.php?s=2&amp;aid=' . $this->selectedAllianceID . '&amp;tid=' . $id . '&amp;pid=' . $row['id'] . '&delpost&amp;admin" onclick="return confirm(\'' . T("Alliance",
                            "Confirm deletion?") . '\');"><img src="img/x.gif" title="' . T("Alliance",
                            "Delete") . '" alt="' . T("Alliance", "Delete") . '"></a>';
                }
            } else if ($this->session->getPlayerId() == $row['uid']) {
                $options[] = '<a class="edit" href="allianz.php?s=2&amp;aid=' . $this->selectedAllianceID . '&amp;pid=' . $row['id'] . '&amp;ac=editpost&amp;seite=1"><img src="img/x.gif" title="' . T("Alliance",
                        "edit") . '" alt="' . T("Alliance", "edit") . '" /></a>';
            }
            $HTML .= implode(" ", $options);
            $HTML .= '</div>';
            $HTML .= '<br /><div class="clear dotted"></div><div class="text">' . BBCode::translateMessagesBBCode($row['post']) . '</div>';
            $edits = $this->model->getPostEdits($row['id']);
            if ($edits['count']) {
                $HTML .= '<div class="edited">' . sprintf(T("Alliance", "x times edited, last edit by y"),
                        $edits['count'],
                        $this->model->getPlayerName($edits['uid']),
                        TimezoneHelper::autoDate($edits['time'], TRUE));
                $HTML .= '</div>';
            }
            $HTML .= '</td></tr>';
        }
        return $HTML;
    }

    private function renderOptions($topicId, $show = FALSE)
    {
        $options = $this->model->getOptions($topicId);
        $total_votes = 0;
        if ($show) {
            $total_votes = $this->model->getTotalVotes($topicId);
        }
        $HTML = '';
        while ($row = $options->fetch_assoc()) {
            $HTML .= '<tr>';
            $HTML .= '<td class="sel">' . $row['option_desc'] . '</td>';
            $HTML .= '<td class="stat"';
            if (!$show) {
                $HTML .= '>';
                $HTML .= '<input class="radio" type="radio" name="vote_option" value="' . $row['id'] . '" />';
                $HTML .= '<td class="count">?</td>';
            } else {
                $votes = $this->model->getTopicVotesCount($topicId, $row['id']);
                $percent = $total_votes == 0 ? 0 : round($votes / $total_votes * 100, 1);
                $HTML .= ' title="' . $percent . '%">';
                $HTML .= '<div class="bar-bg"><div style="width:' . $percent . '%;" class="bar"></div><div class="clear"></div></div>';
                $HTML .= '<td class="count">' . $votes . '</td>';
            }
            $HTML .= '</tr>';
        }
        return $HTML;
    }

    private function showForumRoot($isAdmin)
    {
        $m = new ForumModel();
        if ($m->AllianceHasAnyForums($this->selectedAllianceID, $this->session->getAllianceId())) {
            //show forums.
            $public_form = $m->getPublicForum($this->selectedAllianceID);
            if ($public_form->num_rows) {
                $this->view->vars['content'] .= '<h4 class="round">' . T("Alliance", "public_forum") . '</h4>';
                $view = new PHPBatchView("alliance/rootForums");
                $view->vars['class'] = 'public';
                $view->vars['tbody'] = '';
                while ($row = $public_form->fetch_assoc()) {
                    $view->vars['tbody'] .= '<tr>';
                    $view->vars['tbody'] .= $this->renderForumAdminActions($row, $isAdmin);
                    $view->vars['tbody'] .= '<td class="tit"><a href="allianz.php?s=2&amp;fid=' . $row['id'] . '&amp;aid=' . $this->selectedAllianceID . '" title="' . $row['name'] . '">' . $row['name'] . '</a><br />' . $row['forum_desc'] . '</td>';
                    $view->vars['tbody'] .= '<td class="cou">' . $m->getForumTopicsCount($row['id']) . '</td>';
                    $view->vars['tbody'] .= '<td class="last">' . $this->renderForumLastPost($row['id']) . '</td>';
                    $view->vars['tbody'] .= '</tr>';
                }
                $this->view->vars['content'] .= $view->output();
            }
            $conf_forum = $m->getConfederaciesForums($this->selectedAllianceID,
                $this->session->getAllianceId());
            if (sizeof($conf_forum)) {
                $this->view->vars['content'] .= '<h4 class="round">' . T("Alliance", "conf_forum") . '</h4>';
                $view = new PHPBatchView("alliance/rootForums");
                $view->vars['class'] = 'confederation';
                $view->vars['tbody'] = '';
                foreach ($conf_forum as $row) {
                    $view->vars['tbody'] .= '<tr>';
                    $view->vars['tbody'] .= $this->renderForumAdminActions($row, $isAdmin);
                    $view->vars['tbody'] .= '<td class="tit"><a href="allianz.php?s=2&amp;fid=' . $row['id'] . '&amp;aid=' . $this->selectedAllianceID . '" title="' . $row['name'] . '">' . $row['name'] . '</a><br />' . $row['forum_desc'] . '</td>';
                    $view->vars['tbody'] .= '<td class="cou">' . $m->getForumTopicsCount($row['id']) . '</td>';
                    $view->vars['tbody'] .= '<td class="last">' . $this->renderForumLastPost($row['id']) . '</td>';
                    $view->vars['tbody'] .= '</tr>';
                }
                $this->view->vars['content'] .= $view->output();
            }
            if ($this->session->getAllianceId() == $this->selectedAllianceID) {
                $alliance_forum = $m->getAllianceForum($this->selectedAllianceID);
                if ($alliance_forum->num_rows) {
                    $this->view->vars['content'] .= '<h4 class="round">' . T("Alliance", "alliance_forum") . '</h4>';
                    $view = new PHPBatchView("alliance/rootForums");
                    $view->vars['class'] = 'alliance';
                    $view->vars['tbody'] = '';
                    while ($row = $alliance_forum->fetch_assoc()) {
                        $view->vars['tbody'] .= '<tr>';
                        $view->vars['tbody'] .= $this->renderForumAdminActions($row, $isAdmin);
                        $view->vars['tbody'] .= '<td class="tit"><a href="allianz.php?s=2&amp;fid=' . $row['id'] . '&amp;aid=' . $this->selectedAllianceID . '" title="' . $row['name'] . '">' . $row['name'] . '</a><br />' . $row['forum_desc'] . '</td>';
                        $view->vars['tbody'] .= '<td class="cou">' . $m->getForumTopicsCount($row['id']) . '</td>';
                        $view->vars['tbody'] .= '<td class="last">' . $this->renderForumLastPost($row['id']) . '</td>';
                        $view->vars['tbody'] .= '</tr>';
                    }
                    $this->view->vars['content'] .= $view->output();
                }
                $closed_forum = $m->getClosedForum($this->selectedAllianceID);
                if ($closed_forum->num_rows) {
                    $this->view->vars['content'] .= '<h4 class="round">' . T("Alliance", "closed_forum") . '</h4>';
                    $view = new PHPBatchView("alliance/rootForums");
                    $view->vars['class'] = 'closed';
                    $view->vars['tbody'] = '';
                    while ($row = $closed_forum->fetch_assoc()) {
                        $view->vars['tbody'] .= '<tr>';
                        $view->vars['tbody'] .= $this->renderForumAdminActions($row, $isAdmin);
                        $view->vars['tbody'] .= '<td class="tit"><a href="allianz.php?s=2&amp;fid=' . $row['id'] . '&amp;aid=' . $this->selectedAllianceID . '" title="' . $row['name'] . '">' . $row['name'] . '</a><br />' . $row['forum_desc'] . '</td>';
                        $view->vars['tbody'] .= '<td class="cou">' . $m->getForumTopicsCount($row['id']) . '</td>';
                        $view->vars['tbody'] .= '<td class="last">' . $this->renderForumLastPost($row['id']) . '</td>';
                        $view->vars['tbody'] .= '</tr>';
                    }
                    $this->view->vars['content'] .= $view->output();
                }
                if ($this->selectedAllianceID == $this->session->getAllianceId() && $this->session->hasAlliancePermission(AllianceModel::MANAGE_FORUM)) {
                    $this->view->vars['content'] .= '<div class="spacer"></div>' . $this->getNewForumButton();
                    $this->view->vars['content'] .= $this->getAdminSwitchButton($isAdmin);
                }
            }
        } else {
            $this->view->vars['content'] .= '<p class="error">' . T("Alliance", "noForum") . '</p>';
            if ($this->selectedAllianceID == $this->session->getAllianceId() && $this->session->hasAlliancePermission(AllianceModel::MANAGE_FORUM)) {
                $this->view->vars['content'] .= '<div class="spacer"></div>' . $this->getNewForumButton();
            }
        }
    }

    private function getNewForumButton()
    {
        return '<div class="buttonBox">' . getButton([
                "type"    => "button",
                "class"   => "green",
                'onclick' => "window.location.href = 'allianz.php?s=2&admin&newforum'",
            ],
                ["data" => ["type" => "button", "class" => "green",],],
                T("Alliance", "NewForum")) . '</div>';
    }

    private function getNewTopicButton($fid)
    {
        return '<div class="buttonBox">' . getButton([
                "type"    => "button",
                "class"   => "green",
                'onclick' => "window.location.href = 'allianz.php?s=2&aid=" . $this->selectedAllianceID . "&fid=$fid&ac=newtopic'",
            ],
                ["data" => ["type" => "button", "class" => "green",],],
                T("Alliance", "New Thread")) . '</div>';
    }

    private function getAdminSwitchButton($isAdmin, $fid = 0, $tid = 0)
    {
        return '<div class="buttonBox"><a href="allianz.php?s=2&admin&switch_admin' . ($fid > 0 ? "&fid=" . $fid : '') . ($tid > 0 ? "&tid=" . $tid : '') . '"><img class="switch_admin dynamic_img " src="img/x.gif" alt="' . T("Alliance",
                $isAdmin ? "switch non admin" : "switch admin") . '"></a></div>';
    }

    private function newForum()
    {
        $view = new PHPBatchView("alliance/newForum");
        if (WebService::isPost()) {
            //new forum post!
            if (!empty($_POST['u1'])) {
                $bid = isset($_POST['bid']) ? ($_POST['bid'] == 1 ? 0 : ($_POST['bid'] == 2 ? 1 : ($_POST['bid'] == 0 ? 2 : 3))) : 0;
                $this->model->addForum(
                    $this->session->getAllianceId(),
                    filter_var($_POST['u1'], FILTER_SANITIZE_STRING),
                    filter_var($_POST['u2'], FILTER_SANITIZE_STRING),
                    $bid,
                    isset($_POST['for_sitters']) && $_POST['for_sitters'] == 1 ? 1 : 0,
                    isset($_POST['allys_by_id']) ? $_POST['allys_by_id'] : NULL,
                    isset($_POST['allys_by_name']) ? $_POST['allys_by_name'] : NULL,
                    isset($_POST['users_by_id']) ? $_POST['users_by_id'] : NULL,
                    isset($_POST['users_by_name']) ? $_POST['users_by_name'] : NULL);
                $this->redirect("allianz.php?s=2");
            }
        }
        $this->view->vars['content'] .= $view->output();
        return FALSE;
    }

    private function editForum()
    {
        $forum = $this->model->getForum($this->selectedAllianceID,
            $this->session->getAllianceId(),
            (int)$_REQUEST['fid']);
        if ($forum === FALSE) {
            return TRUE;
        }
        if ($forum['aid'] <> $this->session->getAllianceId()) {
            return TRUE;
        }
        if (WebService::isPost()) {
            if (!empty($_POST['u1'])) {
                $this->model->editForum($forum['id'],
                    filter_var($_POST['u1'], FILTER_SANITIZE_STRING),
                    filter_var($_POST['u2'], FILTER_SANITIZE_STRING),
                    isset($_POST['for_sitter']) && $_POST['for_sitter'] == 1 ? 1 : 0,
                    isset($_POST['bnds']) ? $_POST['bnds'] : NULL,
                    isset($_POST['allys_by_id']) ? $_POST['allys_by_id'] : NULL,
                    isset($_POST['allys_by_name']) ? $_POST['allys_by_name'] : NULL,
                    isset($_POST['users']) ? $_POST['users'] : NULL,
                    isset($_POST['users_by_id']) ? $_POST['users_by_id'] : NULL,
                    isset($_POST['users_by_name']) ? $_POST['users_by_name'] : NULL);
                $this->redirect("allianz.php?s=2");
            }
        }
        $view = new PHPBatchView("alliance/forum_edit");
        $view->vars['name'] = $forum['name'];
        $view->vars['desc'] = $forum['forum_desc'];
        $view->vars['for_sitters'] = $forum['sitter'];
        $view->vars['fid'] = $forum['id'];
        $view->vars['showMoreAlliances'] = $forum['area'] == 1;
        $view->vars['showMorePlayers'] = $forum['area'] == 3;
        if ($view->vars['showMoreAlliances']) {
            $allowed = $this->model->getAllowedAlliancesForForum($forum['id']);
            $view->vars['hasAlliances'] = $allowed->num_rows;
            if ($view->vars['hasAlliances']) {
                $view->vars['alliances'] = '';
                while ($row = $allowed->fetch_assoc()) {
                    $alliance = $this->model->getAllianceNameAndTag($row['aid']);
                    if ($alliance === FALSE) {
                        $view->vars['hasAlliances']--;
                        continue;
                    }
                    $view->vars['alliances'] .= '<tr>';
                    $view->vars['alliances'] .= '<td class="sel"><input class="check" type="checkbox" name="bnds[]" value="' . $row['aid'] . '" checked /></td>';
                    $view->vars['alliances'] .= '<td class="tag">' . $alliance['name'] . '</td>';
                    $view->vars['alliances'] .= '<td class="ally">' . $alliance['tag'] . '</td>';
                    $view->vars['alliances'] .= '</tr>';
                }
            }
        } else if ($view->vars['showMorePlayers']) {
            $allowed = $this->model->getAllowedPlayersForForum($forum['id']);
            $view->vars['hasPlayers'] = $allowed->num_rows;
            if ($view->vars['hasPlayers']) {
                $view->vars['players'] = '';
                $i = 0;
                while ($row = $allowed->fetch_assoc()) {
                    $player = $this->model->getPlayerName($row['uid'], TRUE);
                    if ($player === NULL) {
                        $view->vars['hasPlayers']--;
                        continue;
                    }
                    $view->vars['players'] .= '<tr>';
                    $view->vars['players'] .= '<td class="sel"><input class="check" type="checkbox" name="users[' . $i . ']" value="' . $row['uid'] . '" checked /></td>';
                    $view->vars['players'] .= '<td class="pla">' . $player . '</td>';
                    $view->vars['players'] .= '</tr>';
                    ++$i;
                }
            }
        }
        $view->vars['bid'] = $forum['area'] == 0 ? 1 : ($forum['area'] == 1 ? 2 : ($forum['area'] == 2 ? 0 : 3));
        $this->view->vars['content'] .= $view->output();
        return FALSE;
    }

    private function showForum($isAdmin)
    {
        $m = new ForumModel();
        $forum = $m->getForum($this->selectedAllianceID,
            $this->session->getAllianceId(),
            (int)$_REQUEST['fid']);
        if ($forum === FALSE) {
            return TRUE;
        }
        if ($forum['aid'] <> $this->session->getAllianceId() && in_array($forum['area'], [2, 3,])) {
            return TRUE;
        }
        $view = new PHPBatchView("alliance/forum_topic");
        $view->vars['aid'] = $this->selectedAllianceID;
        $view->vars['fid'] = $forum['id'];
        $view->vars['forumName'] = $forum['name'];
        $view->vars['areaName'] = T("Alliance",
            ['public_forum', 'conf_forum', 'alliance_forum', 'closed_forum',][$forum['area']]);
        $view->vars['content'] = '';
        $topics = $m->getForumTopics($forum['id']);
        while ($row = $topics->fetch_assoc()) {
            $view->vars['content'] .= '<tr>';
            $view->vars['content'] .= $this->renderTopicAdminActions($forum, $row, $isAdmin);
            $view->vars['content'] .= '<td class="tit"><a href="allianz.php?s=2&amp;aid=' . $this->selectedAllianceID . '&amp;tid=' . $row['id'] . '">' . $row['thread'] . '</a><br /></td>';
            $view->vars['content'] .= '<td class="cou">' . $m->getTopicAnswersCount($row['id']) . '</td>';
            $view->vars['content'] .= '<td class="last">';
            $view->vars['content'] .= $this->renderTopicLastPost($row['id']);
            $view->vars['content'] .= '</td>';
            $view->vars['content'] .= '</tr>';
        }
        if (!$topics->num_rows) {
            $view->vars['content'] .= '<tr><td colspan="4" class="noData">' . T("Alliance",
                    "no thread created") . '</td></tr>';
        }
        $this->view->vars['content'] .= $view->output();
        if ($this->session->hasAlliancePermission(AllianceModel::MANAGE_FORUM) && $forum['aid'] == $this->session->getAllianceId()) {
            $this->view->vars['content'] .= '<div class="spacer"></div>' . $this->getNewTopicButton($forum['id']);
            $this->view->vars['content'] .= $this->getAdminSwitchButton($isAdmin, $forum['id']);
        }
        return FALSE;
    }

    private function renderTopicLastPost($topicId)
    {
        $m = new ForumModel();
        $last = $m->getTopicLastPost($topicId);
        if ($last === FALSE) {
            return NULL;
        }
        $HTML = TimezoneHelper::autoDate($last['time'], TRUE) . '<br />';
        $HTML .= ' <a href="spieler.php?uid=' . $last['uid'] . '">' . $m->getPlayerName($last['uid']) . '</a>';
        $HTML .= '<a href="allianz.php?s=2&amp;tid=' . $last['topicId'] . '&amp;aid=' . $this->selectedAllianceID . '&amp;page=max"><img class="latest_reply" src="img/x.gif" alt="' . T("Alliance",
                "show last post") . '" title="' . T("Alliance", "show last post") . '" /></a>';
        return $HTML;
    }

    private function renderForumLastPost($forumId)
    {
        $m = new ForumModel();
        $last = $m->getForumLastPost($forumId);
        if ($last === FALSE) {
            return NULL;
        }
        $HTML = TimezoneHelper::autoDate($last['time'], TRUE) . '<br />';
        $HTML .= ' <a href="spieler.php?uid=' . $last['uid'] . '">' . $m->getPlayerName($last['uid']) . '</a>';
        $HTML .= '<a href="allianz.php?s=2&amp;tid=' . $last['topicId'] . '&amp;aid=' . $this->selectedAllianceID . '&amp;page=max"><img class="latest_reply" src="img/x.gif" alt="' . T("Alliance",
                "show last post") . '" title="' . T("Alliance", "show last post") . '" /></a>';
        return $HTML;
    }

    private function renderTopicAdminActions($forum, $row, $isAdmin)
    {
        $options = '<td class="ico">';
        if (!$isAdmin || $forum['aid'] != $this->session->getAllianceId()) {
            if ($row['close']) {
                $row['close'] = $forum['area'] == 1 ? $this->model->isTopicOpenedForUser($forum['id'],
                    $this->session->getPlayerId()) : $row['close'];
            }
            $entries = $this->model->hasForumNewEntries($row['id']);
            $folder = [];
            $folder[] = 'folder';
            if ($entries) {
                $folder[] = 'new';
            }
            if ($row['stick']) {
                $folder[] = 'sticky';
            }
            if ($row['close']) {
                $folder[] = 'lock';
            }
            $options .= '<img class="' . implode("_", $folder) . '" src="img/x.gif">';
        } else {
            if ($row['close']) {
                $options .= '<a class="unlock" href="?s=2&amp;tid=' . $row['id'] . '&amp;admin&amp;unlock"><img src="img/x.gif" alt="' . T("Alliance",
                        "open_topic") . '" title="' . T("Alliance", "open_topic") . '"></a>';
            } else {
                $options .= '<a class="lock" href="?s=2&amp;tid=' . $row['id'] . '&amp;admin&amp;lock"><img src="img/x.gif" alt="' . T("Alliance",
                        "close_topic") . '" title="' . T("Alliance", "close_topic") . '"></a>';
            }
            $options .= '<a class="edit" href="allianz.php?s=2&amp;tid=' . $row['id'] . '&amp;admin&amp;edittopic" title="' . T("Alliance",
                    "edit") . '"><img src="img/x.gif" alt="' . T("Alliance", "edit") . '" /></a><br />';
            if ($row['stick']) {
                $options .= '<a class="unpin" href="?s=2&amp;tid=' . $row['id'] . '&amp;admin&amp;unpin"><img src="img/x.gif" alt="' . T("Alliance",
                        "open_topic") . '" title="' . T("Alliance", "unstick_topic") . '"></a>';
            } else {
                $options .= '<a class="pin" href="?s=2&amp;tid=' . $row['id'] . '&amp;admin&amp;pin"><img src="img/x.gif" alt="' . T("Alliance",
                        "close_topic") . '" title="' . T("Alliance", "stick_topic") . '"></a>';
            }
            $options .= '<a class="fdel" href="?s=2&amp;tid=' . $row['id'] . '&amp;admin&amp;deltopic"><img src="img/x.gif" alt="' . T("Alliance",
                    "Delete") . '" onclick="return confirm(\'' . T("Alliance", "Confirm deletion?") . '\');"></a>';
        }
        $options .= '</td>';
        return $options;
    }

    private function renderForumAdminActions($row, $isAdmin)
    {
        $options = '<td class="ico">';
        if (!$isAdmin || $row['aid'] != $this->session->getAllianceId()) {
            $m = new ForumModel();
            $entries = $m->hasForumNewEntries($row['id']);
            if (!$entries) {
                $options .= '<img class="folder" src="img/x.gif" alt="' . T("Alliance",
                        "thread without new entries") . '" title="' . T("Alliance",
                        "thread without new entries") . '">';
            } else {
                $options .= '<img class="folder_new" src="img/x.gif" alt="' . T("Alliance",
                        "thread with new entries") . '" title="' . T("Alliance", "thread with new entries") . '">';
            }
        } else {
            $bid = $row['area'] == 0 ? 1 : ($row['area'] == 1 ? 2 : ($row['area'] == 2 ? 0 : 3));
            if ($row['area'] == 1) {
                //Conf forums act different
                $options .= '<a class="edit" href="allianz.php?s=2&amp;fid=' . $row['id'] . '&amp;admin&amp;editforum" title="' . T("Alliance",
                        "edit") . '"><img src="img/x.gif" alt="' . T("Alliance", "edit") . '" /></a>';
                $options .= '<br /><a class="fdel" href="allianz.php?s=2&amp;fid=' . $row['id'] . '&amp;admin&amp;delforum" onclick="return confirm(\'' . T("Alliance",
                        "Confirm deletion?") . '\');" title="' . T("Alliance",
                        "Delete") . '"><img src="img/x.gif" alt="' . T("Alliance", "Delete") . '" /></a>';
            } else {
                $options .= '<a class="up_arr" href="allianz.php?s=2&amp;fid=' . $row['id'] . '&amp;bid=' . $bid . '&amp;admin&amp;pos=-1" title="' . T("Alliance",
                        "to the top") . '"><img src="img/x.gif" alt="' . T("Alliance", "to the top") . '" /></a>';
                $options .= '<a class="edit" href="allianz.php?s=2&amp;fid=' . $row['id'] . '&amp;admin&amp;editforum" title="' . T("Alliance",
                        "edit") . '"><img src="img/x.gif" alt="' . T("Alliance", "edit") . '" /></a>';
                $options .= '<br /><a class="down_arr" href="allianz.php?s=2&amp;fid=' . $row['id'] . '&amp;bid=' . $bid . '&amp;admin&amp;pos=1" title="' . T("Alliance",
                        "to the bottom") . '"><img src="img/x.gif" alt="' . T("Alliance", "to the bottom") . '" /></a>';
                $options .= '<a class="fdel" href="allianz.php?s=2&amp;fid=' . $row['id'] . '&amp;admin&amp;delforum" onclick="return confirm(\'' . T("Alliance",
                        "Confirm deletion?") . '\');" title="' . T("Alliance",
                        "Delete") . '"><img src="img/x.gif" alt="' . T("Alliance", "Delete") . '" /></a>';
            }
        }
        $options .= '</td>';
        return $options;
    }
} 