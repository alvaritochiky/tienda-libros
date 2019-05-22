CREATE DATABASE tienda_libros;
USE tienda_libros;

CREATE TABLE usuarios(
id                int (255) auto_increment not null,
nombre            varchar (100) not null,
apellidos         varchar (255),
email             varchar (255) not null,
contraseña        varchar (255) not null,
rol               varchar(50),
imagen            varchar (255),

CONSTRAINT pk_usuarios PRIMARY KEY (id),
CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDb;

INSERT INTO usuarios VALUES(NULL,"Admin","Admin","admin@admin.com","Admin","Admin",NULL);

CREATE TABLE genero(
id                int (255) auto_increment not null,
nombre            varchar (100) not null,

CONSTRAINT pk_genero PRIMARY KEY (id)
)ENGINE=InnoDb;

INSERT INTO genero VALUES(NULL,"Ciencia Ficcion");
INSERT INTO genero VALUES(NULL,"Romantica");
INSERT INTO genero VALUES(NULL,"Juvenil");
INSERT INTO genero VALUES(NULL,"Thriller");
INSERT INTO genero VALUES(NULL,"Novela Grafica");


CREATE TABLE productos(
id              int(255) auto_increment not null,
genero_id       int(255) not null,
nombre          varchar(100) not null,
descripcion     text,
autor           varchar(100) not null,
precio          float(100,2) not null,
tipo            varchar(100) not null,
stock           int(255) not null,
oferta          varchar(2),
fecha           date not null,
imagen          varchar(255),
pdf             varchar(255),
CONSTRAINT pk_productos PRIMARY KEY(id),
CONSTRAINT fk_producto_genero FOREIGN KEY(genero_id) REFERENCES genero(id)
)ENGINE=InnoDb;

CREATE TABLE pedidos(
id                int (255) auto_increment not null,
usuario_id        int(255) not null,
provincia         varchar (100) not null,
localidad         varchar (255) not null,
direccion         varchar (255) not null,
coste             float (200,2) not null,
estado            varchar(50) not null,
fecha             date,
hora              time,
CONSTRAINT pk_pedidos PRIMARY KEY(id),
CONSTRAINT fk_pedidos_usuarios FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
)ENGINE=InnoDb;

CREATE TABLE ventas(
id              int(255) auto_increment not null,
pedido_id       int(255) not null,
producto_id     int(255) not null,
unidades        int(255) not null,


CONSTRAINT pk_ventas PRIMARY KEY(id),
CONSTRAINT fk_ventas_pedidos FOREIGN KEY (pedido_id) REFERENCES pedidos(id),
CONSTRAINT fk_ventas_productos FOREIGN KEY (producto_id) REFERENCES productos(id)
)ENGINE=InnoDb;