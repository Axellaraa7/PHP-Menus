-- create database tests_projects;
create table if not exists menus(
  id smallserial primary key,
  name varchar(50) not null,
  description text not null 
);

create table if not exists submenus(
  id smallserial primary key,
  name varchar(50) not null,
  description text not null,
  id_menus smallint not null,
  constraint fk_id_menus foreign key (id_menus) references menus(id)
);