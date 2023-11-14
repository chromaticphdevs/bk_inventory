CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `gender` enum('MALE','FEMALE') NOT NULL,
  `user_type` enum('admin','factory','manager') DEFAULT 'admin',
  `address` text DEFAULT NULL,
  `created_at` timestamp DEFAULT now(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8


alter table users 
  add column created_at timestamp DEFAULT now();

alter table users add column profile text;

INSERT INTO users(
  username,password,
  firstname,lastname,
  gender,user_type,
  address
) VALUES(
  'admin','1111',
  'Mark Angelo', 'Gonzales',
  'Male', 'admin',
  'main street 123'
);