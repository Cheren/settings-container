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

namespace App\Containers\Vendor\Settings\Foundation;

use App\Ship\Foundation\SectionContainer;

final class Settings extends SectionContainer
{
    public const KEY = 'key';
    public const TYPE = 'type';
    public const VALUE = 'value';

    protected string $apiBaseUri = 'settings';
}
