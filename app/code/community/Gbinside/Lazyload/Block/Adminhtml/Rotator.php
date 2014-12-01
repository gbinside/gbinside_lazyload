<?php

/**
 * Created by PhpStorm.
 * User: roberto
 * Date: 28/11/2014
 * Time: 17:33
 */
class Gbinside_Lazyload_Block_Adminhtml_Rotator extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    protected $_element;

    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $this->_element = $element;
        return $this->_toHtml();
    }

    /**
     * Return ajax url for button
     *
     * @return string
     */
    public function getAjaxCheckUrl()
    {
        return Mage::helper('adminhtml')->getUrl('*/*/check');
    }

    /**
     * Generate button html
     *
     * @return string
     */
    public function _toHtml()
    {
        $button = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setData(array(
                'id' => 'gblazyload_button',
                'label' => $this->helper('adminhtml')->__('Generate'),
                'onclick' => 'javascript:new Ajax.Request(\'http://www.ajaxload.info/cache/FF/FF/FF/00/00/00/1-0.gif\', { onSuccess: function(response) { alert(response.statusText); } } ); return false;'
            ));

        return
            '<img src="' . Mage::getDesign()->getSkinUrl('images/gblazyload/ajax-loader.gif', array('_area'=>'frontend')) . '" />' .
            '<br />'.
            'Type (1-39): <input name="type" value="1" class="gblazyload_rotator"/>'.
            '<br />'.
            'Background color: <input name="color1" value="FFFFFF" class="gblazyload_rotator"/>'.
            '<br />'.
            'Foreground color: <input name="color2" value="000000" class="gblazyload_rotator"/>'.
            '<br />'.
            //print_r($this->_element->debug(), true) .
            'Transparent background: <input type="checkbox" value="1" name="trans" class="gblazyload_rotator"/>'.
            '<br />'.
            $button->toHtml();
    }
} 