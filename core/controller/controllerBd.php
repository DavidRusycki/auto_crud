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

/**
 * Retorna um array com os nomes da rotinas do sistema.
 */
function getArrayRotinasSistema() {
    $aRotinas = [];
    $aConsultaRotinas = execute(getSqlGetRotinas());
    foreach ($aConsultaRotinas as $aRotina) {
        $aRotinas[] = $aRotina['nome'];
    }
    return $aRotinas;
}

/**
 * Retorna o sql para consultar as rotinas do sistema.
 */
function getSqlGetRotinas() {
    return 'select * from tbrotina';
}

/**
 * Retorna o sql de consulta para a rotina.
 */
function getSqlConsultaRotina() {
    return "select * from tb{$_GET[ROTINA]}";
}