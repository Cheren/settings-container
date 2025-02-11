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

namespace App\Containers\Vendor\Setting\Data\Repositories;

use App\Containers\Vendor\Setting\Foundation\Setting;
use App\Containers\Vendor\Setting\Models\Setting as SettingModel;
use App\Ship\Parents\Repositories\Repository;

final class SettingRepository extends Repository
{
    protected $fieldSearchable = [
        ID => '=',
        Setting::KEY => '='
    ];

    public function model(): string
    {
        return SettingModel::class;
    }
}
