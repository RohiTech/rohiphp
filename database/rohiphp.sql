
-- Crear la base de datos rohipos
-- CREATE DATABASE rohiphp;

-- Conectar a la base de datos
-- USE rohiphp;

-- Crear la tabla roles
CREATE TABLE roles (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) UNIQUE NOT NULL,
  descripcion TEXT
);

-- Crear la tabla usuarios
CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  nombre VARCHAR(255) NOT NULL,
  apellido VARCHAR(255) NOT NULL,
  rol_id INT NOT NULL, -- Relacion con la tabla roles
  estado BOOLEAN DEFAULT TRUE
);

-- Crear la tabla sesiones
CREATE TABLE sesiones (
  id INT AUTO_INCREMENT PRIMARY KEY,
  usuario_id INT NOT NULL, -- Relacion con la tabla usuarios
  token VARCHAR(255) UNIQUE NOT NULL,
  fecha_inicio TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  fecha_fin TIMESTAMP,
  estado BOOLEAN DEFAULT TRUE
);

-- Crear la tabla productos
CREATE TABLE productos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  codigo VARCHAR(255) UNIQUE NOT NULL,
  nombre VARCHAR(255) NOT NULL,
  descripcion TEXT,
  precio_compra DECIMAL(10,2) NOT NULL,
  precio_venta DECIMAL(10,2) NOT NULL,
  stock INT NOT NULL,
  categoria_id INT,
  estado BOOLEAN DEFAULT TRUE
);

-- Crear la tabla clientes
CREATE TABLE clientes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  apellido VARCHAR(255) NOT NULL,
  dni VARCHAR(255) UNIQUE,
  direccion TEXT,
  telefono VARCHAR(20),
  email VARCHAR(255),
  estado BOOLEAN DEFAULT TRUE
);

-- Crear la tabla proveedores
CREATE TABLE proveedores (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  contacto VARCHAR(255),
  telefono VARCHAR(20),
  direccion TEXT,
  email VARCHAR(255),
  estado BOOLEAN DEFAULT TRUE
);

-- Crear la tabla categorias
CREATE TABLE categorias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(255) NOT NULL,
  descripcion TEXT
);

-- Crear la tabla ventas
CREATE TABLE ventas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  usuario_id INT,
  cliente_id INT,
  total DECIMAL(10,2) NOT NULL,
  estado VARCHAR(255) DEFAULT 'pendiente'
);

-- Crear la tabla detalles_venta
CREATE TABLE detalles_venta (
  id INT AUTO_INCREMENT PRIMARY KEY,
  venta_id INT,
  producto_id INT,
  cantidad INT NOT NULL,
  precio_unitario DECIMAL(10,2) NOT NULL,
  descuento DECIMAL(10,2) DEFAULT 0
);

-- Crear la tabla cierres_caja
CREATE TABLE cierres_caja (
  id INT AUTO_INCREMENT PRIMARY KEY,
  fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  usuario_id INT,
  monto_inicial DECIMAL(10,2) NOT NULL,
  monto_final DECIMAL(10,2) NOT NULL
);

-- Crear la tabla movimientos_caja
CREATE TABLE movimientos_caja (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cierre_caja_id INT,
  tipo VARCHAR(255) NOT NULL,
  descripcion TEXT,
  monto DECIMAL(10,2) NOT NULL
);

-- Establecer las relaciones entre las tablas

-- Roles y usuarios
ALTER TABLE usuarios
  ADD CONSTRAINT fk_usuarios_roles FOREIGN KEY (rol_id) REFERENCES roles(id);

-- Usuarios y sesiones
ALTER TABLE sesiones
  ADD CONSTRAINT fk_sesiones_usuarios FOREIGN KEY (usuario_id) REFERENCES usuarios(id);

-- Productos y categorias
ALTER TABLE productos
  ADD CONSTRAINT fk_productos_categorias FOREIGN KEY (categoria_id) REFERENCES categorias(id);

-- Usuarios y ventas
ALTER TABLE ventas
  ADD CONSTRAINT fk_ventas_usuarios FOREIGN KEY (usuario_id) REFERENCES usuarios(id);

-- Clientes y ventas
ALTER TABLE ventas
  ADD CONSTRAINT fk_ventas_clientes FOREIGN KEY (cliente_id) REFERENCES clientes(id);

-- Ventas y detalles_venta
ALTER TABLE detalles_venta
  ADD CONSTRAINT fk_detalles_venta_ventas FOREIGN KEY (venta_id) REFERENCES ventas(id);

-- Productos y detalles_venta
ALTER TABLE detalles_venta
  ADD CONSTRAINT fk_detalles_venta_productos FOREIGN KEY (producto_id) REFERENCES productos(id);

-- Usuarios y cierres_caja
ALTER TABLE cierres_caja
  ADD CONSTRAINT fk_cierres_caja_usuarios FOREIGN KEY (usuario_id) REFERENCES usuarios(id);

-- Cierres_caja y movimientos_caja
ALTER TABLE movimientos_caja
  ADD CONSTRAINT fk_movimientos_caja_cierres_caja FOREIGN KEY (cierre_caja_id) REFERENCES cierres_caja(id);

-- Insertar datos de ejemplo (Recuerda usar contraseñas seguras en tu aplicación)
INSERT INTO roles (nombre, descripcion) VALUES ('administrador', 'Rol con todos los permisos');
INSERT INTO roles (nombre, descripcion) VALUES ('cajero', 'Rol con permisos limitados');
INSERT INTO roles (nombre, descripcion) VALUES ('vendedor', 'Rol con permisos para ventas');

-- Insertar un usuario administrador
INSERT INTO usuarios (username, password, nombre, apellido, rol_id, estado) 
VALUES 
  ('admin', '$2y$10$k6p9aX7e01/Z4/W.Q9L2OugP3D.Z8.4vM2f746Wq6R.Q.H3O3m.', 'Administrador', 'Sistema', 1, TRUE);

-- Insertar un usuario cajero
INSERT INTO usuarios (username, password, nombre, apellido, rol_id, estado) 
VALUES 
  ('cajero1', '$2y$10$k6p9aX7e01/Z4/W.Q9L2OugP3D.Z8.4vM2f746Wq6R.Q.H3O3m.', 'Cajero', 'Uno', 2, TRUE);

-- Insertar un usuario vendedor
INSERT INTO usuarios (username, password, nombre, apellido, rol_id, estado) 
VALUES 
  ('vendedor1', '$2y$10$k6p9aX7e01/Z4/W.Q9L2OugP3D.Z8.4vM2f746Wq6R.Q.H3O3m.', 'Vendedor', 'Dos', 3, TRUE);
	
	
/***************************************************************************************/

-- 2. Categorias (no tiene claves foráneas)
INSERT INTO categorias (nombre, descripcion) VALUES
  ('Ropa', 'Prendas de vestir'),
  ('Calzado', 'Zapatillas, zapatos'),
  ('Accesorios', 'Bolsos, sombreros');

-- 4. Productos (dependencia: categoria_id)
INSERT INTO productos (codigo, nombre, descripcion, precio_compra, precio_venta, stock, categoria_id, estado) VALUES
  ('P001', 'Camiseta', 'Camiseta de algodón', 10.00, 15.00, 50, 1, TRUE),
  ('P002', 'Pantalón', 'Pantalón de jean', 25.00, 35.00, 30, 2, TRUE),
  ('P003', 'Zapatillas', 'Zapatillas deportivas', 30.00, 40.00, 20, 3, TRUE);

-- 5. Clientes (no tiene claves foráneas)
INSERT INTO clientes (nombre, apellido, dni, direccion, telefono, email, estado) VALUES
  ('Pedro', 'García', '12345678', 'Av. Siempreviva 123', '555-1234', 'pedro.garcia@email.com', TRUE),
  ('Ana', 'Martínez', '87654321', 'Calle Principal 456', '555-5678', 'ana.martinez@email.com', TRUE);

-- 6. Proveedores (no tiene claves foráneas)
INSERT INTO proveedores (nombre, contacto, telefono, direccion, email, estado) VALUES
  ('Fábrica de Ropa S.A.', 'Juan López', '555-9876', 'Calle Industrial 789', 'fabricaderopa@email.com', TRUE),
  ('Calzado Deportivo S.R.L.', 'María Sánchez', '555-1011', 'Av. Industrial 1011', 'calzadodeportivo@email.com', TRUE);

-- 7. Ventas (dependencias: usuario_id, cliente_id)
INSERT INTO ventas (fecha, usuario_id, cliente_id, total, estado) VALUES
  (CURRENT_TIMESTAMP, 4, 1, 50.00, 'pendiente'),
  (CURRENT_TIMESTAMP, 4, 2, 75.00, 'pagado');

-- 8. Detalles_venta (dependencias: venta_id, producto_id)
INSERT INTO detalles_venta (venta_id, producto_id, cantidad, precio_unitario, descuento) VALUES
  (1, 1, 2, 15.00, 0.00),
  (1, 2, 1, 35.00, 0.00),
  (2, 3, 2, 40.00, 0.00);

-- 9. Cierres_caja (dependencia: usuario_id)
INSERT INTO cierres_caja (fecha, usuario_id, monto_inicial, monto_final) VALUES
  (CURRENT_TIMESTAMP, 4, 100.00, 200.00);

-- 10. Movimientos_caja (dependencia: cierre_caja_id)
INSERT INTO movimientos_caja (cierre_caja_id, tipo, descripcion, monto) VALUES
  (1, 'ingreso', 'Venta de productos', 50.00),
  (1, 'egreso', 'Pago a proveedores', 25.00);

