drop table if exists projects;
create table projects(
	id int(10) not null primary key auto_increment,
	reference varchar(100),
	title varchar(100),
	customer_id int(10),
	budget decimal(10 ,2),
	max_budget decimal(10 , 2),
	cost decimal(10,2) comment 'this is what user will be seen',
	start_date date ,
	est_completion_date date,
	type varchar( 100 ),
	classification varchar(100),
	storey char(20),
	address text,
	created_by int(10),
	updated_by int(10),
	created_at timestamp default now(),
	updated_at timestamp default now() ON UPDATE now()
);


alter table projects
	add column sqm char(10) after classification;