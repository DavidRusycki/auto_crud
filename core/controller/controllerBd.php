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
        $aRes = $oPrepare->fetchAll(PDO::FETCH_ASSOC);
        $aRes = trataRes($aRes);
        return $aRes;
    } catch (\Throwable $e) {
        echo '<pre>';
        echo $e;
        echo '</pre>';
        die();
    }
}

/**
 * Executa o sql passado e retorna o fetch do PDO.
 * @param String $sSql
 * @return Mixed - Resultado do SQL
 */
function executeSql($sSql) {
    try {
        $oPrepare = getConection()->prepare($sSql);
        $oPrepare->execute();
        $aRes = $oPrepare->fetchAll(PDO::FETCH_ASSOC);
        return $aRes;
    } catch (\Throwable $e) {
        echo '<pre>';
        echo $e;
        echo '</pre>';
        die();
    }
}


/**
 * Trata o retorno;
 * @param Array $aRes
 * @return Mixed
 */
function trataRes($aRes) {
    $xRetorno = true;
    if (count($aRes)) {
        $xRetorno = $aRes;
    }
    return $xRetorno;
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
    includeControllerAlteracao();
    $sChave = getChave();
    $sQuantidadeLimite = QUANTIDADE_PAGINA;
    $xOffset = $_GET[PAGINA] * QUANTIDADE_PAGINA - QUANTIDADE_PAGINA;
    return "select * from tb{$_GET[ROTINA]} order by {$sChave} limit {$sQuantidadeLimite} offset {$xOffset}";
}

/**
 * Retorna o sql de consulta para a rotina.
 */
function getSqlQuantidadeRegistros() {
    return "select count(*) from tb{$_GET[ROTINA]} ";
}

/**
 * Retorna os dados de um linha do banco de dados da rotina.
 */
function getLinhaFromRotinaChave($sChave) {
    return execute(getSqlLinhaFromRotinaChave($sChave, $_GET[$sChave]));
}

/**
 * Retorna o sql para consultar uma linha do banco de acordo com a chave.
 */
function getSqlLinhaFromRotinaChave($sChave, $xValor) {
    $sTable = 'tb'.$_GET[ROTINA];
    return "select * from {$sTable} where {$sChave} = {$xValor} limit 1";
}