create table fund(
    idx int not null auto_increment,
    user_idx int not null,
    board_idx int not null,
    fund_price int not null,
    fund_amount int not null,
    created_at char(20),
    cond char(20) not null,
    primary key(idx)
);