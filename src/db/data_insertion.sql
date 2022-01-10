INSERT INTO `user` (`username`, `email`, `password`, `is_admin`) VALUES
('admin', 'admin@eatup.com', '$2y$10$yC1xRBWWeImUWSzlAcZnMu9KAVtssbIEvAhqzkPX3terWD1Iqrdg6', '1');

INSERT INTO `category` (`id_category`, `category_name`) VALUES
(1, 'Panini'),
(2, 'Pizza'),
(3, 'HotDog'),
(4, 'Snacks'),
(5, 'Desserts'),
(6, 'Drinks');

ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

INSERT INTO `product` (`id_product`, `product_name`, `product_img`, `price`, `description`, `rating`, `kcal`) VALUES
(1, 'Hamburger', 'hamburger.png', 4.00, 'Panino con carne di manzo e pomodoro', 4.2, 300),
(2, 'Cheeseburger', 'cheeseburger.png', 4.50, 'Panino con carne di manzo, pomodoro e cheddar', 4.4, 350),
(3, 'Bacon Burger', 'bacon_burger.png', 6.00, 'Panino con carne di manzo, pomodoro e bacon', 4.6, 450),
(4, 'Chicken Burger', 'chicken_burger.png', 5.50, 'Panino con cotoletta di pollo e maionese', 4.6, 450),
(5, 'Burrito', 'burrito.png', 5.00, 'Burrito con pollo fritto, pomodoro e insalata', 4.3, 400),
(6, 'Nachos', 'nachos.png', 4.50, 'Nachos con jalapeños e cheddar fuso', 4.7, 300),
(7, 'Hot Dog spicy', 'hot_dog_spicy.png', 4.00, 'Hot Dog con ketchup, maionese, jalapeños e cipolla', 4.1, 400),
(8, 'Patatine - Small', 'patatine_small.png', 5.50, 'Patatine fritte pepate - porzione piccola', 4.4, 200),
(9, 'Patatine - Medium', 'patatine_medium.png', 5.50, 'Patatine fritte pepate - porzione media', 4.6, 320),
(10, 'Patatine - Large', 'patatine_large.png', 5.50, 'Patatine fritte pepate - porzione grande', 4.8, 450),
(11, 'Patate al forno', 'patate_forno.png', 5.50, 'Patate al forno croccanti con pepe e paprika', 4.9, 350),
(12, 'Nuggets', 'nuggets.png', 4.00, 'Crocchette fritte di pollo dorate - 10 pezzi', 4.5, 300),
(13, 'Acqua naturale', 'acqua_naturale.png', 1.00, "Acqua naturale Sant'Anna - bottiglia da 500ml", 0, 0),
(14, 'Acqua frizzante', 'acqua_frizzante.png', 1.00, "Acqua frizzante Sant'Anna - bottiglia da 500ml", 0, 0),
(15, 'Coca Cola', 'coca_cola.png', 1.50, 'Coca cola da 500ml', 0, 210),
(16, 'Thè pesca', 'thè_pesca.png', 2.00, 'FuzeTea alla pesca - 400ml', 0, 200),
(17, 'Thè limone', 'thè_limone.png', 2.00, 'FuzeTea al limone - 400ml', 0, 200),
(18, 'Bufala', 'bufala.png', 6.00, 'Pizza con pomodoro e mozzarella di bufala campana', 4.9, 900),
(19, 'Margherita', 'margherita.png', 5.00, 'Pizza con pomodoro, mozzarella e basilico', 4.7, 700),
(20, 'Diavola', 'diavola.png', 6.00, 'Pizza con pomodoro, mozzarella e salame piccante', 4.6, 950),
(21, 'Passeggiata', 'passeggiata.png', 7.00, 'Pizza con pomodoro, mozzarella e verdure di stagione', 4.4, 870),
(22, 'Torta giada', 'croccante_cioccolato.png', 4.00, 'Fetta di torta gelato al cioccolato con frutta secca croccante e cocco', 4.6, 450),
(23, 'Cheesecake', 'cheesecake.png', 4.00, 'Fetta di cheesecake ai frutti rossi (fragole, lamponi e ciligie)', 4.7, 500),
(24, 'Pancake', 'pancake.png', 2.50, "Pancake (2 pezzi) con sciroppo d'acero", 4.8, 350),
(25, 'Hot Dog', 'hot_dog_simple.png', 3.50, "Hot Dog con würstel austriaco e senape", 4.3, 350);

ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

INSERT INTO `product_has_category` (`product`, `category`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 4),
(7, 3),
(8, 4),
(9, 4),
(10, 4),
(11, 4),
(12, 4),
(13, 6),
(14, 6),
(15, 6),
(16, 6),
(17, 6),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 5),
(23, 5),
(24, 5),
(25, 3);

INSERT INTO `delivery_man` (`delivery_man_name`, `delivery_man_img`) VALUES
("Luca", "luca.jpg"),
("Giorgio", "giorgio.jpg"),
("Massimo", "massimo.jpg"),
("Laura", "laura.jpg"),
("Chiara", "chiara.jpg"),
("Michael", "michael.jpg"),
("Alex", "alex.jpg");