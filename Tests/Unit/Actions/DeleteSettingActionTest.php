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

use App\Containers\Vendor\Setting\Actions\DeleteSettingAction;
use App\Containers\Vendor\Setting\Foundation\Setting;
use App\Containers\Vendor\Setting\Models\Setting as SettingModel;
use App\Containers\Vendor\Setting\Tests\UnitTestCase;

final class DeleteSettingActionTest extends UnitTestCase
{
    public function testSuccess(): void
    {
        $settings = SettingModel::factory()->create();

        $this->assertSame(1, app(DeleteSettingAction::class)->run($settings->key));

        $this->assertDatabaseMissing(SettingModel::TABLE, [
            Setting::KEY => $settings->key
        ]);
    }

    public function testInvalidKey(): void
    {
        $this->assertSame(ZERO, app(DeleteSettingAction::class)->run('custom-key'));
    }
}
