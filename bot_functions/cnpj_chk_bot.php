 <?php

function cnpj_chk($cnpj)
{
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.receitaws.com.br/v1/cnpj/" . $cnpj);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    $dados = curl_exec($ch);
    curl_close($ch);
    
    if (strpos($dados, "atividade_principal") !== false) {
        
        $json_str = json_decode($dados);
        
        $str_array1 = $json_str->{"atividade_principal"};     
        $str_a = $str_array1[0]->{"text"};
        $str_b = $json_str->{"data_situacao"};
        $str_c = $json_str->{"nome"};
        $str_d = $json_str->{"uf"};
        $str_e = $json_str->{"telefone"};
        
        $str_array2 = $json_str->{"qsa"};     
        $qual        = $str_array2[0]->{"qual"} == "" ? "N/A" : $str_array2[0]->{"qual"};
        $socio_admin = $str_array2[0]->{"nome"} == "" ? "N/A" : $str_array2[0]->{"nome"};
        
        $str_f = $json_str->{"situacao"};
        $str_g = $json_str->{"bairro"} == "" ? "N/A" : $json_str->{"bairro"};
        $str_h = $json_str->{"logradouro"} == "" ? "N/A" : $json_str->{"logradouro"};
        $str_i = $json_str->{"numero"} == "" ? "N/A" : $json_str->{"numero"};
        $str_j = $json_str->{"cep"};
        $str_k = $json_str->{"municipio"};
        $str_l = $json_str->{"abertura"};
        $str_m = $json_str->{"natureza_juridica"};
        $str_n = $json_str->{"fantasia"};
        $str_o = $json_str->{"cnpj"};
        $str_p = $json_str->{"ultima_atualizacao"};
        $str_q = $json_str->{"status"};
        $str_r = $json_str->{"tipo"};
        $str_t = $json_str->{"email"} == "" ? "N/A" : $json_str->{"email"};
        $str_y = $json_str->{"capital_social"};
        
        return "*CNPJ:* `$str_o`\n*Atividade Principal:* `$str_a`\n*Nome:* `$str_c`\n*Dt. Situação:* `$str_b`\n*UF:* `$str_d`\n*Tel:* `$str_e`\n*Qual:* `$qual`\n*Nome:* `$socio_admin`\n*Situação:* `$str_f`\n*Bairro:* `$str_g`\n*Logradouro:* `$str_h`\n*Número:* `$str_i`\n*CEP:* `$str_j`\n*Cidade:* `$str_k`\n*Abertura:* `$str_l`\n*Nat. Jurídica:* `$str_m`\n*Fantasia:* `$str_n`\n*Ultima Atualiz:* `$str_p`\n*Status:* `$str_q`\n*Tipo:* `$str_r`\n*E-mail:* `$str_t`\n*Capital Social:* `$str_y`";
        
    } else {
        return "*CNPJ Inválido!*";
    }
} 