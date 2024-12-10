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

namespace App\Containers\Vendor\Settings\Permissions;

use App\Containers\AppSection\Authorization\Dto\CreatePermissionDto;
use App\Containers\Vendor\Settings\Facades\Container;
use App\Ship\Access\Permission;
use Illuminate\Support\Collection;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

final class Permissions extends Permission
{
    public const MANAGE_SETTINGS = 'vendor-settings-manage-settings';

    /**
     * @return Collection
     * @throws UnknownProperties
     */
    public function getList(): Collection
    {
        return collect([
            new CreatePermissionDto([
                'name' => self::MANAGE_SETTINGS,
                'section' => $this->getSection(),
                'container' => $this->getContainer(),
                'display_name' => $this->getTranslateKey('manage_settings.name'),
                'description' => $this->getTranslateKey('manage_settings.description')
            ])
        ]);
    }

    public function getSection(): string
    {
        return Container::getSectionName();
    }

    public function getContainer(): string
    {
        return Container::getSectionName();
    }

    public function getSchemaAccessor(): ?string
    {
        return Schema::class;
    }
}
