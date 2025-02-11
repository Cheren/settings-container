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

use App\Containers\Vendor\Setting\Dto\SettingsDto;
use App\Containers\Vendor\Setting\Foundation\Setting;
use App\Containers\Vendor\Setting\Models\Setting as SettingModel;
use App\Containers\Vendor\Setting\Requests\ApiSettingRequest;
use App\Ship\Collections\ValidationRules;
use App\Ship\Contracts\GettableDto;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class CreateSettingRequest extends ApiSettingRequest implements GettableDto
{
    public function authorize(): bool
    {
        if ($this->isUserScreenSettings()) {
            $this->clearAccess();
        }

        return parent::authorize();
    }

    public function rules(): array
    {
        return [
            Setting::KEY => $this->getSettingKeyValidationRules(),
            Setting::VALUE => $this->getSettingValueValidationRules(),
            Setting::TYPE => $this->getSettingTypeValidationRules()
        ];
    }

    /**
     * @return SettingsDto
     * @throws UnknownProperties
     */
    public function getDto(): SettingsDto
    {
        return $this->newDto($this->validated());
    }

    /**
     * @param array $data
     * @return SettingsDto
     * @throws UnknownProperties
     */
    public function newDto(array $data = []): SettingsDto
    {
        return new SettingsDto($data);
    }

    public function getSettingKeyValidationRules(): ValidationRules
    {
        return parent::getSettingKeyValidationRules()->addRequired();
    }

    public function getSettingValueValidationRules(): ValidationRules
    {
        return validation_rules()
            ->addRequired()
            ->add(
                $this->getSettingValueByTypeValidationRule(
                    $this->get(Setting::TYPE)
                )
            );
    }

    protected function prepareForValidation(): void
    {
        if (!$this->has(Setting::TYPE)) {
            $this->merge([
                Setting::TYPE => SettingModel::TYPE_STRING
            ]);
        }
    }
}
