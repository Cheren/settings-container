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

namespace App\Containers\Vendor\Setting\Tasks;

use App\Containers\Vendor\Setting\Dto\SettingsDto;
use App\Containers\Vendor\Setting\Foundation\Setting;
use App\Containers\Vendor\Setting\Models\Setting as SettingModel;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use Exception;

class UpdateSettingsByKeyTask extends SettingTask
{
    /**
     * @param SettingsDto $dto
     * @return SettingModel
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run(SettingsDto $dto): SettingModel
    {
        $setting = $this->findSetting($dto->key);

        try {
            return $this->repository->update([
                Setting::VALUE => $dto->value,
                Setting::TYPE => $dto->type
            ], $setting->id);
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }

    /**
     * @param string $key
     * @return SettingModel
     * @throws NotFoundException
     */
    protected function findSetting(string $key): SettingModel
    {
        $setting = $this->repository
            ->findWhere([
                Setting::KEY => $key
            ])
            ->first();

        if (!$setting) {
            throw new NotFoundException();
        }

        return $setting;
    }
}
