-- Banco de dados: bdpetimagens
-- CREATE DATABASES bdpetimagens;
-- USES bdpetimagens;

CREATE TABLE pets 
(
  id int(11) NOT NULL,
  nome varchar(100) NOT NULL,
  especie enum('cachorro','gato') NOT NULL,
  raca varchar(80) DEFAULT NULL,
  idade int(11) DEFAULT NULL,
  imagem varchar(255) NOT NULL,
  cadastrado_em datetime DEFAULT current_timestamp(),
  status enum('disponivel','adotado') DEFAULT 'disponivel'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO pets (id, nome, especie, raca, idade, imagem, cadastrado_em, status) VALUES
(1, 'Pet 1', 'cachorro', 'Vira-lata', 2, 'uploads/pets/pet- (1).jpg', '2026-04-14 20:49:26', 'disponivel'),
(2, 'Pet 2', 'gato', 'Siamês', 3, 'uploads/pets/pet- (2).jpg', '2026-04-14 20:49:26', 'disponivel'),
(3, 'Pet 3', 'cachorro', 'Sem raça', 1, 'uploads/pets/pet- (3).jpg', '2026-04-14 20:49:26', 'disponivel'),
(4, 'Pet 4', 'gato', 'Vira-lata', 4, 'uploads/pets/pet- (4).jpg', '2026-04-14 20:49:26', 'disponivel'),
(5, 'Pet 5', 'cachorro', 'Labrador', 5, 'uploads/pets/pet- (5).jpg', '2026-04-14 20:49:26', 'disponivel'),
(6, 'Pet 6', 'gato', 'Persa', 2, 'uploads/pets/pet- (6).jpg', '2026-04-14 20:49:26', 'disponivel'),
(7, 'Pet 7', 'cachorro', 'Vira-lata', 6, 'uploads/pets/pet- (7).jpg', '2026-04-14 20:49:26', 'disponivel'),
(8, 'Pet 8', 'gato', 'Sem raça', 1, 'uploads/pets/pet- (8).jpg', '2026-04-14 20:49:26', 'disponivel'),
(9, 'Pet 9', 'cachorro', 'Poodle', 3, 'uploads/pets/pet- (9).jpg', '2026-04-14 20:49:26', 'disponivel'),
(10, 'Pet 10', 'gato', 'Vira-lata', 4, 'uploads/pets/pet- (10).jpg', '2026-04-14 20:49:26', 'disponivel'),
(11, 'Pet 11', 'cachorro', 'Sem raça', 2, 'uploads/pets/pet- (11).jpg', '2026-04-14 20:49:26', 'disponivel'),
(12, 'Pet 12', 'gato', 'Siamês', 5, 'uploads/pets/pet- (12).jpg', '2026-04-14 20:49:26', 'disponivel'),
(13, 'XUXU', 'cachorro', 'CASCA GROSSA', 5, 'uploads/pets/pet- (13).jpg', '2026-04-14 21:03:21', 'disponivel');

ALTER TABLE pets  ADD PRIMARY KEY (id);
ALTER TABLE pets  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
