<?php 

/**
 * 
 * @author Ehrlich, Andreas <ehrlich.andreas@googlemail.com>
 */
class EhrlichAndreas_LotteryCms_ModuleExtended extends EhrlichAndreas_LotteryCms_Module
{
    
    /**
     * 
     * @param array $provider
     * @return array
     */
    public function addReturnProvider($provider)
    {
        if (empty($provider))
        {
            return false;
        }

        if (!is_array($provider))
        {
            $providers = array($provider);
        }
        else
        {
            $providers = $provider;
        }
        
        $db = $this->getConnection();

        $providers = array_values($providers);

        $providers = array_combine($providers, $providers);

        $param = array
        (
            'cols'  => array
            (
                'provider_id'   => 'provider_id',
                'provider'      => 'provider',
            ),
            'where' => array
            (
                'provider'  => $providers,
            ),
        );

        $rowset = $this->getProviderList($param);

        $provider_ids = array();

        foreach ($rowset as $row) 
        {
            $provider_ids[$row['provider_id']] = $row['provider_id'];
        }

        if (count($rowset) == count($providers))
        {
            return $provider_ids;
        }

        $providers_tmp = array();

        foreach ($rowset as $row)
        {
            $providers_tmp[$row['provider']] = $row['provider'];
        }

        foreach ($providers as $provider)
        {
            if (!isset($providers_tmp[$provider]))
            {
                $param = array
                (
                    'provider'  => $provider,
                );

                $this->addProvider($param);
            }
        }
        
        return $this->addReturnProvider($providers);
    }
    
    /**
     * 
     * @param array $provider
     * @return array
     */
    public function addReturnLottery($provider, $lotteryName)
    {
        $providerIds = $this->addReturnProvider($provider);
        
        if (empty($providerIds))
        {
            return false;
        }
        
        if (empty($lotteryName))
        {
            return false;
        }

        if (!is_array($lotteryName))
        {
            $lotteryNames = array($lotteryName);
        }
        else
        {
            $lotteryNames = $lotteryName;
        }

        if (!is_array($provider))
        {
            $providers = array($provider);
        }
        else
        {
            $providers = $provider;
        }
        
        $provider = array_shift($providers);
        
        $provider_id = array_shift($providerIds);
        
        $db = $this->getConnection();

        $lotteryNames = array_values($lotteryNames);

        $lotteryNames = array_combine($lotteryNames, $lotteryNames);

        $param = array
        (
            'cols'  => array
            (
                'lottery_id'    => 'lottery_id',
                'provider_id'   => 'provider_id',
                'provider'      => 'provider',
                'lottery_name'  => 'lottery_name',
            ),
            'where' => array
            (
                'provider_id'   => $provider_id,
                'lottery_name'  => $lotteryNames,
            ),
        );

        $rowset = $this->getLotteryList($param);

        $lottery_ids = array();

        foreach ($rowset as $row) 
        {
            $lottery_ids[$row['lottery_id']] = $row['lottery_id'];
        }

        if (count($rowset) == count($lotteryNames))
        {
            return $lottery_ids;
        }

        $lotteryNames_tmp = array();

        foreach ($rowset as $row)
        {
            $lotteryNames_tmp[$row['lottery_name']] = $row['lottery_name'];
        }

        foreach ($lotteryNames as $lotteryName)
        {
            if (!isset($lotteryNames_tmp[$lotteryName]))
            {
                $param = array
                (
                    'provider_id'   => $provider_id,
                    'provider'      => $provider,
                    'lottery_name'  => $lotteryName,
                );

                $this->addLottery($param);
            }
        }
        
        return $this->addReturnLottery($provider, $lotteryNames);
    }
}