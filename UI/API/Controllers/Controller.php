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

namespace App\Containers\Vendor\Settings\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\Vendor\Settings\Actions\CreateSettingAction;
use App\Containers\Vendor\Settings\Actions\DeleteSettingAction;
use App\Containers\Vendor\Settings\Actions\GetAllSettingsAction;
use App\Containers\Vendor\Settings\Actions\UpdateSettingByKeyAction;
use App\Containers\Vendor\Settings\Dto\SettingsDto;
use App\Containers\Vendor\Settings\UI\API\Requests\CreateSettingRequest;
use App\Containers\Vendor\Settings\UI\API\Requests\DeleteSettingRequest;
use App\Containers\Vendor\Settings\UI\API\Requests\GetAllSettingsRequest;
use App\Containers\Vendor\Settings\UI\API\Requests\UpdateSettingRequest;
use App\Containers\Vendor\Settings\UI\API\Transformers\SettingTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Prettus\Repository\Exceptions\RepositoryException;

class Controller extends ApiController
{
    /**
     * @param CreateSettingRequest $request
     * @return JsonResponse
     * @throws InvalidTransformerException
     * @throws CreateResourceFailedException
     */
    public function createSetting(CreateSettingRequest $request): JsonResponse
    {
        $dto = new SettingsDto($request->all());
        $setting = app(CreateSettingAction::class)->run($dto);
        return $this->json($this->transform($setting, SettingTransformer::class));
    }

    /**
     * @param DeleteSettingRequest $request
     * @return JsonResponse
     * @throws DeleteResourceFailedException
     */
    public function deleteSetting(DeleteSettingRequest $request): JsonResponse
    {
        app(DeleteSettingAction::class)->run($request->key);
        return $this->noContent();
    }

    /**
     * @param GetAllSettingsRequest $request
     * @return JsonResponse
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function getAllSettings(GetAllSettingsRequest $request): JsonResponse
    {
        $settings = app(GetAllSettingsAction::class)->run();
        return $this->json($this->transform($settings, SettingTransformer::class));
    }

    /**
     * @param UpdateSettingRequest $request
     * @return JsonResponse
     * @throws InvalidTransformerException
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function updateSetting(UpdateSettingRequest $request): JsonResponse
    {
        $dto = new SettingsDto($request->all());
        $setting = app(UpdateSettingByKeyAction::class)->run($dto);
        return $this->created($this->transform($setting, SettingTransformer::class));
    }
}
