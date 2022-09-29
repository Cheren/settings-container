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

namespace App\Containers\Vendor\Settings\UI\API\Requests;

use App\Containers\Vendor\Settings\Models\Setting;
use App\Ship\Parents\Validation\Rule;

class UpdateSettingRequest extends CreateSettingRequest
{
    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
            'isOwner'
        ]);
    }

    protected function getKeyRules(): array
    {
        $rules = parent::getKeyRules();
        foreach ($rules as $i => $rule) {
            if (preg_match('/^unique:/', $rule)) {
                $rules[$i] = Rule::unique(Setting::TABLE, 'key')->ignore($this->key, 'key');
            }
        }

        return $rules;
    }
}
