-- Eliminar la base de datos si ya existe
DROP DATABASE IF EXISTS gestion_hotel;
CREATE DATABASE gestion_hotel CHARACTER SET utf8mb4;
USE gestion_hotel;

-- Tabla para tipos de habitaciones
CREATE TABLE tipo_habitacion (
    tipo_habitacion_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_tipo VARCHAR(50) NOT NULL,
    descripcion TEXT
);

-- Tabla para habitaciones
CREATE TABLE habitacion (
    habitacion_id INT AUTO_INCREMENT PRIMARY KEY,
    numero_habitacion VARCHAR(10) NOT NULL,
    tipo_habitacion_id INT NOT NULL,
    piso INT NOT NULL,
    estado VARCHAR(20) DEFAULT 'Disponible',
    FOREIGN KEY (tipo_habitacion_id) REFERENCES tipo_habitacion(tipo_habitacion_id)
);

-- Tabla para clientes
CREATE TABLE cliente (
    cliente_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    email VARCHAR(100),
    telefono VARCHAR(20),
    direccion VARCHAR(255)
);

-- Tabla para reservas
CREATE TABLE reserva (
    reserva_id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    habitacion_id INT NOT NULL,
    fecha_entrada DATE NOT NULL,
    fecha_salida DATE NOT NULL,
    monto_total DECIMAL(10, 2) NOT NULL,
    estado VARCHAR(20) DEFAULT 'Pendiente',
    FOREIGN KEY (cliente_id) REFERENCES cliente(cliente_id),
    FOREIGN KEY (habitacion_id) REFERENCES habitacion(habitacion_id)
);

-- Tabla para pagos
CREATE TABLE pago (
    pago_id INT AUTO_INCREMENT PRIMARY KEY,
    reserva_id INT NOT NULL,
    fecha_pago DATE NOT NULL,
    monto DECIMAL(10, 2) NOT NULL,
    metodo_pago VARCHAR(50),
    FOREIGN KEY (reserva_id) REFERENCES reserva(reserva_id)
);

-- Tabla para empleados
CREATE TABLE empleado (
    empleado_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    email VARCHAR(100),
    telefono VARCHAR(20),
    puesto VARCHAR(50),
    salario DECIMAL(10, 2)
);

-- Tabla para servicios
CREATE TABLE servicio (
    servicio_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_servicio VARCHAR(50) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL
);

-- Tabla para servicios utilizados por los clientes
CREATE TABLE servicio_cliente (
    servicio_cliente_id INT AUTO_INCREMENT PRIMARY KEY,
    reserva_id INT NOT NULL,
    servicio_id INT NOT NULL,
    fecha_servicio DATE NOT NULL,
    cantidad INT DEFAULT 1,
    precio_total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (reserva_id) REFERENCES reserva(reserva_id),
    FOREIGN KEY (servicio_id) REFERENCES servicio(servicio_id)
);

-- Tabla para solicitudes de mantenimiento
CREATE TABLE solicitud_mantenimiento (
    solicitud_id INT AUTO_INCREMENT PRIMARY KEY,
    habitacion_id INT NOT NULL,
    fecha_solicitud DATE NOT NULL,
    descripcion TEXT,
    estado VARCHAR(20) DEFAULT 'Pendiente',
    FOREIGN KEY (habitacion_id) REFERENCES habitacion(habitacion_id)
);

-- Tabla para proveedores
CREATE TABLE proveedor (
    proveedor_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_empresa VARCHAR(100) NOT NULL,
    nombre_contacto VARCHAR(50),
    telefono_contacto VARCHAR(20),
    direccion VARCHAR(255)
);

-- Tabla para inventarios (artículos disponibles en el hotel)
CREATE TABLE inventario (
    inventario_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_articulo VARCHAR(50) NOT NULL,
    descripcion TEXT,
    cantidad INT NOT NULL,
    proveedor_id INT,
    FOREIGN KEY (proveedor_id) REFERENCES proveedor(proveedor_id)
);

-- Tabla para eventos (eventos realizados en el hotel)
CREATE TABLE evento (
    evento_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_evento VARCHAR(100) NOT NULL,
    fecha_evento DATE NOT NULL,
    descripcion TEXT,
    nombre_organizador VARCHAR(50),
    contacto_organizador VARCHAR(20)
);

-- Tabla para reservas de eventos
CREATE TABLE reserva_evento (
    reserva_evento_id INT AUTO_INCREMENT PRIMARY KEY,
    evento_id INT NOT NULL,
    cliente_id INT NOT NULL,
    fecha_reserva DATE NOT NULL,
    FOREIGN KEY (evento_id) REFERENCES evento(evento_id),
    FOREIGN KEY (cliente_id) REFERENCES cliente(cliente_id)
);

-- Tabla para retroalimentación (comentarios de los clientes)
CREATE TABLE retroalimentacion (
    retroalimentacion_id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    fecha_retroalimentacion DATE NOT NULL,
    calificacion INT CHECK(calificacion >= 1 AND calificacion <= 5),
    comentarios TEXT,
    FOREIGN KEY (cliente_id) REFERENCES cliente(cliente_id)
);

-- Tabla para horarios de limpieza de habitaciones
CREATE TABLE horario_limpieza (
    horario_id INT AUTO_INCREMENT PRIMARY KEY,
    habitacion_id INT NOT NULL,
    fecha_limpieza DATE NOT NULL,
    empleado_id INT NOT NULL,
    FOREIGN KEY (habitacion_id) REFERENCES habitacion(habitacion_id),
    FOREIGN KEY (empleado_id) REFERENCES empleado(empleado_id)
);

-- Tabla para ofertas promocionales
CREATE TABLE oferta_promocional (
    oferta_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_oferta VARCHAR(100) NOT NULL,
    descripcion TEXT,
    fecha_inicio DATE NOT NULL,
    fecha_fin DATE NOT NULL,
    porcentaje_descuento DECIMAL(5, 2) NOT NULL
);

-- Tabla para actividades (actividades organizadas por el hotel)
CREATE TABLE actividad (
    actividad_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_actividad VARCHAR(100) NOT NULL,
    descripcion TEXT,
    fecha_actividad DATE NOT NULL,
    costo DECIMAL(10, 2) NOT NULL
);

-- Tabla para reservas de actividades
CREATE TABLE reserva_actividad (
    reserva_actividad_id INT AUTO_INCREMENT PRIMARY KEY,
    actividad_id INT NOT NULL,
    cliente_id INT NOT NULL,
    fecha_reserva DATE NOT NULL,
    FOREIGN KEY (actividad_id) REFERENCES actividad(actividad_id),
    FOREIGN KEY (cliente_id) REFERENCES cliente(cliente_id)
);

-- Tabla para detalles del inventario (detalles específicos de los artículos)
CREATE TABLE detalle_inventario (
    detalle_inventario_id INT AUTO_INCREMENT PRIMARY KEY,
    inventario_id INT NOT NULL,
    cantidad INT NOT NULL,
    fecha_entrada DATE NOT NULL,
    fecha_salida DATE,
    FOREIGN KEY (inventario_id) REFERENCES inventario(inventario_id)
);

-- Tabla para reportes de mantenimiento (informes de mantenimiento realizados)
CREATE TABLE reporte_mantenimiento (
    reporte_mantenimiento_id INT AUTO_INCREMENT PRIMARY KEY,
    solicitud_id INT NOT NULL,
    empleado_id INT NOT NULL,
    fecha_reporte DATE NOT NULL,
    descripcion TEXT,
    FOREIGN KEY (solicitud_id) REFERENCES solicitud_mantenimiento(solicitud_id),
    FOREIGN KEY (empleado_id) REFERENCES empleado(empleado_id)
);

-- Tabla para menús de restaurante (menús disponibles en el restaurante del hotel)
CREATE TABLE menu_restaurante (
    menu_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_menu VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL
);

-- Tabla para pedidos de restaurante (pedidos realizados en el restaurante del hotel)
CREATE TABLE pedido_restaurante (
    pedido_restaurante_id INT AUTO_INCREMENT PRIMARY KEY,
    menu_id INT NOT NULL,
    cliente_id INT NOT NULL,
    fecha_pedido DATE NOT NULL,
    cantidad INT NOT NULL,
    precio_total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (menu_id) REFERENCES menu_restaurante(menu_id),
    FOREIGN KEY (cliente_id) REFERENCES cliente(cliente_id)
);

-- Insertar datos de ejemplo
INSERT INTO tipo_habitacion (nombre_tipo, descripcion) VALUES
('Individual', 'Habitación individual con una cama'),
('Doble', 'Habitación doble con dos camas'),
('Suite', 'Suite de lujo con comodidades adicionales');

INSERT INTO habitacion (numero_habitacion, tipo_habitacion_id, piso, estado) VALUES
('101', 1, 1, 'Disponible'),
('102', 2, 1, 'Disponible'),
('201', 1, 2, 'Ocupada'),
('202', 2, 2, 'Disponible'),
('301', 3, 3, 'Disponible');

INSERT INTO servicio (nombre_servicio, descripcion, precio) VALUES
('Servicio de Habitación', 'Servicio de habitación las 24 horas', 20.00),
('Spa', 'Servicios de spa relajantes', 50.00),
('Gimnasio', 'Acceso al gimnasio', 15.00);

INSERT INTO empleado (nombre, apellido, email, telefono, puesto, salario) VALUES
('Juan', 'Pérez', 'juan.perez@hotel.com', '555-1234', 'Gerente', 5000.00),
('Ana', 'Gómez', 'ana.gomez@hotel.com', '555-5678', 'Recepcionista', 3000.00),
('Luis', 'Martínez', 'luis.martinez@hotel.com', '555-8765', 'Limpiador', 2500.00);

INSERT INTO proveedor (nombre_empresa, nombre_contacto, telefono_contacto, direccion) VALUES
('SuministrosHotel', 'Carlos', '555-4321', '123 Calle de Suministros'),
('ProveeduríaHotelera', 'Lucía', '555-6789', '456 Avenida del Proveedor');

INSERT INTO inventario (nombre_articulo, descripcion, cantidad, proveedor_id) VALUES
('Toalla', 'Toalla de baño', 100, 1),
('Champú', 'Botella de champú', 200, 2),
('Almohada', 'Almohada cómoda', 50, 1);

INSERT INTO oferta_promocional (nombre_oferta, descripcion, fecha_inicio, fecha_fin, porcentaje_descuento) VALUES
('Venta de Invierno', '20% de descuento en todas las habitaciones', '2024-01-01', '2024-01-31', 20.00),
('Especial de Verano', '15% de descuento en suites', '2024-06-01', '2024-08-31', 15.00);

INSERT INTO actividad (nombre_actividad, descripcion, fecha_actividad, costo) VALUES
('Clase de Yoga', 'Clase de yoga matutina', '2024-07-15', 10.00),
('Tour de la Ciudad', 'Tour guiado por la ciudad', '2024-07-16', 25.00);
