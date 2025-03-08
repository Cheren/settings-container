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

namespace App\Containers\Vendor\Setting\Traits;

use App\Containers\Vendor\Setting\Foundation\Setting;
use App\Containers\Vendor\Setting\Models\Setting as SettingModel;
use App\Ship\Collections\ValidationRules;
use App\Ship\Validation\Rule;
use Illuminate\Validation\Rules\Exists;
use Illuminate\Validation\Rules\In;
use Illuminate\Validation\Rules\Unique;

trait SettingValidationRules
{
    public function getSettingKeyValidationRules(): ValidationRules
    {
        return validation_rules()
            ->addString()
            ->add(
                $this->getSettingUniqueKeyValidationRule()
            );
    }

    public function getSettingTypeValidationRules(): ValidationRules
    {
        return validation_rules()
            ->addString()
            ->add(
                $this->getSettingAllowedTypesValidationRule()
            );
    }

    public function getSettingValueByTypeValidationRule(?string $type): string
    {
        return match ($type) {
            SettingModel::TYPE_DATA => 'array',
            SettingModel::TYPE_INT => 'numeric',
            default => 'string'
        };
    }

    public function getSettingExistsByKeyValidationRule(): Exists
    {
        return Rule::exists(SettingModel::TABLE, Setting::KEY);
    }

    public function getSettingUniqueKeyValidationRule(): Unique
    {
        return Rule::unique(SettingModel::TABLE, Setting::KEY);
    }

    public function getSettingAllowedTypesValidationRule(): In
    {
        return Rule::in([
            SettingModel::TYPE_INT,
            SettingModel::TYPE_DATA,
            SettingModel::TYPE_STRING
        ]);
    }
}
