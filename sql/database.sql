drop table if exists Commentary;
create table Commentary(
    poster_id INTEGER REFERENCES User(id),
    user_id INTEGER REFERENCES User(id),
    pet_id INTEGER REFERENCES Pet(id),
    text VARCHAR(256) UNIQUE NOT NULL,
    FOREIGN KEY(user_id, pet_id) REFERENCES Post(user_id, pet_id),
    PRIMARY KEY(user_id, poster_id, pet_id)
);

drop table if exists Post;
create table Post(
    user_id INTEGER REFERENCES User(id),
    pet_id INTEGER REFERENCES Pet(id),
    description VARCHAR(256) UNIQUE NOT NULL,
    PRIMARY KEY(user_id, pet_id)
);

drop table if exists User;
create table User(
    id INTEGER PRIMARY KEY,
    username VARCHAR(256) NOT NULL,
    password VARCHAR(256) NOT NULL,
    picture VARCHAR(256),
    email VARCHAR(256) UNIQUE NOT NULL,
    mobile_number CHAR(9) UNIQUE NOT NULL
);

drop table if exists Pet;
create table Pet(
    id INTEGER PRIMARY KEY,
    name VARCHAR(256) NOT NULL,
    species VARCHAR(256) NOT NULL,
    location VARCHAR(256) NOT NULL,
    size INTEGER,
    color VARCHAR(32)
);

drop table if exists Favourite;
create table Favourite(
    user_id INTEGER REFERENCES User(id),
    pet_id INTEGER REFERENCES Pet(id),
    PRIMARY KEY(user_id, pet_id)
);

drop table if exists Proposal;
create table Proposal(
    popopipi_id INTEGER REFERENCES User(id),
    user_id INTEGER,
    pet_id INTEGER,
    accepted INTEGER,
    FOREIGN KEY(user_id, pet_id) REFERENCES Post(user_id, pet_id),
    PRIMARY KEY(popopipi_id, user_id, pet_id)
);

-- TODO Esquema: adicionar seta de poster_id de proposal p/ user_id de post_id

PRAGMA foreign_keys = ON;
INSERT INTO Pet VALUES(NULL, "Pantufa", "Gatus Gordus", "Costa lmao", 999, "Blaique");
INSERT INTO Pet VALUES(NULL, "Golden", "Golden Retriever", "Canil da trofa", 30, "Blaique");

INSERT INTO User VALUES(NULL, "Padoru", "Sempre a trolar", "padoru.png", "padoru@padoru.com", "912345678");
INSERT INTO User VALUES(NULL, "Maynardo", "Jaime do rato trovejante", "maynerd.png", "maynerd@tool.band", "9souonard");

INSERT INTO Favourite VALUES(1, 1);

INSERT INTO Post VALUES(2, 1, "Cute gato");

INSERT INTO Commentary VALUES(1, 2, 1, "Mas o que gacha games. Gato fofo btw.");

INSERT INTO Proposal VALUES(1, 2, 1, 1);
