<?php
use Colors\Color;


require_once __DIR__ . '/support/libphutil/src/__phutil_library_init__.php';
require_once __DIR__ . '/vendor/autoload.php';

$files = scandir(__DIR__ . '/test');
array_shift($files);
array_shift($files);

$tests = scandir(__DIR__ . '/src/tests');
array_shift($tests);
array_shift($tests);

array_walk($tests, function(&$test) {
    $test = '\\PRB\\Linter\\Tests\\' . substr($test, 0, strrpos($test, '.'));
});
$c = new Color;

foreach ($files as $file) {
    $path = realpath(__DIR__ . '/test/' . $file);
    echo $c($path)->bold() . PHP_EOL;

    if (!xhpast_is_available()) {
        die($c(xhpast_get_build_instructions())->red()->bold() . PHP_EOL);
    }

    foreach ($tests as $test) {
        $test = new $test(__DIR__ . '/test/' . $file, '/tmp', XHPASTTree::newFromData(file_get_contents($path)));
        $nodes = explode('\\', get_class($test));
        $test_name = array_pop($nodes);
        if ($test->success) {
            echo $c($test_name . ': SUCCESS')->green() . PHP_EOL;
        }

        if (!$test->success) {
            echo $c($test_name . ': FAIL')->red() . PHP_EOL;
            ob_start();
            var_dump($test->result);
            $output = explode(PHP_EOL, ob_get_contents());
            ob_end_clean();

            array_walk($output, function(&$line) {
                $line = '    ' . $line;
            });
            echo implode(PHP_EOL, $output);
            echo PHP_EOL;
        }
    }

    echo PHP_EOL;
}
