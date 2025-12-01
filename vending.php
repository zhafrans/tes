<?php

function vendingMachine(array $money): array
{
    if (count($money) > 3) {
        return ['message' => 'Pembayaran tidak valid'];
    }

    foreach ($money as $m) {
        if (!in_array($m, [2000, 5000])) {
            return ['message' => 'Pembayaran tidak valid'];
        }
    }

    $total = array_sum($money);

    $products = [
        'Sprite'    => 5000,
        'Fanta'     => 3000,
        'Coca Cola' => 2000,
        'Mineral'   => 1000,
    ];

    $output = [];

    foreach ($products as $name => $price) {
        if ($total >= $price) {
            $qty = floor($total / $price);

            if ($qty > 0) {
                $output[] = "{$qty}x {$name}";
                $total -= $qty * $price;
            }
        }
    }

    return [
        'input'  => $money,
        'total'  => array_sum($money),
        'output' => $output
    ];
}

if (PHP_SAPI === 'cli') {
    echo "=== Vending Machine CLI ===\n";
    echo "Masukkan nominal uang (pisahkan dengan spasi, contoh: 2000 5000): ";
    $input = trim(fgets(STDIN));

    $money = array_map('intval', explode(' ', $input));

    if (empty($money) || empty($input)) {
        echo "Error: Input tidak boleh kosong\n";
        exit(1);
    }

    $result = vendingMachine($money);

    echo "\nHasil:\n";

    if (isset($result['message'])) {
        echo "Error: " . $result['message'] . "\n";
    } else {
        echo "Input: " . implode(', ', $result['input']) . "\n";
        echo "Total: " . $result['total'] . "\n";
        echo "Output: " . implode(', ', $result['output']) . "\n";
    }
}
