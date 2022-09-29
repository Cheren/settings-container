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
 * @apiName            deleteSetting
 *
 * @api                {DELETE} /v1/settings/:key Удалить
 * @apiDescription     Удалить сохранённые настройки по ключу.
 *
 * @apiVersion         1.0.0
 * @apiPermission      Аутентифицированный пользователь с правами "crud-settings"
 *
 * @apiSuccessExample  {json}  Success-Response:
 * HTTP/1.1 204 No content
 */

use App\Containers\Vendor\Settings\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::delete('settings/{key}', [Controller::class, 'deleteSetting'])
    ->name('api_settings_delete_setting')
    ->middleware(['auth:api']);
