<?php
require_once('./core/includer.php');

/**
 * Controller para o menu inicial do sistema.
 */

/**
 * Responsável por exibir o menu do rotinas do sistema.
 */
function exibeMenuRotinas() {
    includeViewMenu();
}

/**
 * Monta a consulta.
 */
function montaConsulta() {
    includeControllerBd();
    includeConstantes();
    $aRotinas = getArrayRotinasSistema();
    $sAcaoConsultar = ACAO_CONSULTAR;
    foreach($aRotinas as $sRotina) {
        echo "<a class=\"btn btn-success\" href=\"?rotina={$sRotina}&acao={$sAcaoConsultar}\">".ucfirst($sRotina)."</a>";
    }
}

/**
 * Retorna o nome da tela de Menus
 */
function getNomeRotina() {
    return 'Home';
}