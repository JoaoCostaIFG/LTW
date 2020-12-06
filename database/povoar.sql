PRAGMA foreign_keys = ON;

-- User
--  id    username    password    picture    email    mobile_number
INSERT INTO User VALUES(1, "Padoru", "Sempre a trolar", "padoru@padoru.com", "912345678", "1.png");
INSERT INTO User VALUES(2, "Maynardo", "Jaime do rato trovejante", "maynerd@tool.band", "921912912", "2.png");
INSERT INTO User VALUES(3, "Nachos", "ltweaminhacadeirapreferida123", "nachoMan@hotmail.com", "933333333", "3.png");
INSERT INTO User VALUES(4, "Irao", "meow33meow", "atchim@gmail.com", "966666666", "4.png");
INSERT INTO User VALUES(5, "FontaoFontalhao", "ronron#99", "santinho@gmail.com", "911111111", "5.png");
INSERT INTO User VALUES(6, "Lucas", "desculpeinterromper", "auau@hotmail.com", "933334563", "6.png");
INSERT INTO User VALUES(7, "Davide", "wafflegood123", "xxxwaffle420hd69@coldmail.com", "932560122", "7.png");
INSERT INTO User VALUES(8, "João", "fogoistodemoramuito", "ihhhhhh@uimail.com", "911911911", "8.png");
INSERT INTO User VALUES(9, "CarlosPereira935", "HYN7h68Gohioh", "carlospereira@gmail.com", "932457977", "9.png");
INSERT INTO User VALUES(10, "Canil da Trofa", "JNNJUHNOHn7N7", "canildatrofa@gmail.com", "252877658", "10.png");
INSERT INTO User VALUES(11, "Louisse221", "bhH7B667m87y", "louie221@gmail.com", "252586000", "11.png");

-- Color
-- id   name
INSERT INTO Color VALUES(1,"Brown");
INSERT INTO Color VALUES(2,"White");
INSERT INTO Color VALUES(3,"Black");
INSERT INTO Color VALUES(4,"Blonde");
INSERT INTO Color VALUES(5,"Grey");
INSERT INTO Color VALUES(6,"Green");

-- City
-- id   name
INSERT INTO City VALUES(1, "Trofa");
INSERT INTO City VALUES(2, "Porto");
INSERT INTO City VALUES(3, "Lisboa");
INSERT INTO City VALUES(4, "Santa Maria da Feira");
INSERT INTO City VALUES(5, "Espinho");
INSERT INTO City VALUES(6, "Santo Tirso");
INSERT INTO City VALUES(7, "Ovar");

-- Animal
-- id   name
INSERT INTO Animal VALUES(1, "Dog");
INSERT INTO Animal VALUES(2, "Cat");
INSERT INTO Animal VALUES(3, "Bird");
INSERT INTO Animal VALUES(4, "Turtle");

-- Species
-- id   name    animal_id
INSERT INTO Species VALUES(1, "Bombay", 2);
INSERT INTO Species VALUES(2, "Cyprus", 2);
INSERT INTO Species VALUES(3, "Persian", 2);
INSERT INTO Species VALUES(4, "Golden Retriever", 1);
INSERT INTO Species VALUES(5, "Parrot", 3);
INSERT INTO Species VALUES(6, "Unknown", 4);
INSERT INTO Species VALUES(7, "Unknown", 3);
INSERT INTO Species VALUES(8, "Unknown", 2);
INSERT INTO Species VALUES(9, "Unknown", 1);
INSERT INTO Species VALUES(10, "Mixed", 1);
INSERT INTO Species VALUES(11, "Mixed", 2);
INSERT INTO Species VALUES(12, "Basenji", 1);

-- PetPost
-- id   name    age    gender   size    description   date    color_id    species_id  city_id    user_id
INSERT INTO PetPost VALUES(1, "Pantufa", 7, 0, 3, "Gatus Gordus", "10/08/2020", 3, 1, 2, 4);
INSERT INTO PetPost VALUES(2, "Bobi", 3, 0, 2, "Good doggo pls adopt.", "01/08/2020", 2, 4, 1, 3);
INSERT INTO PetPost VALUES(3, "Poki", 10, 0, 1, "Poki is a very lazy cat.", "01/09/2020", 3, 2, 3, 1);
INSERT INTO PetPost VALUES(4, "Lourito", 12, 0, 2, "This parrot is really cool and will keep you company!", "14/09/2020", 4, 5, 4, 7);
INSERT INTO PetPost VALUES(5, "Sisel", 1, 1, 1, "A young cat that loves to play!", "14/11/2020", 5, 3, 5, 8);
INSERT INTO PetPost VALUES(6, "Ninja", 20, 0, 3, "Ninja likes to sleep a lot but is always ready to play!", "20/11/2020", 6, 6, 6, 8);
INSERT INTO PetPost VALUES(7, "Bolinhas", 5, 1, 2, "She's a very calm and amicable kitten (nya~). Everyone loves her constantly surprised look.", "01/11/2020", 5, 11, 5, 5);
INSERT INTO PetPost VALUES(8, "Daisy", 1, 1, 1, "Daisy is really sweat and loves attention", "01/11/2020", 1, 11, 7, 9);
INSERT INTO PetPost VALUES(9, "Mia", 1, 1, 1, "Mia loves being outside! She would love living in a house with a big garden!", "03/11/2020", 1, 11, 7, 9);
INSERT INTO PetPost VALUES(10, "Spot", 3, 0, 2, "Spot is a playful who is looking for someone to play with him. He enjoys going on walks and meeting other dogs. He is very good with children of all ages and is sure to bring smiles to your household!", "03/10/2020", 1, 12, 1, 10);
INSERT INTO PetPost VALUES(11, "Golden", 3, 0, 2, "Golden was abandoned during is childhood. Luckily, we found him! He loves meeting new people and he would love to meet his new family soon :)", "09/10/2020", 1, 4, 1, 10);
INSERT INTO PetPost VALUES(12, "Bazinga", 1, 0, 1, "Bazinga is looking for a new home!", "29/11/2020", 6, 6, 7, 1);
INSERT INTO PetPost VALUES(13, "Chico", 10, 0, 2, "Chico was living on the streets but now he is too old to find food for himself He is looking for someone who can give him lots of love and delicious food!", "29/12/2020", 3, 11, 1, 10);
INSERT INTO PetPost VALUES(14, "Gatoplank", 12, 0, 2, "Well behaved cat. He is really good with children.", "20/12/2020", 5, 11, 3, 2);

-- Photo
-- id   post_id extension  date
INSERT INTO PetPhoto VALUES(NULL, 1, "jpg", "10/08/2020");
INSERT INTO PetPhoto VALUES(NULL, 1, "jpg", "10/08/2020");
INSERT INTO PetPhoto VALUES(NULL, 2, "jpg", "01/08/2020");
INSERT INTO PetPhoto VALUES(NULL, 3, "jpg", "01/09/2020");
INSERT INTO PetPhoto VALUES(NULL, 4, "jpg", "14/09/2020");
INSERT INTO PetPhoto VALUES(NULL, 4, "jpg", "15/09/2020");
INSERT INTO PetPhoto VALUES(NULL, 5, "jpg", "14/09/2020");
INSERT INTO PetPhoto VALUES(NULL, 6, "jpg", "22/11/2020");
INSERT INTO PetPhoto VALUES(NULL, 7, "jpg", "01/11/2020");
INSERT INTO PetPhoto VALUES(NULL, 8, "png", "01/11/2020");
INSERT INTO PetPhoto VALUES(NULL, 9, "jpg", "03/11/2020");
INSERT INTO PetPhoto VALUES(NULL, 9, "jpg", "03/11/2020");
INSERT INTO PetPhoto VALUES(NULL, 10, "png", "03/10/2020");
INSERT INTO PetPhoto VALUES(NULL, 11, "png", "09/10/2020");
INSERT INTO PetPhoto VALUES(NULL, 12, "jpg", "29/11/2020");
INSERT INTO PetPhoto VALUES(NULL, 13, "jpg", "31/12/2020");
INSERT INTO PetPhoto VALUES(NULL, 14, "png", "20/12/2020");

-- Comment
-- id   user_id     post_id     text    date
INSERT INTO Comment VALUES(NULL, 1, 1, "Cute cat.", "18/09/2020");
INSERT INTO Comment VALUES(NULL, 3, 1, "Fat.", "19/09/2020");
INSERT INTO Comment VALUES(NULL, 8, 4, "That is a cool looking parrot.", "20/09/2020");
INSERT INTO Comment VALUES(NULL, 6, 5, "Soo cutee", "20/11/2020");
INSERT INTO Comment VALUES(NULL, 2, 9, "Meow Meow!!", "20/12/2020");
INSERT INTO Comment VALUES(NULL, 9, 7, "What a cutie! uwu", "02/12/2020");
INSERT INTO Comment VALUES(NULL, 11, 7, "If I wasn't so occupied with my two kittens, I'd take her in...:(", "07/12/2020");
INSERT INTO Comment VALUES(NULL, 2, 12, "Cute turtle.BAZINGA", "18/09/2020");

-- Question
-- id   user_id     post_id     text    date
INSERT INTO Question VALUES(NULL, 3, 1, "Why is it so fat?", "19/09/2020");
INSERT INTO Question VALUES(NULL, 5, 4, "Is it real?", "22/09/2020");
INSERT INTO Question VALUES(NULL, 5, 3, "At what time of the day does he sleep?", "22/09/2020");
INSERT INTO Question VALUES(NULL, 11, 7, "Has she been vaccinated?", "22/11/2020");

-- Answer
-- id   user_id      question_id    text    date
INSERT INTO Answer VALUES(NULL, 4, 1, "Dunno.", "20/09/2020");
INSERT INTO Answer VALUES(NULL, 8, 2, "Maybe uwu.", "23/09/2020");
INSERT INTO Answer VALUES(NULL, 1, 3, "He sleeps a lot. I would say he sleeps 10 hours a day. More or less.", "23/09/2020");

-- Favourite
-- user_id      post_id
INSERT INTO Favourite VALUES(1, 1);
INSERT INTO Favourite VALUES(4, 4);
INSERT INTO Favourite VALUES(6, 5);

-- Proposal
-- id   user_id      post_id    accepted    date
INSERT INTO Proposal VALUES(2, 1, 0, "21/09/2020");
INSERT INTO Proposal VALUES(5, 2, 1, "21/10/2020");
INSERT INTO Proposal VALUES(4, 4, 1, "23/10/2020");
INSERT INTO Proposal VALUES(5, 9, 0, "21/12/2020");


