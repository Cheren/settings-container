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

namespace App\Containers\Vendor\Settings\Actions;

use App\Containers\Vendor\Settings\Dto\SettingsDto;
use App\Containers\Vendor\Settings\Models\Setting;
use App\Containers\Vendor\Settings\Tasks\CreateSettingTask;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action;

class CreateSettingAction extends Action
{
    /**
     * @param SettingsDto $dto
     * @return Setting
     * @throws CreateResourceFailedException
     */
    public function run(SettingsDto $dto): Setting
    {
        return app(CreateSettingTask::class)->run($dto);
    }
}
