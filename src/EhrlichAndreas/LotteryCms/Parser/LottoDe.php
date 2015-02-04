<?php

class EhrlichAndreas_LotteryCms_Parser_LottoDe
{
	
	/**
	 * start page uri
	 *
	 * @var string 
	 */
	protected $domain = 'lotto.de';
	
	/**
	 * content provider
	 *
	 * @var string 
	 */
	protected $provider = 'lotto.de';
	
	/**
	 * start page uri
	 *
	 * @var string 
	 */
	protected $uriStartPage = 'http://lotto.de/';
	
	/**
	 * lottery info uri
	 *
	 * @var string 
	 */
    //protected $uriLotteryDrawPage = '/de/ergebnisse/zusatzlotterien/archiv_1/results_zusatzspiele.xhtml';
    protected $uriLotteryDrawPage = '/bin/6aus49_archiv';
    
	/**
	 *
	 * @var Zend_Http_Client 
	 */
	protected $httpClient = null;
	
	/**
	 * 
	 * @return Zend_Http_Client
	 */
	public function getHttpClient()
	{
		if (is_null($this->httpClient))
		{
			$config = array
			(
				'adapter'	=> 'Zend_Http_Client_Adapter_Proxy',
				'useragent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_3) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.65 Safari/537.31',
                'timeout'   => 30,
			);

			$headers = array
			(
				'Referer'			=> $this->uriStartPage,
				'Accept'			=> 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
				'Accept-Charset'	=> 'ISO-8859-1,utf-8;q=0.7,*;q=0.3',
				'Accept-Encoding'	=> 'gzip,deflate',
				'Accept-Language'	=> 'de-DE,de;q=0.8,en-US;q=0.6,en;q=0.4',
				'DNT'				=> '1',
			);

			if (function_exists('curl_exec') && is_callable('curl_exec'))
			{
				$config['adapter'] = 'Zend_Http_Client_Adapter_Curl';
			}

			$client = new Zend_Http_Client(null, $config);

			$client->setCookieJar();

			$client->setHeaders($headers);
			
			$this->httpClient = $client;
		}
		
		return $this->httpClient;
	}
    
    /**
     * 
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }
    
	/**
	 * 
	 * @param array $link
	 * @return string
	 * @throws Exception
	 */
    public function getLotteryResults($link)
    {
        $link['scheme'] = 'http';
        
        $link['host'] = $this->domain;
        
        $link['path'] = $this->uriLotteryDrawPage;
        
        if (!isset($link['query']))
        {
            $link['query'] = array();
        }
        
        $contents = $this->getLotteryResultsContents($link);
        
        $structure = $this->parseLotteryResults($contents);
        
        return $structure;
    }
    
	/**
	 * 
	 * @param array $link
	 * @return string
	 * @throws Exception
	 */
    public function getLotteryResultsContents($link)
    {
		$client = $this->getHttpClient();
		
		$client->resetParameters();
		
		$uri = $link['scheme'] . '://' . $link['host'] . $link['path'];
		
		$client->setUri($uri);
        
        if (!isset($link['query']))
        {
            $link['query'] = array();
        }
        
        /*
        if (isset($link['query']['viewstate']))
        {
            $link['query']['javax.faces.ViewState'] = $link['query']['viewstate'];
            
            $link['query']['javax.faces.ViewState'] = strval($link['query']['javax.faces.ViewState']);
            
            unset($link['query']['viewstate']);
        }
        
        if (isset($link['query']['year']))
        {
            $link['query']['j_id_4:j_id_5:jahr'] = $link['query']['year'];
            
            $link['query']['j_id_4:j_id_5:jahr'] = strval($link['query']['j_id_4:j_id_5:jahr']);
            
            unset($link['query']['year']);
        }
        
        if (isset($link['query']['day']))
        {
            if(stripos($link['query']['day'], '-') !== false)
            {
                $day = explode('-', $link['query']['day']);
                
                $day = $day[2] . '.' . $day[1] . '.' . $day[0];
                
                $link['query']['day'] = $day;
            }
            
            $link['query']['j_id_4:j_id_5:tag'] = $link['query']['day'];
            
            $link['query']['j_id_4:j_id_5:tag'] = strval($link['query']['j_id_4:j_id_5:tag']);
            
            unset($link['query']['day']);
        }
        
        
        $javax_faces_source = true;
        
        $javax_faces_source = $javax_faces_source && isset($link['query']['j_id_4:j_id_5:jahr']);
        
        $javax_faces_source = $javax_faces_source && isset($link['query']['j_id_4:j_id_5:tag']);
            
        if ($javax_faces_source)
        {
            if (stripos($link['query']['j_id_4:j_id_5:tag'], $link['query']['j_id_4:j_id_5:jahr']) === false)
            {
                $link['query']['javax.faces.source'] = 'j_id_4:j_id_5:jahr';
            }
            else
            {
                $link['query']['javax.faces.source'] = 'j_id_4:j_id_5:tag';  
            }
        }
        
        if (count($link['query']) > 0)
        {
            $link['query']['j_id_4:j_id_5_SUBMIT'] = '1';
            
            $link['query']['javax.faces.behavior.event'] = 'change';
            
            $link['query']['javax.faces.partial.event'] = 'change';
            
            $link['query']['javax.faces.partial.ajax'] = 'true';
            
            $link['query']['javax.faces.partial.execute'] = $link['query']['javax.faces.source'];
            
            $link['query']['javax.faces.partial.execute'] .= ' @this';
            
            $link['query']['javax.faces.partial.render'] = 'j_id_4:j_id_5';
            
            $link['query']['j_id_4:j_id_5'] = 'j_id_4:j_id_5';
        }
        
        if (isset($link['query']['j_id_4:j_id_5:jahr']))
        {
            $link['query']['year'] = $link['query']['j_id_4:j_id_5:jahr'];
        }
        
        if (isset($link['query']['j_id_4:j_id_5:tag']))
        {
            $link['query']['drawday'] = $link['query']['j_id_4:j_id_5:tag'];

            $day = explode('.', $link['query']['drawday']);
            
            $day = $day[2] . '-' . $day[1] . '-' . $day[0];
            
            $link['query']['drawday'] = $day;
        }
         * 
         */    
        
        if (count($link['query']) > 0)
        {
            $orderQueryKeys = array
            (
                'year',
                'drawday',
                #'j_id_4:j_id_5:jahr',
                #'j_id_4:j_id_5:tag',
                #'j_id_4:j_id_5_SUBMIT',
                #'javax.faces.ViewState',
                #'javax.faces.behavior.event',
                #'javax.faces.partial.event',
                #'javax.faces.source',
                #'javax.faces.partial.ajax',
                #'javax.faces.partial.execute',
                #'javax.faces.partial.render',
                #'j_id_4:j_id_5',
            );

            $queryTmp = array();

            foreach ($orderQueryKeys as $name)
            {
                if (isset($link['query'][$name]))
                {
                    $queryTmp[$name] = $link['query'][$name];
                }
            }

            $link['query'] = $queryTmp;

            foreach ($link['query'] as $name => $value)
            {
                $client->setParameterGet($name, $value);
            }
            
            #$client->setRawData(http_build_query($link['query']), 'application/x-www-form-urlencoded; charset=UTF-8');
        
            $client->setMethod(Zend_Http_Client::POST);
            
            $headers = array
            (
                'Faces-Request' => 'partial/ajax',
                'Origin'        => 'http://' . $this->domain,
                'Accept'        => '*/*',
                'DNT'           => '1',
                'Referer'       => $uri,
                'Content-Type'  => 'application/x-www-form-urlencoded; charset=UTF-8',
            );
            
            $client->setHeaders($headers);
        }
		
		$response = $client->request();
		
		if (true || $response->getStatus() == 200)
		{
			$contents = $response->getBody();
		}
		else
		{
			throw new Exception('no contents found on link "' . $uri . '?' .  http_build_query($this->uriStartPageParam).'"');
		}
		
		return $contents;
    }
    
	/**
	 * reads the draw contents, parses 
	 * its structure into an array and returns 
	 * the array
	 * 
	 * @param string $content
	 * @return array
	 * @throws Exception
	 */
    public function parseLotteryResults($content)
    {
        $content = Zend_Json::decode($content);
        
        $contentKeys = array_keys($content);
        
        $daysKey = 0;
        
        $draw_dateKey = 0;
        
        foreach ($contentKeys as $key)
        {
            if (preg_match('#^\d+#', $key))
            {
                if (stripos($key, '-'))
                {
                    $draw_dateKey = $key;
                }
                else
                {
                    $daysKey = $key;
                }
            }
        }
        
        $years = array();
        
        if (isset($content['years']))
        {
            $years = $content['years'];
        
            unset($content['years']);
        
            $years = array_combine($years, $years);
            
            krsort($years);
        }
        
        $days = array();
        
        if (isset($content[$daysKey]))
        {
            $days = $content[$daysKey];
        
            unset($content[$daysKey]);
        
            foreach ($days as $key => $value)
            {
                $days[$key] = $value['date'];
            }
        
            $days = array_combine($days, $days);
            
            krsort($days);
        }
        
        $viewstate = '';
        
        $spiel77Digits = $content[$draw_dateKey]['spiel77']['gewinnzahlen'];
        
        $super6Digits = $content[$draw_dateKey]['super6']['gewinnzahlen'];
        
        $lottoDigits = $content[$draw_dateKey]['lotto']['gewinnzahlen'];
        
        $lottoDigitsAdditional = $content[$draw_dateKey]['lotto']['superzahl'];
        
        $lottoDigitsBonus = $content[$draw_dateKey]['lotto']['zusatzzahl'];
        
        $draw_date = $content[$draw_dateKey]['date'];
        
        $year_8601 = substr($draw_date, 0, stripos($draw_date, '-'));
        
        $jackpotSpiel77 = '0.00';
        
        $jackpotSuper6 = '0.00';
        
        $jackpotLotto = '0.00';
        
        
        
        //$forms = MiniPhp_Util_Html::parseForms($content);
        
        /*
        foreach ($forms as $form)
        {
            if (isset($form['j_id_4:j_id_5:jahr']))
            {
                $years = $form['j_id_4:j_id_5:jahr'];
                
                $years = array_keys($years);
                
                $years = array_combine($years, $years);
                
                break;
            }
        }
        
        foreach ($forms as $form)
        {
            if (isset($form['j_id_4:j_id_5:tag']))
            {
                $days = $form['j_id_4:j_id_5:tag'];
                
                $days = array_keys($days);
                
                foreach ($days as $key => $value)
                {
                    $value = explode('.', $value);
                    
                    $value = $value[2] . '-' . $value[1] . '-' . $value[0];
                    
                    $days[$key] = $value;
                }
                
                $days = array_combine($days, $days);
                
                break;
            }
        }
        
        foreach ($forms as $form)
        {
            if (isset($form['javax.faces.ViewState']))
            {
                $viewstate = $form['javax.faces.ViewState'];
            }
        }
        
        $posBegin = stripos($content, 'id="javax.faces.ViewState">');
        
        if ($posBegin !== false)
        {
            $posEnd = stripos($content, '</', $posBegin);
            
            $posBegin = stripos($content, '>', $posBegin) + 1;
            
            $viewstate = substr($content, $posBegin, $posEnd - $posBegin);
            
            $viewstate = substr($viewstate, strlen('<![CDATA['));
            
            $posEnd = stripos($viewstate, ']]>');
            
            $viewstate = substr($viewstate, 0, $posEnd);
        }
        
        $posBegin = stripos($content, 'field_spiel77');
        
        if ($posBegin !== false)
        {
            $posEnd = stripos($content, '</', $posBegin);
            
            $posBegin = stripos($content, '>', $posBegin);
            
            $spiel77 = substr($content, $posBegin, $posEnd - $posBegin);
            
            $spiel77 = preg_replace('#[^\d]#', '', $spiel77);
        }
        
        $posBegin = stripos($content, 'field_super6');
        
        if ($posBegin !== false)
        {
            $posEnd = stripos($content, '</', $posBegin);
            
            $posBegin = stripos($content, '>', $posBegin);
            
            $super6 = substr($content, $posBegin, $posEnd - $posBegin);
            
            $super6 = preg_replace('#[^\d]#', '', $super6);
        }
        
        $posBegin = stripos($content, 'id="j_id_4:j_id_5:tag"');
        
        if ($posBegin !== false)
        {
            $posEnd = stripos($content, '</select', $posBegin);
            
            $draw_date = substr($content, $posBegin, $posEnd - $posBegin);
            
            $draw_date = '<select ' . $draw_date . '</select>';
            
            $draw_date = MiniPhp_Util_Xml::parseXml($draw_date);
            
            $draw_date = $draw_date['option'];
            
            $dayTmp = '';
            
            if (count($draw_date) > 0)
            {
                $dayTmp = $draw_date[0]['value'];
                
                foreach ($draw_date as $value)
                {
                    if (isset($value['selected']))
                    {
                        $dayTmp = $value['value'];
                        
                        break;
                    }
                }
            }
            
            $draw_date = $dayTmp;
            
            $draw_date = explode(' ', $draw_date);
            
            $draw_date = array_pop($draw_date);
            
            $draw_date = explode('.', $draw_date);

            $draw_date = $draw_date[2] . '-' . $draw_date[1] . '-' . $draw_date[0];
        }
        
        $posBegin = stripos($content, 'id="j_id_4:j_id_5:jahr"');
        
        if ($posBegin !== false)
        {
            $posEnd = stripos($content, '</select', $posBegin);
            
            $year_8601 = substr($content, $posBegin, $posEnd - $posBegin);
            
            $year_8601 = '<select ' . $year_8601 . '</select>';
            
            $year_8601 = MiniPhp_Util_Xml::parseXml($year_8601);
            
            $year_8601 = $year_8601['option'];
            
            $yearTmp = '';
            
            if (count($year_8601) > 0)
            {
                $yearTmp = $year_8601[0]['value'];
                
                foreach ($year_8601 as $value)
                {
                    if (isset($value['selected']))
                    {
                        $yearTmp = $value['value'];
                        
                        break;
                    }
                }
            }
            
            $year_8601 = $yearTmp;
        }
        
        $posBegin = stripos($content, 'Spieleinsatz:');
        
        if ($posBegin !== false)
        {
            $posEnd = stripos($content, '</', $posBegin);
            
            $jackpotSpiel77 = substr($content, $posBegin, $posEnd - $posBegin);
            
            $jackpotSpiel77 = explode(' ', $jackpotSpiel77);
            
            $jackpotSpiel77 = $jackpotSpiel77[1];
            
            $jackpotSpiel77 = str_replace('.', '', $jackpotSpiel77);
            
            $jackpotSpiel77 = str_replace(',', '.', $jackpotSpiel77);
            
            $jackpotSpiel77 = preg_replace('#[^\d\.]#', '', $jackpotSpiel77);
            
            if (empty($jackpotSpiel77))
            {
                $jackpotSpiel77 = 0;
            }
            
            $jackpotSpiel77 = floatval($jackpotSpiel77);
            
            $jackpotSpiel77 = number_format($jackpotSpiel77, 2, '.', '');
        }
        
        if ($jackpotSpiel77 != '0.00')
        {
            $posBegin = stripos($content, 'Spieleinsatz:', $posEnd);
        }
        
        if ($posBegin !== false)
        {
            $posEnd = stripos($content, '</', $posBegin);
            
            $jackpotSuper6 = substr($content, $posBegin, $posEnd - $posBegin);
            
            $jackpotSuper6 = explode(' ', $jackpotSuper6);
            
            $jackpotSuper6 = $jackpotSuper6[1];
            
            $jackpotSuper6 = str_replace('.', '', $jackpotSuper6);
            
            $jackpotSuper6 = str_replace(',', '.', $jackpotSuper6);
            
            $jackpotSuper6 = preg_replace('#[^\d\.]#', '', $jackpotSuper6);
            
            if (empty($jackpotSuper6))
            {
                $jackpotSuper6 = 0;
            }
            
            $jackpotSuper6 = floatval($jackpotSuper6);
            
            $jackpotSuper6 = number_format($jackpotSuper6, 2, '.', '');
        }*/
        
        $spiel77 = array
        (
            'lottery_name'          => 'spiel77',
            'provider'              => $this->provider,
            'provider_lottery_id'   => 'spiel77',
            'provider_lottery_name' => 'Spiel 77',
            'digits'                => $spiel77Digits,
            'digits_additional'     => '',
            'digits_bonus'          => '',
            'date_draw'             => $draw_date,
            'year_8601'             => $year_8601,
            'amount'                => '0.00',
            'payout'                => array(),
        );
        
        $super6 = array
        (
            'lottery_name'          => 'super6',
            'provider'              => $this->provider,
            'provider_lottery_id'   => 'super6',
            'provider_lottery_name' => 'Super 6',
            'digits'                => $super6Digits,
            'digits_additional'     => '',
            'digits_bonus'          => '',
            'date_draw'             => $draw_date,
            'year_8601'             => $year_8601,
            'amount'                => '0.00',
            'payout'                => array(),
        );
        
        $lotto = array
        (
            'lottery_name'          => 'lotto',
            'provider'              => $this->provider,
            'provider_lottery_id'   => 'lotto',
            'provider_lottery_name' => 'Lotto',
            'digits'                => $lottoDigits,
            'digits_additional'     => $lottoDigitsAdditional,
            'digits_bonus'          => $lottoDigitsBonus,
            'date_draw'             => $draw_date,
            'year_8601'             => $year_8601,
            'amount'                => '0.00',
            'payout'                => array(),
        );
        
        if (is_array($lotto['digits']))
        {
            $lotto['digits'] = implode(' ', $lotto['digits']);
        }
        
        $keys = array
        (
            'lotto',
            'spiel77',
            'super6',
        );
        
        #echo '<pre>';
        #print_r($content);
        
        $return = array
        (
            'additional' => array
            (
                'years'     => $years,
                'drawdays'  => $days,
                'viewstate' => $viewstate,
            ),
            'lottery' => array
            (
                'lotto'     => $lotto,
                'spiel77'   => $spiel77,
                'super6'    => $super6,
            ),
        );
        
        foreach ($keys as $key)
        {
            $currency = $content[$draw_dateKey][$key]['waehrung'];

            $spieleinsatz = $content[$draw_dateKey][$key]['spieleinsatz'];
                
            $return['lottery'][$key]['amount'] = $spieleinsatz;

            $return['lottery'][$key]['currency'] = $currency;
            
            foreach ($return['lottery'][$key] as $k => $v)
            {
                if (is_null($v))
                {
                    $return['lottery'][$key][$k] = '';
                }
            }
            
            
            if (!isset($content[$draw_dateKey][$key]['quoten']))
            {
                continue;
            }
            
            foreach ($content[$draw_dateKey][$key]['quoten'] as $quote)
            {
                $hits = $quote['kurzbeschreibung'];
                
                $hits = explode('+', $hits);
                
                foreach ($hits as $k => $hit)
                {
                    $hit = trim($hit);
                    
                    if (preg_match('#\d#', $hit) && !is_int($hit))
                    {
                        $hit = preg_replace('#[^\d]#', '', $hit);
                    }
                    
                    $hits[$k] = $hit;
                }
                
                $payout = array
                (
                    'rank'          => $quote['klasse'],
                    'amount'        => $quote['quote'],
                    'winners'       => $quote['anzahl'],
                    'hits'          => $hits[0],
                    'additional'    => '',
                    'currency'      => $currency,
                );
                
                if (isset($hits[1]))
                {
                    $payout['additional'] = $hits[1];
                }
                
                #$return['additional'][$key]['payout'][] = $payout;
                
                $return['lottery'][$key]['payout'][] = $payout;
            }
        }
        
        return $return;
    }
}