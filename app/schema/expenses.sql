drop table if exists expenses;
create table expenses(
	id int(10) not null primary key auto_increment,
	expenses varchar(100),
	amount decimal(10 , 2),
	budget decimal(10 ,2),
	max_budget decimal(10 ,2),
	description text,
	sector_id int(10),
	project_id int(10),
	created_by int(10),
	created_at timestamp default now()
);