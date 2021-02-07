create table message(
    idx int not null auto_increment,
    send_user_idx int not null,
    receiver_user_idx int not null,
    title char(20) not null,
    content char(100) not null,
    created_at char(20),
    primary key(idx)
);