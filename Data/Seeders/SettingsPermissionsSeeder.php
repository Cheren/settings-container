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

namespace App\Containers\Vendor\Settings\Data\Seeders;

use App\Containers\AppSection\Authorization\Dto\CreatePermissionDto;
use App\Containers\AppSection\Authorization\Tasks\CreatePermissionTask;
use App\Containers\Vendor\Settings\Access\SettingsPermissions;
use App\Ship\Parents\Seeders\Seeder;
use App\Ship\Exceptions\CreateResourceFailedException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class SettingsPermissionsSeeder extends Seeder
{
    /**
     * @return void
     * @throws CreateResourceFailedException
     * @throws UnknownProperties
     */
    public function run(): void
    {
        $createPermissionTask = app(CreatePermissionTask::class);

        (new SettingsPermissions())
            ->getList()
            ->each(function (CreatePermissionDto $permissionDto) use ($createPermissionTask) {
                $createPermissionTask->run($permissionDto);
            });
    }
}
