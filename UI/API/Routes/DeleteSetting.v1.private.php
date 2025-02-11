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
 * @apiGroup Setting
 * @apiName deleteSetting
 *
 * @api {delete} /v1/settings/:key Удалить
 * @apiDescription Удалить сохранённые настройки по ключу.
 *
 * @apiVersion 1.0.0
 * @apiPermission Аутентифицированный пользователь с правами "crud-settings"
 *
 * @apiParam {String} key Уникальный ключ
 * 
 * @apiSuccessExample {json} Успешный ответ:
 * HTTP/1.1 204 No content
 */

use App\Containers\Vendor\Setting\Facades\Container;
use App\Containers\Vendor\Setting\Foundation\Setting;
use App\Containers\Vendor\Setting\UI\API\Controllers\DeleteSettingController;
use Illuminate\Support\Facades\Route;

Route::delete(Container::getApiUri('{' . Setting::KEY . '}'), DeleteSettingController::class)
    ->name('api_settings_delete_setting')
    ->middleware(['auth:api']);
