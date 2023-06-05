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

namespace App\Containers\Vendor\Settings\UI\API\Transformers;

use App\Containers\Vendor\Settings\Manager;
use App\Containers\Vendor\Settings\Models\Setting;
use App\Ship\Parents\Transformers\Transformer;

class SystemSettingsTransformer extends Transformer
{
    public function transform(Setting $setting): array
    {
        $manager = Manager::getInstance();
        $settingSchema = $manager->get($setting->key);

        return [
            'key' => $setting->key,
            'type' => $setting->type,
            'title' => $settingSchema->getName(),
            'value' => $settingSchema->transformValue($setting->value)
        ];
    }
}
