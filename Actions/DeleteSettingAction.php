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

use App\Containers\Vendor\Settings\Tasks\DeleteSettingTask;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Parents\Actions\Action;

class DeleteSettingAction extends Action
{
    /**
     * @param string $key
     * @return int|null
     * @throws DeleteResourceFailedException
     */
    public function run(string $key): ?int
    {
        return app(DeleteSettingTask::class)->run($key);
    }
}
