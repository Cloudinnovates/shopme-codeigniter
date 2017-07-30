-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2017 at 08:50 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopme`
--

-- --------------------------------------------------------

--
-- Table structure for table `books_items`
--

CREATE TABLE `books_items` (
  `item_id` int(11) NOT NULL,
  `item_category` varchar(50) NOT NULL DEFAULT 'NA',
  `item_brand` varchar(50) NOT NULL DEFAULT 'NA',
  `item_cost` int(11) NOT NULL DEFAULT '0',
  `item_stock` int(11) NOT NULL DEFAULT '1',
  `item_description` varchar(50) NOT NULL,
  `item_path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books_items`
--

INSERT INTO `books_items` (`item_id`, `item_category`, `item_brand`, `item_cost`, `item_stock`, `item_description`, `item_path`) VALUES
(0, '', '', 0, 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `user_id` int(10) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image_id` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`user_id`, `category`, `image_id`) VALUES
(1, 'kids', 3),
(1, 'kids', 2),
(1, 'kids', 21),
(9, 'kids', 5),
(9, 'mens', 1),
(9, 'mens', 5),
(9, 'mens', 4),
(3, 'mens', 2);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `sender` int(5) NOT NULL,
  `receiver` int(5) NOT NULL,
  `at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`sender`, `receiver`, `at`, `message`) VALUES
(1, 2, '2017-06-15 08:28:38', 'hii admin i am bob'),
(2, 1, '2017-06-15 08:28:58', 'hello bob how r u'),
(2, 3, '2017-06-15 08:29:05', 'hi ramana'),
(1, 2, '2017-06-15 08:29:22', 'i am fine'),
(3, 2, '2017-06-15 08:29:44', 'hello'),
(2, 1, '2017-06-15 08:46:16', 'hi bob'),
(2, 1, '2017-06-15 08:55:38', 'hi bob'),
(1, 2, '2017-06-15 11:13:49', 'hi admin');

-- --------------------------------------------------------

--
-- Table structure for table `electronics_items`
--

CREATE TABLE `electronics_items` (
  `item_id` int(11) NOT NULL,
  `item_category` varchar(50) NOT NULL DEFAULT 'NA',
  `item_brand` varchar(50) NOT NULL DEFAULT 'NA',
  `item_cost` int(11) NOT NULL DEFAULT '0',
  `item_stock` int(11) NOT NULL DEFAULT '1',
  `item_description` varchar(50) NOT NULL,
  `item_path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `electronics_items`
--

INSERT INTO `electronics_items` (`item_id`, `item_category`, `item_brand`, `item_cost`, `item_stock`, `item_description`, `item_path`) VALUES
(0, '', '', 0, 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `kids_items`
--

CREATE TABLE `kids_items` (
  `item_id` int(11) NOT NULL,
  `item_category` varchar(50) NOT NULL DEFAULT 'NA',
  `item_brand` varchar(50) NOT NULL DEFAULT 'NA',
  `item_cost` int(11) NOT NULL DEFAULT '0',
  `item_stock` int(11) NOT NULL DEFAULT '1',
  `item_description` varchar(50) NOT NULL,
  `item_path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kids_items`
--

INSERT INTO `kids_items` (`item_id`, `item_category`, `item_brand`, `item_cost`, `item_stock`, `item_description`, `item_path`) VALUES
(0, '', '', 0, 1, '', ''),
(1, 'shirts', 'puma', 1000, 1, 'dhoti', 'kids/shirts/1.jpg'),
(2, 'shirts', 'puma', 1000, 1, 'dhoti', 'kids/shirts/2.jpg'),
(3, 'shirts', 'play boy', 1299, 1, 'dhoti', 'kids/shirts/3.jpg'),
(4, 'shirts', 'puma', 600, 1, 'night wear', 'kids/shirts/4.jpg'),
(5, 'shirts', 'brando', 700, 1, 'full hand shirt', 'kids/shirts/5.jpg'),
(6, 'shirts', 'brando', 700, 1, 'full hand shirt', 'kids/shirts/6.jpg'),
(7, 'shirts', 'puma', 400, 1, 'full hand tshirt', 'kids/shirts/7.jpg'),
(8, 'shirts', 'brando', 800, 1, 'dhoti', 'kids/shirts/8.jpg'),
(9, 'shirts', 'play boy', 300, 1, 'half hands tshirt', 'kids/shirts/9.jpg'),
(10, 'shirts', 'brando', 299, 1, 'half hands tshirt', 'kids/shirts/10.jpg'),
(11, 'shirts', 'puma', 302, 1, 'half hands tshirt', 'kids/shirts/11.jpg'),
(12, 'shirts', 'oppo', 499, 1, 'full hands tshirt', 'kids/shirts/12.jpg'),
(13, 'shirts', 'nitch', 499, 1, 'half hands tshirt', 'kids/shirts/13.jpg'),
(14, 'shirts', 'oppo', 399, 1, 'half hands tshirt', 'kids/shirts/14.jpg'),
(15, 'pants', 'bravo', 399, 1, 'short', 'kids/pants/15.jpg'),
(16, 'pants', 'brando', 503, 1, 'jeans pant', 'kids/pants/16.jpg'),
(17, 'pants', 'oppo', 800, 1, 'jeans pant', 'kids/pants/17.jpg'),
(18, 'pants', 'nitch', 600, 1, 'cotton pant', 'kids/pants/18.jpg'),
(19, 'pants', 'bravo', 499, 1, 'jeans pant', 'kids/pants/19.jpg'),
(20, 'pants', 'puma', 399, 1, 'cotton pant', 'kids/pants/20.jpg'),
(21, 'inners', 'bravo', 299, 1, 'baniyan', 'kids/inners/21.jpg'),
(22, 'inners', 'nitch', 301, 1, 'baniyan', 'kids/inners/22.jpg'),
(23, 'inners', 'oppo', 399, 1, 'kiddi wear', 'kids/inners/23.jpg'),
(24, 'inners', 'levo', 199, 1, 'baniyan', 'kids/inners/24.jpg'),
(25, 'inners', 'nitch', 399, 1, 'baniyan', 'kids/inners/25.jpg'),
(26, 'inners', 'oppo', 400, 1, 'baniyan', 'kids/inners/26.jpg'),
(27, 'inners', 'brando', 350, 1, 'baniyan', 'kids/inners/27.jpg'),
(28, 'foot', 'play boy', 499, 1, 'shoes', 'kids/foot/28.jpg'),
(29, 'foot', 'bravo', 450, 1, 'shoes', 'kids/foot/29.jpg'),
(30, 'foot', 'nitch', 550, 1, 'shoes', 'kids/foot/30.jpg'),
(31, 'foot', 'oppo', 450, 1, 'shoes', 'kids/foot/31.jpg'),
(32, 'foot', 'brando', 660, 1, 'shoes', 'kids/foot/32.jpg'),
(33, 'foot', 'nike', 450, 1, 'shoes', 'kids/foot/33.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mens_items`
--

CREATE TABLE `mens_items` (
  `item_id` int(11) NOT NULL,
  `item_category` varchar(50) NOT NULL DEFAULT 'NA',
  `item_brand` varchar(50) NOT NULL DEFAULT 'NA',
  `item_cost` int(11) NOT NULL DEFAULT '0',
  `item_stock` int(11) NOT NULL DEFAULT '1',
  `item_description` varchar(50) NOT NULL,
  `item_path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mens_items`
--

INSERT INTO `mens_items` (`item_id`, `item_category`, `item_brand`, `item_cost`, `item_stock`, `item_description`, `item_path`) VALUES
(0, '', '', 0, 1, '', ''),
(1, 'shirts', 'levin', 3000, 1, 'coat', 'mens/shirts/1.jpg'),
(2, 'shirts', 'jumbo', 2500, 1, 'coat', 'mens/shirts/2.jpg'),
(3, 'shirts', 'levin', 3000, 1, 'coat', 'mens/shirts/3.jpg'),
(4, 'shirts', 'monster', 4000, 1, 'coat', 'mens/shirts/4.jpg'),
(5, 'shirts', 'polo', 3000, 1, 'coat', 'mens/shirts/5.jpg'),
(6, 'pants', 'brando', 490, 1, 'jeans pant', 'mens/pants/6.jpg'),
(7, 'pants', 'tornado', 990, 1, 'torn jeans pant', 'mens/pants/7.jpg'),
(8, 'pants', 'officer choice', 799, 1, 'formal pant', 'mens/pants/8.jpg'),
(9, 'inners', 'polo', 299, 1, 'baniyan', 'mens/inners/9.jpg'),
(10, 'foot', 'nike', 699, 1, 'shoes', 'mens/foot/10.jpg'),
(11, 'foot', 'lopo', 600, 1, 'shoes', 'mens/foot/11.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `msgseen`
--

CREATE TABLE `msgseen` (
  `user_id` int(11) NOT NULL,
  `userseen` tinyint(1) NOT NULL DEFAULT '1',
  `adminseen` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msgseen`
--

INSERT INTO `msgseen` (`user_id`, `userseen`, `adminseen`) VALUES
(1, 1, 1),
(2, 0, 0),
(3, 0, 1),
(4, 0, 1),
(5, 0, 1),
(6, 0, 1),
(7, 0, 1),
(8, 0, 0),
(9, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `others_items`
--

CREATE TABLE `others_items` (
  `item_id` int(11) NOT NULL,
  `item_category` varchar(50) NOT NULL DEFAULT 'NA',
  `item_brand` varchar(50) NOT NULL DEFAULT 'NA',
  `item_cost` int(11) NOT NULL DEFAULT '0',
  `item_stock` int(11) NOT NULL DEFAULT '1',
  `item_description` varchar(50) NOT NULL,
  `item_path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `others_items`
--

INSERT INTO `others_items` (`item_id`, `item_category`, `item_brand`, `item_cost`, `item_stock`, `item_description`, `item_path`) VALUES
(0, '', '', 0, 1, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `request_items`
--

CREATE TABLE `request_items` (
  `user_id` int(11) NOT NULL,
  `item_cat` varchar(50) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_items`
--

INSERT INTO `request_items` (`user_id`, `item_cat`, `item_id`) VALUES
(1, 'kids', 21);

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `user_id` int(10) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image_id` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`user_id`, `category`, `image_id`) VALUES
(1, 'kids', 3);

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `shop_id` int(11) NOT NULL,
  `shop_type` varchar(50) NOT NULL,
  `shop_name` varchar(50) NOT NULL,
  `shop_city` varchar(50) NOT NULL,
  `shop_lat` double NOT NULL,
  `shop_long` double NOT NULL,
  `shop_dist` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`shop_id`, `shop_type`, `shop_name`, `shop_city`, `shop_lat`, `shop_long`, `shop_dist`) VALUES
(1, 'Honda Bikes sales and services', 'Honda showroom', 'Miryalaguda', 16.875433802028976, 79.56552878213961, 0),
(2, 'Garments', 'Pallavi Garments', 'Warangal', 17.979830581756023, 79.59549206403199, 0),
(3, 'Groceries', 'Ramesh Kirana Shop', 'NarketPally', 17.204806161961052, 79.19353614069212, 0),
(4, 'Clothing', 'Vamshi Dresses', 'Nalgonda', 17.06053469114599, 79.27236089922178, 0),
(5, 'Restaurant', 'Gokul Chat', 'Koti,Hyderabad', 17.385115671062216, 78.48595216798401, 0),
(6, 'Bannquet Halls', 'Sri Balaji Function Hall', 'Hyathnagar,Hyderabad', 17.331281930874876, 78.59251763149109, 0),
(7, 'Juice Point', 'Vikky Juice ', 'New Delhi', 28.66257306535426, 77.23066809499824, 0),
(8, 'Transporters', 'Transportes Elola', 'Mexico,USA', 19.636575475225154, -99.1917375499878, 0),
(9, 'Body Shop', 'Sephora', 'Paris,France', 48.857455777635394, 2.352237993254107, 0),
(10, 'Restaurant', 'The Aloo', 'Australia', -25.274434381749327, 133.77536666997526, 0),
(11, 'Library', 'State Central Library', 'Bangalore', 12.974107899762203, 77.59164445659178, 0),
(12, 'Automobile Services', 'Mahi Services', 'Kozhikode,Kerala', 11.262919926214293, 75.77714843383797, 0),
(13, 'Restaurant', 'Ramachandra Western', 'Vishakhapatnam', 17.686243483934728, 83.20655103430181, 0),
(14, 'Homes', 'Maithri Residency', 'Karimnagar', 18.43815835543555, 79.12597660077199, 0),
(15, 'Hospital', 'Apollo Hospitals', 'Kurnool', 15.8281257, 78.03727920000006, 0),
(16, 'Shopping ', 'Mangalya Shopping mall', 'Hanamkonda', 18.004490218513627, 79.55756816508165, 0),
(17, 'Restaurant', 'srinivasa canteen', 'Kazipet', 17.9721925093509, 79.50251669126283, 0),
(18, 'Bars and Restaurant', 'Kalinga Dhaba', 'Kazipet', 17.98903984877906, 79.53355908891604, 0),
(20, 'Restaurant and Banquet Halls', 'Palamuru Grill', 'Kazipet', 17.992643863588984, 79.53854766381528, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_ids`
--

CREATE TABLE `transaction_ids` (
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_ids`
--

INSERT INTO `transaction_ids` (`user_id`, `transaction_id`, `timestamp`) VALUES
(1, '210798', '2017-06-14 11:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_requests`
--

CREATE TABLE `transaction_requests` (
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` tinyint(4) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `emailid` varchar(30) DEFAULT NULL,
  `admin` int(11) NOT NULL DEFAULT '0',
  `wallet` int(11) NOT NULL DEFAULT '0',
  `image_path` varchar(100) NOT NULL,
  `views` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `emailid`, `admin`, `wallet`, `image_path`, `views`) VALUES
(1, 'bob', '9f9d51bc70ef21ca5c14f307980a29d8', 'bob@gmail.com', 0, 1299, '1.jpg', 28),
(2, 'saiprasenthati', '74b3538d1fcd00d7d37a424145e4f999', 'saiprasenthati@gmail.com', 1, 2369, '2.jpg', 16),
(3, 'ramanareddy', 'cb0cbcab6a0b1bb452656347d9c9769d', 'ramanarocks11@gmail.com', 0, 0, '', 5),
(4, 'abhilashvemula', '706c820014dd3699d97c5e8e861795e2', 'avemula1@student.nitw.ac.in', 0, 0, '', 1),
(5, 'anjierni', '32e253e32624586954152248853dadb8', 'anjierni@gmail.com', 0, 0, '', 9),
(6, 'santhoshgorla', 'b50759521661e117e3565018346c21ee', 'gorlasanthosh123@gmai.com', 0, 0, '', 4),
(7, 'rahulbharghav', 'cb8020303a089b22a1b83a8383cb8a85', 'rahulbharghav143@gmail.com', 0, 0, '', 2),
(8, 'sushrut111', '061535ec00c93e50a1f136d7955737de', 'sushrut345@live.in', 0, 0, '', 1),
(9, 'user123', '6ad14ba9986e3615423dfca256d04e3f', 'user123@gmail.com', 1, 0, '9.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `womens_items`
--

CREATE TABLE `womens_items` (
  `item_id` int(11) NOT NULL,
  `item_category` varchar(50) NOT NULL DEFAULT 'NA',
  `item_brand` varchar(50) NOT NULL DEFAULT 'NA',
  `item_cost` int(11) NOT NULL DEFAULT '0',
  `item_stock` int(11) NOT NULL DEFAULT '1',
  `item_description` varchar(50) NOT NULL,
  `item_path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `womens_items`
--

INSERT INTO `womens_items` (`item_id`, `item_category`, `item_brand`, `item_cost`, `item_stock`, `item_description`, `item_path`) VALUES
(0, '', '', 0, 1, '', ''),
(1, 'top', 'juke', 399, 1, 'half hands top', 'womens/top/1.jpg'),
(2, 'top', 'polo', 600, 1, 'full hands top shirt', 'womens/top/2.jpg'),
(3, 'foot', 'fototo', 589, 1, 'heels chappal', 'womens/foot/3.jpg'),
(4, 'foot', 'toyer', 499, 1, 'chappal', 'womens/foot/4.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books_items`
--
ALTER TABLE `books_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `electronics_items`
--
ALTER TABLE `electronics_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `kids_items`
--
ALTER TABLE `kids_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `mens_items`
--
ALTER TABLE `mens_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `others_items`
--
ALTER TABLE `others_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `womens_items`
--
ALTER TABLE `womens_items`
  ADD PRIMARY KEY (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shops`
--
ALTER TABLE `shops`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
