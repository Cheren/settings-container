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

use App\Containers\Vendor\Setting\Actions\CreateSettingAction;
use App\Containers\Vendor\Setting\Dto\SettingsDto;
use App\Containers\Vendor\Setting\Foundation\Setting;
use App\Containers\Vendor\Setting\Models\Setting as SettingModel;
use App\Containers\Vendor\Setting\Tests\UnitTestCase;
use JBZoo\Data\JSON;

final class CreateSettingActionTest extends UnitTestCase
{
    public function testSuccessCreateStringValue(): void
    {
        $dto = new SettingsDto([
            Setting::KEY => 'title',
            Setting::VALUE => 'Test title'
        ]);

        $result = app(CreateSettingAction::class)->run($dto);

        $this->assertInstanceOf(SettingModel::class, $result);
        $this->assertNull($result->group);
        $this->assertSame($dto->key, $result->key);
        $this->assertSame($dto->value, $result->value);
        $this->assertNull($result->created_by);
    }

    public function testSuccessCreateIntValue(): void
    {
        $dto = new SettingsDto([
            Setting::KEY => 'age',
            Setting::VALUE => '225',
            Setting::TYPE => SettingModel::TYPE_INT
        ]);

        $result = app(CreateSettingAction::class)->run($dto);

        $this->assertInstanceOf(SettingModel::class, $result);
        $this->assertNull($result->group);
        $this->assertSame($dto->key, $result->key);
        $this->assertSame(225, $result->value);
        $this->assertNull($result->created_by);
    }

    public function testSuccessCreateDataValueAndWithCreatedBy(): void
    {
        $user = $this->getTestingUser();

        $dto = new SettingsDto([
            Setting::KEY => 'age',
            Setting::VALUE => [
                'age' => '31',
                'name' => 'Tester'
            ],
            Setting::TYPE => SettingModel::TYPE_DATA
        ]);

        $result = app(CreateSettingAction::class)->run($dto);

        $this->assertInstanceOf(SettingModel::class, $result);
        $this->assertNull($result->group);
        $this->assertSame($dto->key, $result->key);
        $this->assertInstanceOf(JSON::class, $result->value);
        $this->assertSame('31', $result->value->get('age'));
        $this->assertSame($user->id, $result->created_by);
    }
}
