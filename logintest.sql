-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2023 at 11:22 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logintest`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `card_number` varchar(16) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_email`, `phone_number`, `card_number`, `address`, `city`, `state`, `zip_code`, `password`) VALUES
(2, 'test here', 'fakeuser@gmail.com', '2345678', '8765445677', '8765 lincoln rd', 'abbafsac', 'sdfghn', '34569', '$2y$10$zyfzuBDa6CyK1XFLRJF.juZ7UbsHJ8nuYMQ/9meTdGp20rlS631WO'),
(4, 'testing user', 'testing@test.com', '1234567890', '8765445677', '1234 main street', 'kent', 'ohio', '44242', '$2y$10$/9Y6hkxk1JgAOysAqUt9ee7yU3qkc7TvZLGrPX0sUSXIGI.HRCxGS'),
(6, 'name last', 'name@gmail.com', '76543456', '12345678', '1234 mnhyujn  st', 'cfgh', 'fl', '43567', '$2y$10$bPz3JQ4TelW1tOgdCwuSLO6UBs7A8D9LtxSlQvkKr9UEsj8GlGAlm');

--
-- Triggers `customers`
--
DELIMITER $$
CREATE TRIGGER `delete_customers_payment` AFTER DELETE ON `customers` FOR EACH ROW BEGIN
    DELETE FROM payment WHERE payment.customer_id = OLD.customer_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `employee_email` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `department` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `salary` decimal(10,2) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `employee_name`, `employee_email`, `date_of_birth`, `department`, `start_date`, `salary`, `password`) VALUES
(2, 'fake employee', 'testing@store.com', '1980-12-09', 'Sales', '2020-05-12', '80000.00', '$2y$10$1wSiLIa8826WXxipECP39uEoe7GcRBd.tjpKX5S.A8JpPXE3Q.Zia'),
(3, 'first last', 'fake@store.com', '1964-04-13', 'Packaging', '2022-06-30', '65000.00', '$2y$10$/Ssqqr9447N5NG84IK6AlOlMDg9ma8M4Rrc31e6MH5GgYrFZ0nSI6');

-- --------------------------------------------------------

--
-- Table structure for table `order_info`
--

CREATE TABLE `order_info` (
  `customer_email` varchar(100) NOT NULL,
  `Order_Number` int(11) NOT NULL,
  `Num_Of_Items` int(11) NOT NULL,
  `Total_Price` varchar(20) NOT NULL,
  `employee_email` varchar(100) NOT NULL,
  `Purchase_date` date NOT NULL,
  `Arrival_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_info`
--

INSERT INTO `order_info` (`customer_email`, `Order_Number`, `Num_Of_Items`, `Total_Price`, `employee_email`, `Purchase_date`, `Arrival_Date`) VALUES
('testing@test.com', 1, 3, '45.50', 'fake@store.com', '2020-05-13', '2020-05-16'),
('testing@test.com', 2, 2, '245.50', 'fake@store.com', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `card_number` varchar(19) NOT NULL,
  `payment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `customer_id`, `card_number`, `payment_date`) VALUES
(1001, 2, '6011058990508044', '2018-05-27'),
(1002, 4, '5270115486610892', '2020-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `availability` int(11) NOT NULL,
  `material` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `size` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `cost`, `product_name`, `category`, `availability`, `material`, `color`, `size`) VALUES
(1001, '49.99', 'Gold Plated Ring', 'Ring', 25, 'Gold Plated', 'Gold', '7'),
(1002, '79.99', 'Silver Hoop Earrings', 'Earrings', 50, 'Silver', 'Silver', '2 inch'),
(1003, '149.99', 'Diamond Tennis Bracelet', 'Bracelet', 10, 'White Gold', 'Silver', '6 inch'),
(1004, '399.99', 'Platinum Engagement Ring', 'Ring', 5, 'Platinum', 'Silver', '5'),
(1005, '29.99', 'Beaded Anklet', 'Anklet', 30, 'Beads', 'Multi-color', 'Adjustable'),
(1006, '149.99', 'Pearl Necklace', 'Necklace', 15, 'Gold Plated', 'White', '18 inch'),
(1007, '99.99', 'Leather Purse', 'Purse', 20, 'Leather', 'Black', 'Medium'),
(1008, '299.99', 'Sapphire and Diamond Earrings', 'Earrings', 8, 'White Gold', 'Blue and White', '1 inch'),
(1009, '199.99', 'Crystal Bangle Bracelet', 'Bracelet', 12, 'Silver Plated', 'Clear', '7 inch'),
(1010, '69.99', 'Turquoise Ring', 'Ring', 40, 'Sterling Silver', 'Turquoise', '6'),
(1011, '399.99', 'Diamond Stud Earrings', 'Earrings', 3, 'Platinum', 'Silver', '0.5 carat'),
(1012, '49.99', 'Braided Leather Bracelet', 'Bracelet', 18, 'Leather', 'Brown', '8 inch'),
(1013, '199.99', 'Ruby and Diamond Necklace', 'Necklace', 7, 'Yellow Gold', 'Red and White', '20 inch'),
(1014, '89.99', 'Gold Plated Chain Necklace', 'Necklace', 22, 'Gold Plated', 'Gold', '24 inch'),
(1015, '149.99', 'Diamond Cocktail Ring', 'Ring', 6, 'White Gold', 'Silver', '8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_email` (`customer_email`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `employee_email` (`employee_email`);

--
-- Indexes for table `order_info`
--
ALTER TABLE `order_info`
  ADD PRIMARY KEY (`Order_Number`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_info`
--
ALTER TABLE `order_info`
  MODIFY `Order_Number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1017;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
