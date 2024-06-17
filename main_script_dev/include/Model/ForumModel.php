<?php

namespace Model;

use Core\Database\DB;
use Core\Session;

class ForumModel
{
    public function haveIVoted($topicId, $uid)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM forum_vote WHERE topicId=$topicId AND uid=$uid") > 0;
    }

    public function voteOptionExists($topicId, $id)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM forum_options WHERE topicId=$topicId AND id=$id");
    }

    public function vote($uid, $topicId, $optionId)
    {
        $db = DB::getInstance();
        $db->query("INSERT INTO forum_vote (uid, topicId, value) VALUES ($uid, $topicId, $optionId)");
    }

    public function lockTopic($id)
    {
        $db = DB::getInstance();
        $db->query("UPDATE forum_topic SET close=1 WHERE id=$id");
    }

    public function unlockTopic($id)
    {
        $db = DB::getInstance();
        $db->query("UPDATE forum_topic SET close=0 WHERE id=$id");
    }

    public function stickTopic($id)
    {
        $db = DB::getInstance();
        $db->query("UPDATE forum_topic SET stick=1 WHERE id=$id");
    }

    public function unstickTopic($id)
    {
        $db = DB::getInstance();
        $db->query("UPDATE forum_topic SET stick=0 WHERE id=$id");
    }

    /**
     * @param $id -> post id
     * @param $uid -> player id who edits the post!
     * @param $post -> post data.
     */
    public function editPost($id, $uid, $post)
    {
        $db = DB::getInstance();
        $db->query("INSERT INTO forum_edit (uid, postId, time) VALUES ($uid, $id, " . time() . ")");
        $db->query("UPDATE forum_post SET post='$post' WHERE id=$id AND deleted=0");
    }

    /**
     * @param $postId -> post ID to get!
     *                => gets how many time a post is edited and which player is it last edited by.
     *
     * @return array
     */
    public function getPostEdits($postId)
    {
        $db = DB::getInstance();

        return $db->query("SELECT COUNT(id) AS `count`, uid, time FROM forum_edit WHERE postId=$postId ORDER BY time DESC LIMIT 1")->fetch_assoc();
    }

    public function deletePost($pid)
    {
        $db = DB::getInstance();
        $db->query("UPDATE forum_post SET deleted=1 WHERE id=$pid");
        $db->query("DELETE FROM forum_edit WHERE postId=$pid");
    }

    /**
     * @param $uid -> user id for the first added post in topic.
     * @param $aid -> alliance ID which this topic belongs to
     * @param $forumId -> forum id which this topic will be gone to.
     * @param $thread -> thread is a little short desc of the topic and what's it about.
     * @param $text -> this text is used for the first
     * @param $umfrage_thema -> survey name if this is not empty we have a survey.
     * @param $options -> options of Survey.
     * @param $ends -> the time when survey will be finished.
     */
    public function addTopic($uid, $aid, $forumId, $thread, $text, $umfrage_thema, $options, $ends)
    {
        $db = DB::getInstance();
        //getting forum for area option.(if it's closed forum this topic is also closed)
        $forum = $db->query("SELECT area FROM forum_forums WHERE id=$forumId AND aid=$aid");
        if (!$forum->num_rows) {
            return FALSE;
        }//no forum found!
        $area = $forum->fetch_assoc()['area'];
        $closed = 0;
        if ($area == 3 || $area == 0) {
            $closed = 1;
        }//all right this is a closed forum.
        //inserting topic
        $SurveyStartTime = time();
        $db->query("INSERT INTO forum_topic (forumId, thread, close, SurveyStartTime, Survey, end_time) VALUES ('$forumId', '$thread', '$closed', '$SurveyStartTime', '$umfrage_thema', '$ends')");
        $topicId = $db->lastInsertId();
        //we will add a post.
        //adding options on the survey.
        if (!empty($umfrage_thema) && is_array($options)) {
            foreach ($options as $option) {
                if (empty($option)) {
                    continue;
                }
                $this->addOption($topicId, $option);
            }
        }
        $isAdmin = Session::getInstance()->hasAlliancePermission(AllianceModel::MANAGE_FORUM);
        $this->addPost($uid, $aid, $forumId, $topicId, $text, Session::getInstance()->isSitter(), $isAdmin);

        return $topicId;
    }

    /**
     * @param $topicId -> topic ID
     * @param $desc -> desc of the option.
     *                 => this will add an option to Survey.
     */
    public function addOption($topicId, $desc)
    {
        $db = DB::getInstance();
        $desc = $db->real_escape_string($desc);
        $db->query("INSERT INTO forum_options (topicId, option_desc) VALUES ($topicId, '$desc')");
    }

    /**
     * @param $uid - player id who sends this post
     * @param $aid - session alliance ID
     * @param $forumId - forum parent Id
     * @param $aid - the alliance ID of current user session.
     * @param $topicId - topic id where post will be gone to!
     * @param $post - post message
     * @param $isAdmin - if the player is admin we don't use closed topic.
     */
    public function addPost($uid, $aid, $forumId, $topicId, $post, $isSitter = FALSE, $isAdmin = FALSE)
    {
        if (!$aid) {
            return FALSE;
        } //how you will access here i don't know but you can't.
        $db = DB::getInstance();
        $post = $db->real_escape_string($post);
        //checking for closed forum.
        $find = $db->query("SELECT aid, area, sitter FROM forum_forums WHERE id=$forumId");
        if (!$find->num_rows) {
            return FALSE;
        } //no forum found! congrats bug!
        $forum = $find->fetch_assoc();
        if ($isSitter && $forum['sitter'] == 0) {
            return FALSE;
        } //this forum is not allowed for sitter to post in.
        $isAdmin = $isAdmin && $forum['aid'] == $aid; //check whether it's own alliance or not! maybe we are admin for other alliances!
        if ($forum['area'] == 1 && $forum['aid'] <> $aid && !$this->isForumShownForAlliance($forumId,
                $forum['aid'],
                $aid)) {
            //conf forum.
            return FALSE;
        }
        $topic = $db->query("SELECT close FROM forum_topic WHERE id=$topicId");
        if (!$topic->num_rows) {
            return FALSE;
        } //topic not found.
        $topic = $topic->fetch_assoc();
        //maybe the topic is closed.
        if (!$isAdmin && $topic['close'] && ($forum['area'] <> 1 || !$this->isTopicOpenedForUser($forumId, $uid))) {
            return FALSE;
        }
        //all done ....
        $db->query("INSERT INTO forum_post (aid, uid, forumId, topicId, post, time, deleted) VALUES ($aid, $uid, $forumId, $topicId, '$post', " . time() . ", 0)");
    }

    /**
     * @param $forumId -> forum ID
     * @param $aid1 -> forum owner alliance ID if it is set to 0 we'll get it.
     * @param $aid2 -> session alliance ID
     *                 => checks whether you can view this or not.
     *
     * @return bool
     */
    public function isForumShownForAlliance($forumId, $aid1, $aid2)
    {
        $db = DB::getInstance();
        if ($aid1 == 0) {
            //get alliance ID from forum.
            $aid1 = $db->fetchScalar("SELECT aid FROM forum_forums WHERE id=$forumId");
            if (!$aid1) {
                return FALSE;
            }
        }
        //check for alliances.
        $allowed = 0 < $db->fetchScalar("SELECT COUNT(id) FROM diplomacy WHERE ((aid1=$aid1 AND aid2=$aid2) OR (aid1=$aid2 AND aid2=$aid1)) AND accepted=1");
        if ($allowed) {
            return TRUE;
        } //it's allowed go on.
        $find = 0 < $db->fetchScalar("SELECT COUNT(id) FROM forum_open_alliances WHERE forumId=$forumId AND aid=$aid2");
        if ($find) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * @param $forumId -> Forum ID
     * @param $uid -> user ID
     *                 => gets if a player have access to a closed topic or not!
     *
     * @return bool
     */
    public function isTopicOpenedForUser($forumId, $uid)
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT COUNT(id) FROM forum_open_players WHERE forumId=$forumId AND uid=$uid");
        if ($find->num_rows) {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * @param $topicId -> topic ID
     * @param $value -> value of vote.
     *                 => gets how much an option is voted.
     *
     * @return mixed
     */
    public function getTopicVotesCount($topicId, $value)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM forum_vote WHERE topicId=$topicId AND value=$value");
    }

    public function getTotalVotes($topicId)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM forum_vote WHERE topicId=$topicId");
    }

    public function getTotalPostsCount($topicId)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM forum_post WHERE topicId=$topicId AND deleted=0");
    }

    public function getPlayerPostsCount($aid, $uid)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM forum_post WHERE aid=$aid AND uid=$uid");
    }

    public function getPost($id)
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT * FROM forum_post WHERE id=$id AND deleted=0");
        if (!$find->num_rows) {
            return FALSE;
        }

        return $find->fetch_assoc();
    }

    public function getPosts($topicId, $page)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM forum_post WHERE topicId=$topicId AND deleted=0 LIMIT " . (($page - 1) * 10) . ", 10");
    }

    public function hasForumNewEntries($forumId)
    {
        $last = $this->getForumLastPost($forumId, TRUE);
        if ($last === FALSE) {
            return FALSE;
        }
        if (time() - $last['time'] <= 3 * 86400) {
            return TRUE;
        }

        return TRUE;
    }

    /**
     * @param $forumId
     * gets the forum last post.
     *
     * @return array|bool
     */
    public function getForumLastPost($forumId, $justTime = FALSE)
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT " . ($justTime ? "time" : "*") . " FROM forum_post WHERE forumId=$forumId AND deleted=0 ORDER BY time DESC LIMIT 1");;
        if (!$find->num_rows) {
            return FALSE;
        }

        return $find->fetch_assoc();
    }

    /**
     * @param $topicId -> topic ID
     *                 => this will be Survey options.
     *
     * @return bool|\mysqli_result
     */
    public function getOptions($topicId)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM forum_options WHERE topicId=$topicId");
    }

    /**
     * @param $aid => alliance ID which we want to get public forum from.
     *             get the public forum of an alliance with $aid
     *
     * @return bool|\mysqli_result
     */
    public function getPublicForum($aid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM forum_forums WHERE aid=$aid AND area=0 ORDER BY pos ASC");
    }

    /**
     * @param $forumId => forum ID
     *                 => gets the number of topics a forum have.
     *
     * @return int
     */
    public function getForumTopicsCount($forumId)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id) FROM forum_topic WHERE forumId=$forumId");
    }

    public function getPlayerName($uid, $NA = FALSE)
    {
        $db = DB::getInstance();
        $name = $db->fetchScalar("SELECT name FROM users WHERE id=$uid");
        if (!$name) {
            return $NA ? NULL : '<span class="none2">[?]</span>';
        }

        return $name;
    }

    public function getPlayerRow($uid, $cols = '*')
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT $cols FROM users WHERE id=$uid");
        if (!$find->num_rows) {
            [];
        }

        return $find->fetch_assoc();
    }

    public function getPlayerAllianceID($uid, $NA = FALSE)
    {
        $db = DB::getInstance();
        $find = $db->fetchScalar("SELECT aid FROM users WHERE id=$uid");
        if (!$find) {
            return $NA ? NULL : 0;
        }

        return $find;
    }

    public function getPlayerTotalVillagesAndPop($uid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT total_pop, total_villages FROM user WHERE id=$uid")->fetch_assoc();
    }

    /**
     * @param $topicId
     * get topic last post
     *
     * @return array|bool
     */
    public function getTopicLastPost($topicId, $justTime = FALSE)
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT " . ($justTime ? "time" : "*") . " FROM forum_post WHERE topicId=$topicId AND deleted=0 ORDER BY time DESC LIMIT 1");;
        if (!$find->num_rows) {
            return FALSE;
        }

        return $find->fetch_assoc();
    }

    /**
     * @param $forumId
     * => this will get all topic that a forum belongs to.
     *
     * @return bool|\mysqli_result
     */
    public function getForumTopics($forumId)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM forum_topic WHERE forumId=$forumId");
    }

    /**
     * @param      $aid => current alliance ID
     * @param      $aid2 => current session alliance ID
     * @param bool $sitter => is sitter or what?
     *                     => gets the Confederacies Forum.
     *
     * @return array
     */
    public function getConfederaciesForums($aid, $aid2)
    {
        $db = DB::getInstance();
        $assoc = [];
        $find = $db->query("SELECT * FROM forum_forums WHERE aid=$aid AND area=1");
        while ($row = $find->fetch_assoc()) {
            if ($aid2 <> $aid && (!$aid2 || !$this->isForumShownForAlliance($row['id'], $row['aid'], $aid2))) {
                continue;
            }
            $assoc[] = $row;
        }
        $find->free();

        return $assoc;
    }

    public function editTopic($row, $aid, $name, $fid)
    {
        $db = DB::getInstance();
        if ($fid <> $row['forumId']) {
            $find = $db->fetchScalar("SELECT COUNT(id) FROM forum_forums WHERE aid=$aid AND id=$fid");
            if (!$find) {
                $fid = $row['fid'];
            }
        }
        $db->query("UPDATE forum_topic SET thread='{$name}', forumId=$fid WHERE id={$row['id']}");
    }

    public function AllianceHasAnyForums($aid1, $aid2)
    {
        $db = DB::getInstance();
        $total = 0;
        //always we have public forum.
        $total += $db->fetchScalar("SELECT COUNT(id) FROM forum_forums WHERE aid=$aid1 AND area=0");
        if ($aid2 > 0 && $aid1 == $aid2) {
            //other my alliance forums.
            $total += $db->fetchScalar("SELECT COUNT(id) FROM forum_forums WHERE aid=$aid1 AND (area>0)");
        } else {
            $assoc = [];
            $find = $db->query("SELECT id, aid FROM forum_forums WHERE aid=$aid1 AND area=1");
            while ($row = $find->fetch_assoc()) {
                if (!$aid2 || !$this->isForumShownForAlliance($row['id'], $aid1, $aid2)) {
                    continue;
                }
                $assoc[] = $row;
            }
            $find->free();
            $total += sizeof($assoc);
        }

        return $total > 0;
    }

    /**
     * @param $aid -> target alliance ID
     *             => this will get Alliance forum which is just for alliance members.
     *
     * @return bool|\mysqli_result
     */
    public function getAllianceForum($aid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM forum_forums WHERE aid=$aid AND area=2 ORDER BY pos ASC");
    }

    /**
     * @param $aid -> target alliance ID
     *             => this will get closed forums which only allowed players can post.
     *
     * @return bool|\mysqli_result
     */
    public function getClosedForum($aid)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM forum_forums WHERE aid=$aid AND area=3");
    }

    public function addForum($aid, $name, $desc, $area, $sitter, $allys_by_id, $allys_by_name, $users_by_id, $users_by_name)
    {
        $db = DB::getInstance();
        $name = $db->real_escape_string($name);
        $desc = $db->real_escape_string($desc);
        if (strlen($name) >= 20) {
            return 0;
        }
        if (strlen($desc) >= 38) {
            return 0;
        }


        $pos = $db->fetchScalar("SELECT COUNT(id) FROM forum_forums WHERE aid=$aid AND area=$area");
        $db->query("INSERT INTO forum_forums (aid, name, forum_desc, area, sitter, pos) VALUES ('$aid', '$name', '$desc', '$area', '$sitter', '$pos')");
        $forumId = $db->lastInsertId();
        if ($area == 1) {
            //conf forum
            if (is_array($allys_by_id)) {
                foreach ($allys_by_id as $allianceId) {
                    $this->addAllowedAlliance($forumId, $allianceId);
                }
            }
            if (is_array($allys_by_name)) {
                foreach ($allys_by_name as $allianceName) {
                    $this->addAllowedAlliance($forumId, $allianceName, TRUE);
                }
            }
        } else if ($area == 3) {
            //closed forum
            if (is_array($users_by_id)) {
                foreach ($users_by_id as $userId) {
                    $this->addAllowedUser($forumId, $userId);
                }
            }
            if (is_array($users_by_name)) {
                foreach ($users_by_name as $name) {
                    $this->addAllowedUser($forumId, $name, TRUE);
                }
            }
        }

        return $forumId;
    }

    public function addAllowedAlliance($forumId, $allianceId, $tag = FALSE)
    {
        if (empty($allianceId)) {
            return FALSE;
        }
        $db = DB::getInstance();
        if ($tag) {
            $tag = $db->real_escape_string($tag);
            $allianceId = $db->fetchScalar("SELECT id FROM alidata WHERE tag='$tag' LIMIT 1");
            if (!$allianceId) {
                return FALSE;
            }
        }
        $find = 0 < $db->fetchScalar("SELECT COUNT(id) FROM forum_open_alliances WHERE aid=$allianceId AND forumId=$forumId");
        if ($find) {
            return FALSE;
        }
        $find = 0 < $db->fetchScalar("SELECT COUNT(id) FROM alidata WHERE id=$allianceId");
        if (!$find) {
            return FALSE;
        }
        $db->query("INSERT INTO forum_open_alliances (forumId, aid) VALUES ($forumId, $allianceId)");
    }

    public function addAllowedUser($forumId, $uid, $name = FALSE)
    {
        if (empty($uid)) {
            return FALSE;
        }
        $db = DB::getInstance();
        if ($name) {
            $name = $db->real_escape_string($name);
            $uid = $db->fetchScalar("SELECT id FROM users WHERE name='$name' LIMIT 1");
            if (!$uid) {
                return FALSE;
            }
        }
        $find = $db->fetchScalar("SELECT COUNT(id) FROM forum_open_players WHERE uid=$uid AND forumId=$forumId");
        if ($find) {
            return FALSE;
        }
        $find = $db->fetchScalar("SELECT COUNT(id) FROM users WHERE id=$uid");
        if (!$find) {
            return FALSE;
        }
        $db->query("INSERT INTO forum_open_players (uid, forumId) VALUES ($uid, $forumId)");
    }

    public function editForum($forumId, $name, $desc, $sitter, $bnds, $allys_by_id, $allys_by_name, $users, $users_by_id, $users_by_name)
    {
        $db = DB::getInstance();
        $name = $db->real_escape_string($name);
        $desc = $db->real_escape_string($desc);
        $allys_by_name = $db->real_escape_string($allys_by_name);
        $users_by_name = $db->real_escape_string($users_by_name);
        $db->query("DELETE FROM forum_open_players WHERE forumId=$forumId " . (sizeof($users) ? " AND uid NOT IN(" . implode(",",
                    $users) . ")" : ''));
        $db->query("DELETE FROM forum_open_alliances WHERE forumId=$forumId " . (sizeof($bnds) ? " AND uid NOT IN(" . implode(",",
                    $bnds) . ")" : ''));
        if (is_array($allys_by_id)) {
            foreach ($allys_by_id as $allianceId) {
                $this->addAllowedAlliance($forumId, $allianceId);
            }
        }
        if (is_array($allys_by_name)) {
            foreach ($allys_by_name as $allianceName) {
                $this->addAllowedAlliance($forumId, $allianceName, TRUE);
            }
        }
        if (is_array($users_by_id)) {
            foreach ($users_by_id as $userId) {
                $this->addAllowedUser($forumId, $userId);
            }
        }
        if (is_array($users_by_name)) {
            foreach ($users_by_name as $name) {
                $this->addAllowedUser($forumId, $name, TRUE);
            }
        }
        $db->query("UPDATE forum_forums SET name='$name', forum_desc='$desc', sitter='$sitter' WHERE id=$forumId");
    }

    /**
     * @param $forumId -> Forum ID
     * @param $aid -> session Alliance ID
     *                 => this will delete a forum will all dependencies.
     */
    public function deleteForum($forumId, $aid)
    {
        $db = DB::getInstance();
        $db->query("DELETE FROM forum_open_players WHERE forumId=$forumId");
        $db->query("DELETE FROM forum_open_alliances WHERE forumId=$forumId");
        $topics = $db->query("SELECT id FROM forum_topic WHERE forumId=$forumId");
        while ($row = $topics->fetch_assoc()) {
            $this->deleteTopic($row['id'], $aid);
        }
        $db->query("DELETE FROM forum_forums WHERE id=$forumId");
        //$this->recalculateForumPositions($aid);
    }

    /**
     * @param $id -> topic id
     * @param $aid -> alliance id which this topic belongs to!
     *             => deletes a topic will all dependencies.
     *
     * @return bool
     */
    public function deleteTopic($id, $aid)
    {
        $db = DB::getInstance();
        //getting forumId from topic to validate alliances.
        $find = $db->query("SELECT forumId FROM forum_topic WHERE id=$id");
        if (!$find->num_rows) {
            return FALSE;
        } //no topic found!
        $forumId = $find->fetch_assoc()['forumId'];
        //getting parent forum alliance Id
        $find = $db->query("SELECT aid FROM forum_forums WHERE id=$forumId");
        if (!$find->num_rows) {
            return FALSE;
        } //no forum found! congrats bug!
        $allianceId = $find->fetch_assoc()['aid'];
        if ($aid <> $allianceId) {
            return FALSE;
        } //alliances doesn't match!
        //deletion
        //delete topic vote options.
        $db->query("DELETE FROM forum_options WHERE topicId=$id");
        //delete topic votes.
        $db->query("DELETE FROM forum_vote WHERE topicId=$id");
        //getting posts to delete edits.
        $find = $db->query("SELECT id FROM forum_post WHERE topicId=$id");
        while ($row = $find->fetch_assoc()) {
            $db->query("DELETE FROM forum_edit WHERE postId={$row['id']}");
        }
        $find->free();
        //deleting posts.
        $db->query("UPDATE forum_post SET deleted=1 WHERE topicId=$id");
        //deleting topic
        $db->query("DELETE FROM forum_topic WHERE id=$id");

        return $forumId;
    }

    public function getTopicAnswersCount($topicId)
    {
        $db = DB::getInstance();

        return $db->fetchScalar("SELECT COUNT(id)-1 FROM forum_post WHERE topicId=$topicId");
    }

    public function getForum($aid, $aid2, $forumId)
    {
        $db = DB::getInstance();
        $forum = $db->query("SELECT * FROM forum_forums WHERE id=$forumId");
        if (!$forum->num_rows) {
            return FALSE;
        }
        $forum = $forum->fetch_assoc();
        if ($aid <> $aid2 && $forum['area'] == 1 && !$this->isForumShownForAlliance($forumId, $aid, $aid2)) {
            return FALSE;
        }

        return $forum;
    }

    public function getTopic($id)
    {
        $db = DB::getInstance();
        $forum = $db->query("SELECT * FROM forum_topic WHERE id=$id");
        if (!$forum->num_rows) {
            return FALSE;
        }

        return $forum->fetch_assoc();
    }

    public function getAllowedAlliancesForForum($forumId)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM forum_open_alliances WHERE forumId=$forumId");
    }

    public function getAllowedPlayersForForum($forumId)
    {
        $db = DB::getInstance();

        return $db->query("SELECT * FROM forum_open_players WHERE forumId=$forumId");
    }

    public function getAllianceNameAndTag($aid)
    {
        $db = DB::getInstance();
        $find = $db->query("SELECT name, tag FROM alidata WHERE id=$aid");
        if (!$find->num_rows) {
            return ["name" => NULL, "tag" => NULL];
        }

        return $find->fetch_assoc();
    }

    /**
     * @param $aid -> current Session Alliance ID
     * @param $forumId
     * @param $pos
     */
    public function changeForumPosition($aid, $forumId, $pos)
    {
        $db = DB::getInstance();
        $forum = $db->query("SELECT pos, area FROM forum_forums WHERE aid=$aid AND id=$forumId");
        if (!$forum->num_rows) {
            return;
        }
        $forum = $forum->fetch_assoc();
        $cur_pos = $forum['pos'];
        $area = $forum['area'];
        if ($pos == 1) {
            $db->query("UPDATE forum_forums SET pos=pos" . ($pos == -1 ? '+1' : '-1') . " WHERE pos>$cur_pos AND area=$area");
            $db->query("UPDATE forum_forums SET pos=pos" . ($pos == 1 ? '+1' : '-1') . " WHERE pos<$cur_pos AND area=$area");
        } else {
            $db->query("UPDATE forum_forums SET pos=pos" . ($pos == 1 ? '+1' : '-1') . " WHERE pos>$cur_pos AND area=$area");
            $db->query("UPDATE forum_forums SET pos=pos" . ($pos == -1 ? '+1' : '-1') . " WHERE pos<$cur_pos AND area=$area");
        }
        $db->query("UPDATE forum_forums SET pos=IF(pos" . ($pos == 1 ? '+1' : '-1') . ">0, pos" . ($pos == 1 ? '+1' : '-1') . ", 0) WHERE id=$forumId");
    }
} 