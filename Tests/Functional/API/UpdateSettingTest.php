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
use Illuminate\Testing\Fluent\AssertableJson;

final class UpdateSettingTest extends ApiTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->endpoint = 'patch@v1/' . Container::getApiUri();
    }

    public function testOwnerSettings(): void
    {
        $user = $this->getTestingUser();

        $setting = SettingModel::factory()
            ->createdBy($user)
            ->create([
                Setting::KEY => 'total',
                Setting::VALUE => '10'
            ]);

        $data = [
            Setting::KEY => $setting->key,
            Setting::VALUE => '16'
        ];

        $this->makeCall($data);

        $this->response->assertCreated();

        $this->response->assertJson(
            fn (AssertableJson $json): AssertableJson => $json
                ->has('data')
                ->where('data.' . Setting::KEY, $data[Setting::KEY])
                ->where('data.' . Setting::VALUE, $data[Setting::VALUE])
                ->etc()
        );
    }

    public function testNotOwnerSettings(): void
    {
        $user = User::factory()->create();

        $setting = SettingModel::factory()
            ->createdBy($user)
            ->create([
                Setting::KEY => 'total',
                Setting::VALUE => '22'
            ]);

        $this->makeCall([
            Setting::KEY => $setting->key,
            Setting::VALUE => '20'
        ]);

        $this->assertActionIsUnauthorized();
    }

    public function testNotOwnerSettingsForAdmin(): void
    {
        $user = User::factory()->create();

        $this->getTestingUser(null, null, true);

        $setting = SettingModel::factory()
            ->createdBy($user)
            ->create([
                Setting::KEY => 'total',
                Setting::VALUE => '15'
            ]);

        $data = [
            Setting::KEY => $setting->key,
            Setting::VALUE => '26'
        ];

        $this->makeCall($data);

        $this->response->assertCreated();

        $this->response->assertJson(
            fn (AssertableJson $json): AssertableJson => $json
                ->has('data')
                ->where('data.' . Setting::KEY, $data[Setting::KEY])
                ->where('data.' . Setting::VALUE, $data[Setting::VALUE])
                ->etc()
        );
    }
}
