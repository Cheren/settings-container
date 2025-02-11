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

namespace App\Containers\Vendor\Setting\UI\API\Transformers;

use App\Containers\Vendor\Setting\Foundation\Setting;
use App\Containers\Vendor\Setting\Manager;
use App\Containers\Vendor\Setting\Models\Setting as SettingModel;
use App\Ship\Parents\Transformers\Transformer;

class SystemSettingsTransformer extends Transformer
{
    public function transform(SettingModel $setting): array
    {
        $manager = Manager::getInstance();
        $settingSchema = $manager->get($setting->key);

        return [
            Setting::KEY => $setting->key,
            Setting::TYPE => $setting->type,
            TITLE => $settingSchema->getName(),
            VALUE => $settingSchema->transformValue($setting->value)
        ];
    }
}
