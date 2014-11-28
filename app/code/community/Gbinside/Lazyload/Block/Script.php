<?php

/**
 * Created by PhpStorm.
 * User: roberto
 * Date: 28/11/2014
 * Time: 14:19
 */
class Gbinside_Lazyload_Block_Script extends Mage_Core_Block_Abstract
{
    protected function _toHtml()
    {
        $helper = Mage::helper('gblazyload');

        if (!$helper->isEnabled()) {
            return '';
        }

        $secureHeight = $helper->getSecureHeight();
        return <<<SCRIPT
<script type="text/javascript">
//<![CDATA[

function gblazyload() {
    var secureHeight = {$secureHeight}
    $$('img[src$="gblazyload/ajax-loader.gif"]').each( function(x) {
        var scrollTop = document.viewport.getScrollOffsets()['top'];
        var height = document.viewport.getHeight();
        if (scrollTop + height + secureHeight > x.cumulativeOffset()[1]) {
            Element.writeAttribute(x, 'src', Element.readAttribute(x, 'data-gblazyload'));
        }
    });
}

document.observe("dom:loaded", gblazyload);
Event.observe(window, 'scroll', gblazyload);
Event.observe(window, 'resize', gblazyload);

//]]>
</script>
SCRIPT;
    }

} 