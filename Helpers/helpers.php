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

use App\Containers\Vendor\Settings\Actions\FindSettingByKeyAction;
use JBZoo\Data\JSON;

if (!function_exists('settings')) {

    function settings(string $key, mixed $default = null): int|JSON|string
    {
        try {
            $settings = app(FindSettingByKeyAction::class)->run($key);
        } catch (Exception $exception) {
            $settings = $default;
        }

        return $settings;
    }

}
