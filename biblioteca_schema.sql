-- Tabla Llibres (ahora con num_exemplars)
INSERT INTO Llibres (titol, autor, isbn, any_publicacio, num_exemplars) VALUES
('El nom de la rosa',    'Umberto Eco',      '978-8420679389', 1980, 3),
('Tirant lo Blanch',     'Joanot Martorell', '978-8441419100', 1490, 2),
('La plaça del Diamant', 'Mercè Rodoreda',   '978-8497871501', 1962, 4),
('Solitud',              'Víctor Català',    '978-8473291234', 1905, 1),
('El metge de Fortuny',  'Martí de Riquer',  '978-8429755678', 2001, 2);

-- Tabla Socis (sin cambios)
INSERT INTO Socis (nom, telefon, email, data_alta, actiu) VALUES
('Anna García',     '612345678', 'anna.garcia@email.com',   '2024-01-15', 1),
('Pere Martínez',   '623456789', 'pere.martinez@email.com', '2024-03-22', 1),
('Marta López',     '634567890', 'marta.lopez@email.com',   '2023-11-05', 1),
('Joan Puig',       '645678901',  NULL,                     '2023-08-10', 0),
('Laura Fernández', '656789012', 'laura.f@email.com',       '2025-02-28', 1);

-- Tabla Prestecs
-- id_soci e id_llibre referencian los ids insertados arriba (1-5)
INSERT INTO Prestecs (data_prestec, data_retorn_prevista, data_retorn_real, id_soci, id_llibre) VALUES
('2025-01-10', '2025-01-24', '2025-01-22', 1, 3),  -- Anna retornó
('2025-02-05', '2025-02-19', '2025-02-20', 2, 1),  -- Pere retornó tarde
('2025-03-01', '2025-03-15', NULL,          3, 2),  -- Marta aún no retornó
('2025-03-10', '2025-03-24', NULL,          5, 4),  -- Laura aún no retornó
('2025-04-01', '2025-04-15', '2025-04-14', 1, 5);  -- Anna retornó