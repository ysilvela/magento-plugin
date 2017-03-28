<?php

class Mage_Eligebtc_Block_Callback extends Mage_Core_Block_Abstract
{
    protected function _toHtml()
    {
        $eligebtc = Mage::getModel('eligebtc/EligebtcFactory');

        return $eligebtc->validateCallback();
    }
}
