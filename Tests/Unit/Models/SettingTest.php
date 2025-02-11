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

namespace App\Containers\Vendor\Setting\Tests\Unit\Models;

use App\Containers\Vendor\Setting\Foundation\Setting;
use App\Containers\Vendor\Setting\Models\Setting as SettingModel;
use App\Containers\Vendor\Setting\Tests\UnitTestCase;
use JBZoo\Data\JSON;

final class SettingTest extends UnitTestCase
{
    protected SettingModel $model;

    public function setUp(): void
    {
        parent::setUp();
        $this->model = new SettingModel();
    }

    public function testTimestamps(): void
    {
        $this->assertFalse($this->model->timestamps);
    }

    public function testFillabel(): void
    {
        $fields = [
            Setting::KEY,
            Setting::VALUE,
            Setting::TYPE
        ];

        foreach ($fields as $field) {
            $this->assertTrue(in_array($field, $this->model->getFillable()));
        }
    }

    public function testGetAttributeIsIntType(): void
    {
        $model = new SettingModel([
            Setting::TYPE => SettingModel::TYPE_INT,
            Setting::VALUE => '4567'
        ]);

        $this->assertIsInt($model->value);
        $this->assertSame(4567, $model->value);
    }

    public function testGetAttributeIsDataType(): void
    {
        $model = new SettingModel([
            Setting::TYPE => SettingModel::TYPE_DATA,
            Setting::VALUE => [
                'key' => 'value'
            ]
        ]);

        $this->assertInstanceOf(JSON::class, $model->value);
        $this->assertSame('value', $model->value->get('key'));
    }
}
