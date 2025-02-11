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

namespace App\Containers\Vendor\Setting\UI\API\Controllers;

use App\Containers\Vendor\Setting\Actions\DeleteSettingAction;
use App\Containers\Vendor\Setting\UI\API\Requests\DeleteSettingRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class DeleteSettingController extends ApiController
{
    /**
     * @param DeleteSettingRequest $request
     * @param DeleteSettingAction $action
     * @return JsonResponse
     * @throws DeleteResourceFailedException
     */
    public function __invoke(DeleteSettingRequest $request, DeleteSettingAction $action): JsonResponse
    {
        $action->run($request->key);
        return $this->noContent();
    }
}