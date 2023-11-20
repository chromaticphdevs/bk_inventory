drop table if exists stock_weight_consumptions;
create table stock_weight_consumptions(
    id int(10) not NULL PRIMARY KEY AUTO_INCREMENT,
    item_id int(10),
    parent_id int(10),
    parent_key varchar(100),
    consumption decimal(10,2),
    weight_unit_id int(10),
    is_processed boolean DEFAULT false,
    created_at timestamp DEFAULT now()
);