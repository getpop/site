<?php

declare(strict_types=1);

namespace PoP\Site;

use PoP\Root\Component\AbstractComponent;
use PoP\Root\Component\YAMLServicesTrait;
use PoP\Site\Config\ServiceConfiguration;

/**
 * Initialize component
 */
class Component extends AbstractComponent
{
    use YAMLServicesTrait;
    // const VERSION = '0.1.0';

    public static function getDependedComponentClasses(): array
    {
        return [
            \PoP\Application\Component::class,
            \PoP\Base36Definitions\Component::class,
            \PoP\ResourceLoader\Component::class,
        ];
    }

    /**
     * Initialize services
     */
    protected static function doInitialize(): void
    {
        parent::doInitialize();
        self::initYAMLServices(dirname(__DIR__));
        ServiceConfiguration::initialize();
    }
}
