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

namespace App\Containers\Vendor\Setting\Models;

use Apiato\Core\Contracts\HasResourceKey;
use App\Containers\Vendor\Setting\Data\Factories\SettingFactory;
use App\Containers\Vendor\Setting\Foundation\Setting as BaseSetting;
use App\Ship\Database\Eloquent\Concerns\HasCreatedBy;
use App\Ship\Parents\Models\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use JBZoo\Data\JSON as JsonData;

/**
 * @property int $id Уникальный идентификатор.
 * @property string $key Уникальный ключ.
 * @property string|int|JsonData $value Установленные значения.
 * @property string $type Тип.
 * @property null|int $created_by Уникальный идентификатор пользователя которы создал.
 *
 * @method static Factory|SettingFactory factory(...$parameters)
 */
class Setting extends Model implements HasResourceKey
{
    use HasCreatedBy;

    public const TABLE = 'settings';
    public const RESOURCE_KEY = 'Setting';
    public const TYPE_STRING = 'string';
    public const TYPE_INT = 'int';
    public const TYPE_DATA = 'data';

    public $timestamps = false;

    protected $table = self::TABLE;
    protected string $resourceKey = self::RESOURCE_KEY;

    protected $fillable = [
        BaseSetting::KEY,
        BaseSetting::VALUE,
        BaseSetting::TYPE
    ];


    /**
     * @param mixed $value
     * @return int|JsonData|string
     */
    public function getValueAttribute(mixed $value): int|JsonData|string
    {
        if ($this->isType(self::TYPE_DATA)) {
            return new JsonData($value);
        } elseif ($this->isType(self::TYPE_INT)) {
            return (int)$value;
        }

        return (string)$value;
    }

    public function setValueAttribute($value): void
    {
        if (is_array($value)) {
            $value = (new JsonData($value))->write();
        }

        $this->attributes[BaseSetting::VALUE] = $value;
    }

    public function isType(string $type): bool
    {
        return $this->type === $type;
    }

    protected function performInsert(Builder $query): bool
    {
        $this->updateCreatedBy();
        return parent::performInsert($query);
    }
}
