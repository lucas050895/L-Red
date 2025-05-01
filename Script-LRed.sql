create database lred;
use lred;


/*CLIENTES*/
create table clientes(
	id int,
    nombre varchar(30),
    apellido varchar(30),
    razon varchar(30),
    cuilcuit int(15),
    celular int(10),
    otro int(10),
    email varchar(30),
    direccion varchar(50),
    localidad varchar (20),
    primary key(id)
);


/*CCTV*/
create table trabajos_cctv(
	id int,
    clientes_id int,
    dvr_marca varchar(30),
    dvr_modelo varchar(30),
    dvr_disco varchar(30),
    dvr_capacidad int(5),
    dvr_medida int(5),
    camaras_cantidad int(5),
    camaras_modelo varchar(20),
    camaras_caja int(3),
    fichas_balum int(5),
    fichas_rj45 int(5),
    cables_utp int(5),
    cables_patch varchar(5),
    cables_zapatilla varchar(5),
    cables_fuente varchar(5),
    cables_pulpito varchar(5),
    cables_hdmi varchar(5),
    insumos_tar6 int(5),
    insumos_tor6 int(5),
    insumos_tar8 int(5),
    insumos_tor8 int(5),
    insumos_gra8 int(5),
    insumos_prec int(5),
	acceso_usuario varchar(20),
    acceso_contraseña varchar(20),
    observaciones varchar(300),
    primary key(id)
);


/*IP*/
create table trabajos_ip(
	id int,
    cliente_id int,
    camara_modelo varchar(20),
    ip_01 varchar(20),
    ip_02 varchar(20),
    ip_03 varchar(20),
    ip_04 varchar(20),
    ip_05 varchar(20),
	puerto_01 int(5),
    puerto_02 int(5),
    puerto_03 int(5),
    puerto_04 int(5),
    puerto_05 int(5),
    fichas_rj45 int(5),
    fichas_plug int(5),
    cables_fuentes varchar(5),
    cables_utp int(5),
    cables_zapatilla varchar(5),
    insumos_tar6 int(5),
    insumos_tor6 int(5),
    insumos_tar8 int(5),
    insumos_tor8 int(5),
    insumos_gra8 int(5),
    insumos_prec int(5),
	acceso_usuario varchar(20),
    acceso_contraseña varchar(20),
    acceso_host varchar(50),
    observaciones varchar(300),
    primary key(id)
);


/*RED*/
create table trabajos_red(
	id int,
    clientes_id int,
    equipo_tipo varchar(20),
    equipo_modelo varchar(20),
    cables_utp int(5),
    cables_par int(5),
    fichas_rj45 int(5),
    fichas_empalme int(5),
    rack int(5),
    insumos_tar6 int(5),
    insumos_tor6 int(5),
    insumos_tar8 int(5),
    insumos_tor8 int(5),
    insumos_gra8 int(5),
    insumos_prec int(5),
    observaciones varchar(300),
    primary key(id)
);


/*ARCHIVOS EXCEL*/
create table archivos_excel(
	id int,
    clientes_id int,
    nombre varchar(100),
    ruta varchar(100),
    primary key(id)
);


/*ARCHIVOS FOTOS*/
create table archivos_fotos(
	id int,
    clientes_id int,
    nombre varchar(100),
    ruta varchar(100),
    primary key(id)
);


/*ARCHIVOS FOTOS*/
create table archivos_pdf(
	id int,
    clientes_id int,
    nombre varchar(100),
    ruta varchar(100),
    primary key(id)
);