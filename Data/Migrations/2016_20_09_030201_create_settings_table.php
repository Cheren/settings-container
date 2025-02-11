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

use App\Containers\AppSection\User\Models\User;
use App\Containers\Vendor\Setting\Foundation\Setting;
use App\Containers\Vendor\Setting\Models\Setting as SettingModel;
use App\Ship\Database\Migrations\CreateSchemaTable;
use App\Ship\Database\Migrations\CreateTableMigration;
use Illuminate\Database\Schema\Blueprint;

final class CreateSettingsTable extends CreateTableMigration
{
    public function addTableColumns(Blueprint $table): CreateSchemaTable
    {
        $table->id();

        $table->string(Setting::KEY)
            ->unique();

        $table->text(Setting::VALUE);

        $table->string(Setting::TYPE, Setting::TYPE_MAX_LENGTH)
            ->default(SettingModel::TYPE_STRING);

        $table->unsignedBigInteger(CREATED_BY)
            ->nullable();

        return $this;
    }

    public function addTableColumnsForeign(Blueprint $table): CreateSchemaTable
    {
        $table->foreign(CREATED_BY, $this->getFieldForeignKeyName(CREATED_BY))
            ->on(User::TABLE)
            ->references(ID);

        return $this;
    }

    public function addTableColumnsIndex(Blueprint $table): CreateSchemaTable
    {
        $table->index(Setting::KEY, $this->getFieldIndexName(Setting::KEY));
        return $this;
    }

    public function getTableName(): string
    {
        return SettingModel::TABLE;
    }
}
