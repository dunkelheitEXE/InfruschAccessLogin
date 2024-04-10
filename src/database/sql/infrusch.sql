create database infrusch;
use infrusch;

create table infrusch_access (
	id int not null auto_increment,
    username varchar(255) not null,
    token varchar(255) not null,
    primary key(id)
);

create table infrusch_alta_servicios(
	servicio_id int not null auto_increment,
    foreign key(cliente_id) references infrusch_clients(cliente_id),
    primary key(servicio_id)
);

create table infrusch_clients (
	cliente_id int not null auto_increment,
    cliente_constancia varchar(300),
    cliente_nombre varchar(300) not null,
    cliente_direccion varchar(350) not null,
    cliente_telefono varchar(10),
    cliente_email varchar(255),
    primary key(cliente_id)
);
ALTER TABLE infrusch_clients ADD cliente_password varchar(300) not null;


Select * from infrusch_access;
select * from infrusch_clients;

-- delete from infrusch_access where id = 7;
delete from infrusch_clients where cliente_id=3;
-- delete from registro_infrusch_clientes where id=1;


