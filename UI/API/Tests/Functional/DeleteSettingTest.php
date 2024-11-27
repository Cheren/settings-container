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

use Apiato\Core\Traits\TestsTraits\PhpUnit\TestsRequestHelperTrait;
use App\Containers\AppSection\User\Models\User;
use App\Containers\Vendor\Settings\Permissions\Permissions;
use App\Containers\Vendor\Settings\Models\Setting;
use App\Containers\Vendor\Settings\Tests\ApiTestCase;
use Illuminate\Http\Response;

class DeleteSettingTest extends ApiTestCase
{
    protected string $endpoint = 'delete@v1/settings/{key}';

    protected array $access = [
        'roles' => [
            'admin'
        ],
        'permissions' => Permissions::MANAGE_SETTINGS
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
        $user = $this->getTestingUser(null, [
            'roles' => [],
            'permissions' => [
                Permissions::MANAGE_SETTINGS
            ]
        ]);

        $settings = Setting::factory()->create([
            'key' => 'items',
            'value' => '10',
            'created_by' => $user
        ]);

        $response = $this->injectId($settings->key)->makeCall();
        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $this->assertDatabaseMissing(Setting::TABLE, [
            'key' => $settings->key
        ]);
    }

    public function testNotOwnerSettings(): void
    {
        $user = User::factory()->create();

        $this->getTestingUser(null, [
            'roles' => [],
            'permissions' => [
                Permissions::MANAGE_SETTINGS
            ]
        ]);

        $settings = Setting::factory()->create([
            'key' => 'offer',
            'value' => 'same',
            'created_by' => $user->id
        ]);

        $response = $this->injectId($settings->key)->makeCall();

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
            'key' => 'current',
            'value' => '15',
            'created_by' => $user->id
        ]);

        $response = $this->injectId($settings->key)->makeCall();

        $response->assertStatus(Response::HTTP_NO_CONTENT);
        $this->assertDatabaseMissing(Setting::TABLE, [
            'key' => $settings->key
        ]);
    }

    /**
     * @param $id
     * @param bool $skipEncoding
     * @param string $replace
     * @return $this|TestsRequestHelperTrait
     */
    public function injectId($id, $skipEncoding = true, $replace = '{key}'): self
    {
        return parent::injectId($id, $skipEncoding, $replace);
    }
}
