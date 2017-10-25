<?php

function gerar_senha()
{
    
    $tamanho = mt_rand(8, 16);
    
    $mi = "abcdefghijklmnopqrstuvyxwz";
    $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ";
    $si = "?!@#$%&*()_+=\/}{][";
    $nu = "0123456789";
    
    $caractere .= str_shuffle($mi);
    $caractere .= str_shuffle($ma);
    $caractere .= str_shuffle($si);
    $caractere .= str_shuffle($nu);
    
    $senha = substr(str_shuffle($caractere), 0, $tamanho);
    
    return utf8_encode($senha);
}

function senhas()
{
    for ($i = 1; $i <= 5; $i++) {
        $pass[$i] = gerar_senha();
    }
    return "`" . $pass[1] . "`\n`" . $pass[2] . "`\n`" . $pass[3] . "`\n`" . $pass[4] . "`\n`" . $pass[5] . "`";
} 