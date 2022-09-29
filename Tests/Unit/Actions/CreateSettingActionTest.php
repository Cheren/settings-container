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

use App\Containers\Vendor\Settings\Actions\CreateSettingAction;
use App\Containers\Vendor\Settings\Dto\SettingsDto;
use App\Containers\Vendor\Settings\Models\Setting;
use App\Containers\Vendor\Settings\Tests\TestCase;
use JBZoo\Data\JSON;

class CreateSettingActionTest extends TestCase
{
    public function testSuccessCreateStringValue(): void
    {
        $dto = new SettingsDto([
            'key' => 'title',
            'value' => 'Test title'
        ]);

        $result = app(CreateSettingAction::class)->run($dto);
        $this->assertInstanceOf(Setting::class, $result);
        $this->assertNull($result->group);
        $this->assertSame($dto->key, $result->key);
        $this->assertSame($dto->value, $result->value);
        $this->assertNull($result->created_by);
    }

    public function testSuccessCreateIntValue(): void
    {
        $dto = new SettingsDto([
            'key' => 'age',
            'value' => '225',
            'type' => Setting::TYPE_INT
        ]);

        $result = app(CreateSettingAction::class)->run($dto);
        $this->assertInstanceOf(Setting::class, $result);
        $this->assertNull($result->group);
        $this->assertSame($dto->key, $result->key);
        $this->assertSame(225, $result->value);
        $this->assertNull($result->created_by);
    }

    public function testSuccessCreateDataValueAndWithCreatedBy(): void
    {
        $user = $this->getTestingUser();

        $dto = new SettingsDto([
            'key' => 'age',
            'value' => [
                'age' => '31',
                'name' => 'Tester'
            ],
            'type' => Setting::TYPE_DATA
        ]);

        $result = app(CreateSettingAction::class)->run($dto);
        $this->assertInstanceOf(Setting::class, $result);
        $this->assertNull($result->group);
        $this->assertSame($dto->key, $result->key);
        $this->assertInstanceOf(JSON::class, $result->value);
        $this->assertSame('31', $result->value->get('age'));
        $this->assertSame($user->id, $result->created_by);
    }
}
