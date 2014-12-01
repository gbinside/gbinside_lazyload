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
        #http://spiffygif.com/gif?rotate=29&color=000000&corners=0.7&lines=9&trail=52&length=9&radius=11&shadow=true&width=5&halo=true&bgColor=992599
        $params = array();
        foreach (array('rotate','lines','length','width','radius','corners','trail','rotate','bgColor','color','shadow','halo') as $p) {
            $params[] = $p . "='+\$F('gblazyload_" . $p . "')+'";
        }
        $gifurl = 'http:\\/\\/spiffygif.com\\/gif?' . implode('&', $params);

        $preview = $this->getLayout()->createBlock('adminhtml/widget_button')
            ->setData(array(
                'id' => 'gblazyload_button_preview',
                'label' => $this->helper('gblazyload')->__('Preview'),
                //'onclick' => 'javascript:new Ajax.Request(\'http://spiffygif.com/gif\', { onSuccess: function(response) { alert(response.statusText); } } ); return false;'
                'onclick' => "javascript:
                new Ajax.Request('" . $gifurl . "', { onSuccess: function(response) { } } );
                $('gblazyload_system_config_image').setAttribute('src', '" . $gifurl . "') ;
                return false;"
//                'onclick' => "javascript: alert( '" . $gifurl . "') ; return false;"
            ));

        return
            '<img id="gblazyload_system_config_image" src="' . Mage::getDesign()->getSkinUrl('images/gblazyload/ajax-loader.gif', array('_area'=>'frontend')) . '" />' .
            '<br />'.
            'length (0-45): <input id="gblazyload_length" name="gblazyload_length" value="0" class="gblazyload_rotator"/>'.
            '<br />'.
            'width (1-15): <input id="gblazyload_width" name="gblazyload_width" value="1" class="gblazyload_rotator"/>'.
            '<br />'.
            'radius (0-27): <input id="gblazyload_radius" name="gblazyload_radius" value="8" class="gblazyload_rotator"/>'.
            '<br />'.
            'Lines (1-16): <input id="gblazyload_lines" name="gblazyload_lines" value="1" class="gblazyload_rotator"/>'.
            '<br />'.
            'Corners (0.0-1.0): <input id="gblazyload_corners" name="gblazyload_corners" value="0.0" class="gblazyload_rotator"/>'.
            '<br />'.
            'Trail (10-100): <input id="gblazyload_trail" name="gblazyload_trail" value="10" class="gblazyload_rotator"/>'.
            '<br />'.
            'Rotate (0-90): <input id="gblazyload_rotate" name="gblazyload_rotate" value="0" class="gblazyload_rotator"/>'.
            '<br />'.
            'Background color: <input id="gblazyload_bgColor" name="gblazyload_bgColor" value="FFFFFF" class="gblazyload_rotator"/>'.
            '<br />'.
            'Foreground color: <input id="gblazyload_color" name="gblazyload_color" value="000000" class="gblazyload_rotator"/>'.
            '<br />'.
            //print_r($this->_element->debug(), true) .
            'Shadow: <input type="checkbox" value="1" id="gblazyload_shadow" name="gblazyload_shadow" class="gblazyload_rotator"/>'.
            '<br />'.
            'Halo: <input type="checkbox" value="1" id="gblazyload_halo" name="gblazyload_halo" class="gblazyload_rotator"/>'.
            '<br />'.
            $preview->toHtml();
    }
} 