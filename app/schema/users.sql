drop table if exists users;
create table users(
	id int(10) not null primary key auto_increment,
	first_name varchar(50),
	last_name varchar(50),
	email varchar(100) not null,
	type enum('management' , 'customer'),
	access varchar(100),
	phone varchar(50),
	password varchar(150) not null,
	profile text,
	is_verified boolean default false,
	created_at timestamp default now(),
	updated_at timestamp default now() ON UPDATE now()
);

