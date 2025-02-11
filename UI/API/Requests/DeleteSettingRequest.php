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
use App\Containers\Vendor\Setting\Requests\ApiSettingRequest;
use App\Ship\Collections\ValidationRules;

class DeleteSettingRequest extends ApiSettingRequest
{
    protected array $urlParameters = [
        Setting::KEY
    ];

    public function rules(): array
    {
        return [
            Setting::KEY => $this->getSettingKeyValidationRules()
        ];
    }

    public function getSettingKeyValidationRules(): ValidationRules
    {
        return validation_rules()
            ->addRequired()
            ->add(
                $this->getSettingExistsByKeyValidationRule()
            );
    }

    public function authorize(): bool
    {
        return $this->check([
            'hasAccess',
            'isOwner'
        ]);
    }
}
