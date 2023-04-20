CREATE TABLE IF NOT EXISTS `merch` (
	`itemID` int(11) NOT NULL AUTO_INCREMENT,
	`itemName` varchar(200) NOT NULL,
	`itemDesc` text NOT NULL,
	`itemPrice` decimal(7,2) NOT NULL,
	`rrp` decimal(7,2) NOT NULL DEFAULT '0.00',
	`itemQuantity` int(11) NOT NULL,
	`itemImg` text NOT NULL,
	`date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*insert function for merch*/

INSERT INTO `products` (`itemId`, `itemName`, `itemDesc`, `itemPrice`, `rrp`, `itemQuantity`, `itemImg`, `date_added`) VALUES
(1, 'Earrings', '<p>Jewelry Store Diamond Earrings</p><h3>Features</h3><ul><li>14K White Gold</li><li>After purchase adjustments</li><li>Weight: .24ct.</li><li>Finest quality yet!</li></ul>', '499.99', '0.00', 10, 'earrings.jpg', 'CURRENT_TIMESTAMP'),
(2, 'Hat', '<p>Jewelry Store Diamond Earrings</p><h3>Features</h3><ul><li>14K White Gold</li><li>After purchase adjustments</li><li>Weight: .24ct.</li><li>Finest quality yet!</li></ul>', '49.99', '29.99', 34, 'hat.jpg', 'CURRENT_TIMESTAMP'),
(3, 'Tie', '<p>Jewlery Store Professional Tie</p><h3>Features</h3><ul><li>100% Polyester</li><li>Available in all sizes</li><li>Very fine detail</li><li>Hand sewn</li></ul>', '19.99', '0.00', 23, 'tie.jpg', 'CURRENT_TIMESTAMP'),
(4, 'Ring', '<p>Jewlery Store Diamon Ring</p><h3>Features</h3><ul><li>Diamond White</li<li>Available in all sizes 4-10</li><li>.2ct.</li><li>Perfect for a beautiful engagement!</li></ul>', '999.99', '0.00', 7, 'ring.jpg', 'CURRENT_TIMESTAMP');
(5, 'Necklace', '<p>Jewlery Store Necklace</p><h3>Features</h3><ul><li>Diamond White</li><li>Available in all sizes</li><li>1.00ct.</li><li>Elegant look!</li></ul>', '7999.99', '0.00', 23, 'necklace.jpg', 'CURRENT_TIMESTAMP'),
(6, 'Purse', '<p>Jewlery Store Purse</p><h3>Features</h3><ul><li>100% Leather</li><li>Available in all colors</li><li>Suited to carry things of all sizes</li><li>Dress in style!</li></ul>', '74.99', '0.00', 23, 'purse.jpg', 'CURRENT_TIMESTAMP');