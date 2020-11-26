<?php

/**
 * Class Frontend_Observer_InitSession
 */
class Frontend_Observer_InitSession extends Core_Observer_Abstract
{
    /**
     * Execute
     *
     * @param Leafiny_Object $object
     *
     * @return void
     * @throws Exception
     */
    public function execute(Leafiny_Object $object): void
    {
        /** @var Frontend_Session_Frontend $session */
        $session = App::getSingleton('session', 'frontend');
        $session->init();
    }
}