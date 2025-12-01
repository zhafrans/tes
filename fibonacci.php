<?php

function fibonacci(int $n): array
{
    if ($n < 0) {
        return ['error' => 'N tidak boleh negatif'];
    }

    $series = [];
    $a = 0;
    $b = 1;

    while ($a <= $n) {
        $series[] = $a;
        $c = $a + $b;
        $a = $b;
        $b = $c;
    }

    return [
        'n'      => $n,
        'series' => $series,
        'value'  => end($series),
        'total'  => array_sum($series),
    ];
}

if (PHP_SAPI === 'cli') {
    echo "=== Fibonacci CLI ===\n";
    echo "Masukkan nilai n: ";
    $input = trim(fgets(STDIN));

    $n = (int) $input;

    $result = fibonacci($n);

    echo "\nHasil:\n";

    if (isset($result['error'])) {
        echo "Error: " . $result['error'] . "\n";
    } else {
        echo "n: " . $result['n'] . "\n";
        echo "Deret Fibonacci: " . implode(', ', $result['series']) . "\n";
        echo "Nilai terakhir: " . $result['value'] . "\n";
        echo "Total sum: " . $result['total'] . "\n";
    }
}
