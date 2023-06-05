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

namespace App\Containers\Vendor\Settings\Data\Criterias;

use App\Containers\Vendor\Settings\Manager;
use App\Containers\Vendor\Settings\Schema;
use App\Ship\Parents\Criterias\Criteria;
use Illuminate\Database\Eloquent\Builder;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

final class IsSystemSettingsCriteria extends Criteria
{
    /**
     * @param Builder $model
     * @param PrettusRepositoryInterface $repository
     * @return Builder
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function apply($model, PrettusRepositoryInterface $repository)
    {
        $manager = Manager::getInstance();

        $keys = collect();

        $manager
            ->all()
            ->each(function (Schema $settingSchema) use ($keys) {
                $keys->add($settingSchema->getKey());
            });

        return $model->whereIn('key', $keys->toArray());
    }
}
