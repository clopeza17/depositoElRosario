CREATE DATABASE elrosario;

USE elrosario;

CREATE TABLE Clientes (
    id_cliente BIGINT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    contraseña VARCHAR(255) NOT NULL,
    direccion VARCHAR(255),
    telefono VARCHAR(20)
);

CREATE TABLE Productos (
    id_producto BIGINT PRIMARY KEY,
    cantidad INT NOT NULL,
    ubicacion VARCHAR(255)
);

CREATE TABLE Pedidos (
    id_pedido BIGINT PRIMARY KEY,
    id_cliente BIGINT,
    fecha_pedido DATE NOT NULL,
    estado VARCHAR(50),
    monto_total DECIMAL(10, 2),
    FOREIGN KEY (id_cliente) REFERENCES Clientes(id_cliente)
);

CREATE TABLE Detalle_Pedidos (
    id_detalle BIGINT PRIMARY KEY,
    id_pedido BIGINT,
    id_producto BIGINT,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_pedido) REFERENCES Pedidos(id_pedido),
    FOREIGN KEY (id_producto) REFERENCES Productos(id_producto)
);

CREATE TABLE Inventarios (
    id_inventario BIGINT PRIMARY KEY,
    id_producto BIGINT,
    cantidad INT NOT NULL,
    ubicacion VARCHAR(255),
    FOREIGN KEY (id_producto) REFERENCES Productos(id_producto)
);

CREATE TABLE Cuentas (
    id_cuenta BIGINT PRIMARY KEY,
    id_cliente BIGINT,
    fecha_creacion DATE NOT NULL,
    tipo_cuenta VARCHAR(50),
    estado VARCHAR(50),
    FOREIGN KEY (id_cliente) REFERENCES Clientes(id_cliente)
);

CREATE TABLE Pagos (
    id_pago BIGINT PRIMARY KEY,
    id_pedido BIGINT,
    monto DECIMAL(10, 2) NOT NULL,
    fecha_pago DATE NOT NULL,
    metodo_pago VARCHAR(50),
    FOREIGN KEY (id_pedido) REFERENCES Pedidos(id_pedido)
);