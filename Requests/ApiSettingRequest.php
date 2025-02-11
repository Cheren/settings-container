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

namespace App\Containers\Vendor\Setting\Requests;

use App\Containers\Vendor\Setting\Foundation\Setting;
use App\Containers\Vendor\Setting\Models\Setting as SettingModel;
use App\Containers\Vendor\Setting\Traits\SettingValidationRules;
use App\Containers\Vendor\Setting\UI\API\Transformers\AdminSettingTransformer;
use App\Containers\Vendor\Setting\UI\API\Transformers\SettingTransformer;
use App\Ship\Contracts\GettableTransformer;
use App\Ship\Parents\Transformers\Transformer;
use App\Ship\Requests\ApiRequest;

/**
 * @property mixed $key
 */
abstract class ApiSettingRequest extends ApiRequest implements GettableTransformer
{
    use SettingValidationRules;

    public function getTransformer(): Transformer
    {
        return $this->isAdminUser() ? new AdminSettingTransformer() : new SettingTransformer();
    }

    protected function isOwner(): bool
    {
        if ($this->user()->is_admin) {
            return true;
        }

        return $this->countForOwner() > ZERO;
    }

    protected function isUserScreenSettings(): bool
    {
        $key = $this->get(Setting::KEY);
        return (bool)preg_match('/^user\.#[0-9]\.screen\.[0-9a-z_]/', $key);
    }

    protected function countForOwner(): int
    {
        return SettingModel::where(CREATED_BY, $this->user()->id)
            ->where(Setting::KEY, $this->get(Setting::KEY, $this->key))
            ->count();
    }
}
