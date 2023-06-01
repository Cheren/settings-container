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

use App\Containers\AppSection\User\Models\User;
use App\Containers\Vendor\Settings\Access\SettingsPermissions;
use App\Containers\Vendor\Settings\Models\Setting;
use App\Containers\Vendor\Settings\Tests\ApiTestCase;
use Illuminate\Http\Response;

class UpdateSettingTest extends ApiTestCase
{
    protected string $endpoint = 'patch@v1/settings';

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

    public function testOwnerSettings(): void
    {
        $this->getTestingUser(null, [
            'roles' => [],
            'permissions' => [
                SettingsPermissions::MANAGE_SETTINGS
            ]
        ]);

        $settings = Setting::factory()->create([
            'key' => 'total',
            'value' => '10'
        ]);

        $response = $this->makeCall([
            'key' => $settings->key,
            'value' => '16'
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertResponseContainKeyValue([
            'key' => 'total',
            'value' => '16'
        ]);
    }

    public function testNotOwnerSettings(): void
    {
        $user = User::factory()->create();

        $this->getTestingUser(null, [
            'roles' => [],
            'permissions' => [
                SettingsPermissions::MANAGE_SETTINGS
            ]
        ]);

        $settings = Setting::factory()->create([
            'key' => 'total',
            'value' => '22',
            'created_by' => $user->id
        ]);

        $response = $this->makeCall([
            'key' => $settings->key,
            'value' => '20'
        ]);

        $response->assertStatus(Response::HTTP_FORBIDDEN);
        $this->assertResponseContainKeyValue([
            'message' => 'This action is unauthorized.'
        ]);
    }

    public function testNotOwnerSettingsForAdmin(): void
    {
        $user = User::factory()->create();

        $this->getTestingUser(null, null, true);

        $settings = Setting::factory()->create([
            'key' => 'total',
            'value' => '15',
            'created_by' => $user->id
        ]);

        $response = $this->makeCall([
            'key' => $settings->key,
            'value' => '26'
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertResponseContainKeyValue([
            'key' => 'total',
            'value' => '26'
        ]);
    }
}
