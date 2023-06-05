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

use App\Ship\Contracts\Namebled;

abstract class Schema implements Namebled
{
    protected string $key;

    public function getKey(): string
    {
        return $this->key;
    }

    public function valueWithTitle(?string $title, mixed $value, string $type = 'string'): array
    {
        return [
            'value' => $value,
            'title' => $title,
            'type' => $type
        ];
    }

    abstract public function transformValue(mixed $value): mixed;
}
