<?php 

/**
 * 
 * @author Ehrlich, Andreas <ehrlich.andreas@googlemail.com>
 */
class EhrlichAndreas_LotteryCms_Controller_LottoDe extends EhrlichAndreas_LotteryCms_ModuleExtended
{
    
    public function parse($limitDrawList = 5)
    {
        $parser = new EhrlichAndreas_LotteryCms_Parser_LottoDe();
        
        $provider = $parser->getProvider();
        
        $provider_id = 0;
        
        $lottery_name = array
        (
            'spiel77'   => 'spiel77',
            'super6'    => 'super6',
            'lotto'     => 'lotto',
        );
        
        $provider_lottery_name = array
        (
            'spiel77'   => 'Spiel 77',
            'super6'    => 'Super 6',
            'lotto'     => 'Lotto',
        );
        
        $provider_lottery_id = array
        (
            'spiel77'   => 'spiel77',
            'super6'    => 'super6',
            'lotto'     => 'lotto',
        );
        
        $lottery_text = array
        (
            'lottery_draw_title_digits'             => '%provider_territory_name% :: %provider_lottery_name% :: digits',
            'lottery_draw_title_digits_additional'  => '%provider_territory_name% :: %provider_lottery_name% :: digits_additional',
            'lottery_draw_title_digits_bonus'       => '%provider_territory_name% :: %provider_lottery_name% :: digits_bonus',
            'lottery_info_text_information'         => '%provider_territory_name% :: %provider_lottery_name% :: information',
            'lottery_info_text_rules'               => '%provider_territory_name% :: %provider_lottery_name% :: rules',
        );
        
        $locales = array
        (
            'de',
            'en',
        );
        
        $lotteryList = array();
        
        $lotteryTextList = array();
        
        $provider_ids = $this->addReturnProvider($provider);
        
        $provider_id = array_shift($provider_ids);
        
        $lotteryIds = $this->addReturnLottery($provider, $lottery_name);
        
        foreach ($lottery_name as $value)
        {
            $param = array
            (
                'provider_id' => $provider_id,
                'lottery_name' => $value,
                'provider_lottery_id' => $provider_lottery_id[$value],
                'provider_lottery_name' => $provider_lottery_name[$value],
                'provider_territory_name' => 'Deutschland',
                'iso_3166_1_alpha_2' => 'DE',
                'iso_3166_1_alpha_3' => 'DEU',
                'iso_3166_1_numeric' => '276',
                'provider_hosted_in' => 'Deutschland',
                'where' => array
                (
                    'provider_id' => $provider_id,
                    'lottery_name' => $value,
                ),
            );

            $lottery_id = $this->editLottery($param);
        }
        
        $param = array
        (
            'provider_id' => $provider_id,
            'lottery_name' => $lottery_name,
        );

        $rowset = $this->getLotteryList($param);
        
        foreach ($rowset as $row)
        {
            $lotteryList[$row['lottery_name']] = $row;
        }
        
        $param = array
        (
            'provider_id' => $provider_id,
            'lottery_id' => $lotteryIds,
            'locale' => $locales,
            'field_name' => array_keys($lottery_text),
        );
        
        $rowset = $this->getLotteryTextList($param);
        
        foreach ($rowset as $row)
        {
            $key = '';
            $key .= $row['provider_id'];
            $key .= '::';
            $key .= $row['lottery_id'];
            $key .= '::';
            $key .= $row['locale'];
            $key .= '::';
            $key .= $row['field_name'];
            
            $lotteryTextList[$key] = $row;
        }
        
        foreach ($lotteryList as $lottery)
        {
            foreach ($lottery_text as $field_name => $comment)
            {
                foreach ($locales as $locale)
                {
                    $key = '';
                    $key .= $provider_id;
                    $key .= '::';
                    $key .= $lottery['lottery_id'];
                    $key .= '::';
                    $key .= $locale;
                    $key .= '::';
                    $key .= $field_name;
                    
                    if (! isset($lotteryTextList[$key]))
                    {
                        $comment = EhrlichAndreas_Util_Vsprintf::vsprintf($comment, $lottery);
                        
                        $param = array
                        (
                            'lottery_id'            => $lottery['lottery_id'],
                            'provider_id'           => $provider_id,
                            'provider'              => $provider,
                            'provider_lottery_id'   => $lottery['provider_lottery_id'],
                            'locale'                => $locale,
                            'field_name'            => $field_name,
                            'comment '              => $comment,
                        );
                
                        $lottery_text_id = $this->addLotteryText($param);
                        
                        $lotteryTextList[$key] = $param;
                
                        $lotteryTextList[$value]['lottery_text_id'] = $lottery_text_id;
                    }
                }
            }
        }
        
        
        $link = array();
        
        $drawResults = $parser->getLotteryResults($link);
        
        
        $years = $drawResults['additional']['years'];
        
        $days = $drawResults['additional']['drawdays'];
        
        $viewstate = $drawResults['additional']['viewstate'];
        
        
        $drawsCount = 0;
        
        
        foreach ($years as $year)
        {
            if ($limitDrawList > 0 && $drawsCount >= $limitDrawList)
            {
                break;
            }
            
            $day = '0001-01-01';
            
            if (count($days) > 0)
            {
                $day = array_values($days);
                
                $day = $day[0];
            }
            
            $year = strval($year);
            
            if (stripos($day, $year) !== 0)
            {
                $link = array
                (
                    'query' => array
                    (
                        #'viewstate' => $viewstate,
                        'year'      => $year,
                        #'drawday'   => $day,
                    ),
                );

                $drawResults = $parser->getLotteryResults($link);

                $days = $drawResults['additional']['drawdays'];

                #$viewstate = $drawResults['additional']['viewstate'];
            }
            
            foreach ($days as $day)
            {
                $link = array
                (
                    'query' => array
                    (
                        #'viewstate' => $viewstate,
                        'year'      => $year,
                        'drawday'   => $day,
                    ),
                );

                $drawResults = $parser->getLotteryResults($link);

                #$viewstate = $drawResults['additional']['viewstate'];
                
                $lotteryDraws = $drawResults['lottery'];
                
                foreach ($lotteryDraws as $lotteryDraw)
                {
                    if (strlen($lotteryDraw['digits']) <= 0)
                    {
                        continue;
                    }
                    
                    $lottery_id = $lotteryList[$lotteryDraw['lottery_name']]['lottery_id'];
                    
                    $provider_lottery_id = $lotteryList[$lotteryDraw['lottery_name']]['provider_lottery_id'];
                    
                    $where = array
                    (
                        'lottery_id'        => $lottery_id,
                        'provider_draw_id'  => $day,
                    );
                    
                    $param = array
                    (
                        'lottery_id'            => $lottery_id,
                        'provider_id'           => $provider_id,
                        'provider'              => $provider,
                        'provider_lottery_id'   => $provider_lottery_id,
                        'provider_draw_id'      => $day,
                        'date_draw'             => $day,
                        'year_8601'             => $year,
                        'digits'                => $lotteryDraw['digits'],
                        'digits_additional'     => $lotteryDraw['digits_additional'],
                        'digits_bonus'          => $lotteryDraw['digits_bonus'],
                        'currency'              => $lotteryDraw['currency'],
                        'amount'                => $lotteryDraw['amount'],
                    );
                    

                    $rowset = $this->getDrawList($where);
                    
                    if (count($rowset) <= 0)
                    {
                        $paramInsert = $param;
                        
                        $this->addDraw($paramInsert);
                    }
                    else
                    {
                        $paramEdit = $param;
                        
                        $paramEdit['where'] = $where;
                        
                        $this->editDraw($paramEdit);
                    }
                    
                    $rowset = $this->getDrawList($where);
                    
                    
                    $param['draw_id'] = $rowset[0]['draw_id'];
                    
                    $param['provider_game_id'] = $rowset[0]['provider_game_id'];
                    
                    
                    foreach ($lotteryDraw['payout'] as $payout)
                    {
                        $paramSelect = array
                        (
                            'lottery_id'    => $lottery_id,
                            'draw_id'       => $param['draw_id'],
                            'rank'          => $payout['rank'],
                        );

                        $rowset = $this->getPayoutList($paramSelect);
                    
                        $param = array_merge($param, $payout);
                    
                        if (count($rowset) <= 0)
                        {
                            $paramInsert = $param;

                            $this->addPayout($paramInsert);
                        }
                        else
                        {
                            $paramEdit = $param;

                            $paramEdit['where'] = $paramSelect;

                            unset($paramEdit['where']['cols']);

                            $this->editPayout($paramEdit);
                        }
                    }
                }
                
                $drawsCount++;
                
                if ($limitDrawList > 0 && $drawsCount >= $limitDrawList)
                {
                    break;
                }
            }
        }
    }
}

