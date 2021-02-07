create table board(
    idx int not null auto_increment,
    user_idx int not null,
    title char(200) not null,
    content char(230) not null,
    hit int not null,
    file_name char(40),
    file_type char(40),
    file_copied char(40),
    created_at char(20),
    goal_price int not null,
    org_price int not null,
    sale_price int not null,
    amount int not null,
    end_date char(30) not null,
    percent int not null,
    cond char(20) not null,
    primary key(idx)
);