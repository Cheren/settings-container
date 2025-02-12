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

use App\Containers\Vendor\Setting\Facades\Container;
use App\Containers\Vendor\Setting\Foundation\Setting;
use App\Containers\Vendor\Setting\Models\Setting as SettingModel;
use App\Containers\Vendor\Setting\Tests\Functional\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;

final class CreateSettingTest extends ApiTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->endpoint = 'post@v1/' . Container::getApiUri();
    }

    public function testWithInvalidType(): void
    {
        $this->makeCall([
            Setting::KEY => 'users',
            Setting::VALUE => 'test',
            Setting::TYPE => 'no-found'
        ]);

        $this->assertGivenDataWasInvalid();

        $this->response->assertJson(
            fn (AssertableJson $json): AssertableJson => $json
                ->has('errors')
                ->where('errors.' . Setting::TYPE, [
                    'The selected type is invalid.'
                ])
                ->etc()
        );
    }

    public function testSuccess(): void
    {
        $data = [
            Setting::KEY => 'users',
            Setting::VALUE => [
                'page' => 10
            ],
            Setting::TYPE => 'data'
        ];

        $this->makeCall($data);

        $this->response->assertOk();

        $this->response->assertJson(
            fn (AssertableJson $json): AssertableJson => $json
                ->has('data')
                ->where('data.' . OBJECT, SettingModel::RESOURCE_KEY)
                ->where('data.' . Setting::KEY, $data[Setting::KEY])
                ->where('data.' . Setting::VALUE, $data[Setting::VALUE])
                ->etc()
        );
    }
}
