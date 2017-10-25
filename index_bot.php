<?php
/***************************************************
 *               BANKER ROBOT v1.5      *
 *             Created by N1ghtm4R3
 *             https://t.me/MrBanker         *
 * 
 *      Open-Source: 23/09/2017 PHP 7.1 </>
 *                         Perfect-Carders
 ***************************************************/

# incluir funções
include("bot_functions/binchk_bot.php");
include("bot_functions/ipchk_bot.php");
include("bot_functions/ccgen_bot.php");
include("bot_functions/cotacoes_bot.php");
include("bot_functions/dadosUSA_bot.php");
include("bot_functions/cpfgen_bot.php");
include("bot_functions/bingen_bot.php");
include("bot_functions/4devs_tools_bot.php");
include("bot_functions/base64_bot.php");
include("bot_functions/gerar_senha_bot.php");
include("bot_functions/cnpj_chk_bot.php");
include("bot_functions/tcpvpn_bot.php");
include("bot_functions/cpfchk_bot.php");

# requer a função api_resquest, opcional.
require "api_request.php";

# definir constantes | bot config
define('BOT_TOKEN', '160061522:AAGkY4gJKuuh6DQRZKpMNJQTCHUJAf7MU4w'); # bot token
define('API_URL', 'https://api.telegram.org/bot' . BOT_TOKEN . '/'); # telegram api url
define('WEBHOOK_URL', 'https://seu-server.com/index_bot.php'); # webhook url

# var's de informações
$bot_name = "Banker Robot";
$bot_user = "@BankerRobot";
$versao   = "1.5";
$dt_up    = "10/10/2017";
$dev_name = "N1ghtm4R3";
$dev_link = "https://t.me/MrBanker";
$canal_id = "@PerfectCarders"; # ID ou @Username publico do canal que o bot é admin
$admin_id = "250108553"; # ID do admin deste robo (para postar no canal)

# habilitar registro de logs (true = sim ou false = não)
$bot_log = false; # veja a linha 469

function Robot($get)
{
    if (isset($get["text"])) {
        # definir variáveis de identificação e recebimento de dados
        $message_id = $get["message_id"];
        $chat_id    = $get["chat"]["id"];
        $texto      = $get["text"];
        
        # separar comando dos dados inseridos pelo user
        list($str_cmd, $dados) = explode(" ", $texto, 2);
        
        # tratar variavel para receber os comandos:
        $comando = strtolower(trim($str_cmd));
        
        # tratar e enviar dados para as funções
        $bin_chk        = substr(trim($dados), 0, 6);
        $bin            = strtolower(trim($dados));
        $GLOBALS["bin"] = $bin;
        $ip             = trim($dados);
        $sexo           = strtolower(substr(trim($dados), 0, 1));
        $cnpj           = substr(trim($dados), 0, 14);
        $country        = strtolower(substr(trim($dados), 0, 2));
        $cpf            = substr(trim($dados), 0, 11);
        
        # obter informações de usuarios c: /id
        $nome     = $get["from"]["first_name"];
        $id       = $get["from"]["id"];
        $username = $get["from"]["username"];
        $user     = $username == "" ? "N/A" : "@$username";
        $tipo     = $get["chat"]["type"];
        $idioma   = $get["from"]["language_code"];
        
        # comandos do robô
        switch ($comando) {
            case "/start":
                apiRequest("sendMessage", array(
                    "chat_id" => $chat_id,
                    "parse_mode" => "Markdown",
                    "text" => "Olá *$nome!* \u{1F916}\n\nEu sou o *Banker Robot* programado para lhe ajudar com diversas ferramentas Carding de forma rápida e eficiente!\n\nUse o comando /tools para obter minha lista de funções. \u{1F3E6}"
                ));
                break;
            
            case "/tools":
            case "/tools@bankerrobot":
                apiRequest("sendMessage", array(
                    "chat_id" => $chat_id,
                    "reply_to_message_id" => $message_id,
                    "parse_mode" => "Markdown",
                    "text" => "\u{2699} *Minhas Ferramentas:*\n\n*1. Checar BINs:*\nExemplo: _/bin BIN_\n`/bin 552289`\n\n*2. Gerar Cartões:*\nExemplo: _/ccgen BIN_\n`/ccgen 552289`\n\n*3. Checar IP:*\nExemplo: _/ip HOST_\n`/ip google.com`\n\n*4. Gerar D. Pessoais:*\nBR M: `/dados_br M`\nBR F: `/dados_br F`\nUSA: `/dados_usa`\n\n*5. Cota de Moedas:*\nBitcoin: `/altcoins`\nDólar: `/cotacoes`\n\n*6. Gerar CPFs:* `/cpfgen`\n\n*7. Gerar CEP:* `/cepgen`\n\n*8. Gerar BINs:*\n_Aleatório:_ `/bins_gen`\n_MasterCard:_ `/bins_mc`\n_Visa:_ `/bins_visa`\n_Discover:_ `/bins_disc`\n_Amex:_ `/bins_amex`\n\n*9. Base64:*\nCodificar: `/b64_cod texto`\nDecodificar: `/b64_dec (HASH)`\n\n*10. Gerar C. Bancária:*\n `/conta_bancaria`\n\n*11. Gerar Senhas:*\n`/gerar_senha`\n\n*12. Checar CNPJ:*\n`/cnpj 00000000000191`\n\n*13. Gerar Contas SSH:*\nUS: `/tcpvpn us`\nCA: `/tcpvpn ca`\nUK: `/tcpvpn uk`\nSG: `/tcpvpn sg`\nFR: `/tcpvpn fr`\n\n*14. Checar CPF:*\n`/cpf 08985444751`\n\n*# Extras:* /id\n*# Sobre:* /whoami\n*Perfect-Carders* \u{1F1E7}\u{1F1F7}"
                ));
                break;
            
            case "/whoami":
            case "/whoami@bankerrobot":
                apiRequest("sendMessage", array(
                    "chat_id" => $chat_id,
                    "reply_to_message_id" => $message_id,
                    "parse_mode" => "Markdown",
                    "disable_web_page_preview" => 1,
                    "text" => "*Nome:* `" . $GLOBALS["bot_name"] . "`\n*Versão:* `" . $GLOBALS["versao"] . "`\n*Desenvolvedor:* [" . $GLOBALS["dev_name"] . "](" . $GLOBALS["dev_link"] . ")\n*Criado em:*  `03/04/2017`\n*Última atualiz:* `" . $GLOBALS["dt_up"] . "`\n*Canal:* [PerfectCarders](https://t.me/PerfectCarders)\n*Grupo 1:* [CardingGroup](https://t.me/CardingGroup)\n*Grupo 2:* [Coder Zone](https://t.me/CoderZone)\n*Termos:* /termos\n*Source:* /getsource\n\n*Endereço Bitcoin:*\n`1C7WmJfPHS5C87eDxAyjFWj9k9PsnVgk7N`"
                ));
                break;
            
            case "/termos":
            case "/termos@bankerrobot":
                apiRequest("sendMessage", array(
                    "chat_id" => $chat_id,
                    "reply_to_message_id" => $message_id,
                    "parse_mode" => "Markdown",
                    "text" => "*Termos de Uso:*\n\nAo utilizar este robô, você concorda automaticamente com os seguintes termos e condições.\n\n*Última Edição:* _23/04/2017_\n\n*GERAL*\n1. O Perfect-Carders está tentando garantir a disponibilidade contínua deste serviço. No entanto, não existe nenhuma reivindicação de disponibilidade constante. Todos os serviços relacionados com este serviço serão fornecidos apenas de forma voluntária.\n2. A má utilização dos dados emitidos pelo Robô está totalmente por sua responsabilidade, isto refere-se, em particular, à funcionalidade e disponibilidade de conteúdos de terceiros, bem como danos causados ​​pelo uso dos mesmos. Nós não assumiremos qualquer infração por parte do usuário e nem podemos garantir a sua segurança ao usar este serviço, use por sua conta e risco.\n\n*# NOTA:* Nossos termos e condições podem ser alterados a qualquer momento sem qualquer notificação e você concordará automaticamente com eles.\n\n*Perfect-Carders* \u{1F4B3}\n©2015-2017"
                ));
                break;
            
            case "/bin":
                if (!is_numeric($bin_chk)) {
                    apiRequest("sendMessage", array(
                        "chat_id" => $chat_id,
                        "reply_to_message_id" => $message_id,
                        "parse_mode" => "Markdown",
                        "text" => "*Formato inválido!*\n*Exemplo:* `/bin 552289`"
                    ));
                } else {
                    apiRequest("sendMessage", array(
                        "chat_id" => $chat_id,
                        "reply_to_message_id" => $message_id,
                        "parse_mode" => "Markdown",
                        "disable_web_page_preview" => 1,
                        "text" => BIN_Chk($bin_chk) . "\n\n" . $GLOBALS["bot_user"] . ""
                    ));
                }
                break;
            
            case "/ccgen":
                if (!empty($bin)) {
                    apiRequest("sendMessage", array(
                        "chat_id" => $chat_id,
                        "reply_to_message_id" => $message_id,
                        "parse_mode" => "Markdown",
                        "text" => CCs($bin) . "\n\n" . $GLOBALS["bot_user"] . ""
                    ));
                } else {
                    apiRequest("sendMessage", array(
                        "chat_id" => $chat_id,
                        "reply_to_message_id" => $message_id,
                        "parse_mode" => "Markdown",
                        "text" => "*Formato inválido!*\n*Exemplo:* `/ccgen 552289`"
                    ));
                }
                break;
            
            case "/ip":
                if (!empty($ip)) {
                    apiRequest("sendMessage", array(
                        "chat_id" => $chat_id,
                        "reply_to_message_id" => $message_id,
                        "parse_mode" => "Markdown",
                        "text" => IP_Chk($ip) . "\n\n" . $GLOBALS["bot_user"] . ""
                    ));
                } else {
                    apiRequest("sendMessage", array(
                        "chat_id" => $chat_id,
                        "reply_to_message_id" => $message_id,
                        "parse_mode" => "Markdown",
                        "text" => "*Formato inválido!*\n*Exemplo:* `/ip google.com`"
                    ));
                }
                break;
            
            case "/dados_usa":
                apiRequest("sendMessage", array(
                    "chat_id" => $chat_id,
                    "reply_to_message_id" => $message_id,
                    "parse_mode" => "Markdown",
                    "text" => dadosUSA() . "\n\n" . $GLOBALS["bot_user"] . ""
                ));
                break;
            
            case "/cotacoes":
                apiRequest("sendMessage", array(
                    "chat_id" => $chat_id,
                    "reply_to_message_id" => $message_id,
                    "parse_mode" => "Markdown",
                    "text" => cotacoes() . "\n\n" . $GLOBALS["bot_user"] . ""
                ));
                break;
            
            case "/altcoins":
                apiRequest("sendMessage", array(
                    "chat_id" => $chat_id,
                    "reply_to_message_id" => $message_id,
                    "parse_mode" => "Markdown",
                    "text" => criptomoedas() . "\n\n" . $GLOBALS["bot_user"] . ""
                ));
                break;
            
            case "/id":
            case "/id@bankerrobot":
                apiRequest("sendMessage", array(
                    "chat_id" => $chat_id,
                    "reply_to_message_id" => $message_id,
                    "parse_mode" => "Html",
                    "text" => "<b>Nome:</b> <code>$nome</code>\n<b>ID:</b> <code>$id</code>\n<b>User:</b> $user\n<b>Tipo Chat:</b> <code>$tipo</code>\n<b>Idioma:</b> <code>$idioma</code>\n\n" . $GLOBALS["bot_user"] . ""
                ));
                break;
            
            case "/cpfgen":
                apiRequest("sendMessage", array(
                    "chat_id" => $chat_id,
                    "reply_to_message_id" => $message_id,
                    "parse_mode" => "Markdown",
                    "text" => cpfs() . "\n\n" . $GLOBALS["bot_user"] . ""
                ));
                break;
            
            case "/cepgen":
                apiRequest("sendMessage", array(
                    "chat_id" => $chat_id,
                    "reply_to_message_id" => $message_id,
                    "parse_mode" => "Markdown",
                    "disable_web_page_preview" => 1,
                    "text" => gerar_cep() . "\n\n" . $GLOBALS["bot_user"] . ""
                ));
                break;
            
            case "/bins_gen":
                apiRequest("sendMessage", array(
                    "chat_id" => $chat_id,
                    "reply_to_message_id" => $message_id,
                    "parse_mode" => "Markdown",
                    "text" => bins_gen() . "\n\n" . $GLOBALS["bot_user"] . ""
                ));
                break;
            
            case "/bins_mc":
                apiRequest("sendMessage", array(
                    "chat_id" => $chat_id,
                    "reply_to_message_id" => $message_id,
                    "parse_mode" => "Markdown",
                    "text" => bins_mc() . "\n\n" . $GLOBALS["bot_user"] . ""
                ));
                break;
            
            case "/bins_visa":
                apiRequest("sendMessage", array(
                    "chat_id" => $chat_id,
                    "reply_to_message_id" => $message_id,
                    "parse_mode" => "Markdown",
                    "text" => bins_visa() . "\n\n" . $GLOBALS["bot_user"] . ""
                ));
                break;
            
            case "/bins_amex":
                apiRequest("sendMessage", array(
                    "chat_id" => $chat_id,
                    "reply_to_message_id" => $message_id,
                    "parse_mode" => "Markdown",
                    "text" => bins_amex() . "\n\n" . $GLOBALS["bot_user"] . ""
                ));
                break;
            
            case "/bins_disc":
                apiRequest("sendMessage", array(
                    "chat_id" => $chat_id,
                    "reply_to_message_id" => $message_id,
                    "parse_mode" => "Markdown",
                    "text" => bins_disc() . "\n\n" . $GLOBALS["bot_user"] . ""
                ));
                break;
            
            case "/post":
                if ($id == $GLOBALS["admin_id"]) {
                    if (!empty($dados)) {
                        apiRequest("sendMessage", array(
                            "chat_id" => $GLOBALS["canal_id"],
                            "parse_mode" => "Markdown",
                            "text" => $dados
                        ));
                        apiRequest("sendMessage", array(
                            "chat_id" => $chat_id,
                            "reply_to_message_id" => $message_id,
                            "parse_mode" => "Markdown",
                            "text" => $dados
                        ));
                    } else {
                        apiRequest("sendMessage", array(
                            "chat_id" => $chat_id,
                            "reply_to_message_id" => $message_id,
                            "disable_web_page_preview" => 1,
                            "parse_mode" => "Html",
                            "text" => "<b>$nome</b> as suas ordens! Para postar algum texto no canal PerfectCarders use o seguinte comando:\n<code>/post seu-texto</code>\n\nSuporta Markdown!\n<b>*Negrito*</b>\n<i>_Itálico_</i>\n<code>`Código`</code>\n<a href='https://t.me/PerfectCarders'>[LINK](https://t.me/PerfectCarders)</a>\n\nPerfectCarders \u{1F1E7}\u{1F1F7}"
                        ));
                    }
                }
                break;
            
            case "/conta_bancaria":
                apiRequest("sendMessage", array(
                    "chat_id" => $chat_id,
                    "reply_to_message_id" => $message_id,
                    "parse_mode" => "Markdown",
                    "disable_web_page_preview" => 1,
                    "text" => gerar_conta_bancaria() . "\n\n" . $GLOBALS["bot_user"] . ""
                ));
                break;
            
            case "/dados_br":
                if ($sexo == "m" || $sexo == "f") {
                    apiRequest("sendMessage", array(
                        "chat_id" => $chat_id,
                        "reply_to_message_id" => $message_id,
                        "parse_mode" => "Markdown",
                        "disable_web_page_preview" => 1,
                        "text" => gerar_dados_pessoais($sexo) . "\n\n" . $GLOBALS["bot_user"] . ""
                    ));
                } else {
                    apiRequest("sendMessage", array(
                        "chat_id" => $chat_id,
                        "reply_to_message_id" => $message_id,
                        "parse_mode" => "Markdown",
                        "text" => "*Formato inválido!*\n*Você deve especificar o Sexo:*\nMasculino: `/dados_br M`\nFeminino: `/dados_br F`"
                    ));
                }
                break;
            
            case "/b64_cod":
                if (!empty($dados)) {
                    apiRequest("sendMessage", array(
                        "chat_id" => $chat_id,
                        "reply_to_message_id" => $message_id,
                        "parse_mode" => "Markdown",
                        "text" => b64_encode($dados)
                    ));
                } else {
                    apiRequest("sendMessage", array(
                        "chat_id" => $chat_id,
                        "reply_to_message_id" => $message_id,
                        "parse_mode" => "Markdown",
                        "text" => "*Formato inválido!*\n*Exemplo:* `/b64_cod seu-texto`"
                    ));
                }
                break;
            
            case "/b64_dec":
                if (!empty($dados)) {
                    apiRequest("sendMessage", array(
                        "chat_id" => $chat_id,
                        "reply_to_message_id" => $message_id,
                        "text" => b64_decode($dados)
                    ));
                } else {
                    apiRequest("sendMessage", array(
                        "chat_id" => $chat_id,
                        "reply_to_message_id" => $message_id,
                        "parse_mode" => "Markdown",
                        "text" => "*Formato inválido!*\n*Exemplo:* `/b64_dec hash-base64`"
                    ));
                }
                break;
            
            case "/gerar_senha":
                apiRequest("sendMessage", array(
                    "chat_id" => $chat_id,
                    "reply_to_message_id" => $message_id,
                    "parse_mode" => "Markdown",
                    "text" => senhas() . "\n\n" . $GLOBALS["bot_user"] . ""
                ));
                break;
            
            case "/getsource":
            case "/getsource@bankerrobot":
                apiRequest("sendDocument", array(
                    "chat_id" => $chat_id,
                    "reply_to_message_id" => $message_id,
                    "document" => "BQADAQADEgADFSJBRriasLlqrVVaAg",
                    "caption" => "Passwd: PerfectCarders\n\n@MrBanker"
                ));
                break;
            
            case "/cnpj":
                if (is_numeric($cnpj)) {
                    apiRequest("sendMessage", array(
                        "chat_id" => $chat_id,
                        "reply_to_message_id" => $message_id,
                        "parse_mode" => "Markdown",
                        "text" => cnpj_chk($cnpj) . "\n\n" . $GLOBALS["bot_user"] . ""
                    ));
                } else {
                    apiRequest("sendMessage", array(
                        "chat_id" => $chat_id,
                        "reply_to_message_id" => $message_id,
                        "parse_mode" => "Markdown",
                        "text" => "*Formato inválido!*\n*Exemplo:* `/cnpj 00000000000191`\n*Nota:* _Sem pontos, barras ou traços!_"
                    ));
                }
                break;
            
            case "/tcpvpn":
                if ($country == "us" || $country == "ca" || $country == "uk" || $country == "sg" || $country == "fr") {
                    apiRequest("sendMessage", array(
                        "chat_id" => $chat_id,
                        "reply_to_message_id" => $message_id,
                        "parse_mode" => "Markdown",
                        "disable_web_page_preview" => 1,
                        "text" => tcpvpn($country) . "\n\n" . $GLOBALS["bot_user"] . ""
                    ));
                } else {
                    apiRequest("sendMessage", array(
                        "chat_id" => $chat_id,
                        "reply_to_message_id" => $message_id,
                        "parse_mode" => "Markdown",
                        "text" => "*Formato inválido!* *Você deve especificar a sigla do país suportado:*\n\n*Estados Unidos:* `/tcpvpn us`\n*Canadá:* `/tcpvpn ca`\n*Reino Unido:* `/tcpvpn uk`\n*Singapura:* `/tcpvpn sg`\n*França:* `/tcpvpn fr`"
                    ));
                }
                break;
            
            case "/cpf":
                if (is_numeric($cpf)) {
                    apiRequest("sendMessage", array(
                        "chat_id" => $chat_id,
                        "reply_to_message_id" => $message_id,
                        "parse_mode" => "Markdown",
                        "text" => cpf_chk($cpf) . "\n\n" . $GLOBALS["bot_user"] . ""
                    ));
                } else {
                    apiRequest("sendMessage", array(
                        "chat_id" => $chat_id,
                        "reply_to_message_id" => $message_id,
                        "parse_mode" => "Markdown",
                        "text" => "*Formato inválido!*\n*Exemplo:* `/cpf 08985444751`\n*Nota:* _Sem pontos ou traços!_"
                    ));
                }
                break;
        }
    }
}

/** setar webhook
 * ativar: index_bot.php?webhook=ativar
 * deletar: index_bot.php?webhook=excluir
 */
if (isset($_GET["webhook"])) {
    if ($_GET["webhook"] == "ativar") {
        echo "Webhook ativado com sucesso!";
        apiRequest("setWebhook", array(
            "url" => WEBHOOK_URL
        ));
    }
    if ($_GET["webhook"] == "excluir") {
        echo "Webhook excluido com sucesso! bot desligado.";
        apiRequest("setWebhook", array(
            "url" => "delete"
        ));
    }
    exit;
}

# receber atualizações 
$content = file_get_contents("php://input");
$update  = json_decode($content, true);

# salvar recebimento de dados em um arquivo no servidor
if ($bot_log) {
    $logs = dirname(__FILE__) . "/logs_bot.txt"; # cria o arquivo
    $prc  = fopen($logs, "a+"); # leitura e escrita no final do arquivo
    fwrite($prc, $content . "\n\n"); # salva os dados da var $content
    fclose($prc); # encerra o processo
}

if (!$update) {
    # parar ao receber uma atualização errada. (não deve acontecer.)
    exit;
}

if (isset($update["message"])) {
    Robot($update["message"]);
}
?>