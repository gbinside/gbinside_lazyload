<?php

class Gbinside_Lazyload_Block_Adminhtml_Handles extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
    protected function _prepareToRender()
    {
        $this->addColumn(
            'handle',
            array(
                'label' => Mage::helper('gblazyload')->__('Handle Code'),
                'style' => 'width:175px;',
            )
        );
        $this->_addAfter = false;
        $this->_addButtonLabel = Mage::helper('gblazyload')->__('Add Hanlde');
    }


}