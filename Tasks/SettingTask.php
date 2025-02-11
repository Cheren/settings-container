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

use App\Containers\Vendor\Setting\Data\Repositories\SettingRepository;
use App\Ship\Parents\Tasks\Task;

abstract class SettingTask extends Task
{
    public function __construct(
        protected SettingRepository $repository
    ) {
    }
}
