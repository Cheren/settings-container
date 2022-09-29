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

namespace App\Containers\Vendor\Settings\Dto;

use App\Containers\Vendor\Settings\Models\Setting;
use App\Ship\Parents\Dto\Dto;

class SettingsDto extends Dto
{
    public string $key;
    public mixed $value;
    public string $type = Setting::TYPE_STRING;
}
