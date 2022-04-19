create table project_sectors(
	id int(10) not null primary key auto_increment,
	sector varchar(100),
	price_per_sqmtr decimal(10 , 2),
	description text,
	category varchar(100),
	created_at timestamp default now()
);


insert into project_sectors(sector , price_per_sqmtr , description) 
	VALUES('Electrical' , 3504 , 'LAN, WAN , CCTV , others..'),
	('Architectural' , 6000 , 'very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section'),
	('Structural Engineering ', 96 'test only');


insert into project_sectors(
	sector , 
	price_per_sqmtr , 
	description
) 
VALUES
	('Architectural' , 
		6000 , 
		'very popular during the Renaissance'
	),
	('Structural Engineering', 
		96,
	'test only');
