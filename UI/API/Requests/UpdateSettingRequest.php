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

namespace App\Containers\Vendor\Setting\UI\API\Requests;

use App\Containers\Vendor\Setting\Foundation\Setting;
use Illuminate\Validation\Rules\Unique;

class UpdateSettingRequest extends CreateSettingRequest
{
    public function authorize(): bool
    {
        if ($this->isUserScreenSettings()) {
            $this->clearAccess();
        }

        return $this->check([
            'hasAccess',
            'isOwner'
        ]);
    }

    public function getSettingUniqueKeyValidationRule(): Unique
    {
        return parent::getSettingUniqueKeyValidationRule()
            ->ignore($this->key, Setting::KEY);
    }
}
