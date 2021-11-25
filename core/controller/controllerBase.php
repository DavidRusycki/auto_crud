<?php
require_once('./core/includer.php');

/**
 * Inicia o processamento das requisições.
 */
function init() {
    iniciaSecao();
    includeConstantes();
    if (validaUsuarioLogado()) {
        validaParametros();
    }
    else {
        validaLogin();
        includeControllerLogin();
        montaLogin();
    }
}

/**
 * Inicia a sessão.
 */
function iniciaSecao() {
    if (!isset($_SESSION)) {
        session_start();
    }
}

/**
 * Valida se o usuário está logado.
 */
function validaUsuarioLogado() {
    return true;
    $bRetorno = false;
    if (isset($_SESSION) && isset($_SESSION[USUARIO]) && $_SESSION[USUARIO] && $_SESSION[LOGADO]) {
        $bRetorno = true;
    }
    return $bRetorno;
}

/**
 * Valida os parametros passados para definir o destino da requisição.
 */
function validaParametros() {
    trataAcao();
    
    if (isset($_POST) && !empty($_POST) && count($_POST) && isset($_GET) && !empty($_GET) && count($_GET) && isset($_GET[ACAO]) && isset($_GET[ROTINA])) {
        validaPost();
    }
    else if (isset($_GET) && !empty($_GET) && count($_GET) && isset($_GET[ACAO]) && isset($_GET[ROTINA])) {
        validaGet();
    }
    else if (isset($_GET) && !empty($_GET) && count($_GET) && isset($_GET[ACAO]) && $_GET[ACAO] == ACAO_LOGOUT) {
        logout();
    } else {
        includeControllerMenu();
        exibeMenuRotinas();
    }
}

/**
 * Realiza tratativas na ação.
 */
function trataAcao() {
    if (isset($_GET[ACAO])) {
        validaAcao($_GET[ACAO]);
    }
    else {
        $_GET[ACAO] = ACAO_CONSULTAR;
    }
}

/**
 * Valida as ações que possuem parametros POST
 */
function validaPost() {
    switch ($_GET[ACAO]) {
        case ACAO_INCLUIR:
            iniciaInclusao();
            break;
        case ACAO_ALTERAR:
            iniciaAlteracao();
            break;
        case ACAO_LOGIN:
            validaLogin();
            break;
                
        default:
            die();
            break;
    }
}

/**
 * Valida as ações que apenas possuem parametros GET
 */
function validaGet() {
    switch ($_GET[ACAO]) {
        case ACAO_CONSULTAR:
            iniciaConsulta();
            break;
        case ACAO_INCLUIR:
            montaInclusao();
            break;
        case ACAO_DELETAR:
            processaExclusao();
            break;
        case ACAO_ALTERAR:
            montaAlteracao();
            break;
        case ACAO_LOGOUT:
            logout();
            break;

        default:
            die();
            break;
    }
}

/**
 * Valida se a ação é uma ação do sistema.
 */
function validaAcao($iAcao) {
    if (in_array($iAcao, ACOES)) {
        return true;
    }
    else {
        redirectHome();
    }
}

/**
 * Retorna para o link da home.
 */
function redirectHome() {
    header('Location: index.php');
}

/**
 * Inicia o processamento para consultar os dados da rotina.
 */
function iniciaConsulta() {
    includeControllerConsulta();
    iniciaProcessoConsulta();
}

/**
 * Realiza a montagem da tela de inclusão.
 */
function montaInclusao() {
    includeControllerInclusao();
    montaTelaInclusao();
}

/**
 * Inicia o processamento para incluir os dados da rotina.
 */
function iniciaInclusao() {
    includeControllerInclusao();
    processaInclusao();
    redirectForRotina();
}

/**
 * Inicia o processamento para excluir os dados da rotina.
 */
function processaExclusao() {
    includeControllerExclusao();
    processaExclusaoRegistro();
    redirectForRotina();
}
/**
 * Inicia o processamento para alterar os dados da rotina.
 */
function iniciaAlteracao() {
    includeControllerAlteracao();
    processaAlteracao();
    redirectForRotina();
}

/**
 * Realiza a montagem da tela de alteração.
 */
function montaAlteracao() {
    includeArquivoRotina();
    $xChave = getFirstFromArray(getColunasChave());
    if (isset($_GET[$xChave]) && $_GET[$xChave]) {
        includeControllerAlteracao();
        montaTelaAlteracao();
    }
    else {
        redirectHome();
    }
}

/**
 * Inicia o processamento de validação de login no sistema.
 */
function validaLogin() {

    

}

/**
 * Efetua o Logout do sistema.
 */
function logout() {
    unset($_SESSION[USUARIO]);
    $_SESSION[LOGADO] = false;
}

/**
 * Retorna o nome da rotina.
 */
function getNomeRotina() {
    includeConstantes();
    return $_GET[ROTINA];
}

/**
 * Rediciona para a consulta da rotina.
 */
function redirectForRotina() {
    header("Location: index.php?rotina=".$_GET[ROTINA]."");
}

/**
 * Retorna a primeira posição de um array.
 * @param Array $a
 */
function getFirstFromArray($a) {
    foreach($a as $x) {
        return $x;
    }
}
