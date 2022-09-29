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

use App\Containers\Vendor\Settings\Actions\DeleteSettingAction;
use App\Containers\Vendor\Settings\Models\Setting;
use App\Containers\Vendor\Settings\Tests\TestCase;

class DeleteSettingActionTest extends TestCase
{
    public function testSuccess(): void
    {
        $settings = Setting::factory()->create();
        $this->assertSame(1, app(DeleteSettingAction::class)->run($settings->key));
        $this->assertDatabaseMissing(Setting::TABLE, [
            'key' => $settings->key
        ]);
    }

    public function testInvalidKey(): void
    {
        $this->assertSame(0, app(DeleteSettingAction::class)->run('custom-key'));
    }
}
