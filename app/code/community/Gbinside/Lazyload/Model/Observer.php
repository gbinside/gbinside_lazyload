<?php

class Gbinside_Lazyload_Model_Observer
{
    public function httpResponseSendBefore($event)
    {
        $helper = Mage::helper('gblazyload');
        if (!$helper->isEnabled()) {
            return;
        }

        $response = $event->getResponse();
        $body = $response->getBody();
        $response->setBody(preg_replace('/(<img\b[^>]*)\bsrc\s*=\s*/','$1src="'.
            Mage::getDesign()->getSkinUrl('images/gblazyload/ajax-loader.gif')
            .'" data-gblazyload=', $body));
    }
}