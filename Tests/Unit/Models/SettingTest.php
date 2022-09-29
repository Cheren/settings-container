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

namespace App\Containers\Vendor\Settings\Tests\Unit\Models;

use App\Containers\Vendor\Settings\Models\Setting;
use App\Containers\Vendor\Settings\Tests\TestCase;

/**
 * @property Setting $model
 */
class SettingTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->model = new Setting();
    }

    public function testTimestamps(): void
    {
        $this->assertFalse($this->model->timestamps);
    }

    public function testFillabel(): void
    {
        $fields = [
            'key',
            'value',
            'type'
        ];

        foreach ($fields as $field) {
            $this->assertTrue(in_array($field, $this->model->getFillable()));
        }
    }
}
