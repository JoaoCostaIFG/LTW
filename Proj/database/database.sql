.mode columns
.headers on

drop table if exists User;
create table User(
    id INTEGER PRIMARY KEY,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    mobile_number TEXT UNIQUE NOT NULL,
    extension TEXT
);

drop table if exists Color;
create table Color(
    id INTEGER PRIMARY KEY,
    name TEXT NOT NULL
);

drop table if exists City;
create table City(
    id INTEGER PRIMARY KEY,
    name TEXT NOT NULL
);

drop table if exists Animal;
create table Animal(
    id INTEGER PRIMARY KEY,
    name TEXT NOT NULL
);

drop table if exists Species;
create table Species(
    id INTEGER PRIMARY KEY,
    name TEXT NOT NULL,
    animal_id REFERENCES Animal(id)
);

drop table if exists PetPost; 
create table PetPost( 
    id INTEGER PRIMARY KEY,
    name TEXT NOT NULL,
    birth_date DATE NOT NULL,
    gender INTEGER CHECK (gender = 1 OR gender = 0), -- 0 male, 1 female
    size INTEGER CHECK (size = 1 OR size = 2 OR size = 3), -- 1 small, 2 medium, 3 big
    description TEXT NOT NULL,
    date DATE NOT NULL,
    -- 1 being prepared for adopt, 2 ready for adoption, 3 being prep and accepted, 4 being delivered, 5 delivered
    state INTEGER CHECK (state = 1 OR state = 2 OR state = 3 OR state = 4 OR state = 5),
    color_id INTEGER REFERENCES Color(id),
    species_id INTEGER REFERENCES Species(id),
    city_id INTEGER REFERENCES City(id),
    user_id INTEGER REFERENCES User(id)
);

drop table if exists PetPhoto; 
create table PetPhoto( 
    id INTEGER PRIMARY KEY,
    post_id INTEGER REFERENCES PetPost(id) ON DELETE CASCADE,
    extension TEXT CHECK(extension LIKE "jpg" OR extension LIKE "png"),
    date DATE NOT NULL
);

drop table if exists Comment;
create table Comment(
    id INTEGER PRIMARY KEY,
    user_id INTEGER REFERENCES User(id),
    post_id INTEGER REFERENCES PetPost(id) ON DELETE CASCADE,
    text TEXT NOT NULL,
    date DATE NOT NULL
);

drop table if exists Question;
create table Question(
    id INTEGER PRIMARY KEY,
    user_id INTEGER REFERENCES User(id),
    post_id INTEGER REFERENCES PetPost(id) ON DELETE CASCADE,
    text TEXT NOT NULL,
    date DATE NOT NULL
);

drop table if exists Answer;
create table Answer(
    id INTEGER PRIMARY KEY,
    user_id INTEGER REFERENCES User(id),
    question_id INTEGER REFERENCES Question(id) ON DELETE CASCADE,
    text TEXT NOT NULL,
    date DATE NOT NULL
);

drop table if exists Favourite;
create table Favourite(
    user_id INTEGER REFERENCES User(id) ON DELETE CASCADE,
    post_id INTEGER REFERENCES PetPost(id) ON DELETE CASCADE,
    PRIMARY KEY(user_id, post_id)
);

drop table if exists Proposal;
create table Proposal(
    user_id INTEGER REFERENCES User(id),
    post_id INTEGER REFERENCES PetPost(id) ON DELETE CASCADE,
    accepted INTEGER CHECK (accepted = 0 OR accepted = 1 OR accepted = -1), -- 0 Rejected, 1 Accepted, -1 Pending
    date DATE NOT NULL,
    PRIMARY KEY(user_id, post_id)
);

DROP TRIGGER IF EXISTS UpdateStatus;
CREATE TRIGGER UpdateStatus
AFTER UPDATE OF accepted ON Proposal
FOR EACH ROW
WHEN
    New.accepted = 1 AND
    (SELECT PetPost.state FROM PetPost WHERE PetPost.id = New.post_id) < 3
BEGIN
    UPDATE PetPost
    SET state = state + 2
    WHERE PetPost.id = New.post_id;

    UPDATE Proposal
    SET accepted = 0
    WHERE Proposal.post_id = New.post_id AND
        Proposal.user_id != New.user_id;
END;
