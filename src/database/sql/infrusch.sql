create database infrusch;
use infrusch;

create table infrusch_access (
	id int not null auto_increment,
    username varchar(255) not null,
    token varchar(255) not null,
    primary key(id)
);

CREATE TABLE infrusch_clients(
	id_cliente INT NOT NULL AUTO_INCREMENT,
    cliente_constancia VARCHAR(255) NOT NULL,
    cliente_nombre VARCHAR(255) NOT NULL,
    cliente_direccion VARCHAR(255) NOT NULL,
    cliente_telefono VARCHAR(255) NOT NULL,
    cliente_password VARCHAR(255) NOT NULL,
    PRIMARY KEY(id_cliente)
);

-- ALTER TABLE infrusch_clients ADD cliente_email VARCHAR(255) NOT NULL AFTER cliente_telefono;
-- ALTER TABLE infrusch_clients CHANGE id_cliente cliente_id VARCHAR(255) NOT NULL;
-- ALTER TABLE infrusch_clients MODIFY cliente_id INT NOT NULL AUTO_INCREMENT;
Select * from infrusch_access;
SELECT * FROM infrusch_clients;


