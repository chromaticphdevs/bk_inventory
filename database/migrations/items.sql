DROP TABLE IF EXISTS items;
CREATE TABLE `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `weight_unit_id` int,
  `weight` int,
  `category_id` int,
  `packing_id` int,

  `min_stock` int(10) DEFAULT NULL,
  `max_stock` int(10) DEFAULT NULL,
  `variant` varchar(100),
  `remarks` text NOT NULL,
  `is_visible` int(11) NOT NULL,
  `created_at` timestamp DEFAULT now(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8