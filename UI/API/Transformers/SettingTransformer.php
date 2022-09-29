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

namespace App\Containers\Vendor\Settings\UI\API\Transformers;

use App\Containers\Vendor\Settings\Models\Setting;
use App\Ship\Parents\Transformers\Transformer;

class SettingTransformer extends Transformer
{
    public function transform(Setting $entity): array
    {
        $response = [
            'object' => 'Setting',
            'id' => $entity->getHashedKey(),
            'key' => $entity->key,
            'value' => $entity->value
        ];

        return $this->ifAdmin([
            'real_id' => $entity->id,
            'real_created_by' => $entity->created_by
        ], $response);
    }
}
