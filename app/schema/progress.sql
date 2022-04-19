
drop table if exists progress;
create table progress(
	id int(10) not null primary key auto_increment,
	current int(10),
	old int(10),
	project_id int(10),
	description text,
	date date,
	created_by int(10),
	created_at timestamp default now(),
	updated_at timestamp default now() ON UPDATE now()
);