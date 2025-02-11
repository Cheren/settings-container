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

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\Vendor\Setting\Actions\CreateSettingAction;
use App\Containers\Vendor\Setting\UI\API\Requests\CreateSettingRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class CreateSettingController extends ApiController
{
    /**
     * @param CreateSettingRequest $request
     * @param CreateSettingAction $action
     * @return JsonResponse
     * @throws CreateResourceFailedException
     * @throws InvalidTransformerException
     * @throws UnknownProperties
     */
    public function __invoke(CreateSettingRequest $request, CreateSettingAction $action): JsonResponse
    {
        return $this->json(
            $this->transform(
                $action->run($request->getDto()),
                $request->getTransformer()
            )
        );
    }
}