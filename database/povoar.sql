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

