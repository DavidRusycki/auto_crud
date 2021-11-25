<?php
require_once('./core/includer.php');

/**
 * Arquivo para centralizar as tratativas relacionadas a alteração de registros.
 */

/**
 * Realiza o processamento de inclusão.
 */
function processaAlteracao() {
    realizaIncludes();

    $sTable = 'tb'.$_GET[ROTINA];
    $bSucess = execute(getSqlForAlteracao($sTable));
    if (!$bSucess) {
        echo 'Erro na Alteração';
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
 * Retorna o sql para alteração.
 * @return String 
 */
function getSqlForAlteracao($sTable) {
    $aColuns = getColunasForAlteracao();

    $sSql = "update {$sTable} set ";

    $i = 0;
    foreach($aColuns as $sColum) {
        $xValor = getValorFromRelacionamento($sColum);
        if ($i) {
            $sSql .= " , {$sColum} = {$xValor}";
        }
        else {
            $sSql .= " {$sColum} = {$xValor}";
        }
        $i++;
    }

    $xChave = getChave();

    $sSql .= " where {$xChave} = {$_GET[$xChave]}";

    return $sSql;
}

/**
 * Pega os valores dos relacionamentos no POST
 * @param String $sColuna - Coluna 
 * @return String - Valores para o sql.
 */
function getValorFromRelacionamento($sColuna) {
        $xRetorno = null;
        switch (getTipoCampo($sColuna)) {
            case TEXT:
                $xRetorno = "'".$_POST[$sColuna]."'";
                break;
            
            default:
                $xRetorno = $_POST[$sColuna];
                break;
        }
        return $xRetorno;
}

/**
 * Monta a tela de inclusão.
 */
function montaTelaAlteracao() {
    includeViewAlteracao();
}

/**
 * Monta os campos para inclusão dos registros.
 */
function montaCamposAlteracao() {
    includeArquivoRotina();
    includeControllerBd();
    $xChave = getFirstFromArray(getColunasChave());
    $aLinha = getFirstFromArray(getLinhaFromRotinaChave($xChave));
    $aCampos = getColunasForAlteracao();
    foreach($aCampos as $sColunaBd) {
        $sNomeCampo = getNomeCampo($sColunaBd);
        // echo '</br>';
        switch (getTipoCampo($sColunaBd)) {
            case NUMERICO:
                echo "<label for=\"$sColunaBd\">{$sNomeCampo}</label>";
                echo "<input class=\"form-control\" type=\"number\" name=\"$sColunaBd\" id=\"$sColunaBd\" value=\"{$aLinha[$sColunaBd]}\" required>";
                break;
            case TEXT:
                echo "<label for=\"$sColunaBd\">{$sNomeCampo}</label>";
                echo "<input class=\"form-control\" type=\"text\" name=\"$sColunaBd\" id=\"$sColunaBd\" value=\"{$aLinha[$sColunaBd]}\" required>";
                break;
            case DECIMAL:
                echo "<label for=\"$sColunaBd\">{$sNomeCampo}</label>";
                echo "<input class=\"form-control\" type=\"text\" name=\"$sColunaBd\" id=\"$sColunaBd\" value=\"{$aLinha[$sColunaBd]}\" required>";
                break;
            case DATE:
                echo "<label for=\"$sColunaBd\">{$sNomeCampo}</label>";
                echo "<input class=\"form-control\" type=\"date\" name=\"$sColunaBd\" id=\"$sColunaBd\" value=\"{$aLinha[$sColunaBd]}\" required>";
                break;
        }
    }
}

/**
 * Retorna a chave.
 */
function getChave() {
    includeArquivoRotina();
    return getFirstFromArray(getColunasChave());
}

/**
 * Retorna o valor da chave.
 */
function getValorChave() {
    return $_GET[getChave()];
}