<?php

/**
 * ERP system
 *
 * This file is part of the ERM system package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license     https://kalistratov.ru/licenses/erp Proprietary license
 * @copyright   Copyright (C) kalistratov.ru, All rights reserved ©.
 * @link        https://kalistratov.ru
 * @author      Sergey Kalistratov <sergey@kalistratov.ru>
 */

namespace App\Containers\Vendor\Settings\UI\API\Tests\Functional;

use App\Containers\AppSection\Authorization\Models\Role;
use App\Containers\Vendor\Settings\Tests\ApiTestCase;
use Illuminate\Http\Response;

class GetSystemSettingsTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/settings/system';

    protected array $access = [
        'roles' => [
            Role::ADMIN
        ]
    ];

    public function test(): void
    {
        $response = $this->makeCall();
        $response->assertStatus(Response::HTTP_OK);
    }
}
