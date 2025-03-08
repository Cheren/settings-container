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

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\Vendor\Setting\Actions\GetAllSettingsAction;
use App\Containers\Vendor\Setting\UI\API\Requests\GetAllSettingsRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllSettingsController extends ApiController
{
    /**
     * @param GetAllSettingsRequest $request
     * @param GetAllSettingsAction $action
     * @return JsonResponse
     * @throws CoreInternalErrorException
     * @throws InvalidTransformerException
     * @throws RepositoryException
     */
    public function __invoke(GetAllSettingsRequest $request, GetAllSettingsAction $action): JsonResponse
    {
        return $this->json(
            $this->transform(
                $action->run(),
                $request->getTransformer()
            )
        );
    }
}
