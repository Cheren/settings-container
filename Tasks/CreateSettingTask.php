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
use App\Ship\Exceptions\CreateResourceFailedException;
use Exception;

class CreateSettingTask extends SettingTask
{
    /**
     * @param SettingsDto $dto
     * @return Setting
     * @throws CreateResourceFailedException
     */
    public function run(SettingsDto $dto): Setting
    {
        try {
            return $this->repository->create($dto->toArray());
        } catch (Exception $exception) {
            throw new CreateResourceFailedException($exception->getMessage());
        }
    }
}
