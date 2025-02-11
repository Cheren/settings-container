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
use App\Ship\Exceptions\DeleteResourceFailedException;
use Exception;

class DeleteSettingTask extends SettingTask
{
    /**
     * @param string $key
     * @return int|null
     * @throws DeleteResourceFailedException
     */
    public function run(string $key): ?int
    {
        try {
            return $this->repository->deleteWhere([
                [Setting::KEY, '=', $key]
            ]);
        } catch (Exception $exception) {
            throw new DeleteResourceFailedException($exception->getMessage());
        }
    }
}
