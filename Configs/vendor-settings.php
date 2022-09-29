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

use App\Containers\Vendor\Settings\Models\Setting;

$allowedTypes = [
    Setting::TYPE_INT,
    Setting::TYPE_DATA,
    Setting::TYPE_STRING
];

return [

    'rules' => [

        'key' => [
            'string',
            'unique:' . Setting::TABLE . ',key'
        ],

        'type' => [
            'in:' . implode(',', $allowedTypes)
        ]

    ]

];
