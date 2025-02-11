<?php

/**
 * APIATO setting container.
 *
 * This file is part of the APIATO setting container.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    Proprietary
 * @copyright  Copyright (C) kalistratov.ru, All rights reserved.
 * @link       https://kalistratov.ru
 */

namespace App\Containers\Vendor\Setting\Tests\Functional\API;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\Vendor\Setting\Facades\Container;
use App\Containers\Vendor\Setting\Tests\Functional\ApiTestCase;

final class GetSystemSettingsTest extends ApiTestCase
{
    protected array $access = [
        ROLES => [
            Role::ADMIN
        ]
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->endpoint = 'get@v1/' . Container::getApiSystemUri();
    }

    public function test(): void
    {
        $this->makeCall();
        $this->response->assertOk();
    }
}
