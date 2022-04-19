alter table projects
	add column status enum('on-going' , 'completed', 'cancelled') default 'on-going';