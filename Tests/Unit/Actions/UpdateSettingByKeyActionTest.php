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

namespace App\Containers\Vendor\Settings\Tests\Unit\Actions;

use App\Containers\Vendor\Settings\Actions\UpdateSettingByKeyAction;
use App\Containers\Vendor\Settings\Dto\SettingsDto;
use App\Containers\Vendor\Settings\Models\Setting;
use App\Containers\Vendor\Settings\Tests\TestCase;
use App\Ship\Exceptions\NotFoundException;

class UpdateSettingByKeyActionTest extends TestCase
{
    public function testSuccessUpdate(): void
    {
        $settings = Setting::factory()->create([
            'key' => 'user.1.items',
            'value' => [
                'total' => 10
            ],
            'type' => Setting::TYPE_DATA
        ]);

        $dto = new SettingsDto([
            'key' => $settings->key,
            'value' => [
                'total' => 22
            ]
        ]);

        $result = app(UpdateSettingByKeyAction::class)->run($dto);
        $this->assertInstanceOf(Setting::class, $result);
        $this->assertSame(22, (int) $result->value->get('total'));
    }

    public function testInvalidUpdate(): void
    {
        $this->expectException(NotFoundException::class);

        $dto = new SettingsDto([
            'key' => 'page',
            'value' => 10
        ]);

        app(UpdateSettingByKeyAction::class)->run($dto);
    }
}
