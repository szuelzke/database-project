-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2023 at 03:07 PM
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
-- Database: `database_proj`
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
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip_code` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_email`, `phone_number`, `address`, `city`, `state`, `zip_code`, `password`) VALUES
(2, 'test here', 'fakeuser@gmail.com', '2345678', '8765 lincoln rd', 'abbafsac', 'sdfghn', '34569', '$2y$10$zyfzuBDa6CyK1XFLRJF.juZ7UbsHJ8nuYMQ/9meTdGp20rlS631WO'),
(4, 'testing user', 'testing@test.com', '1234567890', '1234 main street', 'kent', 'ohio', '44242', '$2y$10$/9Y6hkxk1JgAOysAqUt9ee7yU3qkc7TvZLGrPX0sUSXIGI.HRCxGS'),
(6, 'name last', 'name@gmail.com', '76543456', '1234 mnhyujn  st', 'cfgh', 'fl', '43567', '$2y$10$bPz3JQ4TelW1tOgdCwuSLO6UBs7A8D9LtxSlQvkKr9UEsj8GlGAlm'),
(7, 'test here', 'fake@test.com', '2345674', '345 dfghb ghj', 'ghjk', 'fghjk', '3462', '$2y$10$q6r7FrXqftnXcp4VxnLD2uCaV5MXqKHw2Rya4eCeLmUvvbTVP0jyy');

--
-- Triggers `customers`
--
DELIMITER $$
CREATE TRIGGER `delete_customers_payment` AFTER DELETE ON `customers` FOR EACH ROW BEGIN
    DELETE FROM payment WHERE payment.customer_email = OLD.customer_email;
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
(3, 'first last', 'fake@store.com', '1964-04-13', 'Packaging', '2022-06-30', '65000.00', '$2y$10$/Ssqqr9447N5NG84IK6AlOlMDg9ma8M4Rrc31e6MH5GgYrFZ0nSI6'),
(4, 'sdfg dfghjkl', 'here@store.com', '1960-05-31', 'HR', '2019-05-31', '89000.00', '$2y$10$CthY6OiOcE6iKDRUs7RI.Osxcf4Meoy7dFGowLgeVBX6BinRtycMO');

-- --------------------------------------------------------

--
-- Table structure for table `merch`
--

CREATE TABLE `merch` (
  `itemID` int(11) NOT NULL,
  `itemName` varchar(200) NOT NULL,
  `itemDesc` text NOT NULL,
  `itemPrice` decimal(7,2) NOT NULL,
  `rrp` decimal(7,2) NOT NULL DEFAULT 0.00,
  `itemQuantity` int(11) NOT NULL,
  `itemImg` text NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `merch`
--

INSERT INTO `merch` (`itemID`, `itemName`, `itemDesc`, `itemPrice`, `rrp`, `itemQuantity`, `itemImg`, `date_added`) VALUES
(1, 'Earrings', '<p>Jewelry Store Diamond Earrings</p><h3>Features</h3><ul><li>14K White Gold</li><li>After purchase adjustments</li><li>Weight: .24ct.</li><li>Finest quality yet!</li></ul>', '499.99', '0.00', 8, 'earrings.jpg', '0000-00-00 00:00:00'),
(2, 'Hat', '<p>Jewelry Store Diamond Earrings</p><h3>Features</h3><ul><li>14K White Gold</li><li>After purchase adjustments</li><li>Weight: .24ct.</li><li>Finest quality yet!</li></ul>', '49.99', '29.99', 33, 'hat.jpg', '0000-00-00 00:00:00'),
(3, 'Tie', '<p>Jewlery Store Professional Tie</p><h3>Features</h3><ul><li>100% Polyester</li><li>Available in all sizes</li><li>Very fine detail</li><li>Hand sewn</li></ul>', '19.99', '0.00', 21, 'tie.jpg', '0000-00-00 00:00:00'),
(4, 'Ring', '<p>Jewlery Store Diamon Ring</p><h3>Features</h3><ul><li>Diamond White</li<li>Available in all sizes 4-10</li><li>.2ct.</li><li>Perfect for a beautiful engagement!</li></ul>', '999.99', '0.00', 7, 'ring.jpg', '0000-00-00 00:00:00'),
(5, 'Necklace', '<p>Jewlery Store Necklace</p><h3>Features</h3><ul><li>Diamond White</li><li>Available in all sizes</li><li>1.00ct.</li><li>Elegant look!</li></ul>', '7999.99', '0.00', 23, 'necklace.jpg', '0000-00-00 00:00:00'),
(6, 'Purse', '<p>Jewlery Store Purse</p><h3>Features</h3><ul><li>100% Leather</li><li>Available in all colors</li><li>Suited to carry things of all sizes</li><li>Dress in style!</li></ul>', '74.99', '0.00', 23, 'purse.jpg', '0000-00-00 00:00:00');

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
('testing@test.com', 2, 2, '245.50', 'fake@store.com', '0000-00-00', '0000-00-00'),
('testing@test.com', 3, 2, '70.98', '', '2023-04-21', '2023-04-24'),
('testing@test.com', 4, 2, '70.98', '', '2023-04-21', '2023-04-24'),
('testing@test.com', 5, 2, '70.98', '', '2023-04-21', '2023-04-24'),
('testing@test.com', 6, 2, '1019.97', '', '2023-04-21', '2023-04-24'),
('testing@test.com', 7, 2, '69.98', '', '2023-04-21', '2023-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `customer_email` varchar(30) NOT NULL,
  `card_number` varchar(19) NOT NULL,
  `payment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `customer_email`, `card_number`, `payment_date`) VALUES
(1001, 'testing@test.com', '6011058990508044', '2018-05-27'),
(1002, 'name@gmail.com', '5270115486610892', '2020-04-22'),
(1004, 'testing@test.com', '4567987654', '2023-04-20'),
(1005, 'testing@test.com', '3456-9876', '2023-04-20'),
(1006, 'testing@test.com', '23456-909871', '2023-04-20');

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
-- Indexes for table `merch`
--
ALTER TABLE `merch`
  ADD PRIMARY KEY (`itemID`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `merch`
--
ALTER TABLE `merch`
  MODIFY `itemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_info`
--
ALTER TABLE `order_info`
  MODIFY `Order_Number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1007;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
