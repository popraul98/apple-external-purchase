<?php
declare(strict_types=1);

namespace Readdle\AppStoreServerAPI;

final class Environment
{
    /**
     * Indicates that the data/notification applies to the production environment.
     *
     * @var string
     */
    const PRODUCTION = 'Production';

    /**
     * Indicates that the data/notification applies to testing in the sandbox environment.
     *
     * @var string
     */
    const SANDBOX = 'Sandbox';

    /**
     * Indicates that the data/notification applies to the production environment.
     *
     * @var string
     */
    const PRODUCTION_EXTERNAL = 'Production_external';

    /**
     * Indicates that the data/notification applies to testing in the sandbox environment.
     *
     * @var string
     */
    const SANDBOX_EXTERNAL = 'Sandbox_external';
}
