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

PRAGMA foreign_keys = ON;

-- User
INSERT INTO User VALUES(NULL, "Padoru", "Sempre a trolar", "padoru.png", "padoru@padoru.com", "912345678");
INSERT INTO User VALUES(NULL, "Maynardo", "Jaime do rato trovejante", "maynerd.png", "maynerd@tool.band", "9souonard");
INSERT INTO User VALUES(NULL, "Nachos", "ltweaminhacadeirapreferida123", "coolpic.png", "nachoMan@hotmail.com", "933333333");
INSERT INTO User VALUES(NULL, "Irao", "meow33meow", "help.png", "atchim@gmail.com", "966666666");
INSERT INTO User VALUES(NULL, "Fontao", "ronron#99", "badpic.png", "santinho@gmail.com", "911111111");
INSERT INTO User VALUES(NULL, "Lucas", "desculpeinterromper", "sadpingu.png", "auau@hotmail.com", "933334563");

-- Color
INSERT INTO Color VALUES(NULL,"Brown");
INSERT INTO Color VALUES(NULL,"White");
INSERT INTO Color VALUES(NULL,"Black");

-- City
INSERT INTO City VALUES(NULL, "Trofa");
INSERT INTO City VALUES(NULL, "Porto");
INSERT INTO City VALUES(NULL, "Lisboa");

-- Animal
INSERT INTO Animal VALUES(NULL, "Dog");
INSERT INTO Animal VALUES(NULL, "Cat");

-- Species
INSERT INTO Species VALUES(NULL, "Bombay", 2);
INSERT INTO Species VALUES(NULL, "Cyprus", 2);
INSERT INTO Species VALUES(NULL, "Persian", 2);
INSERT INTO Species VALUES(NULL, "Golden Retriever", 1);

-- PetPost
INSERT INTO PetPost VALUES(NULL, "Pantufa", 7, 0, 3, "Gatus Gordus", "10/08/2020", 3, 1, 2, 4);
INSERT INTO PetPost VALUES(NULL, "Bobi", 3, 0, 2, "Good doggo pls adopt.", "01/08/2020", 2, 4, 1, 3);
INSERT INTO PetPost VALUES(NULL, "Poki", 10, 1, 1, "Poki is a very lazy cat.", "01/09/2020", 3, 2, 3, 1);

-- Photo
INSERT INTO Photo VALUES(NULL, 1, "pantufa.png", "10/08/2020");
INSERT INTO Photo VALUES(NULL, 1, "pantufa2.png", "10/08/2020");
INSERT INTO Photo VALUES(NULL, 2, "bobi.png", "01/08/2020");
INSERT INTO Photo VALUES(NULL, 3, "poki.png", "01/09/2020");

-- Comment
INSERT INTO Comment VALUES(NULL, 1, 1, "Mas o que gacha games. Gato fofo btw.", "18/09/2020");
INSERT INTO Comment VALUES(NULL, 3, 1, "Gordo.", "19/09/2020");

-- Question
INSERT INTO Question VALUES(NULL, 3, 1, "Como é que ele é tão gordo?", "19/09/2020");

-- Answer
INSERT INTO Answer VALUES(NULL, 4, 1, "Não sei.", "20/09/2020");

-- Favourite
INSERT INTO Favourite VALUES(1, 1);

-- Proposal
INSERT INTO Proposal VALUES(NULL, 2, 1, 0, "21/09/2020");
INSERT INTO Proposal VALUES(NULL, 5, 2, 1, "21/10/2020");
