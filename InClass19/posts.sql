CREATE DATABASE `inclass19`;

USE inclass19;

CREATE TABLE `posts`
(
    `id`        int(11) NOT NULL AUTO_INCREMENT,
    `name`      varchar(80) NOT NULL,
    `description`      TEXT NOT NULL,
    primary key (`id`)
);

insert into posts (name, description)
values ('First Note', 'Wake up');

insert into posts (name, description)
values ('Second Note', 'Take a shower');

insert into posts (name, description)
values ('Third Note', 'Eat cereal for breakfast');

insert into posts (name, description)
values ('Fourth Note', 'Go to school');

insert into posts (name, description)
values ('Fifth Note', 'TBD');