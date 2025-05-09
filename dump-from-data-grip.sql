create table users
(
    user_id   int auto_increment
        primary key,
    full_name varchar(500) not null,
    telephone varchar(255) not null,
    email     varchar(255) not null,
    password  varchar(255) not null,
    login     varchar(20)  not null,
    constraint users_pk
        unique (login),
    constraint users_pk_2
        unique (email)
);

INSERT INTO app_db.users (user_id, full_name, telephone, email, password, login) VALUES (1, 'Артем Палыч', '345345345345', 'artem.nik@bk.ru', '$argon2id$v=19$m=65536,t=4,p=1$YkNjbnpqZmhSRE5heFFiMA$g3Sp2U6TcL/QB1ERWjiWZjTHYZl4hBfhSRJyLjyd298', 'artem');
INSERT INTO app_db.users (user_id, full_name, telephone, email, password, login) VALUES (2, 'фвыа', '345345345', 'arte3m.nik@bk.ru', '$argon2id$v=19$m=65536,t=4,p=1$bnR0LjJKcElhQzY0c3pNRQ$uY8fxK75nxOeLfvzox4+eYMo1c+Ylt/SNXV+JvsycE4', 'asdf');
INSERT INTO app_db.users (user_id, full_name, telephone, email, password, login) VALUES (4, 'ывафываы', '097098709', 'arte322m.nik@bk.ru', '$argon2id$v=19$m=65536,t=4,p=1$MkZWQjhvcG9VbEQyOHZiTA$guy25HCOKRLu+fYwiFRbbYIieuS5y/JGIYN2HvAN7k8', 'asdf1');

create table paylooad_types
(
    paylooad_type_id int auto_increment
        primary key,
    name             varchar(255) not null
);

INSERT INTO app_db.paylooad_types (paylooad_type_id, name) VALUES (1, 'наличные');
INSERT INTO app_db.paylooad_types (paylooad_type_id, name) VALUES (2, 'банковская карта');

create table service_statuses
(
    service_statuse_id int auto_increment
        primary key,
    name               varchar(255) not null
);

INSERT INTO app_db.service_statuses (service_statuse_id, name) VALUES (1, 'в работе');
INSERT INTO app_db.service_statuses (service_statuse_id, name) VALUES (2, 'выполнено');
INSERT INTO app_db.service_statuses (service_statuse_id, name) VALUES (3, 'отменено');


create table service_types
(
    service_type_id int auto_increment
        primary key,
    name            varchar(255) charset utf8mb4 not null
)
    collate = utf8mb4_general_ci;

INSERT INTO app_db.service_types (service_type_id, name) VALUES (1, 'общий клининг');
INSERT INTO app_db.service_types (service_type_id, name) VALUES (2, 'генеральная уборка');
INSERT INTO app_db.service_types (service_type_id, name) VALUES (3, 'послестроительная уборка');
INSERT INTO app_db.service_types (service_type_id, name) VALUES (4, 'химчистка ковров и мебели');


create table services
(
    service_id        int auto_increment
        primary key,
    address           varchar(255) not null,
    contact           varchar(255) null,
    datetime          datetime     not null,
    service_type_id   int          not null,
    payload_type_id   int          not null,
    service_status_id int          null,
    reason            varchar(500) null,
    user_id           int          not null,
    constraint services_paylooad_types_paylooad_type_id_fk
        foreign key (payload_type_id) references paylooad_types (paylooad_type_id)
            on update cascade on delete cascade,
    constraint services_service_statuses_service_statuse_id_fk
        foreign key (service_status_id) references service_statuses (service_statuse_id)
            on update cascade on delete cascade,
    constraint services_service_types_service_type_id_fk
        foreign key (service_type_id) references service_types (service_type_id)
            on update cascade on delete cascade,
    constraint services_users_user_id_fk
        foreign key (user_id) references users (user_id)
            on update cascade on delete cascade
);