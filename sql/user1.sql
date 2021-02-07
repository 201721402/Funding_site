create table user1(
    idx int not null auto_increment,
    id char(20) not null,
    password char(20) not null,
    name char(20) not null,
    email char(20) not null,
    address char(50) not null,
    tel char(20) not null,
    created_at char(20),
    point int,
    level int,
    primary key(idx)
);