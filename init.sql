CREATE DATABASE `classiccharacters`;
USE `classiccharacters`;
CREATE TABLE `characters`
(
    `guid`                      int(11) unsigned NOT NULL DEFAULT 0 COMMENT 'Global Unique Identifier',
    `account`                   int(11) unsigned NOT NULL DEFAULT 0 COMMENT 'Account Identifier',
    `name`                      varchar(12) NOT NULL DEFAULT '',
    `race`                      tinyint(3) unsigned NOT NULL DEFAULT 0,
    `class`                     tinyint(3) unsigned NOT NULL DEFAULT 0,
    `gender`                    tinyint(3) unsigned NOT NULL DEFAULT 0,
    `level`                     tinyint(3) unsigned NOT NULL DEFAULT 0,
    `xp`                        int(10) unsigned NOT NULL DEFAULT 0,
    `money`                     int(10) unsigned NOT NULL DEFAULT 0,
    `playerBytes`               int(10) unsigned NOT NULL DEFAULT 0,
    `playerBytes2`              int(10) unsigned NOT NULL DEFAULT 0,
    `playerFlags`               int(10) unsigned NOT NULL DEFAULT 0,
    `position_x`                float       NOT NULL DEFAULT 0,
    `position_y`                float       NOT NULL DEFAULT 0,
    `position_z`                float       NOT NULL DEFAULT 0,
    `map`                       int(11) unsigned NOT NULL DEFAULT 0 COMMENT 'Map Identifier',
    `orientation`               float       NOT NULL DEFAULT 0,
    `taximask`                  longtext             DEFAULT NULL,
    `online`                    tinyint(3) unsigned NOT NULL DEFAULT 0,
    `cinematic`                 tinyint(3) unsigned NOT NULL DEFAULT 0,
    `totaltime`                 int(11) unsigned NOT NULL DEFAULT 0,
    `leveltime`                 int(11) unsigned NOT NULL DEFAULT 0,
    `logout_time`               bigint(20) unsigned NOT NULL DEFAULT 0,
    `is_logout_resting`         tinyint(3) unsigned NOT NULL DEFAULT 0,
    `rest_bonus`                float       NOT NULL DEFAULT 0,
    `resettalents_cost`         int(11) unsigned NOT NULL DEFAULT 0,
    `resettalents_time`         bigint(20) unsigned NOT NULL DEFAULT 0,
    `trans_x`                   float       NOT NULL DEFAULT 0,
    `trans_y`                   float       NOT NULL DEFAULT 0,
    `trans_z`                   float       NOT NULL DEFAULT 0,
    `trans_o`                   float       NOT NULL DEFAULT 0,
    `transguid`                 bigint(20) unsigned NOT NULL DEFAULT 0,
    `extra_flags`               int(11) unsigned NOT NULL DEFAULT 0,
    `stable_slots`              tinyint(1) unsigned NOT NULL DEFAULT 0,
    `at_login`                  int(11) unsigned NOT NULL DEFAULT 0,
    `zone`                      int(11) unsigned NOT NULL DEFAULT 0,
    `death_expire_time`         bigint(20) unsigned NOT NULL DEFAULT 0,
    `taxi_path`                 text                 DEFAULT NULL,
    `honor_highest_rank`        int(11) unsigned NOT NULL DEFAULT 0,
    `honor_standing`            int(11) unsigned NOT NULL DEFAULT 0,
    `stored_honor_rating`       float       NOT NULL DEFAULT 0,
    `stored_dishonorable_kills` int(11) NOT NULL DEFAULT 0,
    `stored_honorable_kills`    int(11) NOT NULL DEFAULT 0,
    `watchedFaction`            int(10) unsigned NOT NULL DEFAULT 0,
    `drunk`                     smallint(5) unsigned NOT NULL DEFAULT 0,
    `health`                    int(10) unsigned NOT NULL DEFAULT 0,
    `power1`                    int(10) unsigned NOT NULL DEFAULT 0,
    `power2`                    int(10) unsigned NOT NULL DEFAULT 0,
    `power3`                    int(10) unsigned NOT NULL DEFAULT 0,
    `power4`                    int(10) unsigned NOT NULL DEFAULT 0,
    `power5`                    int(10) unsigned NOT NULL DEFAULT 0,
    `exploredZones`             longtext             DEFAULT NULL,
    `equipmentCache`            longtext             DEFAULT NULL,
    `ammoId`                    int(10) unsigned NOT NULL DEFAULT 0,
    `actionBars`                tinyint(3) unsigned NOT NULL DEFAULT 0,
    `grantableLevels`           int(10) unsigned DEFAULT 0,
    `fishingSteps`              tinyint(3) unsigned NOT NULL DEFAULT 0,
    `deleteInfos_Account`       int(11) unsigned DEFAULT NULL,
    `deleteInfos_Name`          varchar(12)          DEFAULT NULL,
    `deleteDate`                bigint(20) unsigned DEFAULT NULL,
    PRIMARY KEY (`guid`),
    KEY                         `idx_account` (`account`),
    KEY                         `idx_online` (`online`),
    KEY                         `idx_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci ROW_FORMAT=DYNAMIC COMMENT='Player System';
INSERT INTO `characters`
    (`guid`, `account`, `name`, `race`, `class`, `level`, `online`)
VALUES
    (1, 1, 'Humanmage', 1, 8, 15, true),
    (2, 1, 'Nelfwarrior', 4, 1, 47, false),
    (3, 3, 'Gmorcshaman', 2, 7, 60, false);

CREATE DATABASE `classicrealmd`;
USE `classicrealmd`;
CREATE TABLE `account` (
                           `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identifier',
                           `username` varchar(32) NOT NULL DEFAULT '',
                           `gmlevel` tinyint(3) unsigned NOT NULL DEFAULT 0,
                           `sessionkey` longtext DEFAULT NULL,
                           `v` longtext DEFAULT NULL,
                           `s` longtext DEFAULT NULL,
                           `email` text DEFAULT NULL,
                           `joindate` datetime NOT NULL DEFAULT current_timestamp(),
                           `lockedIp` varchar(30) NOT NULL DEFAULT '0.0.0.0',
                           `failed_logins` int(11) unsigned NOT NULL DEFAULT 0,
                           `locked` tinyint(3) unsigned NOT NULL DEFAULT 0,
                           `last_module` char(32) DEFAULT '',
                           `module_day` mediumint(8) unsigned NOT NULL DEFAULT 0,
                           `active_realm_id` int(11) unsigned NOT NULL DEFAULT 0,
                           `expansion` tinyint(3) unsigned NOT NULL DEFAULT 0,
                           `mutetime` bigint(40) unsigned NOT NULL DEFAULT 0,
                           `locale` varchar(4) NOT NULL DEFAULT '',
                           `os` varchar(4) NOT NULL DEFAULT '0',
                           `platform` varchar(4) NOT NULL DEFAULT '0',
                           `token` text DEFAULT NULL,
                           `flags` int(10) unsigned NOT NULL DEFAULT 0,
                           PRIMARY KEY (`id`),
                           UNIQUE KEY `idx_username` (`username`),
                           KEY `idx_gmlevel` (`gmlevel`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci ROW_FORMAT=DYNAMIC COMMENT='Account System';
INSERT INTO `account` (`id`, `username`, `gmlevel`) VALUES (1, 'TEST', 0), (2, 'ABCD', 0), (3, 'GM', 4);

GRANT ALL PRIVILEGES ON `classiccharacters`.* TO 'dev'@'%';
GRANT ALL PRIVILEGES ON `classicrealmd`.* TO 'dev'@'%';
FLUSH PRIVILEGES;
