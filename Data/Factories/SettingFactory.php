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

namespace App\Containers\Vendor\Settings\Data\Factories;

use App\Containers\Vendor\Settings\Models\Setting;
use App\Ship\Parents\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * @method Model|Collection|Setting create($attributes = [], ?Model $parent = null)
 */
class SettingFactory extends Factory
{
    protected $model = Setting::class;

    public function definition()
    {
        return [
            'key' => $this->faker->slug,
            'value' => $this->faker->name,
            'type' => Setting::TYPE_STRING
        ];
    }
}
