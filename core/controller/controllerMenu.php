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
        echo "<div class=\"col\">
            <div class=\"card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg\" style=\"background-image: url('./img/{$sRotina}.jpg'); background-size: cover;\">
                <a href=\"?rotina={$sRotina}&acao={$sAcaoConsultar}\" class=\"d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1\">
                    <h2 class=\"pt-5 mt-5 mb-4 display-6 lh-1 fw-bold\">".ucfirst($sRotina)."</h2>
                    
                </a>
            </div>
        </div>";
    }
}

/**
 * Retorna o nome da tela de Menus
 */
function getNomeRotina() {
    return 'Home';
}