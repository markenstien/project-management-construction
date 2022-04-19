drop table if exists files;
create table files(
	id int(10) not null primary key auto_increment,
	folder_id int(10), 
	meta_id int(10),
	meta_key varchar(100),
	name varchar(100),
	display_name varchar(100),
	path text,
	url text,
	full_path text,
	type enum('image' , 'document' , 'exe'),
	tags text,
	is_hidden boolean default false,
	created_at timestamp default now()
);