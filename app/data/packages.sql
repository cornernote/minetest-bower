CREATE TABLE "packages" (

    "id"            INTEGER PRIMARY KEY  NOT NULL  check(typeof("id") = 'integer'),
    "name"          VARCHAR NOT NULL  UNIQUE , 
    "url"           VARCHAR NOT NULL  UNIQUE ,
    "hits"          INTEGER NOT NULL  DEFAULT 0,
    "created_at"    DATETIME NOT NULL, 
    "updated_at"    DATETIME NOT NULL
    
);

CREATE INDEX "packages_name" ON "packages" ("name");
