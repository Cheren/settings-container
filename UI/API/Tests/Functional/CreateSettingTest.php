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
use App\Containers\Vendor\Settings\Tests\ApiTestCase;
use Illuminate\Http\Response;

class CreateSettingTest extends ApiTestCase
{
    protected string $endpoint = 'post@v1/settings';

    protected array $access = [
        'roles' => [
            'admin'
        ],
        'permissions' => SettingsPermissions::MANAGE_SETTINGS
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

    public function testWithInvalidType(): void
    {
        $this->getTestingUser();

        $response = $this->makeCall([
            'key' => 'users',
            'value' => 'test',
            'type' => 'no-found'
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertResponseContainKeyValue([
            'message' => __('ship::exception.message.given_data_was_invalid')
        ]);

        $this->assertValidationErrorContain([
            'type' => 'The selected type is invalid.'
        ]);
    }

    public function testSuccess(): void
    {
        $this->getTestingUser();

        $response = $this->makeCall([
            'key' => 'users',
            'value' => [
                'page' => 10
            ],
            'type' => 'data'
        ]);

        $response->assertStatus(Response::HTTP_OK);

        $this->assertResponseContainKeyValue([
            'object' => 'Setting',
            'key' => 'users',
            'value' => (object) ['page' => 10]
        ]);
    }
}
