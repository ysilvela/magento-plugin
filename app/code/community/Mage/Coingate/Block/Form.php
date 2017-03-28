<?php

class Mage_Eligebtc_Block_Form extends Mage_Payment_Block_Form
{
    protected function _construct()
    {
        $this->setTemplate('eligebtc/form.phtml');

        parent::_construct();
    }
}
