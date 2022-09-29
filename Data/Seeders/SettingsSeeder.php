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

use App\Containers\AppSection\Authorization\Tasks\CreatePermissionTask;
use App\Containers\Vendor\Settings\Access\SettingsPermissions;
use App\Ship\Parents\Seeders\Seeder;
use App\Ship\Exceptions\CreateResourceFailedException;

class SettingsSeeder extends Seeder
{
    /**
     * @throws CreateResourceFailedException
     */
    public function run(): void
    {
        $this->createPermissions();
    }

    /**
     * @return $this
     * @throws CreateResourceFailedException
     */
    protected function createPermissions(): self
    {
        $createPermissionTask = app(CreatePermissionTask::class);

        $createPermissionTask->run(
            SettingsPermissions::CRUD,
            __('vendor@settings::settings.permission.crud')
        );

        return $this;
    }
}
