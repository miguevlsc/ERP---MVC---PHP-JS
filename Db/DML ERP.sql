drop database if EXISTS erp;

CREATE database if not exists ERP;

use ERP;
create table if not exists clientes(
    id_cliente int(9) AUTO_INCREMENT,
    nombre_cliente VARCHAR(20),
    dni VARCHAR(9),
    telef int(9),
    ubi VARCHAR(30),
    eliminado tinyint(1),
    primary key(id_cliente)
);

create table if not exists factura_cliente(
    id_factura_cli int(9) AUTO_INCREMENT,
    fecha TIMESTAMP,
    importe_total double(6,2),
    id_cli int(9),
    primary key(id_factura_cli),
    foreign key(id_cli) REFERENCES clientes(id_cliente) ON DELETE CASCADE
);

create table if not exists producto(
    id_producto int(9) AUTO_INCREMENT,
    nombre_pro VARCHAR(25),
    precio DOUBLE(6,2),
    cantidad int(4),
    info VARCHAR(1024),
    compuesto tinyint(1),   -- Atributo booleano (BOOLEAN, TINYINT) -> 0/1
    PRIMARY KEY(id_producto)
);

create table if not exists proceso_fac_cli(
    id_factura_cli int(9) ,
    id_producto int(9) ,
    cantidad int(4),
    PRIMARY KEY(id_factura_cli,id_producto)
);
    ALTER TABLE proceso_fac_cli add Foreign Key (id_factura_cli) REFERENCES factura_cliente(id_factura_cli) ON DELETE CASCADE;
    alter table proceso_fac_cli add Foreign Key (id_producto) REFERENCES producto(id_producto) ON DELETE CASCADE;


create table if not exists proveedor(
    id_proveedor int(9) AUTO_INCREMENT,
    telf int(9),
    nombre VARCHAR(20),
    ubicacion VARCHAR(40),
    PRIMARY KEY (id_proveedor)
);


create table if not exists factura_prov(
    id_factura_prov int(9) AUTO_INCREMENT,
    fecha date,
    precio_compra double(6,2),
    id_prov int(9),
    PRIMARY KEY(id_factura_prov),
    Foreign Key (id_prov) REFERENCES proveedor(id_proveedor) ON DELETE CASCADE
);


create table if not exists proceso_fac_prov(
    id_producto int(9),
    id_factura_prov int(9),
    cantidad int(4),
    PRIMARY KEY(id_producto,id_factura_prov)
);
    ALTER TABLE proceso_fac_prov ADD Foreign Key (id_producto) REFERENCES producto(id_producto) ON DELETE CASCADE;
    ALTER TABLE proceso_fac_prov ADD Foreign Key (id_factura_prov) REFERENCES factura_prov(id_factura_prov) ON DELETE CASCADE;
    
create table if not exists producto_final(
    id_producto_final int(9) AUTO_INCREMENT,
    cantidad int(3),
    primary KEY(id_producto_final)
);
   ALTER TABLE producto_final ADD Foreign Key (id_producto_final) REFERENCES producto(id_producto) ON DELETE CASCADE;

create table if not exists componentes(
    id_producto_final int(9) AUTO_INCREMENT,
    id_producto int(9),
    cantidad_componentes int(2),
    PRIMARY KEY (id_producto_final)
);
    ALTER TABLE componentes ADD Foreign Key (id_producto_final) REFERENCES producto(id_producto) ON DELETE CASCADE;
    ALTER TABLE componentes ADD Foreign Key (id_producto) REFERENCES producto(id_producto) ON DELETE CASCADE;


create table if not exists usuarios(
    id_usu int(4) AUTO_INCREMENT,
    nom_usu varchar(20) not null,
    con_usu varchar(200) not null,
    niv_usu int(2),     -- Nivel de sesión para conceder permisos
    PRIMARY KEY(id_usu)
);

insert into usuarios(nom_usu, con_usu, niv_usu) VALUES
    ("usu1","con1",1),
    ("usu2","con2",2),
    ("usu3","con3",1);

insert into clientes(nombre_cliente, dni, telef, ubi, eliminado) VALUES
    ("cliente1", "12345678A", 666666666, "España", 0),
    ("cliente2", "24254354B", 123456789, "Portugal", 1),
    ("cliente3", "76565656C", 987654321, "Benidorm", 0);

insert into producto (nombre_pro, precio, cantidad, info, compuesto) VALUES
    ("producto1", 12.43, 23, "Producto 1, Ta weno1", 0),
    ("producto2", 43.45, 25, "Producto 2, Ta weno2", 1),
    ("producto3", 43.97, 43, "Producto 3, Ta weno3", 0),
    ("producto4", 12.43, 26, "Producto 4, Ta weno4", 1),
    ("producto5", 43.45, 246, "Producto 5, Ta weno5", 1),
    ("producto6", 43.97, 433, "Producto 6, Ta weno6", 0);

/* insert into factura_cliente(fecha, importe_total, id_cliente) VALUES
    ("2019-04-13", 134.34, 1),
    ("2013-12-15", 23.34, 2),
    ("2022-07-21", 24.34, 3); */

/* insert into proceso_fac_cli(id_factura_cli,id_producto,cantidad) VALUES
    (1, 1, 2),
    (2, 2, 1),
    (3, 1, 1); */

INSERT INTO proveedor(telf, nombre, ubicacion) VALUES 
    (123456789,'Hermanos Ramones.SL','Cáceres'),
    (568412785,'Lolis.SA','León'),
    (698534756,'UPS','Masachusets');


drop procedure if exists compraCliente1;
Delimiter //
CREATE PROCEDURE compraCliente1(in nombre_cliente1 varchar(20), in producto1 varchar(25), in cantidad1 int(4))
BEGIN

    declare id_cliente1 int(4);
    declare id_producto1 int(4);
    declare importe_total1 double(6,2);
    declare id_factura_cli1 int(4);

    SELECT id_cliente into id_cliente1 FROM clientes WHERE nombre_cliente = nombre_cliente1;
    SELECT id_producto into id_producto1 FROM producto WHERE nombre_pro=producto1;
    SELECT sum(precio*cantidad1) into importe_total1 FROM producto WHERE id_producto=id_producto1;

    INSERT INTO factura_cliente (fecha, importe_total, id_cli) VALUES (CURRENT_TIMESTAMP(), importe_total1, id_cliente1);
    SELECT LAST_INSERT_ID() into id_factura_cli1; -- Devuelve el campo auto_increment de la última instrucción
    
    INSERT INTO proceso_fac_cli (id_factura_cli, id_producto, cantidad) VALUES (id_factura_cli1, id_producto1, cantidad1);

    UPDATE producto SET cantidad = cantidad-cantidad1 WHERE id_producto=id_producto1;

end;
//
delimiter ;

drop procedure if exists compraProveedor1;
Delimiter //
CREATE PROCEDURE compraProveedor1(in nombre_proveedor1 varchar(20), in producto1 varchar(25), in cantidad1 int(4))
BEGIN

    declare id_proveedor1 int(4);
    declare id_producto1 int(4);
    declare importe_total1 double(6,2);
    declare id_factura_prov1 int(4);

    SELECT id_proveedor into id_proveedor1 FROM proveedor WHERE nombre = nombre_proveedor1;
    SELECT id_producto into id_producto1 FROM producto WHERE nombre_pro=producto1;
    SELECT sum(precio*cantidad1) into importe_total1 FROM producto WHERE id_producto=id_producto1;

    INSERT INTO factura_prov (fecha, precio_compra, id_prov) VALUES (CURRENT_TIMESTAMP(), importe_total1, id_proveedor1);
    SELECT LAST_INSERT_ID() into id_factura_prov1; -- Devuelve el campo auto_increment de la última instrucción
    
    INSERT INTO proceso_fac_prov (id_producto, id_factura_prov, cantidad) VALUES (id_producto1, id_factura_prov1 , cantidad1);

    UPDATE producto SET cantidad = cantidad+cantidad1 WHERE id_producto=id_producto1;

end;
//
delimiter ;