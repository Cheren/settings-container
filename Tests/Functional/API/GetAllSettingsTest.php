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
use App\Containers\Vendor\Setting\Models\Setting;
use App\Containers\Vendor\Setting\Tests\Functional\ApiTestCase;
use Illuminate\Testing\Fluent\AssertableJson;

final class GetAllSettingsTest extends ApiTestCase
{
    protected string $endpoint = 'get@v1/settings';

    public function setUp(): void
    {
        parent::setUp();
        $this->endpoint = 'get@v1/' . Container::getApiUri();
    }

    public function testSuccess(): void
    {
        $baseCount = Setting::count();

        $settings = Setting::factory()
            ->count(5)
            ->create();

        $this->makeCall();

        $this->response->assertOk();

        $this->response->assertJson(
            fn (AssertableJson $json): AssertableJson => $json
                ->has('meta')
                ->where('meta.pagination.total', $baseCount + $settings->count())
                ->etc()
        );
    }
}
