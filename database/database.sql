.mode columns
.headers on

drop table if exists User;
create table User(
    id INTEGER PRIMARY KEY,
    username VARCHAR(256) NOT NULL,
    password VARCHAR(256) NOT NULL,
    picture VARCHAR(256),
    email VARCHAR(256) UNIQUE NOT NULL,
    mobile_number CHAR(9) UNIQUE NOT NULL
);

drop table if exists Color;
create table Color(
    id INTEGER PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

drop table if exists City;
create table City(
    id INTEGER PRIMARY KEY,
    name VARCHAR(256) NOT NULL
);

drop table if exists Animal;
create table Animal(
    id INTEGER PRIMARY KEY,
    name VARCHAR(100) NOT NULL
);

drop table if exists Species;
create table Species(
    id INTEGER PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    animal_id REFERENCES Animal(id)
);

drop table if exists PetPost; 
create table PetPost( 
    id INTEGER PRIMARY KEY,
    name VARCHAR(256) NOT NULL,
    age INTEGER,
    gender INTEGER CHECK (gender = 1 OR gender = 0),
    size INTEGER,
    description VARCHAR(256) NOT NULL,
    date DATE NOT NULL,
    color_id INTEGER REFERENCES Color(id),
    species_id INTEGER REFERENCES Species(id),
    city_id INTEGER REFERENCES City(id),
    user_id INTEGER REFERENCES User(id)
);

drop table if exists Photo; 
create table Photo( 
    id INTEGER PRIMARY KEY,
    post_id INTEGER REFERENCES PetPost(id),
    photo_path VARCHAR(256),
    date DATE NOT NULL
);

drop table if exists Comment;
create table Comment(
    id INTEGER PRIMARY KEY,
    user_id INTEGER REFERENCES User(id),
    post_id INTEGER REFERENCES PetPost(id),
    text VARCHAR(256) UNIQUE NOT NULL,
    date DATE NOT NULL
);

drop table if exists Question;
create table Question(
    id INTEGER PRIMARY KEY,
    user_id INTEGER REFERENCES User(id),
    post_id INTEGER REFERENCES PetPost(id),
    text VARCHAR(256) UNIQUE NOT NULL,
    date DATE NOT NULL
);

drop table if exists Answer;
create table Answer(
    id INTEGER PRIMARY KEY,
    user_id INTEGER REFERENCES User(id),
    question_id INTEGER REFERENCES Question(id),
    text VARCHAR(256) UNIQUE NOT NULL,
    date DATE NOT NULL
);

drop table if exists Favourite;
create table Favourite(
    user_id INTEGER REFERENCES User(id),
    post_id INTEGER REFERENCES PetPost(id),
    PRIMARY KEY(user_id, post_id)
);

drop table if exists Proposal;
create table Proposal(
    id INTEGER PRIMARY KEY,
    user_id INTEGER REFERENCES User(id),
    post_id INTEGER REFERENCES PetPost(id),
    accepted INTEGER,
    date DATE NOT NULL
);

-- TODO Esquema: adicionar seta de poster_id de proposal p/ user_id de post_id

