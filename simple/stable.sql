create database ola;

create user 'ola'@'localhost' IDENTIFIED BY 'ola321';
grant select,insert,update,delete,create,drop on ola.* to 'ola'@'localhost';
ALTER USER 'ola'@'localhost' IDENTIFIED WITH mysql_native_password BY 'ola321';


create table if not exists post_item (id integer auto_increment primary key, summary varchar(200) not null, description varchar (4000), is_read enum('Y', 'N'));
insert into post_item (summary, is_read) values ("Ala ma kota 1", "N");
insert into post_item (summary, is_read) values ("Ala ma kota 2", "N");
insert into post_item (summary, is_read) values ("Ala ma kota 3", "N");
insert into post_item (summary, is_read) values ("Ala ma kota 4", "N");
