-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2025 at 10:18 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `product_id`, `user_name`, `comment_text`, `comment_date`) VALUES
(1, 1, 'user1', 'Excelente cadeira, muito confortável!', '2025-01-20 00:00:00'),
(2, 2, 'user1', 'Design incrível, mas poderia ser mais barata.', '2025-01-21 00:00:00'),
(3, 3, 'user1', 'Som cristalino! Ideal para gaming.', '2025-01-22 00:00:00'),
(4, 4, 'user1', 'Kit completo e vale cada cêntimo!', '2025-01-23 00:00:00'),
(5, 5, 'user1', 'Teclado compacto e fácil de usar.', '2025-01-24 00:00:00'),
(6, 6, 'user1', 'Teclado perfeito para quem gosta de RGB.', '2025-01-25 00:00:00'),
(7, 7, 'user1', 'Monitor com ótima qualidade de imagem.', '2025-01-26 00:00:00'),
(8, 8, 'user1', 'Máquina poderosa, desempenho impecável.', '2025-01-27 00:00:00'),
(9, 9, 'user1', 'PC topo de gama, recomendo para entusiastas.', '2025-01-28 00:00:00'),
(10, 1, 'user2', 'Adorei a iluminação RGB!', '2025-01-20 00:00:00'),
(11, 2, 'user2', 'Muito confortável e resistente.', '2025-01-21 00:00:00'),
(12, 3, 'user2', 'Ótimo custo-benefício para auscultadores.', '2025-01-22 00:00:00'),
(13, 4, 'user2', 'Montagem fácil e desempenho excelente.', '2025-01-23 00:00:00'),
(14, 5, 'user2', 'Marca confiável, recomendo bastante.', '2025-01-24 00:00:00'),
(15, 6, 'user2', 'Adoro o design e a iluminação.', '2025-01-25 00:00:00'),
(16, 7, 'user2', 'Ideal para sessões de gaming longas.', '2025-01-26 00:00:00'),
(17, 8, 'user2', 'Vale cada cêntimo pelo desempenho.', '2025-01-27 00:00:00'),
(18, 9, 'user2', 'A potência deste PC é incrível!', '2025-01-28 00:00:00'),
(19, 1, 'user3', 'Muito boa qualidade de construção.', '2025-01-20 00:00:00'),
(20, 2, 'user3', 'Cor única, faz diferença na sala.', '2025-01-21 00:00:00'),
(21, 3, 'user3', 'Auscultadores muito leves e confortáveis.', '2025-01-22 00:00:00'),
(22, 4, 'user3', 'Performance incrível para jogos.', '2025-01-23 00:00:00'),
(23, 5, 'user3', 'Muito prático para transporte.', '2025-01-24 00:00:00'),
(24, 6, 'user3', 'Altamente recomendado para gamers.', '2025-01-25 00:00:00'),
(25, 7, 'user3', 'Cores vivas e tempo de resposta excelente.', '2025-01-26 00:00:00'),
(26, 8, 'user3', 'Máxima eficiência em multitarefas.', '2025-01-27 00:00:00'),
(27, 9, 'user3', 'Desempenho ultra-rápido!', '2025-01-28 00:00:00'),
(28, 1, 'user4', 'Fácil de ajustar e muito confortável.', '2025-01-20 00:00:00'),
(29, 2, 'user4', 'Padrão incrível, combina com meu setup.', '2025-01-21 00:00:00'),
(30, 3, 'user4', 'Som imersivo e de alta qualidade.', '2025-01-22 00:00:00'),
(31, 4, 'user4', 'Este kit é simplesmente perfeito.', '2025-01-23 00:00:00'),
(32, 5, 'user4', 'Leve e muito prático.', '2025-01-24 00:00:00'),
(33, 6, 'user4', 'Teclas suaves, ótimo para digitação.', '2025-01-25 00:00:00'),
(34, 7, 'user4', 'Monitor ideal para gamers.', '2025-01-26 00:00:00'),
(35, 8, 'user4', 'PC robusto e confiável.', '2025-01-27 00:00:00'),
(36, 9, 'user4', 'Perfeito para jogos de alto desempenho.', '2025-01-28 00:00:00'),
(37, 1, 'user5', 'Ótimo para sessões longas.', '2025-01-20 00:00:00'),
(38, 2, 'user5', 'Estilo único e muito ergonômico.', '2025-01-21 00:00:00'),
(39, 3, 'user5', 'Ideal para música e gaming.', '2025-01-22 00:00:00'),
(40, 4, 'user5', 'Desempenho impressionante.', '2025-01-23 00:00:00'),
(41, 5, 'user5', 'Muito confiável e fácil de usar.', '2025-01-24 00:00:00'),
(42, 6, 'user5', 'Teclado incrível para trabalho e gaming.', '2025-01-25 00:00:00'),
(43, 7, 'user5', 'Imagem perfeita, sem atrasos.', '2025-01-26 00:00:00'),
(44, 8, 'user5', 'PC poderoso, perfeito para gamers.', '2025-01-27 00:00:00'),
(45, 9, 'user5', 'Melhor máquina do mercado!', '2025-01-28 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_cost` decimal(10,2) NOT NULL,
  `order_status` varchar(100) NOT NULL DEFAULT 'on_hold',
  `user_id` int(11) NOT NULL,
  `user_phone` int(11) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_cost`, `order_status`, `user_id`, `user_phone`, `user_city`, `user_address`, `order_date`) VALUES
(1001, 199.99, 'Pendente', 1, 912345678, 'Lisboa', 'Rua A, nº 10', '2025-01-20 00:00:00'),
(1002, 179.99, 'Concluído', 2, 913456789, 'Porto', 'Avenida B, nº 20', '2025-01-21 00:00:00'),
(1003, 209.97, 'Pendente', 3, 914567890, 'Coimbra', 'Rua C, nº 30', '2025-01-22 00:00:00'),
(1004, 1299.99, 'Concluído', 4, 915678901, 'Faro', 'Praça D, nº 40', '2025-01-23 00:00:00'),
(1005, 199.98, 'Cancelado', 5, 916789012, 'Braga', 'Travessa E, nº 50', '2025-01-24 00:00:00'),
(1006, 149.99, 'Pendente', 6, 917890123, 'Setúbal', 'Rua F, nº 60', '2025-01-25 00:00:00'),
(1007, 249.99, 'Concluído', 7, 918901234, 'Leiria', 'Estrada G, nº 70', '2025-01-26 00:00:00'),
(1008, 2199.99, 'Pendente', 8, 919012345, 'Viseu', 'Rua H, nº 80', '2025-01-27 00:00:00'),
(1009, 2499.99, 'Concluído', 9, 920123456, 'Évora', 'Alameda I, nº 90', '2025-01-28 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `order_cost` decimal(10,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL DEFAULT 1,
  `order_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_id`, `product_name`, `product_image`, `order_cost`, `user_id`, `product_quantity`, `order_date`) VALUES
(1, 1001, 1, 'Cadeira Gaming RGB', 'cadeira_rgb.jpg', 199.99, 1, 2, '2025-01-20 00:00:00'),
(2, 1002, 2, 'Cadeira Gaming Roxa', 'cadeira_roxa.jpg', 179.99, 2, 1, '2025-01-21 00:00:00'),
(3, 1003, 3, 'Headphones RGB', 'headphones_rgb.jpg', 69.99, 3, 3, '2025-01-22 00:00:00'),
(4, 1004, 4, 'Kit PC Gaming', 'kit_pc.jpg', 1299.99, 4, 1, '2025-01-23 00:00:00'),
(5, 1005, 5, 'Teclado Logitech', 'logitech_keyboard.jpg', 99.99, 5, 2, '2025-01-24 00:00:00'),
(6, 1006, 6, 'Teclado Razer RGB', 'razer_keyboard.jpg', 149.99, 6, 1, '2025-01-25 00:00:00'),
(7, 1007, 7, 'Monitor LG Gaming', 'monitor_lg.jpg', 249.99, 7, 1, '2025-01-26 00:00:00'),
(8, 1008, 8, 'PC Gaming RTX i9', 'pc_i9.jpg', 2199.99, 8, 1, '2025-01-27 00:00:00'),
(9, 1009, 9, 'PC Gaming Top', 'pc_top.jpg', 2499.99, 9, 1, '2025-01-28 00:00:00'),
(10, 1010, 2, 'Cadeira Gaming Roxa', 'cadeira_roxa.jpg', 179.99, 1, 1, '2025-01-20 20:50:19');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_category` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_image1`, `product_price`) VALUES
(1, 'Cadeira Gaming RGB', 'Cadeiras Gaming', 'A combinação perfeita entre estilo e conforto! Esta cadeira gaming conta com iluminação LED RGB vibrante, um design ergonómico e apoio lombar ajustável, tornando-a a escolha ideal para os jogadores que passam longas horas em frente ao ecrã.', 'cadeira_rgb.jpg', 199.99),
(2, 'Cadeira Gaming Roxa', 'Cadeiras Gaming', 'Com um padrão camuflado roxo exclusivo e um design que mistura modernidade e conforto, esta cadeira gaming oferece uma experiência premium, com apoio lombar ajustável e materiais de alta qualidade para uma durabilidade excecional.', 'cadeira_roxa.jpg', 179.99),
(3, 'Headphones RGB', 'Auscultadores Gaming', 'Mergulha num som cristalino com estes auscultadores gaming de última geração! Com som surround imersivo, microfone ajustável e iluminação RGB personalizável, são o acessório perfeito para qualquer jogador.', 'headphones_rgb.jpg', 69.99),
(4, 'Kit PC Gaming', 'Kits de PC Gaming', 'Um kit completo para os verdadeiros entusiastas de gaming! Inclui um PC topo de gama com componentes de alto desempenho, teclado e rato RGB, e tudo o que precisas para uma experiência de jogo inesquecível.', 'kit_pc.jpg', 1299.99),
(5, 'Teclado Logitech', 'Teclados Gaming', 'O equilíbrio perfeito entre desempenho e portabilidade. Este teclado mecânico da Logitech destaca-se pelo seu design compacto, iluminação RGB personalizável e switches ultrarrápidos, ideal para quem procura precisão máxima.', 'logitech_keyboard.jpg', 99.99),
(6, 'Teclado Razer RGB', 'Teclados Gaming', 'Descobre a excelência com este teclado mecânico da Razer, concebido para os jogadores mais exigentes. Oferece iluminação RGB espetacular, construção robusta e switches de resposta rápida para um controlo perfeito.', 'razer_keyboard.jpg', 149.99),
(7, 'Monitor LG Gaming', 'Monitores Gaming', 'Desfruta de gráficos incríveis com este monitor LG de 27 polegadas, equipado com resolução Full HD e uma taxa de atualização de 144Hz, garantindo uma jogabilidade fluida e detalhada para os jogadores mais exigentes.', 'monitor_lg.jpg', 249.99),
(8, 'PC Gaming RTX i9', 'PCs Gaming', 'Projetado para quem não aceita compromissos, este PC gaming conta com o poderoso processador Intel i9 e uma placa gráfica RTX de última geração. Perfeito para jogar os títulos mais desafiantes com qualidade máxima.', 'pc_i9.jpg', 2199.99),
(9, 'PC Gaming Top', 'PCs Gaming', 'Uma verdadeira obra-prima no mundo do gaming! Este PC combina um design premium com iluminação RGB deslumbrante e componentes de alta performance, garantindo horas de diversão e desempenho inigualável.', 'pc_top.jpg', 2499.99);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(1, 'user1', 'user1@gmail.com', '$2y$10$dDd70vhpqx4HDSWKq3C/KuIPxpEv9jsK4W/KVPiEJ/5wtBqjNBoA.'),
(2, 'user2', 'user2@gmail.com', '$2y$10$dDd70vhpqx4HDSWKq3C/KuIPxpEv9jsK4W/KVPiEJ/5wtBqjNBoA.'),
(3, 'user3', 'user3@gmail.com', '$2y$10$dDd70vhpqx4HDSWKq3C/KuIPxpEv9jsK4W/KVPiEJ/5wtBqjNBoA.'),
(4, 'user4', 'user4@gmail.com', '$2y$10$dDd70vhpqx4HDSWKq3C/KuIPxpEv9jsK4W/KVPiEJ/5wtBqjNBoA.'),
(5, 'user5', 'user5@gmail.com', '$2y$10$dDd70vhpqx4HDSWKq3C/KuIPxpEv9jsK4W/KVPiEJ/5wtBqjNBoA.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UX_Constraint` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1011;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
