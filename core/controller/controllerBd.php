<?php
require_once('./core/includer.php');

/**
 * Arquivo para centralizar a comunicação com o banco de dados.
 */

/**
 * Executa o sql passado e retorna o fetch do PDO.
 * @param String $sSql
 * @return Mixed - Resultado do SQL
 */
function execute($sSql) {
    try {
        $oPrepare = getConection()->prepare($sSql);
        $oPrepare->execute();
        return $oPrepare->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $e) {
        echo '<pre>';
        echo $e;
        echo '</pre>';
        die();
    }
}

/**
 * Retorna o DataObject PDO.
 * @return PDO $oConn
 */
function getConection() {
    includeConstantes();

    $sBd = BD;
    $sHost = HOST;
    $sBdName = BD_NAME;

    $oConn = new \PDO("{$sBd}:host={$sHost};dbname={$sBdName}", USER, SENHA);
    $oConn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    return $oConn;
}