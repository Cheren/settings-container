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

use App\Containers\Vendor\Settings\Tasks\FindSettingByKeyTask;
use App\Ship\Parents\Actions\Action;
use JBZoo\Data\JSON;
use App\Ship\Exceptions\NotFoundException;

class FindSettingByKeyAction extends Action
{
    /**
     * @param string $key
     * @return int|JSON|string
     * @throws NotFoundException
     */
    public function run(string $key): int|JSON|string
    {
        return app(FindSettingByKeyTask::class)->run($key);
    }
}
