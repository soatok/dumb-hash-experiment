<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

/*
 * Select two random strings:
 */
$m_1 = random_bytes(8);
$m_2 = random_bytes(8);

/*
 * Continue until we reach a collision
 */
$h1 = dumb_hash($m_1, true);
$h2 = dumb_hash($m_2, true);
$iterations = 0;
$carry = 0;
$found = false;
do {
    $h1 = dumb_hash($h1, true);
    $h2 = dumb_hash($h2, true);
    ++$iterations;

    if ($h1 === $h2) {
        $found = true;
        break;
    }
    if ($iterations === PHP_INT_MAX) {
        ++$carry;
        $iterations = 0;
    }
} while (!$found && $carry < 2);

if ($found) {
    if ($carry > 0) {
        echo "Iterations required: ({$carry} * PHP_INT_MAX) + {$iterations}\n";
    } else {
        echo 'Iterations required: ', $iterations, PHP_EOL;
    }
    echo 'Converged hash: ', sodium_bin2hex($h1), PHP_EOL;
} else {
    echo 'No convergence!', PHP_EOL;
}

echo "\t", 'm_1 = ', sodium_bin2hex($m_1), PHP_EOL;
echo "\t", 'm_2 = ', sodium_bin2hex($m_2), PHP_EOL;
exit ($found ? 1 : 0);
