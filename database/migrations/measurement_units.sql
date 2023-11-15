create table weight_units(
    id int(10) not NULL PRIMARY KEY AUTO_INCREMENT,
    abbr_name char(50) unique,
    name varchar(50),
    created_at timestamp DEFAULT now()
);


INSERT INTO weight_units(
    abbr_name , name
) VALUES('g', 'gram'),
('kg', 'kilogram'),
('t', 'tonne');



create table packing_units(
    id int(10) not NULL PRIMARY KEY AUTO_INCREMENT,
    abbr_name char(50) unique,
    name varchar(50),
    created_at timestamp DEFAULT now()
);

INSERT INTO packing_units(
    abbr_name , name
) VALUES('per_sack', 'Per Sack'),
('per_item', 'Per Item');