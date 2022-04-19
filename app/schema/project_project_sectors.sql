create table project_project_sectors(
	id int(10) not null primary key auto_increment,
	sector_id int(10) not null,
	project_id int(10) not null,
	budget decimal(10 , 2),
	max_budget decimal(10 ,2),
	created_at timestamp default now(),
	updated_at timestamp default now() ON UPDATE now()
);