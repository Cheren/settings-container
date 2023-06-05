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

namespace App\Containers\Vendor\Settings\Tests\Unit;

use App\Containers\Vendor\Settings\Manager;
use App\Containers\Vendor\Settings\Tests\TestCase;

class ManagerTest extends TestCase
{
    public function test()
    {
        $manager = Manager::getInstance();

        dd($manager->all());

        dd($manager->getPaths());
    }
}
