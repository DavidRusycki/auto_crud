<?php
require_once('./core/includer.php');

/**
 * Iniciar a consulta para o usuário.
 */
function iniciaProcessoConsulta() {
    requireViewRotina();
}

/**
 * Verifica qual o arquivo destino da requisição.
 */
function requireViewRotina() {
    includeConstantes();
    if (getExisteArquivoConsultaRotina()) {
        require_once(getNomeViewRotina());
    }
    else {
        includeViewConsulta();
    }
}

/**
 * Verifica se existe arquivo para aquela rotina.
 */
function getExisteArquivoConsultaRotina() {
    return file_exists(getNomeViewRotina());
}

/**
 * Retorna o possível nome para a view da Rotina.
 */
function getNomeViewRotina() {
    $sRotina = ucfirst($_GET[ROTINA]);
    return "./core/view/view{$sRotina}.php";
}

/**
 * Monta a consulta.
 */
function montaConsulta() {
    includeConstantes();
    includeControllerBd();
    $aRegistros = execute(getSqlConsultaRotina());
    if (is_array($aRegistros)) {
        adicionaColunas($aRegistros);
        echo '<table class="table table-striped">';
        montaColunas($aRegistros);
        montaLinhas($aRegistros);
        echo '</table>';        
    }
    else {
        echo '<br>';
        echo 'Nenhum registro encontrado.';
    }
}

/**
 * Adiciona os botões nas linhas da consulta.
 * @param Array $aRegistros - Registros
 */
function adicionaColunas(&$aRegistros) {
    foreach($aRegistros as $indice => $aLinha) {
        $aRegistros[$indice]['acoes'] = 1;
    }
}

/**
 * Adiciona as colunas da consulta.
 */
function montaColunas($aRegistros) {
    echo '<thead>';
    echo '<tr>';
    foreach($aRegistros as $aRegistro) {
        foreach($aRegistro as $iIndice => $sColuna) {
            trataTituloColuna($iIndice);    
        }
        break;
    }
    echo '</tr>';
    echo '</thead>';
}

/**
 * Monta as colunas da table.
 */
function trataTituloColuna($sColuna) {
    includeArquivoRotina();
    $aNomes = getNomeCampos();

    switch ($sColuna) {
        case 'acoes':
            echo "<th scope=\"col\">Ações</th>";
            break;
        
        default:
            echo "<th scope=\"col\">".$aNomes[$sColuna]."</th>";
            break;
    }

}

/**
 * Monta as linhas com os valores vindos do banco de dados.
 * @param Array $aRegistros - Valores do banco.
 */
function montaLinhas($aRegistros) {
    echo '<tbody>';
    foreach($aRegistros as $aLinha) {
        echo '<tr>';
        foreach($aLinha as $sColuna => $xValor) {
            trataLinha($sColuna, $xValor, $aLinha);
        }
        echo '</tr>';
    }
    echo '</tbody>';
}


/**
 * Possibilita realizar um tratamento para as linhas.
 * @param String $sColuna - Nome da coluna.
 * @param Mixed $xValor - Valor da coluna.
 * @param Array $aLinha - Array da linha.
 */
function trataLinha($sColuna, $xValor, $aLinha) {
    switch ($sColuna) {
        case 'acoes':
            echo "<td><a href=\"?rotina=".getNomeRotina()."&codigo={$aLinha[implode('',getColunasChave())]}&acao=".ACAO_ALTERAR."\" class=\"btn btn-primary\">Alterar</a> <a href=\"?rotina=".getNomeRotina()."&codigo={$aLinha[implode('',getColunasChave())]}&acao=".ACAO_DELETAR."\" class=\"btn btn-danger\">Deletar</a></td>";
            break;

        default:
        echo "<td>{$xValor}</td>";
            break;
    }
}

/**
 * Retorna o nome da rotina.
 */
function getNomeRotina() {
    includeConstantes();
    return $_GET[ROTINA];
}