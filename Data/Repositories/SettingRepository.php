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

namespace App\Containers\Vendor\Settings\Data\Repositories;

use App\Containers\Vendor\Settings\Models\Setting;
use App\Ship\Parents\Repositories\Repository;

class SettingRepository extends Repository
{
    protected $fieldSearchable = [
        'id' => '=',
        'key' => '='
    ];

    public function model(): string
    {
        return Setting::class;
    }
}
