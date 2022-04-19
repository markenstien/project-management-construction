create table folders(
	id int(10) not null primary key auto_increment,
	folder varchar(100),
	parent_id int(10) comment 'folders with parent_id are subfolders',
	meta_id int(10) ,
	meta_key varchar(100) comment 'key of the module where the folder lives',

	is_hidden boolean default false,
	created_by int(10) not null,
	updated_by int(10) not null,
	created_at timestamp default now(),
	updated_at timestamp default now() ON UPDATE now()
);