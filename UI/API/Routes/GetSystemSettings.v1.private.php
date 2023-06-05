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
 *
 * @apiGroup           Settings
 * @apiName            getSystemSettings
 *
 * @api                {GET} /v1/settings/system Список настроек системы
 * @apiDescription     Получить список настроек системы.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Аутентифицированный пользователь
 *
 * @apiExample {js} NodeJS Axios:
const axios = require('axios');

let config = {
    method: 'get',
    url: 'api.domain.test/v1/settings/system',
    headers: {
        'Accept': 'application/json',
        'Authorization': 'Bearer {access_token}',
        'Content-Type': 'application/x-www-form-urlencoded',
        'Cookie': 'refreshToken={refresh_token}'
    }
};

axios(config);
 *
 * @apiSuccessExample  {json} Успешный ответ:
 * HTTP/1.1 200 OK
{
    "data": [
        {
            "key": "amo_crm",
            "type": "data",
            "title": "Настройки интеграции AmoCRM",
            "value": {
                "client_id": {
                    "value": "ID интеграции:",
                    "title": "931cdb48-7931-490cb1-a96a-8c26129993"
                },
                "client_secret": {
                    "value": "Секретный ключ:",
                    "title": "WqWvtRxoL5BwJa2sEGDPGEbZRYQwAGoBzvdmmKHYV20eOcp9meIaWjhSGPuBMR"
                },
                "redirect_uri": {
                    "value": "Адрес для редиректа:",
                    "title": "http://apierp.arb-bio.ru/v1"
                },
                "authorization_code": {
                    "value": "Код авторизации (действителен 20 минут):",
                    "title": ""
                },
                "account_domain": {
                    "value": "Домен аккаунта:",
                    "title": null
                }
            }
        }
    ],
    "meta": {
        "include": [],
        "custom": []
    }
}
 */

use App\Containers\Vendor\Settings\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('settings/system', [Controller::class, 'getSystemSettings'])
    ->name('api_settings_get_system_settings')
    ->middleware(['auth:api']);
