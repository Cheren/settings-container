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

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\Vendor\Settings\Tasks\GetAllSettingsTask;
use App\Ship\Parents\Actions\Action;
use Illuminate\Pagination\LengthAwarePaginator;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllSettingsAction extends Action
{
    /**
     * @return LengthAwarePaginator
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(): LengthAwarePaginator
    {
        return app(GetAllSettingsTask::class)
            ->addRequestCriteria()
            ->ordered()
            ->run();
    }
}
