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

use App\Containers\Vendor\Setting\Foundation\Setting;
use App\Ship\Exceptions\NotFoundException;
use JBZoo\Data\JSON;

class FindSettingByKeyTask extends SettingTask
{
    /**
     * @param string $key
     * @return string|int|JSON
     * @throws NotFoundException
     */
    public function run(string $key): string|int|JSON
    {
        $result = $this->repository
            ->findWhere([
                Setting::KEY => $key
            ])
            ->first();

        if (!$result) {
            throw new NotFoundException();
        }

        return $result->value;
    }
}
