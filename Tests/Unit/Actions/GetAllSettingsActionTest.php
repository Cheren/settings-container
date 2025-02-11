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

use App\Containers\Vendor\Setting\Actions\GetAllSettingsAction;
use App\Containers\Vendor\Setting\Models\Setting;
use App\Containers\Vendor\Setting\Tests\UnitTestCase;
use Illuminate\Pagination\LengthAwarePaginator;

final class GetAllSettingsActionTest extends UnitTestCase
{
    public function test(): void
    {
        $baseCount = Setting::count();

        $settings = Setting::factory()
            ->count(4)
            ->create();

        $result = app(GetAllSettingsAction::class)->run();

        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
        $this->assertSame($settings->count() + $baseCount, $result->total());
    }
}
