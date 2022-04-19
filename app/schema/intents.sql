create table intents(
    id int(10) not null primary key auto_increment,
    intent varchar(100),
    meta_key varchar(100),
    meta_id int(10),
    value text comment 'json encoded data',
    status enum('pending' , 'completed' , 'cancelled') default 'pending',
    expiry_date date,
    created_at timestamp default now(),
    updated_at timestamp default now()
);