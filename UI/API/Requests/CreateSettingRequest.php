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
use App\Containers\Vendor\Settings\Requests\ApiSettingRequest;
use App\Ship\Parents\Validation\Rule;

class CreateSettingRequest extends ApiSettingRequest
{
    public function authorize(): bool
    {
        if ($this->isUserScreenSettings()) {
            $this->access = [
                'permissions' => '',
                'roles' => ''
            ];
        }

        return parent::authorize();
    }

    public function rules(): array
    {
        return [
            'key' => $this->getKeyRules(),
            'value' => $this->getValueRule(),
            'type' => config('vendor-settings.rules.type')
        ];
    }

    protected function isUserScreenSettings(): bool
    {
        $key = $this->get('key');
        return (bool)preg_match('/^user\.#[0-9]\.screen\.[0-9a-z_]/', $key);
    }

    protected function getKeyRules(): array
    {
        return Rule::addRequiredRule(config('vendor-settings.rules.key'));
    }

    protected function getValueRule(): array
    {
        $rules = Rule::addRequiredRule([]);

        if ($this->inputTypeIs(Setting::TYPE_DATA)) {
            $rules[] = 'array';
        } elseif ($this->inputTypeIs(Setting::TYPE_INT)) {
            $rules[] = 'numeric';
        } else {
            $rules[] = 'string';
        }

        return $rules;
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has('type')) {
            $this->merge([
                'type' => Setting::TYPE_STRING
            ]);
        }
    }
}
