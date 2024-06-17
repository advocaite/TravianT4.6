<?php

namespace Core\Jobs;

use Core\Automation;
use Model\AdventureModel;
use Model\AuctionModel;
use Model\AutoExtendModel;
use Model\DailyQuestModel;
use Model\FakeUserModel;
use Model\inactiveModel;
use Model\MedalsModel;
use Model\NatarsModel;

class Launcher
{
    private static $_self;

    public static function lunchJobs()
    {
        set_time_limit(0);
        ini_set("memory_limit", -1);
        self::getInstance()->buildComplete();
        self::getInstance()->movementComplete();
        self::getInstance()->trainingComplete();
        self::getInstance()->gameProgress();
        self::getInstance()->routineJobs();
        self::getInstance()->AIProgress();
        self::getInstance()->postService();
    }

    public function buildComplete()
    {
        $jobs = [];
        {
            $job = [Automation::getInstance(), 'tradeRoutes'];
            $jobs[] = new Job('marketComplete:tradeRoute', 5, $job);
        }
        {
            $job = [Automation::getInstance(), 'researchComplete'];
            $jobs[] = new Job('marketComplete:researchComplete', 3, $job);
        }
        {
            $job = [Automation::getInstance(), 'marketComplete'];
            $jobs[] = new Job('marketComplete:marketComplete', 2, $job);
        }
        {
            $job = [new AuctionModel(), 'doAuction'];
            $jobs[] = new Job('auctionComplete:doAuction', 5, $job);
        }
        {
            $job = [new AuctionModel(), 'fakeAuction'];
            $jobs[] = new Job('routineJobs:fakeAuction', 600, $job);
        }
        {
            $job = [Automation::getInstance(), 'buildComplete'];
            $jobs[] = new Job('buildComplete:buildComplete', 1, $job);
        }
        if(getCustom('autoRaidEnabled')){
            {
                $job = [Automation::getInstance(), 'autoFarmlist'];
                $jobs[] = new Job('autoFarmlist', 30, $job);
            }
        }
        new Job('buildComplete', 1, $jobs, TRUE);
    }

    public static function getInstance()
    {
        if (!(self::$_self instanceof self)) {
            self::$_self = new self();
        }
        return self::$_self;
    }

    public function movementComplete()
    {
        new Job('movementComplete', 0, [Automation::getInstance(), 'attackMovementComplete'], TRUE);
        new Job('movementComplete', 0, [Automation::getInstance(), 'otherMovementComplete'], TRUE);
    }

    public function trainingComplete()
    {
        new Job('trainingComplete', 1, [Automation::getInstance(), 'trainingComplete'], TRUE);
    }

    public function gameProgress()
    {
        $jobs = [];
        {
            $job = [Automation::getInstance(), 'checkAutoFinish'];
            $jobs[] = new Job('gameProgress:checkAutoFinish', 30, $job);
        }
        {
            $job = [Automation::getInstance(), 'setUpNewServer'];
            $jobs[] = new Job('gameProgress:setUpNewServer', 60, $job);
        }
        {
            $job = [Automation::getInstance(), 'boughtGoldMessage'];
            $jobs[] = new Job('gameProgress:boughtGoldMessage', 10, $job);
        }
        {
            $job = [Automation::getInstance(), 'banProgress'];
            $jobs[] = new Job('gameProgress:banProgress', 120, $job);
        }
        {
            $job = [Automation::getInstance(), 'referenceCheck'];
            $jobs[] = new Job('gameProgress:referenceCheck', 30, $job);
        }
        {
            $job = [new NatarsModel(), 'runJobs'];
            $jobs[] = new Job('gameProgress:ArtifactReleases', 30, $job);
        }
        {
            $job = [new MedalsModel(), 'resetMedals'];
            $jobs[] = new Job('gameProgress:resetMedals', 30, $job);
        }
        {
            $job = [new DailyQuestModel(), 'resetDailyQuest'];
            $jobs[] = new Job('gameProgress:resetDailyQuest', 30, $job);
        }
        {
            $job = [new AutoExtendModel(), 'processAutoExtend'];
            $jobs[] = new Job('generalProgress:autoExtend', 60, $job);
        }
        {
            $job = [Automation::getInstance(), 'updateFoolArtifact'];
            $jobs[] = new Job('generalProgress:updateFoolArtifact', 120, $job);
        }
        {
            $job = [Automation::getInstance(), 'checkForArtifactActivation'];
            $jobs[] = new Job('generalProgress:checkForArtifactActivation', 5, $job);
        }
        {
            $job = [Automation::getInstance(), 'cleanupServer'];
            $jobs[] = new Job('generalProgress:cleanupServer', 300, $job);
        }
        {
            $job = [Automation::getInstance(), 'deleteOasisComplete'];
            $jobs[] = new Job('loyaltyAndCulturePoint:deleteOasisComplete', 60, $job);
        }
        {
            $job = [Automation::getInstance(), 'handleAllianceBonusTasks'];
            $jobs[] = new Job('gameProgress:allianceBonus', 60, $job);
        }
        {
            $job = [Automation::getInstance(), 'zeroPopVillages'];
            $jobs[] = new Job('generalProgress:zeroPopVillages', 10, $job);
        }
        new Job('gameProgress', 10, $jobs, TRUE);
    }

    public function routineJobs()
    {
        $jobs = [];
        {
            $job = [new AdventureModel(), 'checkForNewAdventures'];
            $jobs[] = new Job('routineJobs:checkForNewAdventures', 10, $job);
        }
        {
            $job = [Automation::getInstance(), 'checkGameFinish'];
            $jobs[] = new Job('checkIndexFunctions:checkGameFinish', 30, $job);
        }
        {
            $job = [new inactiveModel(), 'startWorker'];
            $jobs[] = new Job('checkIndexFunctions:clearAndDeleting', 30, $job);
        }
        {
            $job = [Automation::getInstance(), 'cleanupIndex'];
            $jobs[] = new Job('checkIndexFunctions:cleanupIndex', 600, $job);
        }
        {
            $job = [Automation::getInstance(), 'refreshCountryFlag'];
            $jobs[] = new Job('mayExitJobs:refreshCountryFlag', 100, $job);
        }
        {
            $job = [Automation::getInstance(), 'resetDailyGold'];
            $jobs[] = new Job('mayExitJobs:resetDailyGold', 45, $job);
        }
        {
            $job = [Automation::getInstance(), 'backup'];
            $jobs[] = new Job('mayExitJobs:backup', 360, $job);
        }
        new Job('routineJobs', 20, $jobs, TRUE);
    }

    public function AIProgress()
    {
        $fakeModel = new FakeUserModel();
        $jobs = [];
        {
            $job = [$fakeModel, 'handleFakeUsers'];
            $jobs[] = new Job('AIProgress:handleFakeUsers', 45, $job);
        }
        {
            $job = [$fakeModel, 'handleFakeUserExpands'];
            $jobs[] = new Job('AIProgress:handleFakeUserExpands', 45, $job);
        }
        $natarsModel = new NatarsModel();
        {
            $job = [$natarsModel, 'handleNatarVillages'];
            $jobs[] = new Job('AIProgress:handleNatarVillages', 15, $job);
        }
        {
            $job = [$natarsModel, 'handleNatarExpansion'];
            $jobs[] = new Job('AIProgress:handleNatarExpansion', 15, $job);
        }
        new Job('AIProgress', 5, $jobs, TRUE);
    }

    public function postService()
    {
        new Job('postService', 100, [Automation::getInstance(), 'postService'], TRUE);
    }
}