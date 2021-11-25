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
        switch (getTipoCampo($sColuna)) {
            case TEXT:
                $aValores[] = "'".$_POST[$sColuna]."'";
                break;
            
            default:
                $aValores[] = $_POST[$sColuna];
                break;
        }
    }

    return implode(',', $aValores);
}

/**
 * Monta a tela de inclusão.
 */
function montaTelaInclusao() {
    includeViewInclusao();
}

/**
 * Monta os campos para inclusão dos registros.
 */
function montaCamposInclusao() {
    includeArquivoRotina();
    $aCampos = getColunasForInclusao();
    foreach($aCampos as $sColunaBd) {
        $sNomeCampo = getNomeCampo($sColunaBd);
        // echo '</br>';
        switch (getTipoCampo($sColunaBd)) {
            case NUMERICO:
                echo "<label for=\"$sColunaBd\">{$sNomeCampo}</label>";
                echo "<input class=\"form-control\" type=\"number\" name=\"$sColunaBd\" id=\"$sColunaBd\" required>";
                break;
            case TEXT:
                echo "<label for=\"$sColunaBd\">{$sNomeCampo}</label>";
                echo "<input class=\"form-control\" type=\"text\" name=\"$sColunaBd\" id=\"$sColunaBd\" required>";
                break;
            case DECIMAL:
                echo "<label for=\"$sColunaBd\">{$sNomeCampo}</label>";
                echo "<input class=\"form-control\" type=\"text\" name=\"$sColunaBd\" id=\"$sColunaBd\" required>";
                break;
            case DATE:
                echo "<label for=\"$sColunaBd\">{$sNomeCampo}</label>";
                echo "<input class=\"form-control\" type=\"date\" name=\"$sColunaBd\" id=\"$sColunaBd\" required>";
                break;
        }
    }

}