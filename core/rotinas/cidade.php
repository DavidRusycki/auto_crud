<?php
/**
 * Arquivo para as informações da rotina de "";
 */

/**
 * Retorna as chaves da tabela que são necessárias para ações de alteração por exemplo.
 * @return Array - Keys da tabela
 */
function getColunasChave() {
    return [
        'codigo'
    ];
}

/**
 * Retorna o nome das colunas no banco de dados.
 * @return Array - Colunas do bd
 */
function getColunasBd() {
    return [
          'codigo'
        , 'nome'
        , 'estado'
    ];
}

/**
 * Retorna o nome da cada campo quando necessário para alguma visualização.
 * @return Array - Nomes das colunas
 */
function getNomeCampos() {
    return [
          'codigo' => 'Código'
        , 'nome' => 'Nome'
        , 'estado' => 'Estado'
    ];
}

/**
 * Método que pode ser modificado caso alguma informação não seja inserida diretamente.
 */
function getColunasForInclusao() {
    return [
        'nome'
      , 'estado'
    ];
}

/**
 * Método que pode ser modificado caso alguma informação não seja alterada diretamente.
 */
function getColunasForAlteracao() {
    return getColunasForInclusao();
}

/**
 * Retorna o nome da cada campo quando necessário para alguma visualização.
 * @return Array - Nomes das colunas
 */
function getNomeCampo($sCampo) {
    $aNomes = getNomeCampos();
    return $aNomes[$sCampo];
}

/**
 * Retorna o tipo do campo para a tela.
 */
function getTipoCampo($sCampo) {
    $aTipos = [
        'codigo' => NUMERICO,
        'nome' => TEXT,
        'estado' => TEXT
    ];
    return $aTipos[$sCampo];
}