CREATE TABLE videojuegos (
id INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(100) UNIQUE NOT NULL,
descripcion TEXT,
categoria ENUM('Accion', 'Aventura', 'RPG', 'Deportes') NOT NULL,
disponible ENUM('SI', 'NO') NOT NULL DEFAULT 'SI',
precio DECIMAL(5,2) NOT NULL
);

INSERT INTO videojuegos (nombre, descripcion, categoria, disponible, precio) VALUES
('Elden Ring', 'Un RPG de mundo abierto con combates desafiantes y exploración profunda.', 'RPG', 'SI', 59.99),
('FIFA 25', 'Simulador de fútbol con licencias oficiales y modos competitivos online.', 'Deportes', 'SI', 49.99),
('The Legend of Zelda: Echoes of Time', 'Aventura épica con exploración de templos y puzles complejos.', 'Aventura', 'SI', 69.90),
('Dark Souls III', 'Acción y RPG con alta dificultad y ambientación oscura.', 'Accion', 'SI', 39.99),
('Hollow Knight', 'Aventura metroidvania en un mundo subterráneo lleno de criaturas e insectos.', 'Aventura', 'NO', 14.99),
('NBA 2K25', 'Simulador de baloncesto con gráficos realistas y mecánicas avanzadas.', 'Deportes', 'SI', 59.50),
('Final Fantasy XVI', 'RPG narrativo con batallas dinámicas y gran calidad visual.', 'RPG', 'SI', 69.99),
('Rocket League', 'Frenético juego de deportes que mezcla fútbol con vehículos acrobáticos.', 'Deportes', 'SI', 19.99),
('Assassin''s Creed Mirage', 'Juego de acción y aventura ambientado en Oriente Medio.', 'Accion', 'SI', 49.99),
('The Witcher 3', 'RPG de mundo abierto centrado en decisiones y narrativa profunda.', 'RPG', 'NO', 29.99),
('Uncharted: Lost Legacy', 'Aventura cinematográfica con exploración y combate.', 'Aventura', 'SI', 24.99),
('Street Fighter VI', 'Juego de lucha con múltiples personajes y modos competitivos.', 'Accion', 'SI', 59.99),
('Gran Turismo 8', 'Simulador de conducción con cientos de vehículos y circuitos.', 'Deportes', 'NO', 69.99),
('Dragon Quest XI', 'RPG clásico con estética colorida y combate por turnos.', 'RPG', 'SI', 39.50),
('Tomb Raider: Origins', 'Juego de aventura con exploración, sigilo y combates intensos.', 'Aventura', 'SI', 44.99);