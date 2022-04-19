create table project_workers(
	id int(10) not null primary key auto_increment,
	project_id int(10) not null,
	user_id int(10) not null,
	role varchar(100),
	description text,
	on_board_date date,
	active enum('active' , 'terminated' , 'resigned') default 'active',
	salary decimal(10 , 2),

	created_at timestamp default now(),
	updated_at timestamp default now(),

	updated_by int(10),
	created_by int(10)
);
