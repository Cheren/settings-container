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

namespace App\Containers\Vendor\Settings;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Ship\Foundation\AbstractManager;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\Finder;

/**
 * @method Schema get(string $key)
 * @method static Manager getInstance()
 */
final class Manager extends AbstractManager
{
    public const PREFIX = 'Settings';

    public function getItemAccessor(): string
    {
        return Schema::class;
    }

    public function getPaths(): array
    {
        $paths = collect();
        foreach (Apiato::getAllContainerPaths() as $containerPath) {
            $containerSettingsPath = $containerPath . '/' . self::PREFIX;
            if (File::isDirectory($containerSettingsPath)) {
                $paths->add($containerSettingsPath);
            }
        }

        return $paths->toArray();
    }

    protected function onRegisterItem(string $className): void
    {
        /** @var Schema $item */
        $item = new $className();
        $this->items->put($item->getKey(), $item);
    }

    protected function findFiles(): Finder
    {
        $finder = new Finder();
        $paths = $this->getPaths();

        if (count($paths)) {
            $finder
                ->files()
                ->followLinks()
                ->in($this->getPaths())
                ->notName('/^' . self::PREFIX . '\.php/')
                ->name('*' . self::PREFIX . '.php');
        }

        return $finder;
    }
}
