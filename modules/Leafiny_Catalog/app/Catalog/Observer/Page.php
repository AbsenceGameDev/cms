<?php
/**
 * This file is part of Leafiny.
 *
 * Copyright (C) Magentix SARL
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

/**
 * Class Catalog_Observer_Page
 */
class Catalog_Observer_Page extends Core_Event implements Core_Interface_Event
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
        /** @var Core_Page $page */
        $page = $object->getData('object');

        if ($page->getObjectIdentifier() !== '/category/*.html') {
            return;
        }

        /** @var Category_Model_Category $category */
        $category = $page->getCustom('category');

        if (!$category) {
            return;
        }

        /** @var string $pageNumber */
        $pageNumber = $page->getObjectParams()->getData(Catalog_Helper_Data::URL_PARAM_PAGE);

        if (!$pageNumber) {
            return;
        }

        if ((int)$pageNumber === 1) {
            $page->error(true);
        }

        /** @var Catalog_Helper_Data $helper */
        $helper = App::getSingleton('helper', 'catalog_product');

        $products = $helper->getCategoryProducts($category->getData('category_id'), (int)$pageNumber);

        if (empty($products)) {
            $page->error(true);
            return;
        }

        if ($page->getCustom('canonical')) {
            $page->setCustom(
                'canonical',
                $page->getCustom('canonical') . '?' . Catalog_Helper_Data::URL_PARAM_PAGE . '=' . $pageNumber
            );
        }
        $page->setCustom(
            'meta_title',
            $page->getCustom('meta_title') . ' - ' . App::translate('Page') . ' ' . $pageNumber
        );
    }
}
