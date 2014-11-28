<?php

/**
 * Created by PhpStorm.
 * User: roberto
 * Date: 28/11/2014
 * Time: 12:20
 */
class Gbinside_Lazyload_Helper_Data extends Mage_Core_Helper_Abstract
{

    public function getSecureHeight()
    {
        return intval(Mage::getStoreConfigFlag('gblazyload/settings/secure_height'));
    }

    public function getHandles()
    {
        $ret = array();
        $a = @unserialize(Mage::getStoreConfig('gblazyload/settings/handles'));
        if ($a) {
            foreach ($a as $v) {
                $ret[] = $v['handle'];
            }
        }
        return $ret;
    }

    public function isEnabled()
    {
        $handles = $this->getHandles();
        return Mage::getStoreConfigFlag('gblazyload/settings/active') && array_intersect($handles, Mage::app()->getLayout()->getUpdate()->getHandles()) ;
    }
}