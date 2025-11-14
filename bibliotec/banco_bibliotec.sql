CREATE TABLE USUARIO 
( 
 id.usuario INT PRIMARY KEY, auto_incrment
 nome INT,  
 telefone INT,  
 email INT,  
 endereco INT,  
 cpf INT,  
); 

CREATE TABLE AUTORES 
( 
 id_autor INT PRIMARY KEY, auto_incrment 
 nome INT,  
 nacionalidade INT,  
 biografia INT,  
 data_nacimento INT,  
); 

CREATE TABLE LIVROS 
( 
 id.livro INT PRIMARY KEY,auto_incrment  
 titulo INT,  
 genero INT,  
 ano_publicado INT,  
 editora INT,  
 numero _paginas INT,  
); 

CREATE TABLE EMPRESTIMO 
( 
 id.emprestimo INT PRIMARY KEY, auto_incrment 
 data_emprestimo INT,  
 data_entrega_prevista INT,  
 id.usuario INT PRIMARY KEY, auto_incrment 
 id.livro INT PRIMARY KEY,auto_incrment  
); 

CREATE TABLE ESCRITO 
( 
 id.edicao INT PRIMARY KEY,auto_incrment  
 nacionalidade INT,  
 multiplos_autores INT,  
 categoria INT,  
 id.livro INT PRIMARY KEY,auto_incrment  
 id_autor INT PRIMARY KEY,auto_incrment,  
); 

ALTER TABLE EMPRESTIMO ADD FOREIGN KEY(id.usuario) REFERENCES USUARIO (id.usuario)
ALTER TABLE EMPRESTIMO ADD FOREIGN KEY(id.livro) REFERENCES LIVROS (id.livro)
ALTER TABLE ESCRITO ADD FOREIGN KEY(id.livro) REFERENCES LIVROS (id.livro)
ALTER TABLE ESCRITO ADD FOREIGN KEY(id_autor) REFERENCES AUTORES (id_autor)