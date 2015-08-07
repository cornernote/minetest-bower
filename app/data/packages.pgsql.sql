CREATE TABLE packages (
    id            SERIAL,
    name          varchar(255) NOT NULL  UNIQUE , 
    url           varchar(512) NOT NULL  UNIQUE ,
    hits          integer NOT NULL  DEFAULT 0,
    created_at    timestamp NOT NULL, 
    updated_at    timestamp NOT NULL   
);