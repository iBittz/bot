<?php
/***************************************************
 *               4devs Tools Bot      *
 *             Created by N1ghtm4R3
 *             https://t.me/MrBanker         *
 * 
 *         UPDATED 04/10/2017 PHP 7.1 </>
 *                         Perfect-Carders
 ***************************************************/

function gerar_conta_bancaria()
{
    GLOBAL $dev_link;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.4devs.com.br/ferramentas_online.php");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:55.0) Gecko/20100101 Firefox/55.0",
        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
        "Connection: keep-alive"
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
        "acao" => "gerar_conta_bancaria",
        "estado" => "",
        "banco" => ""
    )));
    $dados = curl_exec($ch);
    curl_close($ch);
    
    if (strpos($dados, 'Banco') !== false) {
        preg_match_all("(id=\"banco\" value=\"(.*)\")siU", $dados, $match1);
        preg_match_all("(id=\"cidade\" value=\"(.*)\")siU", $dados, $match2);
        preg_match_all("(id=\"estado\" value=\"(.*)\")siU", $dados, $match3);
        preg_match_all("(id=\"agencia\" value=\"(.*)\")siU", $dados, $match4);
        preg_match_all("(id=\"conta_corrente\" value=\"(.*)\")siU", $dados, $match5);
        
        $banco   = trim($match1[1][0]);
        $cidade  = trim($match2[1][0]);
        $estado  = trim($match3[1][0]);
        $agencia = trim($match4[1][0]);
        $conta   = trim($match5[1][0]);
        
        return "*Banco:* `$banco`\n*Cidade:* `$cidade`\n*Estado:* `$estado`\n*Agência:* `$agencia`\n*Conta Corrente:* `$conta`";
    } else {
        return "*ERRO DESCONHECIDO, use o comando novamente! Se o problema pessistir, notifique meu* [desenvolvedor.]($dev_link)";
    }
}

function gerar_dados_pessoais($sexo)
{
    GLOBAL $dev_link;

    if ($sexo == "f") {
        $rtn = "M"; // feminino
    }
    if ($sexo == "m") {
        $rtn = "H"; // masculino
    }
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.4devs.com.br/ferramentas_online.php");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:55.0) Gecko/20100101 Firefox/55.0",
        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
        "Connection: keep-alive"
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
        "acao" => "gerar_pessoa",
        "sexo" => $rtn,
        "idade" => mt_rand(18, 45),
        "pontuacao" => "S",
        "cep_estado" => "",
        "cep_cidade" => ""
    )));
    $dados = curl_exec($ch);
    curl_close($ch);
    
    if (strpos($dados, 'DADOS PESSOAIS') !== false) {
        
        preg_match_all("(id=\"nome\" value=\"(.*)\")siU", $dados, $match1);
        preg_match_all("(id=\"cpf\" value=\"(.*)\")siU", $dados, $match2);
        preg_match_all("(id=\"rg\" value=\"(.*)\")siU", $dados, $match3);
        preg_match_all("(id=\"data_nasc\" value=\"(.*)\")siU", $dados, $match4);
        preg_match_all("(id=\"signo\" value=\"(.*)\")siU", $dados, $match5);
        preg_match_all("(id=\"cep\" value=\"(.*)\")siU", $dados, $match6);
        preg_match_all("(id=\"endereco\" value=\"(.*)\")siU", $dados, $match7);
        preg_match_all("(id=\"numero\" value=\"(.*)\")siU", $dados, $match8);
        preg_match_all("(id=\"bairro\" value=\"(.*)\")siU", $dados, $match9);
        preg_match_all("(id=\"cidade\" value=\"(.*)\")siU", $dados, $match10);
        preg_match_all("(id=\"estado\" value=\"(.*)\")siU", $dados, $match11);
        preg_match_all("(id=\"telefone_fixo\" value=\"(.*)\")siU", $dados, $match12);
        preg_match_all("(id=\"celular\" value=\"(.*)\")siU", $dados, $match13);
        
        $nome     = trim($match1[1][0]);
        $cpf      = trim($match2[1][0]);
        $rg       = trim($match3[1][0]);
        $dt_nasc  = trim($match4[1][0]);
        $signo    = trim($match5[1][0]);
        $cep      = trim($match6[1][0]);
        $endereco = trim($match7[1][0]);
        $numero   = trim($match8[1][0]);
        $bairro   = trim($match9[1][0]);
        $cidade   = trim($match10[1][0]);
        $estado   = trim($match11[1][0]);
        $telefone = trim($match12[1][0]);
        $celular  = trim($match13[1][0]);
        
        return "*Nome:* `$nome`\n*CPF:* `$cpf`\n*RG:* `$rg`\n*Dt. Nasc:* `$dt_nasc`\n*Signo:* `$signo`\n*CEP:* `$cep`\n*Endereço:* `$endereco`\n*Número:* `$numero`\n*Bairro:* `$bairro`\n*Cidade:* `$cidade`\n*Estado:* `$estado`\n*Telefone:* `$telefone`\n*Celular:* `$celular`";
    } else {
        return "*ERRO DESCONHECIDO, use o comando novamente! Se o problema pessistir, notifique meu* [desenvolvedor.]($dev_link)";
    }
}

function gerar_cep()
{
    GLOBAL $dev_link;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.4devs.com.br/ferramentas_online.php");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64; rv:55.0) Gecko/20100101 Firefox/55.0",
        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
        "Connection: keep-alive"
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
        "acao" => "gerar_cep",
        "cep_estado" => "",
        "cep_cidade" => "",
        "somente_numeros" => "S"
    )));
    $dados = curl_exec($ch);
    curl_close($ch);
    
    if (strpos($dados, 'CEP:') !== false) {
        preg_match_all("(id=\"cep\" value=\"(.*)\")siU", $dados, $match1);
        preg_match_all("(id=\"endereco\" value=\"(.*)\")siU", $dados, $match2);
        preg_match_all("(id=\"bairro\" value=\"(.*)\")siU", $dados, $match3);
        preg_match_all("(id=\"cidade\" value=\"(.*)\")siU", $dados, $match4);
        preg_match_all("(id=\"estado\" value=\"(.*)\")siU", $dados, $match5);
        
        $cep      = trim($match1[1][0]);
        $endereco = trim($match2[1][0]);
        $bairro   = trim($match3[1][0]);
        $cidade   = trim($match4[1][0]);
        $estado   = trim($match5[1][0]);
        
        return "*CEP:* `$cep`\n*Endereço:* `$endereco`\n*Bairro:* `$bairro`\n*Cidade:* `$cidade`\n*Estado:* `$estado`";
    } else {
        return "*ERRO DESCONHECIDO, use o comando novamente! Se o problema pessistir, notifique meu* [desenvolvedor.]($dev_link)";
    }
}