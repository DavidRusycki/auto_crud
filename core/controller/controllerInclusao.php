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
    getSqlForInclusao();
}

/**
 * Realiza os includes necessários para o processamento.
 */
function realizaIncludes() {
    includeConstantes();
    includeControllerBd();
}

/**
 * Retorna o sql para inclusão.
 * @return String 
 */
function getSqlForInclusao() {
    return 'çaslkdjfç';
}