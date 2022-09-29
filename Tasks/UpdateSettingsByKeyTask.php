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

namespace App\Containers\Vendor\Settings\Tasks;

use App\Containers\Vendor\Settings\Dto\SettingsDto;
use App\Containers\Vendor\Settings\Models\Setting;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use Exception;

class UpdateSettingsByKeyTask extends SettingTask
{
    /**
     * @param SettingsDto $dto
     * @return Setting
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run(SettingsDto $dto): Setting
    {
        $setting = $this->findSetting($dto->key);

        try {
            return $this->repository->update([
                'value' => $dto->value,
                'type' => $dto->type
            ], $setting->id);
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }

    /**
     * @param string $key
     * @return Setting
     * @throws NotFoundException
     */
    protected function findSetting(string $key): Setting
    {
        $setting = $this->repository->findWhere(['key' => $key])->first();

        if (!$setting) {
            throw new NotFoundException();
        }

        return $setting;
    }
}
