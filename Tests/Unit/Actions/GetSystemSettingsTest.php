<?php

/**
 * ERP system
 *
 * This file is part of the ERM system package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license     https://kalistratov.ru/licenses/erp Proprietary license
 * @copyright   Copyright (C) kalistratov.ru, All rights reserved ©.
 * @link        https://kalistratov.ru
 * @author      Sergey Kalistratov <sergey@kalistratov.ru>
 */

namespace App\Containers\Vendor\Setting\Tests\Unit\Actions;

use App\Containers\Vendor\Setting\Actions\GetSystemSettingsAction;
use App\Containers\Vendor\Setting\Tests\UnitTestCase;
use Illuminate\Database\Eloquent\Collection;

final class GetSystemSettingsTest extends UnitTestCase
{
    public function test(): void
    {
        $result = app(GetSystemSettingsAction::class)->run();
        $this->assertInstanceOf(Collection::class, $result);
    }
}
