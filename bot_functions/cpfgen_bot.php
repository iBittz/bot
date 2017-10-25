<?php

function cpfgen()
{
    $n1 = round(rand(0, 9));
    $n2 = round(rand(0, 9));
    $n3 = round(rand(0, 9));
    $n4 = round(rand(0, 9));
    $n5 = round(rand(0, 9));
    $n6 = round(rand(0, 9));
    $n7 = round(rand(0, 9));
    $n8 = round(rand(0, 9));
    $n9 = round(rand(0, 9));
    $d1 = $n9 * 2 + $n8 * 3 + $n7 * 4 + $n6 * 5 + $n5 * 6 + $n4 * 7 + $n3 * 8 + $n2 * 9 + $n1 * 10;
    $d1 = 11 - (round($d1 - (floor($d1 / 11) * 11)));
    if ($d1 >= 10) {
        $d1 = 0;
    }
    $d2 = $d1 * 2 + $n9 * 3 + $n8 * 4 + $n7 * 5 + $n6 * 6 + $n5 * 7 + $n4 * 8 + $n3 * 9 + $n2 * 10 + $n1 * 11;
    $d2 = 11 - (round($d2 - (floor($d2 / 11) * 11)));
    if ($d2 >= 10) {
        $d2 = 0;
    }
    return $n1 . $n2 . $n3 . $n4 . $n5 . $n6 . $n7 . $n8 . $n9 . $d1 . $d2;
}

function cpfs()
{
    for ($i = 1; $i <= 5; $i++) {
        $cpf[$i] = cpfgen();
    }
    return "`" . $cpf[1] . "`\n`" . $cpf[2] . "`\n`" . $cpf[3] . "`\n`" . $cpf[4] . "`\n`" . $cpf[5] . "`";
} 