create table appointment_types
(
    id          serial      not null
        constraint appointment_types_pkey
            primary key,
    description varchar(10) not null
);

alter table appointment_types
    owner to postgres;

create table information_types
(
    id          serial      not null
        constraint information_types_pkey
            primary key,
    description varchar(13) not null
);

alter table information_types
    owner to postgres;

create table people_types
(
    id          serial      not null
        constraint people_types_pkey
            primary key,
    description varchar(13) not null
);

alter table people_types
    owner to postgres;

create table product_groups
(
    id          serial      not null
        constraint product_groups_pkey
            primary key,
    description varchar(12) not null
);

alter table product_groups
    owner to postgres;

create table product_sub_groups
(
    id                serial      not null
        constraint product_sub_groups_pkey
            primary key,
    product_group     varchar(9)  not null,
    product_sub_group varchar(9)  not null,
    supplier_id       integer     not null,
    price_in          varchar(6)  not null,
    price_out         varchar(7)  not null,
    content           varchar(5)  not null,
    description       varchar(22) not null,
    barcode           varchar(32) not null
);

alter table product_sub_groups
    owner to postgres;

create table people
(
    id            serial     not null
        constraint people_pkey
            primary key,
    people_type   varchar(8) not null,
    name_first    varchar(8),
    name_initials varchar(6),
    name_last     varchar(6) not null
);

alter table people
    owner to postgres;

create table person_information
(
    id               serial      not null
        constraint person_information_pkey
            primary key,
    person_id        integer     not null,
    information_type varchar(13) not null,
    value1           varchar(26) not null,
    value2           varchar(6),
    value3           varchar(8),
    value4           varchar(9)
);

alter table person_information
    owner to postgres;

create table appointments
(
    id                    serial     not null
        constraint appointments_pkey
            primary key,
    start_date            date       not null,
    start_time            varchar(5) not null,
    end_date              date       not null,
    end_time              varchar(5) not null,
    duration              varchar(5) not null,
    comment               varchar(9) not null,
    appointment_type      varchar(9) not null,
    parent_appointment_id integer,
    customer_id           integer    not null,
    employee_id           integer    not null
);

alter table appointments
    owner to postgres;

