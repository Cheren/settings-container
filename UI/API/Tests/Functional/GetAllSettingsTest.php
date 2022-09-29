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

namespace App\Containers\Vendor\Settings\UI\API\Tests\Functional;

use App\Containers\Vendor\Settings\Access\SettingsPermissions;
use App\Containers\Vendor\Settings\Models\Setting;
use App\Containers\Vendor\Settings\Tests\ApiTestCase;
use Illuminate\Http\Response;

class GetAllSettingsTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/settings';

    protected array $access = [
        'roles' => [
            'admin'
        ],
        'permissions' => SettingsPermissions::CRUD
    ];

    public function testWithNoRoleAndPermissions(): void
    {
        $this->getTestingUser(null, [
            'roles' => [],
            'permissions' => []
        ]);

        $response = $this->makeCall();
        $response->assertStatus(Response::HTTP_FORBIDDEN);
        $this->assertResponseContainKeyValue([
            'message' => 'This action is unauthorized.'
        ]);
    }

    public function testSuccess(): void
    {
        $total = 10;
        Setting::factory()->count($total)->create();

        $response = $this->makeCall();
        $response->assertStatus(Response::HTTP_OK);
        $this->assertSame($total, count((array) $this->getResponseContentObject()->data));
    }
}
