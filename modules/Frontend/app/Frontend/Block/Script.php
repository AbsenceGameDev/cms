<?php

declare(strict_types=1);

/**
 * Class Frontend_Block_Script
 */
class Frontend_Block_Script extends Core_Block
{
    /**
     * Retrieve Scripts
     *
     * @return string[]
     */
    public function getScripts(): array
    {
        $scripts = $this->getCustom('javascript');

        if (!$scripts) {
            return [];
        }

        ksort($scripts);

        return $scripts;
    }
}