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

namespace App\Containers\Vendor\Settings\Permissions;

use App\Containers\AppSection\Authorization\Permission\Schema\PermissionsCollection;
use App\Containers\Vendor\Settings\Permissions\Schemas\ManageSettingsSchema;
use App\Ship\Access\PermissionsSchema;

final class Schema extends PermissionsSchema
{
    /**
     * @return PermissionsCollection
     */
    public function schema(): PermissionsCollection
    {
        return $this->schema
            ->add((new ManageSettingsSchema($this))->getSchema());
    }
}
