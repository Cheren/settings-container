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

namespace App\Containers\Vendor\Setting\Actions;

use App\Containers\Vendor\Setting\Dto\SettingsDto;
use App\Containers\Vendor\Setting\Models\Setting;
use App\Containers\Vendor\Setting\Tasks\UpdateSettingsByKeyTask;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action;

class UpdateSettingByKeyAction extends Action
{
    /**
     * @param SettingsDto $dto
     * @return Setting
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run(SettingsDto $dto): Setting
    {
        return app(UpdateSettingsByKeyTask::class)->run($dto);
    }
}
