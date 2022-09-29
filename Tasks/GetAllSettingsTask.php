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

use App\Containers\Vendor\Settings\Data\Criterias\OrderByKeyAscendingCriteria;
use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllSettingsTask extends SettingTask
{
    public function run(): LengthAwarePaginator
    {
        return $this->repository->paginate();
    }

    /**
     * @return $this
     * @throws RepositoryException
     */
    public function ordered(): self
    {
        $this->repository->pushCriteria(new OrderByKeyAscendingCriteria());
        return $this;
    }
}
