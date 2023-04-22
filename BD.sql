CREATE schema cieegame;
use cieegame;

CREATE TABLE category (id INT auto_increment primary key,
description varchar(30),
created_at datetime,
deleted_at datetime,
updated_at datetime);
insert into category (description, created_at) values ('Aventura', now());



create table games(id int auto_increment primary key,
name varchar (30),
description varchar(30),
category_id int not null,
foreign key (category_id) references category(id),
created_at datetime,
deleted_at datetime,
updated_at datetime,
image_url varchar(500),
developer_id int,
foreign key (developer_id) references developers(id));


create table developers (id int auto_increment primary key,
description varchar(39),
created_at datetime,
deleted_at datetime,
updated_at datetime);

insert into developers (description, created_at) values ('Rockstar', now());
update games set deleted_at = null where id = 9;
select * from games;
update category set deleted_at = now() where id = 8;
update games set deleted_at = null where id =16;
select games.name, games.description, games.image_url, games.created_at, category.description as 'category_description', developers.description as 'developerdescription' from games left join category on games.category_id = category.id left join developers on games.developer_id = developers.id where games.deleted_at is null
