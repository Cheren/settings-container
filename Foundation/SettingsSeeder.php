<?php

/**
 * ERP system
 *
 * This file is part of the ERM system package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license     https://kalistratov.ru/licenses/erp Proprietary license
 * @copyright   Copyright (C) kalistratov.ru, All rights reserved ©.
 * @link        https://kalistratov.ru
 * @author      Sergey Kalistratov <sergey@kalistratov.ru>
 */

namespace App\Containers\Vendor\Settings\Foundation;

use App\Containers\Vendor\Settings\Actions\CreateSettingAction;
use App\Containers\Vendor\Settings\Schema;
use App\Ship\Parents\Seeders\Seeder;
use App\Ship\Exceptions\CreateResourceFailedException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

abstract class SettingsSeeder extends Seeder
{
    /**
     * @return void
     * @throws CreateResourceFailedException
     * @throws UnknownProperties
     */
    public function run(): void
    {
        app(CreateSettingAction::class)->run($this->getSettingSchema()->seederSettings());
    }

    abstract protected function getSettingSchema(): Schema;
}
