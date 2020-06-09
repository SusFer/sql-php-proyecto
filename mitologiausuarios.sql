
create database mitologiausuarios;

grant select, insert, update, delete, create, drop on mitologiausuarios.*
  to 'mitologiausuarios'@'localhost' identified by 'Lo-1234-lo';

use mitologiausuarios;

create table Usuarios (
	email varchar(40) primary key,
	contraseña varchar(10) not null,
	nombre varchar(60) not null,
        fechanac varchar(60) not null
);

create table Post (
	idpost integer primary key auto_increment,
	titulo varchar(80) not null,
	articulo varchar(100) not null
);

create table Visualizan (
	email varchar(40), 
	idpost integer,
	primary key(email, idpost),
	foreign key (email)
	  references Usuarios(email)
	  on update cascade
	  on delete restrict,
	foreign key (idpost)
	  references Post(idpost)
	  on update cascade
	  on delete restrict
);
