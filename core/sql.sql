create table tbproduto (
	codigo serial not null,
	nome varchar(200) not null,
	preco decimal(100,2) not null,
	quantidade integer not null
);

alter table tbproduto add constraint pk_tbproduto primary key (codigo);

create table tbrotina (
	codigo serial not null,
	nome varchar(200) not null
);

alter table tbrotina add constraint pk_tbrotina primary key (codigo);
