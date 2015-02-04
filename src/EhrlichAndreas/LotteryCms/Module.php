<?php 

/**
 * 
 * @author Ehrlich, Andreas <ehrlich.andreas@googlemail.com>
 */
class EhrlichAndreas_LotteryCms_Module extends EhrlichAndreas_AbstractCms_Module
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
     * Constructor
     * 
     * @param array $options
     *            Associative array of options
     * @throws EhrlichAndreas_LotteryCms_Exception
     * @return void
     */
    public function __construct ($options = array())
    {
        $options = $this->_getCmsConfigFromAdapter($options);
        
        if (! isset($options['adapterNamespace']))
        {
            $options['adapterNamespace'] = 'EhrlichAndreas_LotteryCms_Adapter';
        }
        
        if (! isset($options['exceptionclass']))
        {
            $options['exceptionclass'] = 'EhrlichAndreas_LotteryCms_Exception';
        }
        
        parent::__construct($options);
    }
    
    /**
     * 
     * @return EhrlichAndreas_LotteryCms_Module
     */
    public function install()
    {
        return parent::install();
    }

    /**
     * 
     * @return string
     */
    public function getTableChance ()
    {
        return $this->adapter->getTableName($this->tableChance);
    }

    /**
     * 
     * @return string
     */
    public function getTableDraw ()
    {
        return $this->adapter->getTableName($this->tableDraw);
    }

    /**
     * 
     * @return string
     */
    public function getTableLottery ()
    {
        return $this->adapter->getTableName($this->tableLottery);
    }

    /**
     * 
     * @return string
     */
    public function getTableLotteryImage ()
    {
        return $this->adapter->getTableName($this->tableLotteryImage);
    }

    /**
     * 
     * @return string
     */
    public function getTableLotteryImageBox ()
    {
        return $this->adapter->getTableName($this->tableLotteryImageBox);
    }

    /**
     * 
     * @return string
     */
    public function getTableLotteryText ()
    {
        return $this->adapter->getTableName($this->tableLotteryText);
    }

    /**
     * 
     * @return string
     */
    public function getTablePayout ()
    {
        return $this->adapter->getTableName($this->tablePayout);
    }

    /**
     * 
     * @return string
     */
    public function getTableProvider ()
    {
        return $this->adapter->getTableName($this->tableProvider);
    }

    /**
     * 
     * @return string
     */
    public function getTableScedule ()
    {
        return $this->adapter->getTableName($this->tableScedule);
    }

    /**
     * 
     * @return string
     */
    public function getTableTerritory ()
    {
        return $this->adapter->getTableName($this->tableTerritory);
    }

    /**
     * 
     * @return string
     */
    public function getTableVersion ()
    {
        return $this->adapter->getTableName($this->tableVersion);
    }

    /**
     * 
     * @return array
     */
    public function getFieldsChance ()
    {
        return array
		(
            'chance_id'             => 'chance_id',
            'published'             => 'published',
            'updated'               => 'updated',
            'enabled'               => 'enabled',
            'lottery_id'            => 'lottery_id',
            'provider_id'           => 'provider_id',
            'provider'              => 'provider',
            'provider_lottery_id'   => 'provider_lottery_id',
            'rank'                  => 'rank',
            'hits'                  => 'hits',
            'additional'            => 'additional',
            'quote'                 => 'quote',
        );
    }

    /**
     * 
     * @return array
     */
    public function getFieldsDraw ()
    {
        return array
		(
            'draw_id'               => 'draw_id',
            'published'             => 'published',
            'updated'               => 'updated',
            'enabled'               => 'enabled',
            'lottery_id'            => 'lottery_id',
            'provider_id'           => 'provider_id',
            'provider'              => 'provider',
            'provider_lottery_id'   => 'provider_lottery_id',
            'provider_draw_id'      => 'provider_draw_id',
            'provider_game_id'      => 'provider_game_id',
            'date_draw'             => 'date_draw',
            'year_8601'             => 'year_8601',
            'year_8601_draw_id'     => 'year_8601_draw_id',
            'digits'                => 'digits',
            'digits_additional'     => 'digits_additional',
            'digits_bonus'          => 'digits_bonus',
            'currency'              => 'currency',
            'amount'                => 'amount',
        );
    }

    /**
     * 
     * @return array
     */
    public function getFieldsLottery ()
    {
        return array
		(
            'lottery_id'                => 'lottery_id',
            'published'                 => 'published',
            'updated'                   => 'updated',
            'enabled'                   => 'enabled',
            'lottery_name'              => 'lottery_name',
            'website'                   => 'website',
            'minimal_win'               => 'minimal_win',
            'record_win'                => 'record_win',
            'price'                     => 'price',
            'provider_id'               => 'provider_id',
            'provider'                  => 'provider',
            'provider_lottery_id'       => 'provider_lottery_id',
            'provider_lottery_name'     => 'provider_lottery_name',
            'provider_territory_id'     => 'provider_territory_id',
            'provider_territory_name'   => 'provider_territory_name',
            'provider_state_name'       => 'provider_state_name',
            'territory_id'              => 'territory_id',
            'iso_3166_1_alpha_2'        => 'iso_3166_1_alpha_2',
            'iso_3166_1_alpha_3'        => 'iso_3166_1_alpha_3',
            'iso_3166_1_numeric'        => 'iso_3166_1_numeric',
            'jackpot'                   => 'jackpot',
            'currency'                  => 'currency',
            'quess_range'               => 'quess_range',
            'provider_hosted_in'        => 'provider_hosted_in',
            'digits_color'              => 'digits_color',
            'digits_additional_color'   => 'digits_additional_color',
            'digits_bonus_color'        => 'digits_bonus_color',
            'image_uri'                 => 'image_uri',
            'image_height'              => 'image_height',
            'image_width'               => 'image_width',
            'image_banner'              => 'image_banner',
        );
    }

    /**
     * 
     * @return array
     */
    public function getFieldsLotteryImage ()
    {
        return array
		(
            'lottery_image_id'      => 'lottery_image_id',
            'published'             => 'published',
            'updated'               => 'updated',
            'enabled'               => 'enabled',
            'lottery_id'            => 'lottery_id',
            'provider_id'           => 'provider_id',
            'provider'              => 'provider',
            'provider_lottery_id'   => 'provider_lottery_id',
            'lottery_image_box_id'  => 'lottery_image_box_id',
            'locale'                => 'locale',
            'order'                 => 'order',
            'path'                  => 'path',
            'comment'               => 'comment',
        );
    }

    /**
     * 
     * @return array
     */
    public function getFieldsLotteryImageBox ()
    {
        return array
		(
            'lottery_image_box_id'  => 'lottery_image_box_id',
            'published'             => 'published',
            'updated'               => 'updated',
            'enabled'               => 'enabled',
            'name'                  => 'name',
            'title'                 => 'title',
            'description'           => 'description',
        );
    }

    /**
     * 
     * @return array
     */
    public function getFieldsLotteryText ()
    {
        return array
		(
            'lottery_text_id'       => 'lottery_text_id',
            'published'             => 'published',
            'updated'               => 'updated',
            'enabled'               => 'enabled',
            'lottery_id'            => 'lottery_id',
            'provider_id'           => 'provider_id',
            'provider'              => 'provider',
            'provider_lottery_id'   => 'provider_lottery_id',
            'locale'                => 'locale',
            'field_name'            => 'field_name',
            'field_value'           => 'field_value',
            'comment'               => 'comment',
        );
    }

    /**
     * 
     * @return array
     */
    public function getFieldsPayout ()
    {
        return array
		(
            'payout_id'             => 'payout_id',
            'published'             => 'published',
            'updated'               => 'updated',
            'enabled'               => 'enabled',
            'lottery_id'            => 'lottery_id',
            'draw_id'               => 'draw_id',
            'provider_id'           => 'provider_id',
            'provider'              => 'provider',
            'provider_lottery_id'   => 'provider_lottery_id',
            'provider_draw_id'      => 'provider_draw_id',
            'provider_game_id'      => 'provider_game_id',
            'provider_payout_id'    => 'provider_payout_id',
            'provider_currency_id'  => 'provider_currency_id',
            'rank'                  => 'rank',
            'hits'                  => 'hits',
            'additional'            => 'additional',
            'amount'                => 'amount',
            'winners'               => 'winners',
            'currency'              => 'currency',
        );
    }

    /**
     * 
     * @return array
     */
    public function getFieldsProvider ()
    {
        return array
		(
            'provider_id'   => 'provider_id',
            'published'     => 'published',
            'updated'       => 'updated',
            'enabled'       => 'enabled',
            'provider'      => 'provider',
            'description'   => 'description',
        );
    }

    /**
     * 
     * @return array
     */
    public function getFieldsScedule ()
    {
        return array
		(
            'scedule_id'            => 'scedule_id',
            'published'             => 'published',
            'updated'               => 'updated',
            'enabled'               => 'enabled',
            'lottery_id'            => 'lottery_id',
            'provider_id'           => 'provider_id',
            'provider'              => 'provider',
            'provider_lottery_id'   => 'provider_lottery_id',
            'weekday_8601'          => 'weekday_8601',
            'time_medium_utc'       => 'time_medium_utc',
        );
    }

    /**
     * 
     * @return array
     */
    public function getFieldsTerritory ()
    {
        return array
		(
            'territory_id'              => 'territory_id',
            'published'                 => 'published',
            'updated'                   => 'updated',
            'enabled'                   => 'enabled',
            'provider_id'               => 'provider_id',
            'provider'                  => 'provider',
            'provider_territory_id'     => 'provider_territory_id',
            'provider_territory_name'   => 'provider_territory_name',
            'iso_3166_1_alpha_2'        => 'iso_3166_1_alpha_2',
            'iso_3166_1_alpha_3'        => 'iso_3166_1_alpha_3',
            'iso_3166_1_numeric'        => 'iso_3166_1_numeric',
            'description'               => 'description',
        );
    }

    /**
     * 
     * @return array
     */
    public function getKeyFieldsChance ()
    {
        return array
		(
            'chance_id' => 'chance_id',
        );
    }

    /**
     * 
     * @return array
     */
    public function getKeyFieldsDraw ()
    {
        return array
		(
            'draw_id'   => 'draw_id',
        );
    }

    /**
     * 
     * @return array
     */
    public function getKeyFieldsLottery ()
    {
        return array
		(
            'lottery_id'    => 'lottery_id',
        );
    }

    /**
     * 
     * @return array
     */
    public function getKeyFieldsLotteryImage ()
    {
        return array
		(
            'lottery_image_id'  => 'lottery_image_id',
        );
    }

    /**
     * 
     * @return array
     */
    public function getKeyFieldsLotteryImageBox ()
    {
        return array
		(
            'lottery_image_box_id'  => 'lottery_image_box_id',
        );
    }

    /**
     * 
     * @return array
     */
    public function getKeyFieldsLotteryText ()
    {
        return array
		(
            'lottery_text_id'   => 'lottery_text_id',
        );
    }

    /**
     * 
     * @return array
     */
    public function getKeyFieldsPayout ()
    {
        return array
		(
            'payout_id' => 'payout_id',
        );
    }

    /**
     * 
     * @return array
     */
    public function getKeyFieldsProvider ()
    {
        return array
		(
            'provider_id'   => 'provider_id',
        );
    }

    /**
     * 
     * @return array
     */
    public function getKeyFieldsScedule ()
    {
        return array
		(
            'scedule_id'    => 'scedule_id',
        );
    }

    /**
     * 
     * @return array
     */
    public function getKeyFieldsTerritory ()
    {
        return array
		(
            'territory_id'  => 'territory_id',
        );
    }

	/**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return mixed
     */
	public function addChance ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }

        if (! isset($params['published']) || $params['published'] == '0000-00-00 00:00:00')
        {
            $params['published'] = date('Y-m-d H:i:s', time());
        }
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = '0001-01-01 00:00:00';
        }
        if (! isset($params['enabled']))
        {
            $params['enabled'] = '1';
        }
        if (! isset($params['lottery_id']))
        {
            $params['lottery_id'] = '0';
        }
        if (! isset($params['provider_id']))
        {
            $params['provider_id'] = '0';
        }
        if (! isset($params['provider']))
        {
            $params['provider'] = '';
        }
        if (! isset($params['provider_lottery_id']))
        {
            $params['provider_lottery_id'] = '0';
        }
        if (! isset($params['rank']))
        {
            $params['rank'] = '0';
        }
        if (! isset($params['hits']))
        {
            $params['hits'] = '0';
        }
        if (! isset($params['additional']))
        {
            $params['additional'] = '';
        }
        if (! isset($params['quote']))
        {
            $params['quote'] = '';
        }
		
		$function = 'Chance';
		
		return $this->_add($function, $params, $returnAsString);
	}

	/**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return mixed
     */
	public function addDraw ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }

        if (! isset($params['published']) || $params['published'] == '0000-00-00 00:00:00')
        {
            $params['published'] = date('Y-m-d H:i:s', time());
        }
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = '0001-01-01 00:00:00';
        }
        if (! isset($params['enabled']))
        {
            $params['enabled'] = '1';
        }
        if (! isset($params['lottery_id']))
        {
            $params['lottery_id'] = '0';
        }
        if (! isset($params['provider_id']))
        {
            $params['provider_id'] = '0';
        }
        if (! isset($params['provider']))
        {
            $params['provider'] = '';
        }
        if (! isset($params['provider_lottery_id']))
        {
            $params['provider_lottery_id'] = '0';
        }
        if (! isset($params['provider_draw_id']))
        {
            $params['provider_draw_id'] = '0';
        }
        if (! isset($params['date_draw']))
        {
            $params['date_draw'] = '0001-01-01';
        }
        if (! isset($params['year_8601']))
        {
            $params['year_8601'] = '0001';
        }
        if (! isset($params['year_8601_draw_id']))
        {
            $params['year_8601_draw_id'] = '0';
        }
        if (! isset($params['digits']))
        {
            $params['digits'] = '';
        }
        if (! isset($params['digits_additional']))
        {
            $params['digits_additional'] = '';
        }
        if (! isset($params['digits_bonus']))
        {
            $params['digits_bonus'] = '';
        }
		
		$function = 'Draw';
		
		return $this->_add($function, $params, $returnAsString);
	}

	/**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return mixed
     */
	public function addLottery ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }

        if (! isset($params['published']) || $params['published'] == '0000-00-00 00:00:00')
        {
            $params['published'] = date('Y-m-d H:i:s', time());
        }
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = '0001-01-01 00:00:00';
        }
        if (! isset($params['enabled']))
        {
            $params['enabled'] = '1';
        }
        if (! isset($params['lottery_name']))
        {
            $params['lottery_name'] = '';
        }
        if (! isset($params['website']))
        {
            $params['website'] = '';
        }
        if (! isset($params['minimal_win']))
        {
            $params['minimal_win'] = '0.00';
        }
        if (! isset($params['record_win']))
        {
            $params['record_win'] = '0.00';
        }
        if (! isset($params['price']))
        {
            $params['price'] = '0.00';
        }
        if (! isset($params['provider_id']))
        {
            $params['provider_id'] = '0';
        }
        if (! isset($params['provider']))
        {
            $params['provider'] = '';
        }
        if (! isset($params['provider_lottery_id']))
        {
            $params['provider_lottery_id'] = '0';
        }
        if (! isset($params['provider_lottery_name']))
        {
            $params['provider_lottery_name'] = '';
        }
        if (! isset($params['provider_territory_id']))
        {
            $params['provider_territory_id'] = '0';
        }
        if (! isset($params['provider_territory_name']))
        {
            $params['provider_territory_name'] = '';
        }
        if (! isset($params['provider_state_name']))
        {
            $params['provider_state_name'] = '';
        }
        if (! isset($params['territory_id']))
        {
            $params['territory_id'] = '0';
        }
        if (! isset($params['iso_3166_1_alpha_2']))
        {
            $params['iso_3166_1_alpha_2'] = '';
        }
        if (! isset($params['iso_3166_1_alpha_3']))
        {
            $params['iso_3166_1_alpha_3'] = '';
        }
        if (! isset($params['iso_3166_1_numeric']))
        {
            $params['iso_3166_1_numeric'] = '';
        }
        if (! isset($params['jackpot']))
        {
            $params['jackpot'] = '0';
        }
        if (! isset($params['currency']))
        {
            $params['currency'] = '';
        }
        if (! isset($params['quess_range']))
        {
            $params['quess_range'] = '';
        }
        if (! isset($params['provider_hosted_in']))
        {
            $params['provider_hosted_in'] = '';
        }
        if (! isset($params['digits_color']))
        {
            $params['digits_color'] = '';
        }
        if (! isset($params['digits_additional_color']))
        {
            $params['digits_additional_color'] = '';
        }
        if (! isset($params['digits_bonus_color']))
        {
            $params['digits_bonus_color'] = '';
        }
        if (! isset($params['image_uri']))
        {
            $params['image_uri'] = '';
        }
        if (! isset($params['image_height']))
        {
            $params['image_height'] = '';
        }
        if (! isset($params['image_width']))
        {
            $params['image_width'] = '';
        }
        if (! isset($params['image_banner']))
        {
            $params['image_banner'] = '';
        }
		
		$function = 'Lottery';
		
		return $this->_add($function, $params, $returnAsString);
	}

	/**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return mixed
     */
	public function addLotteryImage ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }

        if (! isset($params['published']) || $params['published'] == '0000-00-00 00:00:00')
        {
            $params['published'] = date('Y-m-d H:i:s', time());
        }
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = '0001-01-01 00:00:00';
        }
        if (! isset($params['enabled']))
        {
            $params['enabled'] = '1';
        }
        if (! isset($params['lottery_id']))
        {
            $params['lottery_id'] = '0';
        }
        if (! isset($params['provider_id']))
        {
            $params['provider_id'] = '0';
        }
        if (! isset($params['provider']))
        {
            $params['provider'] = '';
        }
        if (! isset($params['provider_lottery_id']))
        {
            $params['provider_lottery_id'] = '0';
        }
        if (! isset($params['lottery_image_box_id']))
        {
            $params['lottery_image_box_id'] = '0';
        }
        if (! isset($params['locale']))
        {
            $params['locale'] = '';
        }
        if (! isset($params['order']))
        {
            $params['order'] = '0';
        }
        if (! isset($params['path']))
        {
            $params['path'] = '';
        }
        if (! isset($params['comment']))
        {
            $params['comment'] = '';
        }
		
		$function = 'LotteryImage';
		
		return $this->_add($function, $params, $returnAsString);
	}

	/**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return mixed
     */
	public function addLotteryImageBox ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }

        if (! isset($params['published']) || $params['published'] == '0000-00-00 00:00:00')
        {
            $params['published'] = date('Y-m-d H:i:s', time());
        }
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = '0001-01-01 00:00:00';
        }
        if (! isset($params['enabled']))
        {
            $params['enabled'] = '1';
        }
        if (! isset($params['name']))
        {
            $params['name'] = '';
        }
        if (! isset($params['title']))
        {
            $params['title'] = '';
        }
        if (! isset($params['description']))
        {
            $params['description'] = '';
        }
		
		$function = 'LotteryImageBox';
		
		return $this->_add($function, $params, $returnAsString);
	}

	/**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return mixed
     */
	public function addLotteryText ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }

        if (! isset($params['published']) || $params['published'] == '0000-00-00 00:00:00')
        {
            $params['published'] = date('Y-m-d H:i:s', time());
        }
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = '0001-01-01 00:00:00';
        }
        if (! isset($params['enabled']))
        {
            $params['enabled'] = '1';
        }
        if (! isset($params['lottery_id']))
        {
            $params['lottery_id'] = '0';
        }
        if (! isset($params['provider_id']))
        {
            $params['provider_id'] = '0';
        }
        if (! isset($params['provider']))
        {
            $params['provider'] = '';
        }
        if (! isset($params['provider_lottery_id']))
        {
            $params['provider_lottery_id'] = '0';
        }
        if (! isset($params['locale']))
        {
            $params['locale'] = '';
        }
        if (! isset($params['field_name']))
        {
            $params['field_name'] = '';
        }
        if (! isset($params['field_value']))
        {
            $params['field_value'] = '';
        }
        if (! isset($params['comment']))
        {
            $params['comment'] = '';
        }
		
		$function = 'LotteryText';
		
		return $this->_add($function, $params, $returnAsString);
	}

	/**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return mixed
     */
	public function addPayout ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
        if (! isset($params['published']) || $params['published'] == '0000-00-00 00:00:00')
        {
            $params['published'] = date('Y-m-d H:i:s', time());
        }
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = '0001-01-01 00:00:00';
        }
        if (! isset($params['enabled']))
        {
            $params['enabled'] = '1';
        }
        if (! isset($params['lottery_id']))
        {
            $params['lottery_id'] = '0';
        }
        if (! isset($params['draw_id']))
        {
            $params['draw_id'] = '0';
        }
        if (! isset($params['provider_id']))
        {
            $params['provider_id'] = '0';
        }
        if (! isset($params['provider']))
        {
            $params['provider'] = '';
        }
        if (! isset($params['provider_lottery_id']))
        {
            $params['provider_lottery_id'] = '0';
        }
        if (! isset($params['provider_draw_id']))
        {
            $params['provider_draw_id'] = '0';
        }
        if (! isset($params['provider_game_id']))
        {
            $params['provider_game_id'] = '0';
        }
        if (! isset($params['provider_payout_id']))
        {
            $params['provider_payout_id'] = '0';
        }
        if (! isset($params['provider_currency_id']))
        {
            $params['provider_currency_id'] = '0';
        }
        if (! isset($params['rank']))
        {
            $params['rank'] = '0';
        }
        if (! isset($params['hits']))
        {
            $params['hits'] = '0';
        }
        if (! isset($params['additional']))
        {
            $params['additional'] = '';
        }
        if (! isset($params['amount']))
        {
            $params['amount'] = '0.00';
        }
        if (! isset($params['winners']))
        {
            $params['winners'] = '0';
        }
		
		$function = 'Payout';
		
		return $this->_add($function, $params, $returnAsString);
	}

	/**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return mixed
     */
	public function addProvider ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
        if (! isset($params['published']) || $params['published'] == '0000-00-00 00:00:00')
        {
            $params['published'] = date('Y-m-d H:i:s', time());
        }
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = '0001-01-01 00:00:00';
        }
        if (! isset($params['enabled']))
        {
            $params['enabled'] = '1';
        }
        if (! isset($params['provider']))
        {
            $params['provider'] = '';
        }
        if (! isset($params['description']))
        {
            $params['description'] = '';
        }
		
		$function = 'Provider';
		
		return $this->_add($function, $params, $returnAsString);
	}

	/**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return mixed
     */
	public function addScedule ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }

        if (! isset($params['published']) || $params['published'] == '0000-00-00 00:00:00')
        {
            $params['published'] = date('Y-m-d H:i:s', time());
        }
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = '0001-01-01 00:00:00';
        }
        if (! isset($params['enabled']))
        {
            $params['enabled'] = '1';
        }
        if (! isset($params['lottery_id']))
        {
            $params['lottery_id'] = '0';
        }
        if (! isset($params['provider_id']))
        {
            $params['provider_id'] = '0';
        }
        if (! isset($params['provider']))
        {
            $params['provider'] = '';
        }
        if (! isset($params['provider_lottery_id']))
        {
            $params['provider_lottery_id'] = '0';
        }
        if (! isset($params['weekday_8601']))
        {
            $params['weekday_8601'] = '0';
        }
        if (! isset($params['time_medium_utc']))
        {
            $params['time_medium_utc'] = '00:00:00';
        }
		
		$function = 'Scedule';
		
		return $this->_add($function, $params, $returnAsString);
	}

	/**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return mixed
     */
	public function addTerritory ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }

        if (! isset($params['published']) || $params['published'] == '0000-00-00 00:00:00')
        {
            $params['published'] = date('Y-m-d H:i:s', time());
        }
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = '0001-01-01 00:00:00';
        }
        if (! isset($params['enabled']))
        {
            $params['enabled'] = '1';
        }
        if (! isset($params['provider_id']))
        {
            $params['provider_id'] = '0';
        }
        if (! isset($params['provider']))
        {
            $params['provider'] = '';
        }
        if (! isset($params['provider_territory_id']))
        {
            $params['provider_territory_id'] = '0';
        }
        if (! isset($params['provider_territory_name']))
        {
            $params['provider_territory_name'] = '';
        }
        if (! isset($params['iso_3166_1_alpha_2']))
        {
            $params['iso_3166_1_alpha_2'] = '';
        }
        if (! isset($params['iso_3166_1_alpha_3']))
        {
            $params['iso_3166_1_alpha_3'] = '';
        }
        if (! isset($params['iso_3166_1_numeric']))
        {
            $params['iso_3166_1_numeric'] = '';
        }
        if (! isset($params['description']))
        {
            $params['description'] = '';
        }
		
		$function = 'Territory';
		
		return $this->_add($function, $params, $returnAsString);
	}
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function deleteChance ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
		$function = 'Chance';
		
		return $this->_delete($function, $params, $returnAsString);
	}
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function deleteDraw ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
		$function = 'Draw';
		
		return $this->_delete($function, $params, $returnAsString);
	}
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function deleteLottery ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
		$function = 'Lottery';
		
		return $this->_delete($function, $params, $returnAsString);
	}
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function deleteLotteryImage ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
		$function = 'LotteryImage';
		
		return $this->_delete($function, $params, $returnAsString);
	}
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function deleteLotteryImageBox ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
		$function = 'LotteryImageBox';
		
		return $this->_delete($function, $params, $returnAsString);
	}
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function deleteLotteryText ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
		$function = 'LotteryText';
		
		return $this->_delete($function, $params, $returnAsString);
	}
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function deletePayout ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
		$function = 'Payout';
		
		return $this->_delete($function, $params, $returnAsString);
	}
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function deleteProvider ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
		$function = 'Provider';
		
		return $this->_delete($function, $params, $returnAsString);
	}
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function deleteScedule ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
		$function = 'Scedule';
		
		return $this->_delete($function, $params, $returnAsString);
	}
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function deleteTerritory ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
		$function = 'Territory';
		
		return $this->_delete($function, $params, $returnAsString);
	}
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function editChance ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = date('Y-m-d H:i:s', time());
        }
		
		$function = 'Chance';
		
		return $this->_edit($function, $params, $returnAsString);
	}
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function editDraw ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = date('Y-m-d H:i:s', time());
        }
		
		$function = 'Draw';
		
		return $this->_edit($function, $params, $returnAsString);
	}
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function editLottery ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = date('Y-m-d H:i:s', time());
        }
		
		$function = 'Lottery';
		
		return $this->_edit($function, $params, $returnAsString);
	}
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function editLotteryImage ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = date('Y-m-d H:i:s', time());
        }
		
		$function = 'LotteryImage';
		
		return $this->_edit($function, $params, $returnAsString);
	}
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function editLotteryImageBox ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = date('Y-m-d H:i:s', time());
        }
		
		$function = 'LotteryImageBox';
		
		return $this->_edit($function, $params, $returnAsString);
	}
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function editLotteryText ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = date('Y-m-d H:i:s', time());
        }
		
		$function = 'LotteryText';
		
		return $this->_edit($function, $params, $returnAsString);
	}
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function editPayout ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = date('Y-m-d H:i:s', time());
        }
		
		$function = 'Payout';
		
		return $this->_edit($function, $params, $returnAsString);
	}
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function editProvider ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = date('Y-m-d H:i:s', time());
        }
		
		$function = 'Provider';
		
		return $this->_edit($function, $params, $returnAsString);
	}
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function editScedule ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = date('Y-m-d H:i:s', time());
        }
		
		$function = 'Scedule';
		
		return $this->_edit($function, $params, $returnAsString);
	}
	
    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
	public function editTerritory ($params = array(), $returnAsString = false)
	{
        if (count($params) == 0)
        {
            return false;
        }
		
        if (! isset($params['updated']) || $params['updated'] == '0000-00-00 00:00:00')
        {
            $params['updated'] = date('Y-m-d H:i:s', time());
        }
		
		$function = 'Territory';
		
		return $this->_edit($function, $params, $returnAsString);
	}

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function getChance ($params = array(), $returnAsString = false)
    {
		$function = 'Chance';
		
		return $this->_get($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $where
     * @return array
     */
    public function getChanceList ($where = array())
    {
		$function = 'Chance';
		
		return $this->_getList($function, $where);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function getDraw ($params = array(), $returnAsString = false)
    {
		$function = 'Draw';
		
		return $this->_get($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $where
     * @return array
     */
    public function getDrawList ($where = array())
    {
		$function = 'Draw';
		
		return $this->_getList($function, $where);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function getLottery ($params = array(), $returnAsString = false)
    {
		$function = 'Lottery';
		
		return $this->_get($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $where
     * @return array
     */
    public function getLotteryList ($where = array())
    {
		$function = 'Lottery';
		
		return $this->_getList($function, $where);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function getLotteryImage ($params = array(), $returnAsString = false)
    {
		$function = 'LotteryImage';
		
		return $this->_get($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $where
     * @return array
     */
    public function getLotteryImageList ($where = array())
    {
		$function = 'LotteryImage';
		
		return $this->_getList($function, $where);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function getLotteryImageBox ($params = array(), $returnAsString = false)
    {
		$function = 'LotteryImageBox';
		
		return $this->_get($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $where
     * @return array
     */
    public function getLotteryImageBoxList ($where = array())
    {
		$function = 'LotteryImageBox';
		
		return $this->_getList($function, $where);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function getLotteryText ($params = array(), $returnAsString = false)
    {
		$function = 'LotteryText';
		
		return $this->_get($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $where
     * @return array
     */
    public function getLotteryTextList ($where = array())
    {
		$function = 'LotteryText';
		
		return $this->_getList($function, $where);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function getPayout ($params = array(), $returnAsString = false)
    {
		$function = 'Payout';
		
		return $this->_get($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $where
     * @return array
     */
    public function getPayoutList ($where = array())
    {
		$function = 'Payout';
		
		return $this->_getList($function, $where);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function getProvider ($params = array(), $returnAsString = false)
    {
		$function = 'Provider';
		
		return $this->_get($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $where
     * @return array
     */
    public function getProviderList ($where = array())
    {
		$function = 'Provider';
		
		return $this->_getList($function, $where);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function getScedule ($params = array(), $returnAsString = false)
    {
		$function = 'Scedule';
		
		return $this->_get($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $where
     * @return array
     */
    public function getSceduleList ($where = array())
    {
		$function = 'Scedule';
		
		return $this->_getList($function, $where);
    }

    /**
     *
     * @param array $params
     * @param boolean $returnAsString
     * @return string
     */
    public function getTerritory ($params = array(), $returnAsString = false)
    {
		$function = 'Territory';
		
		return $this->_get($function, $params, $returnAsString);
    }

    /**
     *
     * @param array $where
     * @return array
     */
    public function getTerritoryList ($where = array())
    {
		$function = 'Territory';
		
		return $this->_getList($function, $where);
    }
	
}