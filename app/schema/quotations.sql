create table quotations(
	id int(10) not null primary key auto_increment,
	reference varchar(100),
	first_name varchar(100),
	last_name varchar(100),
	email varchar(100),
	contact varchar(100),
	sent int(10),
	meta_values text,
	status enum('archived' , 'pending' , 'finished'),
	created_at timestamp default now(),
	updated_at timestamp default now() ON UPDATE now(),
	updated_by timestamp default now()
);