<?php
/**
 * Arquivo para centralizar os includes do sistema.
 * Vizando facilitar a modificação dos caminhos 
 *  e estrutura de arquivos.
 */

function includeControllerBase() {
    require_once('./core/controller/controllerBase.php');
}

function includeConstantes() {
    require_once('./core/constantes.php');
}

function includeControllerLogin() {
    require_once('./core/controller/controllerLogin.php');
}

function includeControllerBd() {
    require_once('./core/controller/controllerBd.php');
}

function includeControllerInclusao() {
    require_once('./core/controller/controllerInclusao.php');
}

function includeControllerConsulta() {
    require_once('./core/controller/controllerConsulta.php');
}

function includeControllerMenu() {
    require_once('./core/controller/controllerMenu.php');
}

function includeViewConsulta() {
    require_once('./core/view/viewConsulta.php');
}

function includeViewMenu() {
    require_once('./core/view/viewMenu.php');
}

function includeViewHeader() {
    require_once('./core/view/viewHeader.php');
}

function includeViewFooter() {
    require_once('./core/view/viewFooter.php');
}

function includeViewLogin() {
    require_once('./core/view/viewLogin.php');
}

function includeViewInclusao() {
    require_once('./core/view/viewInclusao.php');
}

/**
 * Tenta dar require no arquivo da rotina.
 */
function includeArquivoRotina() {
    if (file_exists("./core/rotinas/{$_GET[ROTINA]}.php")) {
        require_once("./core/rotinas/{$_GET[ROTINA]}.php");
    }
    else {
        echo 'Error404';
        echo 'Não encontrado o arquivo '."./core/rotinas/{$_GET[ROTINA]}.php";
        die();
    };
}