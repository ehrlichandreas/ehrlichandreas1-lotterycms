<?php
	
/**
 *
 * @author Ehrlich, Andreas <ehrlich.andreas@googlemail.com>
 */
class EhrlichAndreas_LotteryCms_Adapter_Pdo_Mysql extends EhrlichAndreas_AbstractCms_Adapter_Pdo_Mysql
{
	/**
	 *
	 * @var string 
	 */
	protected $tableChance = 'lottery_chance';
	
	/**
	 *
	 * @var string 
	 */
	protected $tableDraw = 'lottery_draw';
	
	/**
	 *
	 * @var string 
	 */
	protected $tableLottery = 'lottery';
	
	/**
	 *
	 * @var string 
	 */
	protected $tableLotteryImage = 'lottery_image';
	
	/**
	 *
	 * @var string 
	 */
	protected $tableLotteryImageBox = 'lottery_image_box';
	
	/**
	 *
	 * @var string 
	 */
	protected $tableLotteryText = 'lottery_text';
	
	/**
	 *
	 * @var string 
	 */
	protected $tablePayout = 'lottery_payout';
	
	/**
	 *
	 * @var string 
	 */
	protected $tableProvider = 'lottery_provider';
	
	/**
	 *
	 * @var string 
	 */
	protected $tableScedule = 'lottery_scedule';
	
	/**
	 *
	 * @var string 
	 */
	protected $tableTerritory = 'lottery_territory';
	
	/**
	 *
	 * @var string 
	 */
	protected $tableVersion = 'lottery_version';
	
    /**
     * 
     * @return EhrlichAndreas_LotteryCms_Adapter_Pdo_Mysql
     */
	public function install ()
    {
		$this->_install_version_10000();
    }
	
	/**
	 * 
	 * @return EhrlichAndreas_LotteryCms_Adapter_Pdo_Mysql
	 */
	protected function _install_version_10000 ()
	{
		$version = '10000';
		
        $tableChance = $this->getTableName($this->tableChance);
        $tableDraw = $this->getTableName($this->tableDraw);
        $tableLottery = $this->getTableName($this->tableLottery);
        $tableLotteryImage = $this->getTableName($this->tableLotteryImage);
        $tableLotteryImageBox = $this->getTableName($this->tableLotteryImageBox);
        $tableLotteryText = $this->getTableName($this->tableLotteryText);
        $tablePayout = $this->getTableName($this->tablePayout);
        $tableProvider = $this->getTableName($this->tableProvider);
        $tableScedule = $this->getTableName($this->tableScedule);
        $tableTerritory = $this->getTableName($this->tableTerritory);
        $tableVersion = $this->getTableName($this->tableVersion);
		
		$dbAdapter = $this->getConnection();
		
		$versionDb = $this->_getVersion($dbAdapter, $tableVersion);
		
		if ($versionDb >= $version)
		{
			return $this;
		}
        
        $queries = array();
		
        $query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`num` BIGINT(19) NOT NULL AUTO_INCREMENT, ';
        $query[] = '`count` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = 'PRIMARY KEY (`num`) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';

        $query = implode("\n", $query);
        $query = str_replace('%table%', $tableVersion, $query);
		
		$queries[] = $query;
		
		
		$query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`provider_id` BIGINT(19) unsigned NOT NULL AUTO_INCREMENT, ';
        $query[] = '`published` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`updated` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`enabled` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`description` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = 'PRIMARY KEY (`provider_id`), ';
        $query[] = 'KEY `idx_provider` (`provider` (45)) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';

        $query = implode("\n", $query);
		$query = str_replace('%table%', $tableProvider, $query);
		
		$queries[] = $query;
		

        $query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`territory_id` BIGINT(19) unsigned NOT NULL AUTO_INCREMENT, ';
        $query[] = '`published` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`updated` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`enabled` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`provider_territory_id` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider_territory_name` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`iso_3166_1_alpha_2` VARCHAR(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`iso_3166_1_alpha_3` VARCHAR(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`iso_3166_1_numeric` VARCHAR(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`description` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = 'PRIMARY KEY (`territory_id`), ';
        $query[] = 'KEY `idx_provider_provider_territory_id_iso_3166_1_alpha_2` (`provider` (45), `provider_territory_id`, `iso_3166_1_alpha_2`), ';
        $query[] = 'KEY `idx_iso_3166_1_alpha_2_provider_provider_territory_id` (`iso_3166_1_alpha_2`, `provider` (45), `provider_territory_id`) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';

        $query = implode("\n", $query);
		$query = str_replace('%table%', $tableTerritory, $query);
		
		$queries[] = $query;
		
		
		$query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`lottery_id` BIGINT(19) unsigned NOT NULL AUTO_INCREMENT, ';
        $query[] = '`published` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`updated` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`enabled` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`lottery_name` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`website` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`minimal_win` DECIMAL(21,2) NOT NULL DEFAULT \'0.00\', ';
        $query[] = '`record_win` DECIMAL(21,2) NOT NULL DEFAULT \'0.00\', ';
        $query[] = '`price` DECIMAL(21,2) NOT NULL DEFAULT \'0.00\', ';
        $query[] = '`provider_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`provider_lottery_id` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider_lottery_name` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`provider_territory_id` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider_territory_name` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`provider_state_name` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`territory_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`iso_3166_1_alpha_2` VARCHAR(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`iso_3166_1_alpha_3` VARCHAR(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`iso_3166_1_numeric` VARCHAR(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`jackpot` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`currency` VARCHAR(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`quess_range` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`provider_hosted_in` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, ';
        $query[] = '`digits_color` VARCHAR(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`digits_additional_color` VARCHAR(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`digits_bonus_color` VARCHAR(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`image_uri` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`image_height` INT(9) NOT NULL DEFAULT \'0\', ';
        $query[] = '`image_width` INT(9) NOT NULL DEFAULT \'0\', ';
        $query[] = '`image_banner` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = 'PRIMARY KEY (`lottery_id`), ';
        $query[] = 'KEY `idx_provider_id_provider_lottery_id` (`provider_id`, `provider_lottery_id`), ';
        $query[] = 'KEY `idx_lottery_name` (`lottery_name`) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';
		
        $query = implode("\n", $query);
		$query = str_replace('%table%', $tableLottery, $query);
		
		$queries[] = $query;
		
        
		//TODO
		$query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`chance_id` BIGINT(19) unsigned NOT NULL AUTO_INCREMENT, ';
        $query[] = '`published` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`updated` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`enabled` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`lottery_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`provider_lottery_id` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\', ';
        $query[] = '`rank` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`hits` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`additional` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`quote` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = 'PRIMARY KEY (`chance_id`), ';
        $query[] = 'KEY `idx_lottery_id_rank` (`lottery_id`, `rank`), ';
        $query[] = 'KEY `idx_provider_id` (`provider_id`), ';
        $query[] = 'KEY `idx_provider` (`provider`) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';

        $query = implode("\n", $query);
		$query = str_replace('%table%', $tableChance, $query);
		
		$queries[] = $query;
		

		//TODO
        $query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`scedule_id` BIGINT(19) unsigned NOT NULL AUTO_INCREMENT, ';
        $query[] = '`published` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`updated` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`enabled` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`lottery_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`provider_lottery_id` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\', ';
        $query[] = '`weekday_8601` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`time_medium_utc` TIME NOT NULL DEFAULT \'00:00:00\', ';
        $query[] = 'PRIMARY KEY (`scedule_id`), ';
        $query[] = 'KEY `idx_lottery_id_weekday_8601` (`lottery_id`, `weekday_8601`), ';
        #$query[] = 'KEY `idx_lottery_id_weekday_8601_time_medium_utc` (`lottery_id`, `weekday_8601`, `time_medium_utc`), ';
        $query[] = 'KEY `idx_provider_id` (`provider_id`), ';
        $query[] = 'KEY `idx_provider` (`provider`) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';

        $query = implode("\n", $query);
		$query = str_replace('%table%', $tableScedule, $query);
		
		$queries[] = $query;
		
		
		//TODO
		$query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`draw_id` BIGINT(19) unsigned NOT NULL AUTO_INCREMENT, ';
        $query[] = '`published` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`updated` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`enabled` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`lottery_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`provider_lottery_id` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider_draw_id` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider_game_id` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\', ';
        $query[] = '`date_draw` DATE NOT NULL DEFAULT \'0001-01-01\', ';
        $query[] = '`year_8601` YEAR NOT NULL DEFAULT \'0001\', ';
        $query[] = '`year_8601_draw_id` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`digits` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`digits_additional` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`digits_bonus` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`currency` VARCHAR(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`amount` DECIMAL(21,2) NOT NULL DEFAULT \'0.00\', ';
        $query[] = 'PRIMARY KEY (`draw_id`), ';
        $query[] = 'KEY `idx_lottery_id_provider_draw_id_provider_game_id` (`lottery_id`, `provider_draw_id`, `provider_game_id`), ';
        $query[] = 'KEY `idx_provider_id_provider_draw_id_provider_game_id` (`provider_id`, `provider_draw_id`, `provider_game_id`) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';

        $query = implode("\n", $query);
		$query = str_replace('%table%', $tableDraw, $query);
		
		$queries[] = $query;
		
        
		//TODO
		$query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`payout_id` BIGINT(19) unsigned NOT NULL AUTO_INCREMENT, ';
        $query[] = '`published` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`updated` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`enabled` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`lottery_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`draw_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`provider_lottery_id` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider_draw_id` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider_game_id` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider_payout_id` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider_currency_id` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\', ';
        $query[] = '`rank` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`hits` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`additional` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`amount` DECIMAL(21,2) NOT NULL DEFAULT \'0.00\', ';
        $query[] = '`winners` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`currency` VARCHAR(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = 'PRIMARY KEY (`payout_id`), ';
        $query[] = 'KEY `idx_lottery_id_provider_payout_id_provider_game_id` (`lottery_id`, `provider_payout_id`, `provider_game_id`), ';
        $query[] = 'KEY `idx_provider_id_provider_draw_id_provider_game_id` (`provider_id`, `provider_draw_id`, `provider_game_id`), ';
        $query[] = 'KEY `idx_provider_id_provider_payout_id_provider_game_id` (`provider_id`, `provider_payout_id`, `provider_game_id`) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';

        $query = implode("\n", $query);
		$query = str_replace('%table%', $tablePayout, $query);
		
		$queries[] = $query;
        
		
		//TODO
		$query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`lottery_text_id` BIGINT(19) unsigned NOT NULL AUTO_INCREMENT, ';
        $query[] = '`published` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`updated` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`enabled` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`lottery_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`provider_lottery_id` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\', ';
        $query[] = '`locale` VARCHAR(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`field_name` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`field_value` TEXT COLLATE utf8_unicode_ci NOT NULL, ';
        $query[] = '`comment` TEXT COLLATE utf8_unicode_ci NOT NULL, ';
        $query[] = 'PRIMARY KEY (`lottery_text_id`), ';
        $query[] = 'KEY `idx_lottery_id_locale_field_name` (`lottery_id`, `locale`, `field_name`), ';
        $query[] = 'KEY `idx_provider_id_locale_field_name` (`provider_id`, `locale`, `field_name`) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';

        $query = implode("\n", $query);
		$query = str_replace('%table%', $tableLotteryText, $query);
		
		$queries[] = $query;
		
        
		$query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`lottery_image_id` BIGINT(19) unsigned NOT NULL AUTO_INCREMENT, ';
        $query[] = '`published` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`updated` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`enabled` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`lottery_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`provider` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`provider_lottery_id` VARCHAR(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'0\', ';
        $query[] = '`lottery_image_box_id` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`locale` VARCHAR(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`order` BIGINT(19) NOT NULL DEFAULT \'0\', ';
        $query[] = '`path` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`comment` TEXT COLLATE utf8_unicode_ci NOT NULL, ';
        $query[] = 'PRIMARY KEY (`lottery_image_id`), ';
        $query[] = 'KEY `idx_lottery_id_locale_order` (`lottery_id`, `locale`, `order`), ';
        $query[] = 'KEY `idx_lottery_id_locale_path` (`lottery_id`, `locale`, `path`), ';
        $query[] = 'KEY `idx_order_locale_lottery_id` (`order`, `locale`, `lottery_id`), ';
        $query[] = 'KEY `idx_path_locale_lottery_id` (`path`, `locale`, `lottery_id`) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';

        $query = implode("\n", $query);
		$query = str_replace('%table%', $tableLotteryImage, $query);
		
		$queries[] = $query;
		
        
		$query = array();

        $query[] = 'CREATE TABLE IF NOT EXISTS `%table%` ';
        $query[] = '( ';
        $query[] = '`lottery_image_box_id` BIGINT(19) unsigned NOT NULL AUTO_INCREMENT, ';
        $query[] = '`published` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`updated` DATETIME NOT NULL DEFAULT \'0001-01-01 00:00:00\', ';
        $query[] = '`enabled` INT(5) NOT NULL DEFAULT \'0\', ';
        $query[] = '`name` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`title` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT \'\', ';
        $query[] = '`description` TEXT COLLATE utf8_unicode_ci NOT NULL, ';
        $query[] = 'PRIMARY KEY (`lottery_image_box_id`), ';
        $query[] = 'KEY `idx_lottery_image_box_id_name` (`lottery_image_box_id`, `name`), ';
        $query[] = 'KEY `idx_name_lottery_image_box_id` (`name`, `lottery_image_box_id`) ';
        $query[] = ') ';
        $query[] = 'ENGINE = InnoDB ';
        $query[] = 'DEFAULT CHARACTER SET = utf8 ';
        $query[] = 'COLLATE = utf8_unicode_ci ';
        $query[] = 'AUTO_INCREMENT = 1; ';

        $query = implode("\n", $query);
		$query = str_replace('%table%', $tableLotteryImageBox, $query);
		
		$queries[] = $query;
        
		
		if ($versionDb < $version)
		{
            foreach ($queries as $query)
            {
                $stmt = $dbAdapter->query($query);
                $stmt->closeCursor();
            }
			
			$this->_setVersion($dbAdapter, $tableVersion, $version);
		}
		
		return $this;
	}

}