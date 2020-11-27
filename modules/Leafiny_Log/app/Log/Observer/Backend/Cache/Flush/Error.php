<?php

declare(strict_types=1);

/**
 * Class Log_Observer_Backend_Cache_Flush_Error
 */
class Log_Observer_Backend_Cache_Flush_Error extends Core_Observer_Abstract
{
    /**
     * Execute
     *
     * @param Core_Page|Leafiny_Object $object
     *
     * @return void
     * @throws Exception
     */
    public function execute(Leafiny_Object $object): void
    {
        /** @var string $type */
        $type = $object->getData('type');
        /** @var string $type */
        $error = $object->getData('error');
        /** @var Log_Model_Db $log */
        $log = App::getObject('model', 'log_db');

        $log->add('Error deleting cache for ' . $type . ': ' . $error, Log_Model_Log_Interface::ERR);
    }
}