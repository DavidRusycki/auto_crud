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

create table tbpessoa (
	codigo serial not null,
	nome varchar(200) not null,
	idade decimal(100,2) not null
);

alter table tbpessoa add constraint pk_tbpessoa primary key (codigo);

insert into tbpessoa (nome, idade) values ('David', 19);



create table login (
	codigo integer not null,
	usuario varchar(100) not null,
	senha varchar(500) not null
);

insert into login values (5, 'David', md5('pastel'))

select 1 as resposta from login where usuario = 'David' and senha = md5('pastel')
