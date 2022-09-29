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
use App\Containers\Vendor\Settings\Models\Setting;
use App\Ship\Database\Migrations\CreateSchemaTable;
use App\Ship\Database\Migrations\CreateTableMigration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends CreateTableMigration
{
    public function addTableColumns(Blueprint $table): CreateSchemaTable
    {
        $table->id();

        $table->string('key')
            ->unique();

        $table->text('value');

        $table->string('type', 10)
            ->default(Setting::TYPE_STRING);

        $table->unsignedBigInteger('created_by')
            ->nullable();

        return $this;
    }

    public function addTableColumnsForeign(Blueprint $table): CreateSchemaTable
    {
        $table->foreign('created_by', 'setting_created_by_fk')
            ->on(User::TABLE)
            ->references('id');

        return $this;
    }

    public function addTableColumnsIndex(Blueprint $table): CreateSchemaTable
    {
        $table->index('key', 'setting_key_index');
        return $this;
    }

    public function getTableName(): string
    {
        return Setting::TABLE;
    }
}
