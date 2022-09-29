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
 * @apiName            createSetting
 * @apiUse             SettingsSuccessSingleResponse
 *
 * @api                {POST} /v1/settings Создать
 * @apiDescription     Создание новой настройки.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Аутентифицированный пользователь с правами "crud-settings"
 *
 * @apiParam           {String} key Уникальный ключ
 * @apiParam           {String|Int|Array} value Значение
 * @apiParam           {String=string,int,data} type=string Тип хранения настройки
 *
 * @apiExample {js} NodeJS Axios (String TYPE):
const axios = require('axios');
const qs = require('qs');
let data = qs.stringify({
    'key': 'user.#1.orders.table',
    'value': 'hello'
});

let config = {
    method: 'post',
    url: 'api.domain.test/v1/settings',
    headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer {access_token}',
        'Content-Type': 'application/x-www-form-urlencoded',
        'Cookie': 'refreshToken={refresh_token}'
    },
    data : data
};

axios(config);
 * @apiExample {js} NodeJS Axios (Data TYPE):
const axios = require('axios');
const qs = require('qs');
let data = qs.stringify({
    'key': 'user.#1.orders.table',
    'value': [
        'total' : 10,
        'page': 5
    ],
    'type': 'data'
});

let config = {
    method: 'post',
    url: 'api.domain.test/v1/settings',
    headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer {access_token}',
        'Content-Type': 'application/x-www-form-urlencoded',
        'Cookie': 'refreshToken={refresh_token}'
    },
    data : data
};

axios(config);
 */

use App\Containers\Vendor\Settings\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::post('settings', [Controller::class, 'createSetting'])
    ->name('api_settings_create_setting')
    ->middleware(['auth:api']);
