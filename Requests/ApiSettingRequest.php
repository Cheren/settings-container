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

namespace App\Containers\Vendor\Settings\Requests;

use App\Containers\Vendor\Settings\Access\SettingsPermissions;
use App\Containers\Vendor\Settings\Models\Setting;
use App\Containers\Vendor\Settings\UI\API\Transformers\SettingTransformer;
use App\Ship\Contracts\GettableTransformer;
use App\Ship\Parents\Transformers\Transformer;
use App\Ship\Requests\ApiRequest;

/**
 * @property mixed $key
 */
abstract class ApiSettingRequest extends ApiRequest implements GettableTransformer
{
    protected array $access = [
        //'permissions' => SettingsPermissions::MANAGE_SETTINGS,
        'roles' => 'admin'
    ];

    public function authorize(): bool
    {
        return $this->check([
            'hasAccess'
        ]);
    }

    public function getTransformer(): Transformer
    {
        return new SettingTransformer();
    }

    protected function inputTypeIs(string $type): bool
    {
        return $this->get('type') === $type;
    }

    protected function isOwner(): bool
    {
        if ($this->user()->is_admin) {
            return true;
        }

        $count = Setting::where('created_by', $this->user()->id)
            ->where('key', $this->get('key', $this->key))
            ->count();

        return $count > 0;
    }
}
