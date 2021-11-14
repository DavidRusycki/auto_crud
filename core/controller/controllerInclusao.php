<?php
require_once('./core/includer.php');

/**
 * Arquivo para centralizar as tratativas relacionadas a inclusão.
 */

/**
 * Realiza o processamento de inclusão.
 */
function processaInclusao() {
    realizaIncludes();

    $sTable = 'tb'.$_GET[ROTINA];
    $bSucess = execute(getSqlForInclusao($sTable));
    if (!$bSucess) {
        echo 'Erro na inclusão';
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
function getSqlForInclusao($sTable) {
    $sColuns = implode(',', getColunasForInclusao());
    $sValues = getValoresFromRelacionamentos();

    return "insert into {$sTable} ({$sColuns}) values ({$sValues})";
}

/**
 * Pega os valores dos relacionamentos no POST
 * @return String - Valores para o sql.
 */
function getValoresFromRelacionamentos() {
    $aValores = [];
    foreach(getColunasForInclusao() as $sColuna) {
        $aValores[] = $_POST[$sColuna];
    }

    return implode(',', $aValores);
}