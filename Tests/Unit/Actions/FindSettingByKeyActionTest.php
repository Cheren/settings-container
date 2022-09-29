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

use App\Containers\Vendor\Settings\Actions\FindSettingByKeyAction;
use App\Containers\Vendor\Settings\Models\Setting;
use App\Containers\Vendor\Settings\Tests\TestCase;
use App\Ship\Exceptions\NotFoundException;

class FindSettingByKeyActionTest extends TestCase
{
    public function testSuccessFind(): void
    {
        $settings = Setting::factory()->create();
        $result = app(FindSettingByKeyAction::class)->run($settings->key);
        $this->assertSame($settings->value, $result);
    }

    public function testWithInvalidKey(): void
    {
        $this->expectException(NotFoundException::class);
        app(FindSettingByKeyAction::class)->run('invalid.key');
    }
}
