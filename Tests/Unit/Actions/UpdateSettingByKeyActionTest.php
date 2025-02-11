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

namespace App\Containers\Vendor\Setting\Tests\Unit\Actions;

use App\Containers\Vendor\Setting\Actions\UpdateSettingByKeyAction;
use App\Containers\Vendor\Setting\Dto\SettingsDto;
use App\Containers\Vendor\Setting\Foundation\Setting;
use App\Containers\Vendor\Setting\Models\Setting as SettingModel;
use App\Containers\Vendor\Setting\Tests\UnitTestCase;
use App\Ship\Exceptions\NotFoundException;

final class UpdateSettingByKeyActionTest extends UnitTestCase
{
    public function testSuccessUpdate(): void
    {
        $settings = SettingModel::factory()->create([
            Setting::KEY => 'user.1.items',
            Setting::VALUE => [
                'total' => 10
            ],
            Setting::TYPE => SettingModel::TYPE_DATA
        ]);

        $dto = new SettingsDto([
            Setting::KEY => $settings->key,
            Setting::VALUE => [
                'total' => 22
            ],
            Setting::TYPE => SettingModel::TYPE_DATA
        ]);

        $result = app(UpdateSettingByKeyAction::class)->run($dto);
        $this->assertInstanceOf(SettingModel::class, $result);
        $this->assertSame(22, (int)$result->value->get('total'));
    }

    public function testInvalidUpdate(): void
    {
        $this->expectException(NotFoundException::class);

        $dto = new SettingsDto([
            Setting::KEY => 'page',
            Setting::VALUE => 10
        ]);

        app(UpdateSettingByKeyAction::class)->run($dto);
    }
}
