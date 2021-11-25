<?php
require_once('./core/includer.php');

/**
 * Arquivo para centralizar as tratativas relacionadas a exclusão.
 */

/**
 * Realiza o processamento de inclusão.
 */
function processaExclusaoRegistro() {
    realizaIncludes();

    $sTable = 'tb'.$_GET[ROTINA];
    $bSucess = execute(getSqlForExclusao($sTable));
    if (!$bSucess) {
        echo 'Erro na Exclusão';
        die();
    }

    return $bSucess;
}

/**
 * Realiza os includes necessários para o processamento.
 */
function realizaIncludes() {
    includeConstantes();
    includeControllerBd();
    includeArquivoRotina();
}

/**
 * Retorna o sql para inclusão.
 * @return String 
 */
function getSqlForExclusao($sTable) {
    $xChave = end(getColunasChave());
    $xValor = $_GET[$xChave];
    return "delete from {$sTable} where {$xChave} = {$xValor}";
}
