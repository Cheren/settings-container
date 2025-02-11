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

use App\Containers\AppSection\User\Models\User;
use App\Containers\Vendor\Setting\Facades\Container;
use App\Containers\Vendor\Setting\Foundation\Setting;
use App\Containers\Vendor\Setting\Models\Setting as SettingModel;
use App\Containers\Vendor\Setting\Tests\Functional\ApiTestCase;

final class DeleteSettingTest extends ApiTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->endpoint = 'delete@v1/' . Container::getApiUri('{' . Setting::KEY . '}');
    }

    public function testOwnerSettings(): void
    {
        $user = $this->getTestingUser();

        $setting = SettingModel::factory()
            ->create([
                Setting::KEY => 'items',
                Setting::VALUE => '10',
                CREATED_BY => $user
            ]);

        $this
            ->injectId($setting->key)
            ->makeCall();

        $this->response->assertNoContent();

        $this->assertDatabaseMissing(SettingModel::TABLE, [
            Setting::KEY => $setting->key
        ]);
    }

    public function testNotOwnerSettings(): void
    {
        $user = User::factory()->create();

        $setting = SettingModel::factory()
            ->create([
                Setting::KEY => 'offer',
                Setting::VALUE => 'same',
                CREATED_BY => $user->id
            ]);

        $this
            ->injectId($setting->key)
            ->makeCall();

        $this->assertActionIsUnauthorized();
    }

    public function testNotOwnerSettingsForAdmin(): void
    {
        $user = User::factory()->create();

        $this->getTestingUser(null, null, true);

        $setting = SettingModel::factory()
            ->create([
                Setting::KEY => 'current',
                Setting::VALUE => '15',
                CREATED_BY => $user->id
            ]);

        $this
            ->injectId($setting->key)
            ->makeCall();

        $this->response->assertNoContent();

        $this->assertDatabaseMissing(SettingModel::TABLE, [
            Setting::KEY => $setting->key
        ]);
    }

    public function injectId($id, $skipEncoding = true, $replace = '{key}'): static
    {
        return parent::injectId($id, $skipEncoding, $replace);
    }
}
