<?php
require_once('./core/includer.php');

/**
 * Controller para login, controla o login do sistema.
 */

/**
 * Responsável por montar a tela de login.
 */
function montaLogin() {
    includeViewLogin();
}

/**
 * executa o login no sistema.
 */
function login(string $sNome, string $sSenha) {
    includeControllerBd();
    $aRetorno = executeSql(getSqlForLogin($sNome, $sSenha));
    if ($aRetorno) {
        $aRetorno = getFirstFromArray($aRetorno);
        if ($aRetorno) {
            $_SESSION[USUARIO] = $sNome;
            $_SESSION[LOGADO] = true;
        }
        redirectHome();
    }else {
        $_SESSION['erroLogin'] = true;
    }
}

/**
 * Exibe erro de login.
 */
function exibeErro() {
    if ($_SESSION['erroLogin']) {
        echo '
            <div class="alert alert-danger float" role="alert">
                Senha ou Usuário incorretos.
            </div>
        ';
    }
    $_SESSION['erroLogin'] = false;
}

/**
 * Retorna o sql para verificar o login.
 * @param String $sNome
 * @param String $sSenha
 */
function getSqlForLogin(string $sNome, string $sSenha):string {
    return "select 1 as resposta from login where usuario = '{$sNome}' and senha = md5('{$sSenha}');";
}
