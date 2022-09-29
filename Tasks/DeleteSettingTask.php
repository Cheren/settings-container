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
                ['key', '=', $key]
            ]);
        } catch (Exception $exception) {
            throw new DeleteResourceFailedException($exception->getMessage());
        }
    }
}
