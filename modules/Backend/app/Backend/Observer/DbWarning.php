<?php

declare(strict_types=1);

/**
 * Class Backend_Observer_DbWarning
 */
class Backend_Observer_DbWarning extends Core_Event
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
        /** @var Core_Model $model */
        $model = App::getObject('model');

        if ($model->isNoWriting() && !empty($_POST)) {
            /** @var Backend_Page_Admin_Page_Abstract $page */
            $page = $object->getData('object');

            $page->setWarningMessage(
                App::translate('Database writing statements are disabled')
            );
        }
    }
}
