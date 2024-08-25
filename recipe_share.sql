-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 30, 2024 at 04:39 PM
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
-- Database: `recipe_share`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `createdOn` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `createdOn`) VALUES
(1, 'breakfast', '2024-05-27 12:56:04'),
(4, 'lunch', '2024-05-27 12:56:04'),
(5, 'dinner', '2024-05-27 12:56:04'),
(10, 'birthday', '2024-05-30 13:49:21'),
(11, 'Italian', '2024-05-30 13:43:25'),
(12, 'mexican', '2024-05-30 13:48:04'),
(14, 'holiday', '2024-05-30 13:49:39'),
(15, 'chinese', '2024-05-30 14:09:14');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `ingredients` text NOT NULL,
  `preparation` text NOT NULL,
  `cooking_time` int(11) NOT NULL,
  `serving_size` int(11) NOT NULL,
  `special_instructions` text DEFAULT NULL,
  `published` tinyint(1) DEFAULT 0,
  `created_at` datetime NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `user_id`, `category_id`, `title`, `ingredients`, `preparation`, `cooking_time`, `serving_size`, `special_instructions`, `published`, `created_at`, `image_path`, `description`) VALUES
(46, 31, 1, 'Chicken Bhuna', '⅔ cup milk\r\n2 large eggs\r\n1 teaspoon vanilla extract (Optional)\r\n¼ teaspoon ground cinnamon (Optional)\r\nsalt to taste\r\n6 thick slices bread\r\n1 tablespoon unsalted butter, or more as needed', 'Gather all ingredients.\r\nWhisk milk, eggs, vanilla, cinnamon, and salt together in a shallow bowl.\r\nLightly butter a griddle or skillet and heat over medium-high heat.\r\nDunk bread in the egg mixture, soaking both sides\r\nTransfer to the hot skillet and cook until golden, 3 to 4 minutes per side.\r\nServe hot.', 10, 3, '', 1, '2024-05-28 06:47:13', 'uploads/recipes/66550d71cb73b.jpg', 'This fabulous French toast recipe works with many types of bread — white, whole wheat, brioche, cinnamon-raisin, Italian, or French! Delicious served hot with butter and maple syrup.'),
(48, 32, 15, 'Zhajiangmian', 'Sweet bean paste and water\r\nSliced cucumber (and other toppings if you prefer)\r\nMinced ginger\r\nShaoxing wine\r\nOil for cooking\r\nGround pork\r\nChopped onion', 'Add sweet bean sauce to a large bowl. Slowly blend in water and stir constantly, until water is fully incorporated.\r\nHeat a large skillet or a wok over medium-high heat until hot. Add the oil and the ginger. Stir a few times to release the fragrance.\r\nAdd the pork. Cook, stir and chop, until the pork turns to small pieces and has browned. Pour in the Shaoxing wine. Stir and cook for 1 minute.\r\nAdd the sweet bean sauce and turn to medium heat. Stir constantly, until the sauce thickens and turns darker, about 10 mins. If the sauce thickens too quickly and starts to feel like it’s sticking to the bottom of the pan, turn to medium-low heat and slowly blend in more warm water, 2 tablespoons at a time. Reduce the heat if the pan gets too smoky.\r\nAdd the onion. Cook and stir for 3 to 5 minutes, until the onion has softened but remains crispy. Turn off heat and transfer the sauce to a large bowl.\r\nWhile cooking the noodle sauce, bring a large pot of water to a boil and cook noodles according to instructions. Once done, drain the noodles immediately and rinse with cold tap water to stop cooking. Drain again.\r\nAdd noodles to individual serving bowls. Top noodles with sauce, cucumber, and stir fried tomato and egg if using. Garnish with cilantro or green onions. Serve as a main dish', 20, 3, '', 1, '2024-05-30 22:11:37', 'uploads/recipes/6658891919598.jpg', 'A popular classic Beijing dish, Zha Jiang Mian features ground pork and onion cooked in a rich savory brown sauce with a hint of sweetness, tossed with noodles and then served with crunchy cucumber. '),
(49, 31, 11, 'Vitello Tonnato', '1 1/3 lb of veal shoulder\r\n1 carrot\r\n1 onion, halved but not peeled\r\n1 celery stick\r\n2 garlic cloves\r\n5 cloves\r\n6 black peppercorns\r\n2 bay leaves\r\n1 pinch of salt\r\n1 1/16 pint of white wine\r\n3 1/4 pints of water', 'Begin by marinating the veal. Place the meat in a large saucepan with the carrot, onion, celery, garlic, cloves, peppercorns, bay leaves and salt. Pour the white wine over the meat, cover, and leave for about 30 minutes to allow the meat to marinate.\r\nAdd the water to the pan, bring to the boil and turn the heat right down. Cover and simmer for 1 hour 30 minutes.\r\nRemove the meat from the liquid and allow to cool completely. Don’t throw the liquid away, strain it and use in another recipe.\r\nWhile the meat is cooling, make the tuna sauce. Place the tuna, capers, anchovy fillets and egg yolks in a food processor and blitz for about 30 seconds. Add the lemon juice and whiz for another 10 seconds. Season with black pepper.\r\nTurn the food processor onto the lowest speed and add the olive oil, slowly, in a single stream. The finished sauce will have a similar consistency to fresh mayonnaise.\r\nTo serve, slice the beef as thinly as possible and place the slices on a large serving dish. Pour the sauce over the top of the meat but leave some of the meat showing around the edge. Garnish with whole capers.', 60, 4, '', 0, '2024-05-30 22:18:30', 'uploads/recipes/66588ab613fb4.jpg', 'Vitello Tonnato is a kind of ‘surf and turf’ from the north-eastern region of Piemonte. As a child, I spent several magical summers there at my uncle’s house, cycling through seemingly endless fields of maize and picnicking in the hills around Asti. '),
(50, 31, 4, 'Egg Salad', 'Egg\r\nCondiments: You\'ll need mayonnaise and mustard\r\nGreen onion\r\nSeasonings: This egg salad is simply seasoned with salt, pepper, and paprika.', 'Boil, peel, and chop the eggs.\r\nCombine the chopped eggs and the remaining ingredients.\r\nServe on bread or with crackers.', 15, 4, '', 1, '2024-05-30 22:35:36', 'uploads/recipes/66588eb825ba0.jpg', 'This egg salad recipe is the best and easy to make with chopped boiled eggs, mayonnaise, mustard, and green onions for some color and crunch.');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `role`) VALUES
(30, 'admin', 'admin', 'admin', 'admin@admin.com', '$2y$10$2r5/0Npk2nDjmctuT/Rvt.nfSRooPky89RhbAK91.tZHqprQCe4/S', 'Admin'),
(31, 'khurt', 'gonzales', 'khurt', 'khurtgonzales60@gmail.com', '$2y$10$Kx4x8CofV3E1JNe48zrKUe16z2hPvIkvKvvJwPMIq7BG6EBfFSY8i', 'Chef/Cook'),
(32, 'mary rose', 'postrero', 'mary', 'maryrose@gmail.com', '$2y$10$UvKzAsXp4mmTuA7qUr4iLugK5y0ECkkg2pBbxqwDpe4jkxStRlnDS', 'Chef/Cook'),
(33, 'vea', 'almaden', 'vea', 'vea.almaden@gmail.com', '$2y$10$OiBSRZzCeLMogNEKDGGSU.pic8hJJqRgAG7kwumvRBqOEho4y9DR6', 'Chef/Cook'),
(34, 'queency', 'lastimado', 'queency', 'queency.lastimado@gmail.com', '$2y$10$Ra8cVB5xEzgmOVpDVQYNjOqDsuqwGx4kGK3P7ycrKinZOlSsiVaJS', 'Chef/Cook'),
(35, 'Ken', 'En', 'Ken', 'ken.en@gmail.com', '$2y$10$.7nvviNkNeZCkkKspC.iW.1Ls4TTQoTDj7LuoH/Fht6TjZIjYK03C', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category_id` (`category_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipe_id` (`recipe_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `fk_category_id` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
