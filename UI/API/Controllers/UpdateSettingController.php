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
use App\Containers\Vendor\Setting\Actions\UpdateSettingByKeyAction;
use App\Containers\Vendor\Setting\Dto\SettingsDto;
use App\Containers\Vendor\Setting\UI\API\Requests\UpdateSettingRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UpdateSettingController extends ApiController
{
    /**
     * @param UpdateSettingRequest $request
     * @param UpdateSettingByKeyAction $action
     * @return JsonResponse
     * @throws InvalidTransformerException
     * @throws NotFoundException
     * @throws UnknownProperties
     * @throws UpdateResourceFailedException
     * @throws \Apiato\Core\Exceptions\IncorrectIdException
     * @throws \Throwable
     */
    public function __invoke(UpdateSettingRequest $request, UpdateSettingByKeyAction $action): JsonResponse
    {
        $dto = new SettingsDto($request->all());
        $setting = app(UpdateSettingByKeyAction::class)->run($dto);
        return $this->created($this->transform($setting, $request->getTransformer()));
    }
}
