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

namespace App\Containers\Vendor\Settings;

use App\Containers\Vendor\Settings\Dto\SettingsDto;
use App\Ship\Contracts\Namebled;
use JBZoo\Data\JSON;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

abstract class Schema implements Namebled
{
    protected string $key;

    public function getKey(): string
    {
        return $this->key;
    }

    public function setValue(
        ?string $title,
        mixed $value,
        ?string $hint = null,
        string $type = 'string'
    ): array {
        return [
            'value' => $value,
            'title' => $title,
            'hint' => $hint,
            'type' => $type
        ];
    }

    abstract public function transformValue(mixed $value): mixed;

    /**
     * @param string|null $key
     * @return JSON|null|int|array|string
     */
    public function get(?string $key = null): mixed
    {
        static $settings;
        if (is_null($settings)) {
            $settings = settings($this->getKey(), new JSON());
        }

        return is_null($key) ? $settings : $settings->find($key);
    }

    /**
     * @return SettingsDto
     * @throws UnknownProperties
     */
    public function seederSettings(): SettingsDto
    {
        return new SettingsDto([
            'key' => 'default_key',
            'value' => '{}',
            'type' => 'data'
        ]);
    }
}
