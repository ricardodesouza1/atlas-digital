CREATE TABLE cidades (
 id SERIAL PRIMARY KEY,
 nome varchar(100) NOT NULL,
 cidade varchar(100) NOT NULL
 );
 
CREATE TABLE instituicao (
 id SERIAL PRIMARY KEY,
 nome varchar(100) NOT NULL,
 cidade_id int NOT NULL,
 FOREIGN KEY (cidade_id) REFERENCES cidades (id)
 );
 
CREATE TABLE usuario (
    id serial PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    senha VARCHAR(50) NOT NULL,
    tipo int NOT NULL,
    instituicao_id int NOT NULL,
    FOREIGN KEY (instituicao_id) REFERENCES cidades (instituicao)
 
);
CREATE TABLE mapas (
    id serial PRIMARY KEY,
    end_arquivo VARCHAR(100) NOT NULL,
    nome varchar(100) NOT NULL,
    descricao varchar(100) NOT NULL,
    status int NOT NULL,
    codigo VARCHAR(40),
    usuario_id int NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES cidades (usuario)
);
