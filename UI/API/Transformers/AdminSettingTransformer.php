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

namespace App\Containers\Vendor\Setting\UI\API\Transformers;

use App\Containers\Vendor\Setting\Models\Setting as SettingModel;

final class AdminSettingTransformer extends SettingTransformer
{
    public function transform(SettingModel $setting): array
    {
        return parent::transform($setting) +
            [
                $this->realKey(ID) => $setting->id,
                $this->realKey(CREATED_BY) => $setting->created_by
            ];
    }
}
