DROP table if EXISTS batches;
create table batches(
    id int(10) not NULL PRIMARY KEY AUTO_INCREMENT,
    batch_reference varchar(50) unique,
    batch_name varchar(50),
    batch_date date,
    remarks text,
    created_at timestamp DEFAULT now()
);



create table batch_items(
    id int(10) not NULL PRIMARY KEY AUTO_INCREMENT,
    batch_id int(10),
    item_id int(10),
    quantity int(10),
    created_at timestamp DEFAULT now()
);

alter table batches
    add column result_quantity decimal(10, 2);