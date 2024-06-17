DROP TABLE IF EXISTS `a2b`;
CREATE TABLE `a2b`
(
  `id`                 BIGINT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `timestamp`          INT(10) UNSIGNED    NOT NULL DEFAULT '0',
  `timestamp_checksum` VARCHAR(6)          NOT NULL,
  `to_kid`             INT(6) UNSIGNED     NOT NULL,
  `u1`                 BIGINT(50) UNSIGNED NOT NULL,
  `u2`                 BIGINT(50) UNSIGNED NOT NULL,
  `u3`                 BIGINT(50) UNSIGNED NOT NULL,
  `u4`                 BIGINT(50) UNSIGNED NOT NULL,
  `u5`                 BIGINT(50) UNSIGNED NOT NULL,
  `u6`                 BIGINT(50) UNSIGNED NOT NULL,
  `u7`                 BIGINT(50) UNSIGNED NOT NULL,
  `u8`                 BIGINT(50) UNSIGNED NOT NULL,
  `u9`                 BIGINT(50) UNSIGNED NOT NULL,
  `u10`                BIGINT(50) UNSIGNED NOT NULL,
  `u11`                TINYINT(1) UNSIGNED NOT NULL,
  `attack_type`        TINYINT(1) UNSIGNED NOT NULL,
  `redeployHero`       TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY (`timestamp`, `timestamp_checksum`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `daily_quest`;
CREATE TABLE IF NOT EXISTS `daily_quest`
(
  `uid`                   INT(10) UNSIGNED     NOT NULL,
  `qst1`                  TINYINT(1) UNSIGNED  NOT NULL DEFAULT '0',
  `qst2`                  TINYINT(1) UNSIGNED  NOT NULL DEFAULT '0',
  `qst3`                  TINYINT(1) UNSIGNED  NOT NULL DEFAULT '0',
  `qst4`                  TINYINT(1) UNSIGNED  NOT NULL DEFAULT '0',
  `qst5`                  TINYINT(1) UNSIGNED  NOT NULL DEFAULT '0',
  `qst6`                  TINYINT(1) UNSIGNED  NOT NULL DEFAULT '0',
  `qst7`                  TINYINT(1) UNSIGNED  NOT NULL DEFAULT '0',
  `qst8`                  TINYINT(1) UNSIGNED  NOT NULL DEFAULT '0',
  `qst9`                  TINYINT(1) UNSIGNED  NOT NULL DEFAULT '0',
  `qst10`                 TINYINT(1) UNSIGNED  NOT NULL DEFAULT '0',
  `qst11`                 TINYINT(1) UNSIGNED  NOT NULL DEFAULT '0',
  `alliance_contribution` BIGINT(255) UNSIGNED NOT NULL DEFAULT '0',
  `reward1Type`           TINYINT(1) UNSIGNED           DEFAULT '0',
  `reward1Done`           TINYINT(1) UNSIGNED           DEFAULT '0',
  `reward2Type`           TINYINT(1) UNSIGNED           DEFAULT '0',
  `reward2Done`           TINYINT(1) UNSIGNED           DEFAULT '0',
  `reward3Type`           TINYINT(1) UNSIGNED           DEFAULT '0',
  `reward3Done`           TINYINT(1) UNSIGNED           DEFAULT '0',
  `reward4Type`           TINYINT(1) UNSIGNED           DEFAULT '0',
  `reward4Done`           TINYINT(1) UNSIGNED           DEFAULT '0',
  PRIMARY KEY (`uid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `log_ip`;
CREATE TABLE IF NOT EXISTS `log_ip`
(
  `id`   INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid`  INT(11)          NOT NULL,
  `ip`   BIGINT(12)       NOT NULL,
  `time` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`, `time`, `ip`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `summary`;
CREATE TABLE IF NOT EXISTS `summary`
(
  `id`                        INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `players_count`             INT(11)          NOT NULL DEFAULT '0',
  `roman_players_count`       INT(11)          NOT NULL DEFAULT '0',
  `teuton_players_count`      INT(11)          NOT NULL DEFAULT '0',
  `gaul_players_count`        INT(11)          NOT NULL DEFAULT '0',
  `egyptians_players_count`   INT(11)          NOT NULL DEFAULT '0',
  `huns_players_count`        INT(11)          NOT NULL DEFAULT '0',
  `first_village_player_name` VARCHAR(255)     NULL     DEFAULT NULL,
  `first_village_time`        INT(11)          NOT NULL DEFAULT '0',
  `first_art_player_name`     VARCHAR(255)     NULL     DEFAULT NULL,
  `first_art_time`            INT(11)          NOT NULL DEFAULT '0',
  `first_ww_plan_player_name` VARCHAR(255)     NULL     DEFAULT NULL,
  `first_ww_plan_time`        INT(11)          NOT NULL DEFAULT '0',
  `first_ww_player_name`      VARCHAR(255)     NULL     DEFAULT NULL,
  `first_ww_time`             INT(11)          NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 2;
INSERT INTO `summary` (`id`)
VALUES (1);

DROP TABLE IF EXISTS `casualties`;
CREATE TABLE IF NOT EXISTS `casualties`
(
  `id`         INT(10) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `attacks`    INT(10) UNSIGNED    NOT NULL DEFAULT '0',
  `casualties` BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `time`       INT(10) UNSIGNED    NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time` (`time`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS `activation`;
CREATE TABLE `activation`
(
  `id`       INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`     VARCHAR(15)      NOT NULL,
  `password` VARCHAR(40)      NOT NULL,
  `email`    VARCHAR(90)      NULL     DEFAULT '',
  `token`    VARCHAR(32)      NOT NULL,
  `refUid`   INT(11)          NOT NULL,
  `time`     INT UNSIGNED     NOT NULL DEFAULT '0',
  `reminded` TINYINT UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `email` (`email`),
  KEY `token` (`token`),
  KEY `reminded` (`reminded`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `general_log`;
CREATE TABLE `general_log`
(
  `id`       BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid`      INT(11)             NOT NULL,
  `type`     VARCHAR(50)         NOT NULL,
  `log_info` LONGTEXT            NOT NULL,
  `time`     INT(11)             NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `type` (`type`),
  KEY `time` (`time`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `transfer_gold_log`;
CREATE TABLE `transfer_gold_log`
(
  `id`     INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid`    INT(11)          NOT NULL,
  `to_uid` INT(11)          NOT NULL,
  `amount` VARCHAR(50)      NOT NULL,
  `time`   INT(11)          NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `adventure`;
CREATE TABLE `adventure`
(
  `id`   INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `uid`  INT(11)             NOT NULL,
  `kid`  INT(6) UNSIGNED     NOT NULL,
  `dif`  TINYINT(1)          NOT NULL,
  `time` INT(10) UNSIGNED    NOT NULL,
  `end`  TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `kid` (`kid`),
  KEY `time` (`time`),
  KEY `end` (`end`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `ali_invite`;
CREATE TABLE `ali_invite`
(
  `id`       INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `from_uid` INT(11) UNSIGNED NOT NULL,
  `aid`      INT(11) UNSIGNED NOT NULL,
  `uid`      INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`),
  KEY `uid` (`uid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `ali_log`;
CREATE TABLE `ali_log`
(
  `id`   INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `aid`  INT(11)             NOT NULL,
  `type` TINYINT(1) UNSIGNED NOT NULL,
  `data` TEXT                NOT NULL,
  `time` INT(10) UNSIGNED    NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`type`),
  KEY (`time`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `alidata`;
CREATE TABLE `alidata`
(
  `id`                           INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `name`                         VARCHAR(25)         NOT NULL,
  `tag`                          VARCHAR(8)          NOT NULL,
  `desc1`                        TEXT                         DEFAULT NULL,
  `desc2`                        TEXT                         DEFAULT NULL,
  `info1`                        TEXT                         DEFAULT NULL,
  `info2`                        TEXT                         DEFAULT NULL,
  `forumLink`                    VARCHAR(200)                 DEFAULT NULL,
  `max`                          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `total_attack_points`          BIGINT(255)         NOT NULL DEFAULT '0',
  `total_defense_points`         BIGINT(255)         NOT NULL DEFAULT '0',
  `week_attack_points`           BIGINT(255)         NOT NULL DEFAULT '0',
  `week_defense_points`          BIGINT(255)         NOT NULL DEFAULT '0',
  `week_robber_points`           BIGINT(255)         NOT NULL DEFAULT '0',
  `week_pop_changes`             BIGINT(255)         NOT NULL DEFAULT '0',
  `oldPop`                       BIGINT(255)         NOT NULL DEFAULT '0',
  `training_bonus_level`         TINYINT(1)          NOT NULL DEFAULT '0',
  `training_bonus_contributions` BIGINT(255)         NOT NULL DEFAULT '0',
  `armor_bonus_level`            TINYINT(1)          NOT NULL DEFAULT '0',
  `armor_bonus_contributions`    BIGINT(255)         NOT NULL DEFAULT '0',
  `cp_bonus_level`               TINYINT(1)          NOT NULL DEFAULT '0',
  `cp_bonus_contributions`       BIGINT(255)         NOT NULL DEFAULT '0',
  `trade_bonus_level`            TINYINT(1)          NOT NULL DEFAULT '0',
  `trade_bonus_contributions`    BIGINT(255)         NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY (`tag`, `name`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `alistats`;
CREATE TABLE IF NOT EXISTS `alistats`
(
  `id`              INT(11) UNSIGNED     NOT NULL AUTO_INCREMENT,
  `aid`             INT(11) UNSIGNED     NOT NULL,
  `killed_by`       BIGINT(255) UNSIGNED NOT NULL DEFAULT '0',
  `stolen_by`       BIGINT(255) UNSIGNED NOT NULL DEFAULT '0',
  `killed_of`       BIGINT(255) UNSIGNED NOT NULL DEFAULT '0',
  `stolen_of`       BIGINT(255) UNSIGNED NOT NULL DEFAULT '0',
  `total_off_point` BIGINT(255) UNSIGNED NOT NULL DEFAULT '0',
  `total_def_point` BIGINT(255) UNSIGNED NOT NULL DEFAULT '0',
  `time`            INT(10) UNSIGNED              DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`),
  KEY `time` (`time`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS `allimedal`;
CREATE TABLE `allimedal`
(
  `id`       INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `aid`      INT(11) UNSIGNED    NOT NULL,
  `category` TINYINT(2) UNSIGNED NOT NULL,
  `week`     INT(3) UNSIGNED     NOT NULL,
  `rank`     TINYINT(2) UNSIGNED NOT NULL,
  `points`   VARCHAR(30)         NOT NULL,
  `img`      VARCHAR(10)         NOT NULL,
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`),
  KEY `rank` (`rank`),
  KEY `category` (`category`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS `artefacts`;
CREATE TABLE `artefacts`
(
  `id`          INT(11) UNSIGNED     NOT NULL AUTO_INCREMENT,
  `uid`         INT(11) UNSIGNED     NOT NULL,
  `kid`         INT(6) UNSIGNED      NOT NULL,
  `release_kid` INT(6) UNSIGNED      NOT NULL DEFAULT '0',
  `type`        SMALLINT(3) UNSIGNED NOT NULL,
  `size`        TINYINT(1) UNSIGNED  NOT NULL,
  `conquered`   INT(11) UNSIGNED     NOT NULL,
  `lastupdate`  INT(10) UNSIGNED     NOT NULL DEFAULT '0',
  `num`         SMALLINT(3)          NOT NULL,
  `effecttype`  SMALLINT(2)          NOT NULL,
  `effect`      DOUBLE               NOT NULL,
  `aoe`         INT(10)              NOT NULL,
  `status`      TINYINT(1)           NOT NULL DEFAULT '1',
  `active`      TINYINT(1)           NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY (`kid`),
  KEY (`size`),
  KEY (`conquered`),
  KEY (`status`),
  KEY (`type`),
  KEY (`effecttype`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `artlog`;
CREATE TABLE IF NOT EXISTS `artlog`
(
  `id`    INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `artId` INT(11) UNSIGNED NOT NULL,
  `uid`   INT(11)     DEFAULT NULL,
  `name`  VARCHAR(15) DEFAULT NULL,
  `kid`   INT(6) UNSIGNED  NOT NULL,
  `time`  INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `artId` (`artId`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS `auction`;
CREATE TABLE `auction`
(
  `id`        INT(11) UNSIGNED     NOT NULL AUTO_INCREMENT,
  `uid`       INT(11) UNSIGNED     NOT NULL,
  `btype`     TINYINT(2) UNSIGNED  NOT NULL,
  `type`      SMALLINT(3) UNSIGNED NOT NULL,
  `num`       BIGINT(100) UNSIGNED NOT NULL,
  `bids`      INT(11) UNSIGNED     NOT NULL DEFAULT '0',
  `silver`    INT(10) UNSIGNED     NOT NULL DEFAULT '0',
  `maxSilver` INT(10) UNSIGNED     NOT NULL DEFAULT '0',
  `activeUid` INT(10) UNSIGNED     NOT NULL DEFAULT '0',
  `activeId`  INT(11) UNSIGNED     NOT NULL DEFAULT '0',
  `secure_id` VARCHAR(100)         NOT NULL DEFAULT '',
  `time`      INT(10) UNSIGNED     NOT NULL,
  `finish`    TINYINT(1) UNSIGNED  NOT NULL DEFAULT '0',
  `cancel`    TINYINT(1) UNSIGNED  NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY (`activeUid`),
  KEY (`activeId`),
  KEY `finish` (`finish`),
  KEY `cancel` (`cancel`),
  KEY `uid` (`uid`),
  KEY `secure_id` (`secure_id`),
  KEY `time` (`time`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `bids`;
CREATE TABLE IF NOT EXISTS `bids`
(
  `id`        INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid`       INT(11) UNSIGNED NOT NULL,
  `auctionId` INT(11) UNSIGNED NOT NULL,
  `outbid`    TINYINT(1)       NOT NULL DEFAULT '0',
  `del`       TINYINT(1)       NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`, `auctionId`, `outbid`, `del`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS `accounting`;
CREATE TABLE IF NOT EXISTS `accounting`
(
  `id`      INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid`     INT(11) UNSIGNED NOT NULL,
  `cause`   VARCHAR(100)     NOT NULL,
  `reserve` INT(10)          NOT NULL,
  `balance` INT(10) UNSIGNED NOT NULL,
  `time`    INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`, `balance`, `time`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS `blocks`;
CREATE TABLE `blocks`
(
  `id`     INT(11) NOT NULL AUTO_INCREMENT,
  `kid`    INT(11) NOT NULL,
  `map_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kid` (`kid`),
  KEY `map_id` (`map_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;
DROP TABLE IF EXISTS `multiaccount_log`;
CREATE TABLE IF NOT EXISTS `multiaccount_log`
(
  `id`     INT(11) NOT NULL AUTO_INCREMENT,
  `uid`    INT(11) NOT NULL,
  `to_uid` INT(11) NOT NULL,
  `type`   INT(11) NOT NULL,
  `time`   INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `to_uid` (`to_uid`),
  KEY `uid` (`uid`),
  KEY `time` (`time`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;
DROP TABLE IF EXISTS `map_block`;
CREATE TABLE `map_block`
(
  `id`        INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `tx0`       MEDIUMINT(4)        NOT NULL,
  `ty0`       MEDIUMINT(4)        NOT NULL,
  `tx1`       MEDIUMINT(4)        NOT NULL,
  `ty1`       MEDIUMINT(4)        NOT NULL,
  `zoomLevel` TINYINT(1) UNSIGNED NOT NULL,
  `version`   INT(11)             NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tx0` (`tx0`, `ty0`, `tx1`, `ty1`, `version`),
  KEY `zoomLevel` (`zoomLevel`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;


DROP TABLE IF EXISTS `map_mark`;
CREATE TABLE `map_mark`
(
  `id`        INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `uid`       INT(11)             NOT NULL,
  `tx0`       MEDIUMINT(4)        NOT NULL,
  `ty0`       MEDIUMINT(4)        NOT NULL,
  `tx1`       MEDIUMINT(4)        NOT NULL,
  `ty1`       MEDIUMINT(4)        NOT NULL,
  `zoomLevel` TINYINT(1) UNSIGNED NOT NULL,
  `version`   INT(11)             NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tx0` (`uid`, `tx0`, `ty0`, `tx1`, `ty1`, `version`),
  KEY `zoomLevel` (`zoomLevel`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS `building_upgrade`;
CREATE TABLE `building_upgrade`
(
  `id`             INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `kid`            INT(6) UNSIGNED     NOT NULL,
  `building_field` TINYINT(2) UNSIGNED NOT NULL,
  `isMaster`       TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `start_time`     INT(10)             NOT NULL,
  `commence`       INT(11)             NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`building_field`, `isMaster`, `commence`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `deleting`;
CREATE TABLE `deleting`
(
  `uid`  INT(11) UNSIGNED NOT NULL,
  `time` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`uid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `demolition`;
CREATE TABLE `demolition`
(
  `id`             INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `kid`            INT(6) UNSIGNED     NOT NULL,
  `building_field` TINYINT(2) UNSIGNED NOT NULL,
  `end_time`       INT(10) UNSIGNED    NOT NULL,
  `complete`       TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`, `kid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `diplomacy`;
CREATE TABLE `diplomacy`
(
  `id`       INT(10) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `aid1`     INT(10) UNSIGNED    NOT NULL,
  `aid2`     INT(10) UNSIGNED    NOT NULL,
  `type`     TINYINT(1) UNSIGNED NOT NULL,
  `accepted` INT(1)              NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY (`aid1`, `aid2`, `type`, `accepted`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `enforcement`;
CREATE TABLE `enforcement`
(
  `id`     INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `uid`    INT(11) UNSIGNED    NOT NULL,
  `kid`    INT(6) UNSIGNED     NOT NULL DEFAULT '0',
  `to_kid` INT(6) UNSIGNED     NOT NULL DEFAULT '0',
  `race`   TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `u1`     BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u2`     BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u3`     BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u4`     BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u5`     BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u6`     BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u7`     BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u8`     BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u9`     BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u10`    BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u11`    TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `kid` (`kid`),
  KEY `to_kid` (`to_kid`),
  KEY `uid` (`uid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `face`;
CREATE TABLE `face`
(
  `uid`         INT(10) UNSIGNED NOT NULL,
  `headProfile` SMALLINT(2)      NOT NULL,
  `hairColor`   SMALLINT(2)      NOT NULL,
  `hairStyle`   SMALLINT(2)      NOT NULL,
  `ears`        SMALLINT(2)      NOT NULL,
  `eyebrow`     SMALLINT(2)      NOT NULL,
  `eyes`        SMALLINT(2)      NOT NULL,
  `nose`        SMALLINT(2)      NOT NULL,
  `mouth`       SMALLINT(2)      NOT NULL,
  `beard`       SMALLINT(2)      NOT NULL,
  `gender`      VARCHAR(6)       NOT NULL DEFAULT 'male',
  `lastupdate`  INT(11)          NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `farmlist`;
CREATE TABLE `farmlist`
(
  `id`       INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kid`      INT(10) UNSIGNED NOT NULL,
  `owner`    INT(10) UNSIGNED NOT NULL,
  `name`     VARCHAR(45)      NOT NULL,
  `auto`     TINYINT(1)       NOT NULL DEFAULT '0',
  `lastRaid` INT(11)          NOT NULL DEFAULT '0',
  `randSec`  INT(11)          NOT NULL DEFAULT '30',
  PRIMARY KEY (`id`),
  KEY (`kid`, `owner`, `name`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `fdata`;
CREATE TABLE `fdata`
(
  `kid`           INT(6) UNSIGNED     NOT NULL,
  `f1`            TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f1t`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f2`            TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f2t`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f3`            TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f3t`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f4`            TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f4t`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f5`            TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f5t`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f6`            TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f6t`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f7`            TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f7t`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f8`            TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f8t`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f9`            TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f9t`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f10`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f10t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f11`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f11t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f12`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f12t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f13`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f13t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f14`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f14t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f15`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f15t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f16`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f16t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f17`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f17t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f18`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f18t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f19`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f19t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f20`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f20t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f21`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f21t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f22`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f22t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f23`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f23t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f24`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f24t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f25`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f25t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f26`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f26t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f27`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f27t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f28`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f28t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f29`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f29t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f30`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f30t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f31`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f31t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f32`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f32t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f33`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f33t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f34`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f34t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f35`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f35t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f36`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f36t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f37`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f37t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f38`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f38t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f39`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f39t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f40`           TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f40t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `f99`           TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
  `f99t`          TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `embassy`       TINYINT(2)          NOT NULL DEFAULT '0',
  `heroMansion`   TINYINT(2)          NOT NULL DEFAULT '0',
  `lastWWUpgrade` BIGINT(20)          NOT NULL DEFAULT '0',
  `wwname`        VARCHAR(25)         NOT NULL DEFAULT '',
  PRIMARY KEY (`kid`),
  KEY `embassy` (`embassy`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `forum_forums`;
CREATE TABLE `forum_forums`
(
  `id`         INT(11)             NOT NULL AUTO_INCREMENT,
  `aid`        INT(11) UNSIGNED    NOT NULL,
  `name`       VARCHAR(20)         NOT NULL,
  `forum_desc` VARCHAR(38)         NOT NULL,
  `area`       TINYINT(1) UNSIGNED NOT NULL,
  `sitter`     TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `pos`        INT(6)              NOT NULL,
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`),
  KEY `area` (`area`),
  KEY `sitter` (`sitter`),
  KEY `pos` (`pos`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `forum_edit`;
CREATE TABLE `forum_edit`
(
  `id`     INT(11)          NOT NULL AUTO_INCREMENT,
  `uid`    INT(11) UNSIGNED NOT NULL,
  `postId` INT(11)          NOT NULL,
  `time`   INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `postId` (`postId`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `forum_options`;
CREATE TABLE IF NOT EXISTS `forum_options`
(
  `id`          INT(11) UNSIGNED        NOT NULL AUTO_INCREMENT,
  `topicId`     INT(11) UNSIGNED        NOT NULL,
  `option_desc` VARCHAR(60)
                  CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `topicId` (`topicId`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS `forum_post`;
CREATE TABLE `forum_post`
(
  `id`      INT(11)             NOT NULL AUTO_INCREMENT,
  `aid`     INT(11) UNSIGNED    NOT NULL,
  `uid`     INT(11) UNSIGNED    NOT NULL,
  `forumId` INT(11) UNSIGNED    NOT NULL,
  `topicId` INT(11) UNSIGNED    NOT NULL,
  `post`    LONGTEXT            NOT NULL,
  `time`    INT(10) UNSIGNED    NOT NULL,
  `deleted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `aid` (`time`),
  KEY `uid` (`time`),
  KEY `time` (`time`),
  KEY `forumId` (`forumId`),
  KEY `topicId` (`topicId`),
  KEY `deleted` (`deleted`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `forum_vote`;
CREATE TABLE IF NOT EXISTS `forum_vote`
(
  `id`      INT(11) NOT NULL AUTO_INCREMENT,
  `uid`     INT(11) NOT NULL,
  `topicId` INT(11) NOT NULL,
  `value`   INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`, `topicId`, `value`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS `forum_open_players`;
CREATE TABLE IF NOT EXISTS `forum_open_players`
(
  `id`      INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid`     INT(11) UNSIGNED NOT NULL,
  `forumId` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`, `forumId`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS `forum_open_alliances`;
CREATE TABLE IF NOT EXISTS `forum_open_alliances`
(
  `id`      INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `aid`     INT(11) UNSIGNED NOT NULL,
  `forumId` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`, `forumId`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS `forum_topic`;
CREATE TABLE `forum_topic`
(
  `id`              INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `forumId`         INT(11) UNSIGNED    NOT NULL,
  `thread`          VARCHAR(35)         NOT NULL,
  `close`           TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `stick`           TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `SurveyStartTime` INT(10) UNSIGNED    NOT NULL,
  `Survey`          VARCHAR(60)         NOT NULL,
  `end_time`        INT(11) UNSIGNED    NOT NULL,
  PRIMARY KEY (`id`),
  KEY `forumId` (`forumId`, `thread`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `hero`;
CREATE TABLE `hero`
(
  `uid`            INT(11) UNSIGNED        NOT NULL,
  `kid`            INT(6) UNSIGNED         NOT NULL,
  `exp`            BIGINT(255)             NOT NULL DEFAULT '0',
  `health`         DOUBLE(13, 10) UNSIGNED NOT NULL DEFAULT '100.0000000000',
  `itemHealth`     INT(11) UNSIGNED        NOT NULL DEFAULT '0',
  `power`          SMALLINT(3) UNSIGNED    NOT NULL DEFAULT '0',
  `offBonus`       SMALLINT(3) UNSIGNED    NOT NULL DEFAULT '0',
  `defBonus`       SMALLINT(3) UNSIGNED    NOT NULL DEFAULT '0',
  `production`     SMALLINT(3) UNSIGNED    NOT NULL DEFAULT '4',
  `productionType` SMALLINT(1) UNSIGNED    NOT NULL DEFAULT '0',
  `lastupdate`     INT(10) UNSIGNED        NOT NULL DEFAULT '0',
  `hide`           TINYINT(1) UNSIGNED     NOT NULL DEFAULT '1',
  PRIMARY KEY (`uid`),
  KEY `health` (`health`),
  KEY `lastupdate` (`lastupdate`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `items`;
CREATE TABLE `items`
(
  `id`      INT(11) UNSIGNED     NOT NULL AUTO_INCREMENT,
  `uid`     INT(11) UNSIGNED     NOT NULL,
  `btype`   TINYINT(2) UNSIGNED  NOT NULL,
  `type`    SMALLINT(3) UNSIGNED NOT NULL,
  `num`     BIGINT(100) UNSIGNED NOT NULL,
  `placeId` INT(11) UNSIGNED     NOT NULL,
  `proc`    TINYINT(1) UNSIGNED  NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY (`uid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory`
(
  `uid`                INT(11) UNSIGNED NOT NULL,
  `helmet`             INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `body`               INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `leftHand`           INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `rightHand`          INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `shoes`              INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `horse`              INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `bag`                INT(11) UNSIGNED NOT NULL DEFAULT '0',
  `lastupdate`         INT(10) UNSIGNED NOT NULL DEFAULT '0',
  `lastWaterBucketUse` INT(10) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `links`;
CREATE TABLE `links`
(
  `id`   INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid`  INT(11) UNSIGNED NOT NULL,
  `name` VARCHAR(30)      NOT NULL,
  `url`  VARCHAR(255)     NOT NULL,
  `pos`  INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`uid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `mapflag`;
CREATE TABLE `mapflag`
(
  `id`       INT(11)              NOT NULL AUTO_INCREMENT,
  `aid`      INT(11) UNSIGNED     NOT NULL,
  `uid`      INT(11) UNSIGNED     NOT NULL,
  `targetId` INT(11) UNSIGNED     NOT NULL,
  `text`     VARCHAR(50)          NOT NULL,
  `color`    SMALLINT(2) UNSIGNED NOT NULL,
  `type`     SMALLINT(1) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`, `aid`, `type`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `market`;
CREATE TABLE `market`
(
  `id`        INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `aid`       INT(11) UNSIGNED    NOT NULL,
  `kid`       INT(6) UNSIGNED     NOT NULL,
  `x`         SMALLINT(4)         NOT NULL,
  `y`         SMALLINT(4)         NOT NULL,
  `rate`      DOUBLE UNSIGNED     NOT NULL,
  `needType`  TINYINT(1) UNSIGNED NOT NULL,
  `needValue` BIGINT(50) UNSIGNED NOT NULL,
  `giveType`  TINYINT(1) UNSIGNED NOT NULL,
  `giveValue` BIGINT(50)          NOT NULL,
  `maxtime`   INT(10) UNSIGNED    NOT NULL,
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`),
  KEY `rate` (`rate`),
  KEY `rType` (`needType`),
  KEY `giveType` (`giveType`),
  KEY `x` (`x`, `y`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS `traderoutes`;
CREATE TABLE IF NOT EXISTS `traderoutes`
(
  `id`         INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `kid`        INT(6) UNSIGNED     NOT NULL,
  `to_kid`     INT(6) UNSIGNED     NOT NULL,
  `r1`         BIGINT(50) UNSIGNED NOT NULL,
  `r2`         BIGINT(50) UNSIGNED NOT NULL,
  `r3`         BIGINT(50) UNSIGNED NOT NULL,
  `r4`         BIGINT(50) UNSIGNED NOT NULL,
  `enabled`    TINYINT(1) UNSIGNED NOT NULL,
  `start_hour` INT(10) UNSIGNED    NOT NULL,
  `times`      INT(10) UNSIGNED    NOT NULL,
  `time`       INT(10) UNSIGNED    NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kid` (`kid`, `enabled`, `time`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS `marks`;
CREATE TABLE `marks`
(
  `id`     INT(11)          NOT NULL AUTO_INCREMENT,
  `kid`    INT(6) UNSIGNED  NOT NULL,
  `map_id` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`kid`),
  KEY `map_id` (`map_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `mdata`;
CREATE TABLE `mdata`
(
  `id`              INT(11) UNSIGNED     NOT NULL AUTO_INCREMENT,
  `uid`             INT(11) UNSIGNED     NOT NULL,
  `to_uid`          INT(11) UNSIGNED     NOT NULL,
  `topic`           VARCHAR(100)         NOT NULL,
  `message`         LONGTEXT             NOT NULL,
  `viewed`          TINYINT(1) UNSIGNED  NOT NULL DEFAULT '0',
  `archived`        TINYINT(1) UNSIGNED  NOT NULL DEFAULT '0',
  `delete_receiver` SMALLINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `delete_sender`   SMALLINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `reported`        TINYINT(1) UNSIGNED  NOT NULL DEFAULT '0',
  `md5_checksum`    VARCHAR(32)          NOT NULL DEFAULT '',
  `mode`            TINYINT(1) UNSIGNED  NOT NULL DEFAULT '0',
  `time`            INT(10) UNSIGNED     NOT NULL DEFAULT '0',
  `autoType`        TINYINT(1) UNSIGNED  NOT NULL DEFAULT '0',
  `isAlliance`      TINYINT(1) UNSIGNED  NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY (`uid`),
  KEY (`to_uid`),
  KEY `search` (`uid`, `to_uid`, `viewed`, `delete_receiver`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;
DROP TABLE IF EXISTS `autoExtend`;
CREATE TABLE IF NOT EXISTS `autoExtend`
(
  `id`          INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `uid`         INT(11) UNSIGNED    NOT NULL,
  `type`        TINYINT(1) UNSIGNED NOT NULL,
  `commence`    INT(10) UNSIGNED    NOT NULL,
  `lastChecked` INT(11) UNSIGNED    NOT NULL DEFAULT '0',
  `enabled`     TINYINT(1) UNSIGNED NOT NULL,
  `finished`    TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY (`uid`),
  KEY (`commence`, `enabled`, `finished`),
  KEY (`type`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;
DROP TABLE IF EXISTS `buyGoldMessages`;
CREATE TABLE IF NOT EXISTS `buyGoldMessages`
(
  `id`           INT(10) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `uid`          INT(10) UNSIGNED    NOT NULL,
  `gold`         INT(10) UNSIGNED    NOT NULL,
  `type`         TINYINT(1) UNSIGNED NOT NULL,
  `trackingCode` VARCHAR(100)        NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;
DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config`
(
  `id`                          INT(10) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `startTime`                   INT(10) UNSIGNED    NOT NULL DEFAULT '0',
  `map_size`                    INT(10) UNSIGNED    NOT NULL DEFAULT '0',
  `worldUniqueId`               INT(10) UNSIGNED    NOT NULL DEFAULT '0',
  `patchVersion`                INT(10) UNSIGNED    NOT NULL DEFAULT '0',
  `installed`                   TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `automationState`             TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
  `truceFrom`                   INT(10) UNSIGNED    NOT NULL DEFAULT '0',
  `truceTo`                     INT(10) UNSIGNED    NOT NULL DEFAULT '0',
  `truceReasonId`               TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `startEmailsSent`             TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `startConfigurationDone`      TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `WWAlertSent`                 TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `installationTime`            INT(10) UNSIGNED    NOT NULL DEFAULT '0',
  `lastSystemCleanup`           INT(10) UNSIGNED    NOT NULL DEFAULT '0',
  `lastFakeAuction`             INT(10) UNSIGNED    NOT NULL DEFAULT '0',
  `lastNatarsExpand`            INT(10) UNSIGNED    NOT NULL DEFAULT '0',
  `lastDailyGold`               INT(10) UNSIGNED    NOT NULL DEFAULT '0',
  `lastDailyQuestReset`         INT(10) UNSIGNED    NOT NULL DEFAULT '0',
  `lastMedalsGiven`             INT(10) UNSIGNED    NOT NULL DEFAULT '0',
  `lastAllianceContributeReset` INT(10) UNSIGNED    NOT NULL DEFAULT '0',
  `ArtifactsReleased`           TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `WWPlansReleased`             TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `serverFinished`              TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `serverFinishTime`            INT(11) UNSIGNED    NOT NULL DEFAULT '0',
  `finishStatusSet`             TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `postServiceDone`             TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `fakeAccountProcess`          TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
  `maintenance`                 TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `delayTime`                   INT(10) UNSIGNED    NOT NULL DEFAULT '0',
  `lastBackup`                  INT(10) UNSIGNED    NOT NULL DEFAULT '0',
  `needsRestart`                TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `isRestore`                   TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `loginInfoTitle`              VARCHAR(100)        NOT NULL,
  `loginInfoHTML`               LONGTEXT            NOT NULL,
  `message`                     LONGTEXT            NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;
DROP TABLE IF EXISTS `banHistory`;
CREATE TABLE IF NOT EXISTS `banHistory`
(
  `id`     INT(11)                 NOT NULL AUTO_INCREMENT,
  `uid`    INT(11)                 NOT NULL,
  `reason` VARCHAR(100)
             CHARACTER SET utf8mb4 NOT NULL,
  `time`   INT(11)                 NOT NULL,
  `end`    INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;
DROP TABLE IF EXISTS `banQueue`;
CREATE TABLE IF NOT EXISTS `banQueue`
(
  `id`     INT(11)                 NOT NULL AUTO_INCREMENT,
  `uid`    INT(11) DEFAULT NULL,
  `reason` VARCHAR(100)
             CHARACTER SET utf8mb4 NOT NULL,
  `time`   INT(11) DEFAULT NULL,
  `end`    INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;
DROP TABLE IF EXISTS `medal`;
CREATE TABLE `medal`
(
  `id`       INT(11) UNSIGNED     NOT NULL AUTO_INCREMENT,
  `uid`      INT(11) UNSIGNED     NOT NULL,
  `category` TINYINT(2) UNSIGNED  NOT NULL,
  `week`     SMALLINT(3) UNSIGNED NOT NULL,
  `rank`     TINYINT(2) UNSIGNED  NOT NULL,
  `points`   VARCHAR(15)          NOT NULL,
  `img`      VARCHAR(10)          NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  KEY `rank` (`rank`),
  KEY `category` (`category`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS `movement`;
CREATE TABLE `movement`
(
  `id`           INT(11) UNSIGNED     NOT NULL AUTO_INCREMENT,
  `kid`          INT(6) UNSIGNED      NOT NULL,
  `to_kid`       INT(6) UNSIGNED      NOT NULL,
  `race`         TINYINT(1) UNSIGNED  NOT NULL,
  `u1`           BIGINT(50)           NOT NULL DEFAULT '0',
  `u2`           BIGINT(50)           NOT NULL DEFAULT '0',
  `u3`           BIGINT(50)           NOT NULL DEFAULT '0',
  `u4`           BIGINT(50)           NOT NULL DEFAULT '0',
  `u5`           BIGINT(50)           NOT NULL DEFAULT '0',
  `u6`           BIGINT(50)           NOT NULL DEFAULT '0',
  `u7`           BIGINT(50)           NOT NULL DEFAULT '0',
  `u8`           BIGINT(50)           NOT NULL DEFAULT '0',
  `u9`           BIGINT(50)           NOT NULL DEFAULT '0',
  `u10`          BIGINT(50)           NOT NULL DEFAULT '0',
  `u11`          SMALLINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `ctar1`        TINYINT(2) UNSIGNED  NOT NULL DEFAULT '0',
  `ctar2`        TINYINT(2) UNSIGNED  NOT NULL DEFAULT '0',
  `spyType`      TINYINT(1) UNSIGNED  NOT NULL DEFAULT '0',
  `redeployHero` TINYINT(1) UNSIGNED  NOT NULL DEFAULT '0',
  `mode`         TINYINT(1) UNSIGNED  NOT NULL,
  `attack_type`  TINYINT(1) UNSIGNED  NOT NULL,
  `start_time`   BIGINT(15) UNSIGNED  NOT NULL,
  `end_time`     BIGINT(15) UNSIGNED  NOT NULL,
  `data`         VARCHAR(255)         NOT NULL DEFAULT '',
  `markState`    TINYINT(1)           NOT NULL DEFAULT '0',
  `proc`         TINYINT(1)           NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `attack_type` (`attack_type`),
  KEY `kid` (`kid`),
  KEY `to_kid` (`to_kid`),
  KEY `u11` (`u11`),
  KEY `search` (`kid`, `to_kid`, `mode`, `attack_type`),
  KEY `end_time` (`end_time`),
  KEY `mode` (`mode`),
  KEY `proc` (`proc`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 1
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `alliance_notification`;
CREATE TABLE `alliance_notification`
(
  `id`     INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `aid`    INT(11) UNSIGNED    NOT NULL,
  `to_uid` INT(11) UNSIGNED    NOT NULL,
  `type`   TINYINT(1) UNSIGNED NOT NULL,
  `time`   INT(10) UNSIGNED    NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`aid`, `to_uid`, `type`, `time`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 1
  DEFAULT CHARSET = utf8mb4;
DROP TABLE IF EXISTS `messages_report`;
CREATE TABLE `messages_report`
(
  `id`           INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid`          INT(11) UNSIGNED NOT NULL,
  `reported_uid` INT(11) UNSIGNED NOT NULL,
  `message_id`   INT(11) UNSIGNED NOT NULL,
  `type`         VARCHAR(255)     NOT NULL,
  `time`         INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`time`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 1
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `ndata`;
CREATE TABLE `ndata`
(
  `id`            INT(11) UNSIGNED     NOT NULL AUTO_INCREMENT,
  `aid`           INT(11) UNSIGNED     NOT NULL,
  `uid`           INT(11) UNSIGNED     NOT NULL,
  `isEnforcement` TINYINT(1) UNSIGNED  NOT NULL,
  `kid`           INT(6) UNSIGNED      NOT NULL,
  `to_kid`        INT(6) UNSIGNED      NOT NULL,
  `type`          TINYINT(2) UNSIGNED  NOT NULL,
  `bounty`        VARCHAR(255)         NOT NULL,
  `data`          TEXT                 NOT NULL,
  `time`          INT(10) UNSIGNED     NOT NULL,
  `private_key`   VARCHAR(12)          NOT NULL,
  `viewed`        TINYINT(1) UNSIGNED  NOT NULL,
  `archive`       TINYINT(1) UNSIGNED  NOT NULL,
  `deleted`       TINYINT(1) UNSIGNED  NOT NULL DEFAULT '0',
  `losses`        SMALLINT(3) UNSIGNED NOT NULL DEFAULT '0',
  `non_deletable` TINYINT(1) UNSIGNED  NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `aid` (`aid`),
  KEY `uid` (`uid`),
  KEY `to_kid` (`to_kid`),
  KEY `deleted` (`deleted`),
  KEY `archive` (`archive`),
  KEY `type` (`type`),
  KEY `losses` (`losses`),
  KEY `viewed` (`viewed`),
  KEY `count` (`uid`, `archive`, `deleted`, `type`),
  KEY `search` (`uid`, `viewed`, `deleted`)
)
  ROW_FORMAT = COMPRESSED
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;


DROP TABLE IF EXISTS `surrounding`;
CREATE TABLE IF NOT EXISTS `surrounding`
(
  `id`     INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `kid`    INT(11) UNSIGNED    NOT NULL,
  `x`      SMALLINT(4)         NOT NULL,
  `y`      SMALLINT(4)         NOT NULL,
  `type`   TINYINT(2) UNSIGNED NOT NULL,
  `params` TEXT,
  `time`   INT(10) UNSIGNED    NOT NULL,
  PRIMARY KEY (`id`),
  KEY `time` (`time`),
  KEY `kid` (`kid`, `x`, `y`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS `newproc`;
CREATE TABLE `newproc`
(
  `uid`  INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cpw`  VARCHAR(30)      NOT NULL,
  `npw`  VARCHAR(45)      NOT NULL,
  `time` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`uid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS `odata`;
CREATE TABLE `odata`
(
  `kid`                 INT(6) UNSIGNED         NOT NULL,
  `type`                TINYINT(2) UNSIGNED     NOT NULL,
  `did`                 INT(6) UNSIGNED         NOT NULL DEFAULT '0',
  `wood`                DOUBLE(50, 2)           NOT NULL,
  `iron`                DOUBLE(50, 2)           NOT NULL,
  `clay`                DOUBLE(50, 2)           NOT NULL,
  `crop`                DOUBLE(50, 2)           NOT NULL,
  `lasttrain`           INT(10) UNSIGNED        NOT NULL DEFAULT '0',
  `lastfarmed`          INT(11) UNSIGNED        NOT NULL DEFAULT '0',
  `last_loyalty_update` INT(10) UNSIGNED        NOT NULL DEFAULT '0',
  `lastmupdate`         BIGINT(15) UNSIGNED     NOT NULL,
  `conquered_time`      INT(10) UNSIGNED        NOT NULL DEFAULT '0',
  `loyalty`             DOUBLE(13, 10) UNSIGNED NOT NULL DEFAULT '100.0000000000',
  `owner`               INT(11) UNSIGNED        NOT NULL DEFAULT '0',
  PRIMARY KEY (`kid`),
  KEY `did` (`did`),
  KEY `type` (`type`),
  KEY `owner` (`owner`),
  KEY `last_loyalty_update` (`last_loyalty_update`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `odelete`;
CREATE TABLE `odelete`
(
  `id`       INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `kid`      INT(6) UNSIGNED  NOT NULL,
  `oid`      INT(6) UNSIGNED  NOT NULL,
  `end_time` INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kid` (`oid`),
  KEY (`end_time`, `oid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `raidlist`;
CREATE TABLE `raidlist`
(
  `id`       INT(11) UNSIGNED      NOT NULL AUTO_INCREMENT,
  `lid`      INT(11) UNSIGNED      NOT NULL,
  `kid`      INT(6) UNSIGNED       NOT NULL,
  `distance` DOUBLE(4, 1) UNSIGNED NOT NULL,
  `u1`       BIGINT(50)            NOT NULL,
  `u2`       BIGINT(50)            NOT NULL,
  `u3`       BIGINT(50)            NOT NULL,
  `u4`       BIGINT(50)            NOT NULL,
  `u5`       BIGINT(50)            NOT NULL,
  `u6`       BIGINT(50)            NOT NULL,
  `u7`       BIGINT(50)            NOT NULL,
  `u8`       BIGINT(50)            NOT NULL,
  `u9`       BIGINT(50)            NOT NULL,
  `u10`      BIGINT(50)            NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`lid`, `kid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `research`;
CREATE TABLE `research`
(
  `id`       INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `kid`      INT(6) UNSIGNED     NOT NULL,
  `nr`       TINYINT(2)          NOT NULL,
  `mode`     TINYINT(1) UNSIGNED NOT NULL,
  `end_time` INT(10) UNSIGNED    NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mode` (`mode`),
  KEY `kid` (`kid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `send`;
CREATE TABLE `send`
(
  `id`       INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `kid`      INT(6) UNSIGNED     NOT NULL,
  `to_kid`   INT(6) UNSIGNED     NOT NULL,
  `wood`     BIGINT(50) UNSIGNED NOT NULL,
  `clay`     BIGINT(50) UNSIGNED NOT NULL,
  `iron`     BIGINT(50) UNSIGNED NOT NULL,
  `crop`     BIGINT(50) UNSIGNED NOT NULL,
  `x`        TINYINT(1) UNSIGNED NOT NULL,
  `mode`     TINYINT(1) UNSIGNED NOT NULL,
  `end_time` INT(10) UNSIGNED    NOT NULL,
  PRIMARY KEY (`id`),
  KEY `end_time` (`end_time`),
  KEY `kid` (`kid`),
  KEY `to_kid` (`to_kid`),
  KEY `mode` (`mode`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `smithy`;
CREATE TABLE `smithy`
(
  `kid` INT(6) UNSIGNED     NOT NULL AUTO_INCREMENT,
  `u1`  TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `u2`  TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `u3`  TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `u4`  TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `u5`  TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `u6`  TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `u7`  TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `u8`  TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`kid`)
)
  ENGINE = InnoDB
  AUTO_INCREMENT = 1
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `tdata`;
CREATE TABLE `tdata`
(
  `kid` INT(6) UNSIGNED     NOT NULL,
  `u2`  TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `u3`  TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `u4`  TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `u5`  TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `u6`  TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `u7`  TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `u8`  TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `u9`  TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`kid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `training`;
CREATE TABLE `training`
(
  `id`            INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `kid`           INT(6) UNSIGNED     NOT NULL,
  `nr`            TINYINT(2) UNSIGNED NOT NULL,
  `num`           BIGINT(50) UNSIGNED NOT NULL,
  `item_id`       TINYINT(2) UNSIGNED NOT NULL,
  `training_time` BIGINT(25) UNSIGNED NOT NULL,
  `commence`      BIGINT(25) UNSIGNED NOT NULL,
  `end_time`      BIGINT(25) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kid` (`kid`),
  KEY `item_id` (`item_id`),
  KEY `commence` (`commence`),
  KEY `nr` (`nr`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `trapped`;
CREATE TABLE `trapped`
(
  `id`     INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `kid`    INT(6) UNSIGNED     NOT NULL DEFAULT '0',
  `to_kid` INT(6) UNSIGNED     NOT NULL DEFAULT '0',
  `race`   TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `u1`     BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u2`     BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u3`     BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u4`     BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u5`     BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u6`     BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u7`     BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u8`     BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u9`     BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u10`    BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u11`    TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY (`kid`),
  KEY (`to_kid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `units`;
CREATE TABLE `units`
(
  `kid`  INT(6) UNSIGNED     NOT NULL,
  `race` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `u1`   BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u2`   BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u3`   BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u4`   BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u5`   BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u6`   BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u7`   BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u8`   BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u9`   BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u10`  BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  `u11`  TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `u99`  BIGINT(50) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`kid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `ignoreList`;
CREATE TABLE IF NOT EXISTS `ignoreList`
(
  `id`        INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uid`       INT(11) UNSIGNED NOT NULL,
  `ignore_id` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`, `ignore_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS `friendlist`;
CREATE TABLE IF NOT EXISTS `friendlist`
(
  `id`       INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `uid`      INT(11) UNSIGNED    NOT NULL,
  `to_uid`   INT(11) UNSIGNED    NOT NULL,
  `accepted` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`, `to_uid`, `accepted`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `changeEmail`;
CREATE TABLE IF NOT EXISTS `changeEmail`
(
  `uid`   INT(11) UNSIGNED NOT NULL,
  `email` VARCHAR(99)      NOT NULL,
  `code1` VARCHAR(5)       NOT NULL,
  `code2` VARCHAR(5)       NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `email` (`email`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users`
(
  `id`                                               INT(11) UNSIGNED      NOT NULL AUTO_INCREMENT,
  `uuid`                                             VARCHAR(40)           NULL,
  `aid`                                              INT(11) UNSIGNED      NOT NULL DEFAULT '0',
  `alliance_role_name`                               VARCHAR(20)           NOT NULL DEFAULT '',
  `alliance_role`                                    MEDIUMINT(3) UNSIGNED NOT NULL DEFAULT '0',
  `alliance_join_time`                               INT(11) UNSIGNED      NOT NULL DEFAULT '0',
  `alliance_contributions`                           BIGINT(11) UNSIGNED   NOT NULL DEFAULT '0',
  `name`                                             VARCHAR(20)           NOT NULL,
  `password`                                         VARCHAR(40)           NOT NULL,
  `email`                                            VARCHAR(99)           NULL     DEFAULT '',
  `email_verified`                                   TINYINT(3) UNSIGNED   NOT NULL DEFAULT '0',
  `race`                                             TINYINT(1) UNSIGNED   NOT NULL,
  `access`                                           TINYINT(1) UNSIGNED   NOT NULL DEFAULT '1',
  `countryFlag`                                      VARCHAR(30)           NULL,
  `showMedals`                                       TINYINT(1)            NULL     DEFAULT '0',
  `showCountryFlag`                                  TINYINT(1) UNSIGNED   NOT NULL DEFAULT '0',
  `lastCountryFlagCheck`                             INT(11) UNSIGNED      NOT NULL DEFAULT '0',
  `kid`                                              INT(6) UNSIGNED       NOT NULL,
  `total_name_changes`                               TINYINT(3)            NOT NULL DEFAULT '0',
  `total_pop`                                        BIGINT(255)           NOT NULL DEFAULT '0',
  `total_villages`                                   INT(5)                NOT NULL DEFAULT '0',
  `favorTabs`                                        VARCHAR(40)           NOT NULL DEFAULT '0,0,0,1,0,0,0,0,1,0,0,0,0,0',
  `reportFilters`                                    VARCHAR(20)           NOT NULL DEFAULT '0,0,0,7,31,31,127',
  `allianceSettings`                                 VARCHAR(10)           NOT NULL DEFAULT '0|0|0|0|0',
  `allianceNotificationEnabled`                      TINYINT(1)            NOT NULL DEFAULT '1',
  `autoComplete`                                     VARCHAR(5)            NOT NULL DEFAULT '1,0,0',
  `display`                                          VARCHAR(20)           NOT NULL DEFAULT '0,10,10,0,0,0',
  `timezone`                                         VARCHAR(5)            NOT NULL DEFAULT '0,0',
  `mapMarkSettings`                                  VARCHAR(3)            NOT NULL DEFAULT '1,0',
  `qst_tut`                                          VARCHAR(10)           NOT NULL DEFAULT '1-0',
  `qst_economy`                                      VARCHAR(50)           NOT NULL DEFAULT '0,0,0,0,0,0,0,0,0,0,0,0',
  `qst_world`                                        VARCHAR(50)           NOT NULL DEFAULT '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0',
  `qst_battle`                                       VARCHAR(50)           NOT NULL DEFAULT '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0',
  `gift_gold`                                        INT(11)               NOT NULL DEFAULT '0',
  `bought_gold`                                      INT(11)               NOT NULL DEFAULT '0',
  `silver`                                           INT(11)               NOT NULL DEFAULT '0',
  `plus`                                             INT(11) UNSIGNED      NOT NULL DEFAULT '0',
  `b1`                                               INT(11) UNSIGNED      NOT NULL DEFAULT '0',
  `b2`                                               INT(11) UNSIGNED      NOT NULL DEFAULT '0',
  `b3`                                               INT(11) UNSIGNED      NOT NULL DEFAULT '0',
  `b4`                                               INT(11) UNSIGNED      NOT NULL DEFAULT '0',
  `atkBonusExpireTime`                               INT(11) UNSIGNED      NOT NULL DEFAULT '0',
  `defBonusExpireTime`                               INT(11) UNSIGNED      NOT NULL DEFAULT '0',
  `lastBuyResources`                                 INT(11) UNSIGNED      NOT NULL DEFAULT '0',
  `lastBuyAnimals`                                   INT(11) UNSIGNED      NOT NULL DEFAULT '0',
  `lastBuyTroops`                                    INT(11) UNSIGNED      NOT NULL DEFAULT '0',
  `fasterTraining`                                   INT(11) UNSIGNED      NOT NULL DEFAULT '0',
  `gender`                                           TINYINT(1) UNSIGNED   NOT NULL DEFAULT '0',
  `birthday`                                         VARCHAR(50)           NOT NULL DEFAULT '0',
  `location`                                         VARCHAR(30)           NOT NULL DEFAULT '0',
  `language`                                         VARCHAR(30)           NOT NULL DEFAULT '0',
  `desc1`                                            LONGTEXT              NOT NULL,
  `desc2`                                            LONGTEXT              NOT NULL,
  `note`                                             LONGTEXT              NOT NULL,
  `sit1Uid`                                          INT(11) UNSIGNED      NOT NULL DEFAULT '0',
  `sit1Permissions`                                  SMALLINT(3) UNSIGNED  NOT NULL DEFAULT '87',
  `sit2Uid`                                          INT(11) UNSIGNED      NOT NULL DEFAULT '0',
  `sit2Permissions`                                  SMALLINT(3) UNSIGNED  NOT NULL DEFAULT '87',
  `goldclub`                                         TINYINT(1) UNSIGNED   NOT NULL DEFAULT '0',
  `escape`                                           TINYINT(1) UNSIGNED   NOT NULL DEFAULT '0',
  `total_attack_points`                              BIGINT(255) UNSIGNED  NOT NULL DEFAULT '0',
  `total_defense_points`                             BIGINT(255) UNSIGNED  NOT NULL DEFAULT '0',
  `week_attack_points`                               BIGINT(255) UNSIGNED  NOT NULL DEFAULT '0',
  `week_defense_points`                              BIGINT(255) UNSIGNED  NOT NULL DEFAULT '0',
  `week_robber_points`                               BIGINT(255)           NOT NULL DEFAULT '0',
  `week_alliance_training_contributions`             BIGINT(255)           NOT NULL DEFAULT '0',
  `week_alliance_armor_contributions`                BIGINT(255)           NOT NULL DEFAULT '0',
  `week_alliance_cp_contributions`                   BIGINT(255)           NOT NULL DEFAULT '0',
  `week_alliance_trade_contributions`                BIGINT(255)           NOT NULL DEFAULT '0',
  `total_alliance_training_contributions`            BIGINT(255)           NOT NULL DEFAULT '0',
  `total_alliance_armor_contributions`               BIGINT(255)           NOT NULL DEFAULT '0',
  `total_alliance_cp_contributions`                  BIGINT(255)           NOT NULL DEFAULT '0',
  `total_alliance_trade_contributions`               BIGINT(255)           NOT NULL DEFAULT '0',
  `pending_training_alliance_bonus_unlock_animation` TINYINT(1)            NOT NULL DEFAULT '0',
  `pending_armor_alliance_bonus_unlock_animation`    TINYINT(1)            NOT NULL DEFAULT '0',
  `pending_cp_alliance_bonus_unlock_animation`       TINYINT(1)            NOT NULL DEFAULT '0',
  `pending_trade_alliance_bonus_unlock_animation`    TINYINT(1)            NOT NULL DEFAULT '0',
  `max_off_point`                                    BIGINT(255)           NOT NULL DEFAULT '0',
  `max_off_time`                                     INT(11)               NOT NULL DEFAULT '0',
  `max_off_nid`                                      INT(11)               NOT NULL DEFAULT '0',
  `max_def_point`                                    BIGINT(255)           NOT NULL DEFAULT '0',
  `max_def_time`                                     INT(11)               NOT NULL DEFAULT '0',
  `max_def_nid`                                      INT(11)               NOT NULL DEFAULT '0',
  `oldRank`                                          INT(11)               NOT NULL DEFAULT '-1',
  `cp`                                               INT(11) UNSIGNED      NOT NULL DEFAULT '1',
  `cp_prod`                                          INT(11)               NOT NULL DEFAULT '0',
  `ok`                                               TINYINT(1) UNSIGNED   NOT NULL DEFAULT '0',
  `lastupdate`                                       INT(10) UNSIGNED      NOT NULL DEFAULT '0',
  `lastPkgCodeTry`                                   INT(10) UNSIGNED      NOT NULL DEFAULT '0',
  `pkgCodeTries`                                     INT(10) UNSIGNED      NOT NULL DEFAULT '0',
  `last_adventure_time`                              INT(10) UNSIGNED      NOT NULL DEFAULT '0',
  `total_adventures`                                 INT(10) UNSIGNED      NOT NULL DEFAULT '0',
  `success_adventures_count`                         INT(10) UNSIGNED      NOT NULL DEFAULT '0',
  `success_adventures_hex`                           INT(10) UNSIGNED      NOT NULL DEFAULT '0',
  `lastVillageExpand`                                INT(10) UNSIGNED      NOT NULL DEFAULT '0',
  `lastHeroExpCheck`                                 INT(10) UNSIGNED      NOT NULL DEFAULT '0',
  `signupTime`                                       INT(10) UNSIGNED      NOT NULL DEFAULT '0',
  `protection`                                       INT(10) UNSIGNED      NOT NULL DEFAULT '0',
  `protectionLastExtend`                             INT(10) UNSIGNED      NOT NULL DEFAULT '0',
  `protectionBoughtHours`                            INT(10) UNSIGNED      NOT NULL DEFAULT '0',
  `last_login_time`                                  INT(10) UNSIGNED      NOT NULL DEFAULT '0',
  `last_owner_login_time`                            INT(10) UNSIGNED      NOT NULL DEFAULT '0',
  `lastMultiAccountCheck`                            INT(11) UNSIGNED      NOT NULL DEFAULT '1',
  `vacationActiveTil`                                INT(10) UNSIGNED      NOT NULL DEFAULT '0',
  `profileCacheVersion`                              INT(10) UNSIGNED      NOT NULL DEFAULT '0',
  `vacationUsedDays`                                 INT(5) UNSIGNED       NOT NULL DEFAULT '0',
  `hidden`                                           TINYINT(1) UNSIGNED   NOT NULL DEFAULT '0',
  `ajax_token`                                       VARCHAR(50)           NULL     DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `findPlayer` (`name`, `email`),
  KEY `sitters` (`sit1Uid`, `sit2Uid`),
  KEY `productionBoostAndPlus` (`plus`, `b1`, `b2`, `b3`, `b4`),
  KEY `update_search` (`lastVillageExpand`, `lastMultiAccountCheck`, `lastCountryFlagCheck`, `last_adventure_time`,
                       `lastupdate`, `last_login_time`),
  KEY `statistics` (`countryFlag`, `total_attack_points`, `total_defense_points`, `week_attack_points`,
                    `week_defense_points`, `week_robber_points`, `oldRank`, `total_pop`, `total_villages`,
                    `max_off_point`, `max_def_point`, `hidden`),
  UNIQUE KEY (`uuid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `player_references`;
CREATE TABLE IF NOT EXISTS `player_references`
(
  `id`          INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ref_uid`     INT(11) UNSIGNED NOT NULL,
  `uid`         INT(11) UNSIGNED NOT NULL,
  `rewardGiven` TINYINT(1)       NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `findById` (`uid`, `ref_uid`),
  KEY `rewardGiven` (`rewardGiven`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `vdata`;
CREATE TABLE `vdata`
(
  `kid`                 INT(6) UNSIGNED         NOT NULL,
  `owner`               INT(11) UNSIGNED        NOT NULL,
  `fieldtype`           TINYINT(2) UNSIGNED     NOT NULL,
  `name`                VARCHAR(45)             NOT NULL,
  `capital`             TINYINT(1) UNSIGNED     NOT NULL,
  `pop`                 INT(10)                 NOT NULL,
  `cp`                  INT(10)                 NOT NULL,
  `celebration`         INT(11)                 NOT NULL DEFAULT '0',
  `festival`            INT(11)                 NOT NULL DEFAULT '0',
  `type`                TINYINT(2)              NOT NULL DEFAULT '0',
  `wood`                DOUBLE(50, 4)           NOT NULL DEFAULT '0',
  `clay`                DOUBLE(50, 4)           NOT NULL DEFAULT '0',
  `iron`                DOUBLE(50, 4)           NOT NULL DEFAULT '0',
  `woodp`               BIGINT(50)              NOT NULL DEFAULT '0',
  `clayp`               BIGINT(50)              NOT NULL DEFAULT '0',
  `ironp`               BIGINT(50)              NOT NULL DEFAULT '0',
  `maxstore`            BIGINT(50)              NOT NULL,
  `extraMaxstore`       INT(5) UNSIGNED         NOT NULL DEFAULT '0',
  `crop`                DOUBLE(50, 4)           NOT NULL DEFAULT '0',
  `cropp`               BIGINT(50)              NOT NULL DEFAULT '0',
  `maxcrop`             BIGINT(50)              NOT NULL,
  `extraMaxcrop`        INT(5) UNSIGNED         NOT NULL DEFAULT '0',
  `upkeep`              BIGINT(50)              NOT NULL DEFAULT '0',
  `last_loyalty_update` INT(10) UNSIGNED        NOT NULL DEFAULT '0',
  `lastmupdate`         BIGINT(15) UNSIGNED     NOT NULL DEFAULT '0',
  `loyalty`             DOUBLE(13, 10) UNSIGNED NOT NULL DEFAULT '100.0000000000',
  `created`             INT(11) UNSIGNED        NOT NULL,
  `lastReturn`          INT(11) UNSIGNED        NOT NULL DEFAULT '0',
  `isWW`                TINYINT(1) UNSIGNED     NOT NULL DEFAULT '0',
  `isFarm`              TINYINT(1) UNSIGNED     NOT NULL DEFAULT '0',
  `isArtifact`          TINYINT(1) UNSIGNED     NOT NULL DEFAULT '0',
  `hidden`              TINYINT(1) UNSIGNED     NOT NULL DEFAULT '0',
  `evasion`             TINYINT(1) UNSIGNED     NOT NULL DEFAULT '0',
  `expandedfrom`        INT(6) UNSIGNED         NOT NULL,
  `d1TroopsVersion`     INT(11) UNSIGNED        NOT NULL DEFAULT '0',
  `d1MovementsVersion`  INT(11) UNSIGNED        NOT NULL DEFAULT '0',
  `lastVillageCheck`    INT(10) UNSIGNED        NOT NULL DEFAULT '1',
  `checker`             VARCHAR(50)             NULL     DEFAULT NULL,
  PRIMARY KEY (`kid`),
  KEY `owner` (`owner`),
  KEY `capital` (`capital`),
  KEY `isWW` (`isWW`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `infobox_read`;
CREATE TABLE IF NOT EXISTS `infobox_read`
(
  `id`     INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `infoId` INT(11) UNSIGNED NOT NULL,
  `uid`    INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `infoId` (`infoId`, `uid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS `infobox_delete`;
CREATE TABLE IF NOT EXISTS `infobox_delete`
(
  `id`     INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `infoId` INT(11) UNSIGNED NOT NULL,
  `uid`    INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `infoId` (`infoId`, `uid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS `infobox`;
CREATE TABLE IF NOT EXISTS `infobox`
(
  `id`         INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `forAll`     TINYINT(1) UNSIGNED NOT NULL DEFAULT '1',
  `uid`        INT(11) UNSIGNED    NOT NULL,
  `type`       TINYINT(2) UNSIGNED NOT NULL DEFAULT '0',
  `params`     TEXT                NOT NULL,
  `readStatus` TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `del`        TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  `showFrom`   INT(10) UNSIGNED    NOT NULL,
  `showTo`     INT(10) UNSIGNED    NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`, `forAll`, `readStatus`, `del`, `showFrom`, `showTo`),
  KEY `type` (`type`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;

DROP TABLE IF EXISTS `wdata`;
CREATE TABLE `wdata`
(
  `id`           INT(6) UNSIGNED      NOT NULL AUTO_INCREMENT,
  `x`            SMALLINT(4)          NOT NULL,
  `y`            SMALLINT(4)          NOT NULL,
  `fieldtype`    TINYINT(2) UNSIGNED  NOT NULL,
  `oasistype`    TINYINT(2) UNSIGNED  NOT NULL,
  `landscape`    TINYINT(2) UNSIGNED  NOT NULL,
  `crop_percent` SMALLINT(3) UNSIGNED NOT NULL DEFAULT '0',
  `occupied`     TINYINT(1)           NOT NULL,
  `map`          VARCHAR(50)          NOT NULL DEFAULT '||=||',
  PRIMARY KEY (`id`),
  KEY `crop_percent` (`crop_percent`),
  KEY `fieldtype` (`fieldtype`),
  KEY `oasistype` (`oasistype`),
  KEY `occupied` (`occupied`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;


DROP TABLE IF EXISTS `available_villages`;
CREATE TABLE `available_villages`
(
  `kid`       INT(6) UNSIGNED     NOT NULL AUTO_INCREMENT,
  `fieldtype` DOUBLE              NOT NULL,
  `r`         DOUBLE              NOT NULL,
  `angle`     DOUBLE              NOT NULL,
  `rand`      INT(10) UNSIGNED    NOT NULL,
  `occupied`  TINYINT(1) UNSIGNED NOT NULL DEFAULT '0',
  PRIMARY KEY (`kid`),
  KEY `angle` (`angle`),
  KEY `fieldtype` (`fieldtype`),
  KEY `r` (`r`),
  KEY `occupied` (`occupied`),
  KEY `rand` (`rand`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;
DROP TABLE IF EXISTS `admin_log`;
CREATE TABLE IF NOT EXISTS `admin_log`
(
  `id`   INT(11)      NOT NULL AUTO_INCREMENT,
  `ip`   VARCHAR(100) NOT NULL,
  `log`  TEXT,
  `time` INT(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;
DROP TABLE IF EXISTS `multiaccount_users`;
CREATE TABLE IF NOT EXISTS `multiaccount_users`
(
  `id`       INT(11)             NOT NULL AUTO_INCREMENT,
  `uid`      INT(10) UNSIGNED    NOT NULL,
  `data`     TEXT                NOT NULL,
  `priority` BIGINT(50) UNSIGNED NOT NULL,
  `time`     INT(10) UNSIGNED    NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`uid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;
DROP TABLE IF EXISTS `notificationQueue`;
CREATE TABLE IF NOT EXISTS `notificationQueue`
(
  `id`      INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `message` TEXT             NOT NULL,
  `time`    INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;
DROP TABLE IF EXISTS `activation_progress`;
CREATE TABLE IF NOT EXISTS `activation_progress`
(
  `id`             INT(11)          NOT NULL AUTO_INCREMENT,
  `uid`            INT(10) UNSIGNED NOT NULL,
  `email`          VARCHAR(255)     NOT NULL,
  `activationCode` VARCHAR(30)      NOT NULL,
  `time`           INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`, `email`, `activationCode`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;
DROP TABLE IF EXISTS `login_handshake`;
CREATE TABLE IF NOT EXISTS `login_handshake`
(
  `id`       INT(11)          NOT NULL AUTO_INCREMENT,
  `uid`      INT(10) UNSIGNED NOT NULL,
  `token`    VARCHAR(255)     NOT NULL,
  `isSitter` TINYINT(1)       NOT NULL DEFAULT '0',
  `time`     INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;
DROP TABLE IF EXISTS `notes`;
CREATE TABLE IF NOT EXISTS `notes`
(
  `id`        INT(11)          NOT NULL AUTO_INCREMENT,
  `uid`       INT(10) UNSIGNED NOT NULL,
  `to_uid`    INT(10) UNSIGNED NOT NULL,
  `note_text` TEXT,
  PRIMARY KEY (`id`),
  KEY `search` (`uid`, `to_uid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;
DROP TABLE IF EXISTS `voting_reward_queue`;
CREATE TABLE IF NOT EXISTS `voting_reward_queue`
(
  `id`         INT(11)          NOT NULL AUTO_INCREMENT,
  `uid`        INT(10) UNSIGNED NOT NULL,
  `votingName` VARCHAR(25)      NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  AUTO_INCREMENT = 1;
DROP TABLE IF EXISTS `alliance_bonus_upgrade_queue`;
CREATE TABLE `alliance_bonus_upgrade_queue`
(
  `id`   INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `aid`  INT(11) UNSIGNED    NOT NULL,
  `type` TINYINT(1) UNSIGNED NOT NULL,
  `time` INT(11) UNSIGNED    NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`aid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;

DROP TABLE IF EXISTS `farmlist_last_reports`;
CREATE TABLE `farmlist_last_reports`
(
  `id`   INT(11) UNSIGNED    NOT NULL AUTO_INCREMENT,
  `uid`  INT(11) UNSIGNED    NOT NULL,
  `kid`  INT(11) UNSIGNED    NOT NULL,
  `report_id`  INT(11) UNSIGNED    NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`uid`, `kid`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;