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

use App\Containers\Vendor\Settings\Actions\GetAllSettingsAction;
use App\Containers\Vendor\Settings\Models\Setting;
use App\Containers\Vendor\Settings\Tests\TestCase;
use Illuminate\Pagination\LengthAwarePaginator;

class GetAllSettingsActionTest extends TestCase
{
    public function test(): void
    {
        $total = 10;
        Setting::factory()->count($total)->create();
        $result = app(GetAllSettingsAction::class)->run();
        $this->assertInstanceOf(LengthAwarePaginator::class, $result);
        $this->assertSame($total, $result->count());
    }
}
