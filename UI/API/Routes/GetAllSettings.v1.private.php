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
 *
 * @apiGroup           Settings
 * @apiName            getAllSettings
 *
 * @api                {GET} /v1/settings Список
 * @apiDescription     Получить всесь список настроек.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Аутентифицированный пользователь с правами "crud-settings"
 *
 * @apiExample {js} NodeJS Axios:
const axios = require('axios');

let config = {
    method: 'get',
    url: 'api.domain.test/v1/settings',
    headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer {access_token}',
        'Content-Type': 'application/x-www-form-urlencoded',
        'Cookie': 'refreshToken={refresh_token}'
    }
};
 *
axios(config);
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 200 OK
{
    "data": [
        {
            "object": "Setting",
            "id": "NxOpZowo9GmjKqdR",
            "key": "user.#1.orders.table",
            "value": "hello"
        },
        {
            "object": "Setting",
            "id": "aYOxlpzRMwrX3gD7",
            "key": "user.#1.orders.table1",
            "value": {
                "key": "key value"
            }
        }
        ],
        "meta": {
            "include": [],
            "custom": [],
            "pagination": {
                "total": 2,
                "count": 2,
                "per_page": 10,
                "current_page": 1,
                "total_pages": 1,
                "links": {}
            }
        }
    }
}
 */

use App\Containers\Vendor\Settings\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('settings', [Controller::class, 'getAllSettings'])
    ->name('api_settings_get_all_settings')
    ->middleware(['auth:api']);
