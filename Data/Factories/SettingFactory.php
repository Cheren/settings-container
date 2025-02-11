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

namespace App\Containers\Vendor\Setting\Data\Factories;

use App\Containers\Vendor\Setting\Foundation\Setting;
use App\Containers\Vendor\Setting\Models\Setting as SettingModel;
use App\Ship\Database\Eloquent\Collection;
use App\Ship\Parents\Factories\Factory;
use App\Ship\Parents\Models\Model;
use App\Ship\Traits\Factory\CreatedByState;

/**
 * @method Model|Collection|SettingModel create($attributes = [], ?Model $parent = null)
 */
final class SettingFactory extends Factory
{
    use CreatedByState;

    protected $model = SettingModel::class;

    public function definition(): array
    {
        return [
            Setting::KEY => $this->faker->slug,
            Setting::VALUE => $this->faker->name,
            Setting::TYPE => SettingModel::TYPE_STRING
        ];
    }
}
