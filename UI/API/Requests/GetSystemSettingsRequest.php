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

namespace App\Containers\Vendor\Settings\UI\API\Requests;

use App\Containers\Vendor\Settings\Requests\ApiSettingRequest;
use App\Containers\Vendor\Settings\UI\API\Transformers\SystemSettingsTransformer;
use App\Ship\Parents\Transformers\Transformer;

class GetSystemSettingsRequest extends ApiSettingRequest
{
    public function getTransformer(): Transformer
    {
        return new SystemSettingsTransformer();
    }
}
