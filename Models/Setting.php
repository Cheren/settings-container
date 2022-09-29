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

namespace App\Containers\Vendor\Settings\Models;

use App\Containers\Vendor\Settings\Data\Factories\SettingFactory;
use App\Ship\Database\Eloquent\Concerns\HasCreatedBy;
use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use JBZoo\Data\JSON as JsonData;

/**
 * @property int $id
 * @property null|int $created_by
 * @property string $key
 * @property string|int|JsonData $value
 * @property string $type
 *
 * @method static Factory|SettingFactory factory(...$parameters)
 */
class Setting extends Model
{
    use HasCreatedBy;

    public const TABLE = 'settings';
    public const TYPE_STRING = 'string';
    public const TYPE_INT = 'int';
    public const TYPE_DATA = 'data';

    public $timestamps = false;

    protected $table = self::TABLE;

    protected $fillable = [
        'key',
        'value',
        'type'
    ];

    /**
     * @param mixed $value
     * @return int|JsonData|string
     */
    public function getValueAttribute($value)
    {
        if ($this->isType(self::TYPE_DATA)) {
            return new JsonData($value);
        } elseif ($this->isType(self::TYPE_INT)) {
            return (int) $value;
        }

        return (string) $value;
    }

    public function setValueAttribute($value): void
    {
        if (is_array($value)) {
            $value = (new JsonData($value))->write();
        }

        $this->attributes['value'] = $value;
    }

    public function isType(string $type): bool
    {
        return $this->type === $type;
    }

    protected function performInsert(Builder $query)
    {
        $this->updateCreatedBy();
        return parent::performInsert($query);
    }
}
