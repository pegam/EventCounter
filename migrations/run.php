<?php

require_once __DIR__ . '/../autoloader/autoloader.php';

$executed = require __DIR__ . '/executed.php';

$migrationFileNames = [];
foreach (scandir(__DIR__) as $fileName) {
    if ($fileName !== '.' && $fileName !== '..' && !in_array($fileName, $executed)
        && preg_match('/^\\d+_\\w+\\.php$/', $fileName)
    ) {
        $migrationFileNames[] = $fileName;
    }
}
sort($migrationFileNames, SORT_NATURAL);

foreach ($migrationFileNames as $migrationFileName) {
    require __DIR__ . '/' . $migrationFileName;
    list(, $className) = explode('_', basename($migrationFileName, '.php'));
    if (class_exists($className)) {
        $migration = new $className;
        if ($migration instanceof MigrationInterface) {
            $migration->up();
            $executed[] = $migrationFileName;
        }
    }
}

file_put_contents(__DIR__ . '/executed.php', "<?php\n\nreturn " . var_export($executed, true) . ';');