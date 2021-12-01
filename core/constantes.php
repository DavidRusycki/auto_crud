<?php
/**
 * Arquivo para centralizar as contantes do sistema.
 */

//Ações
const ACAO_CONSULTAR = 1;
const ACAO_INCLUIR   = 2;
const ACAO_ALTERAR   = 3;
const ACAO_DELETAR   = 4;
const ACAO_LOGIN     = 5;
const ACAO_LOGOUT    = 6;
const ACAO_CADASTRAR = 7;

//Ações que o sistema aceita.
const ACOES = [
      ACAO_LOGOUT
    , ACAO_LOGIN
    , ACAO_DELETAR
    , ACAO_ALTERAR
    , ACAO_ALTERAR
    , ACAO_INCLUIR
    , ACAO_CONSULTAR
    , ACAO_CADASTRAR
];

//Random
const USUARIO = 'usuario';
const LOGADO = 'logued';
const ACAO = 'acao';
const ROTINA = 'rotina';
const QUANTIDADE_PAGINA = 9;
const PAGINA = 'pagina';
const RECADO = 'recado';

//Banco de dados;
const BD_NAME = 'dinamic';
const HOST    = 'localhost';
const BD      = 'pgsql';
const SENHA   = 'postgres';
const USER    = 'postgres';
const PORTA   = '5436';

//Tipos dos campos da tela.
const NUMERICO = 'numerico';
const TEXT = 'text';
const DECIMAL = 'decimal';
const DATE = 'date';

