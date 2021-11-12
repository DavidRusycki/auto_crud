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