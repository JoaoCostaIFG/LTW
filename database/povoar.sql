PRAGMA foreign_keys = ON;

-- User
--  id    username    password    picture    email    mobile_number -- password not hashed
INSERT INTO User VALUES(1, "Padoru", "$2y$12$XcQa6.1Lvh1T9AHOaxV5VeU5tEI4TLD9DA/bht0B7Z7WWJs1kRnYu", "padoru@padoru.com", "912345678", "png"); -- Sempre a trolar
INSERT INTO User VALUES(2, "Maynardo", "2y$12$XcQa6.1Lvh1T9AHOaxV5VeU5tEI4TLD9DA/bht0B7Z7WWJs1kRnYu", "maynerd@tool.band", "921912912", "png"); -- Jaime do rato trovejante
INSERT INTO User VALUES(3, "Nachos", "2y$12$XcQa6.1Lvh1T9AHOaxV5VeU5tEI4TLD9DA/bht0B7Z7WWJs1kRnYu", "nachoMan@hotmail.com", "933333333", "png"); -- ltweaminhacadeirapreferida123
INSERT INTO User VALUES(4, "Irao", "2y$12$XcQa6.1Lvh1T9AHOaxV5VeU5tEI4TLD9DA/bht0B7Z7WWJs1kRnYu", "atchim@gmail.com", "966666666", "png"); -- meow33meow
INSERT INTO User VALUES(5, "FontaoFontalhao", "2y$12$XcQa6.1Lvh1T9AHOaxV5VeU5tEI4TLD9DA/bht0B7Z7WWJs1kRnYu", "santinho@gmail.com", "911111111", "png"); -- ronron#99
INSERT INTO User VALUES(6, "Lucas", "2y$12$XcQa6.1Lvh1T9AHOaxV5VeU5tEI4TLD9DA/bht0B7Z7WWJs1kRnYu", "auau@hotmail.com", "933334563", "png"); -- desculpeinterromper
INSERT INTO User VALUES(7, "Davide", "2y$12$XcQa6.1Lvh1T9AHOaxV5VeU5tEI4TLD9DA/bht0B7Z7WWJs1kRnYu", "xxxwaffle420hd69@coldmail.com", "932560122", "png"); -- wafflegood123
INSERT INTO User VALUES(8, "João", "2y$12$XcQa6.1Lvh1T9AHOaxV5VeU5tEI4TLD9DA/bht0B7Z7WWJs1kRnYu", "ihhhhhh@uimail.com", "911911911", "png"); -- fogoistodemoramuito
INSERT INTO User VALUES(9, "CarlosPereira935", "2y$12$XcQa6.1Lvh1T9AHOaxV5VeU5tEI4TLD9DA/bht0B7Z7WWJs1kRnYu", "carlospereira@gmail.com", "932457977", "png"); -- HYN7h68Gohioh
INSERT INTO User VALUES(10, "Canil da Trofa", "2y$12$XcQa6.1Lvh1T9AHOaxV5VeU5tEI4TLD9DA/bht0B7Z7WWJs1kRnYu", "canildatrofa@gmail.com", "252877658", "png"); -- JNNJUHNOHn7N7
INSERT INTO User VALUES(11, "Louisse221", "2y$12$XcQa6.1Lvh1T9AHOaxV5VeU5tEI4TLD9DA/bht0B7Z7WWJs1kRnYu", "louie221@gmail.com", "252586000", "png"); -- bhH7B667m87y

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
INSERT INTO City VALUES(8, "Abrantes");
INSERT INTO City VALUES(9, "Agualva-Cacém");
INSERT INTO City VALUES(10, "Águeda");
INSERT INTO City VALUES(11, "Albergaria-a-Velha");
INSERT INTO City VALUES(12, "Albufeira");
INSERT INTO City VALUES(13, "Faro");
INSERT INTO City VALUES(14, "Alcácer do Sal");
INSERT INTO City VALUES(15, "Alcobaça");
INSERT INTO City VALUES(16, "Alfena");
INSERT INTO City VALUES(17, "Almada");
INSERT INTO City VALUES(18, "Almeirim");
INSERT INTO City VALUES(19, "Amadora");
INSERT INTO City VALUES(20, "Amarante");
INSERT INTO City VALUES(21, "Amora");
INSERT INTO City VALUES(22, "Anadia");
INSERT INTO City VALUES(23, "Aveiro");
INSERT INTO City VALUES(24, "Barcelos");
INSERT INTO City VALUES(25, "Barreiro");
INSERT INTO City VALUES(26, "Beja");
INSERT INTO City VALUES(27, "Borba");
INSERT INTO City VALUES(28, "Braga");
INSERT INTO City VALUES(29, "Bragança");
INSERT INTO City VALUES(30, "Caldas da Rainha");
INSERT INTO City VALUES(31, "Câmara de Lobos");
INSERT INTO City VALUES(32, "Caniço");
INSERT INTO City VALUES(33, "Cantanhede");
INSERT INTO City VALUES(34, "Cartaxo");
INSERT INTO City VALUES(35, "Castelo Branco");
INSERT INTO City VALUES(36, "Chaves");
INSERT INTO City VALUES(37, "Coimbra");
INSERT INTO City VALUES(38, "Costa da Caparica");
INSERT INTO City VALUES(39, "Covilhã");
INSERT INTO City VALUES(40, "Elvas");
INSERT INTO City VALUES(41, "Entroncamento");
INSERT INTO City VALUES(42, "Ermesinde");
INSERT INTO City VALUES(43, "Esmoriz");
INSERT INTO City VALUES(44, "Esposende");
INSERT INTO City VALUES(45, "Estarreja");
INSERT INTO City VALUES(46, "Estremoz");
INSERT INTO City VALUES(47, "Évora");
INSERT INTO City VALUES(48, "Fafe");
INSERT INTO City VALUES(49, "Faro");
INSERT INTO City VALUES(50, "Fátima");
INSERT INTO City VALUES(51, "Felgueiras");
INSERT INTO City VALUES(52, "Figueira da Foz");
INSERT INTO City VALUES(53, "Fiães");
INSERT INTO City VALUES(54, "Freamunde");
INSERT INTO City VALUES(55, "Funchal");
INSERT INTO City VALUES(56, "Fundão");
INSERT INTO City VALUES(57, "Gafanha da Nazaré");
INSERT INTO City VALUES(58, "Gandra");
INSERT INTO City VALUES(59, "Gondomar");
INSERT INTO City VALUES(60, "Gouveia");
INSERT INTO City VALUES(61, "Guarda");
INSERT INTO City VALUES(62, "Guimarães");
INSERT INTO City VALUES(63, "Horta");
INSERT INTO City VALUES(64, "Ílhavo");
INSERT INTO City VALUES(65, "Lagoa (Algarve)");
INSERT INTO City VALUES(66, "Lagoa (Azores)");
INSERT INTO City VALUES(67, "Lagos");
INSERT INTO City VALUES(68, "Lamego");
INSERT INTO City VALUES(69, "Leiria");
INSERT INTO City VALUES(70, "Lixa");
INSERT INTO City VALUES(71, "Loulé");
INSERT INTO City VALUES(72, "Loures");
INSERT INTO City VALUES(73, "Lourosa");
INSERT INTO City VALUES(74, "Macedo de Cavaleiros");
INSERT INTO City VALUES(75, "Machico");
INSERT INTO City VALUES(76, "Maia");
INSERT INTO City VALUES(77, "Mangualde");
INSERT INTO City VALUES(78, "Marco de Canaveses");
INSERT INTO City VALUES(79, "Marinha Grande");
INSERT INTO City VALUES(80, "Matosinhos");
INSERT INTO City VALUES(81, "Mealhada");
INSERT INTO City VALUES(82, "Miranda do Douro");
INSERT INTO City VALUES(83, "Mirandela");
INSERT INTO City VALUES(84, "Montemor-o-Novo");
INSERT INTO City VALUES(85, "Montijo");
INSERT INTO City VALUES(86, "Moura");
INSERT INTO City VALUES(87, "Odivelas");
INSERT INTO City VALUES(88, "Olhão da Restauração");
INSERT INTO City VALUES(89, "Oliveira de Azeméis");
INSERT INTO City VALUES(90, "Oliveira do Bairro");
INSERT INTO City VALUES(91, "Oliveira do Hospital");
INSERT INTO City VALUES(92, "Ourém");
INSERT INTO City VALUES(93, "Paços de Ferreira");
INSERT INTO City VALUES(94, "Paredes");
INSERT INTO City VALUES(95, "Penafiel");
INSERT INTO City VALUES(96, "Peniche");
INSERT INTO City VALUES(97, "Peso da Régua");
INSERT INTO City VALUES(98, "Pinhel");
INSERT INTO City VALUES(99, "Pombal");
INSERT INTO City VALUES(100, "Ponta Delgada");
INSERT INTO City VALUES(101, "Ponte de Sor");
INSERT INTO City VALUES(102, "Portalegre");
INSERT INTO City VALUES(103, "Portimão");
INSERT INTO City VALUES(104, "Vila Baleira (a.k.a. Porto Santo)");
INSERT INTO City VALUES(105, "Póvoa de Santa Iria");
INSERT INTO City VALUES(106, "Póvoa de Varzim");
INSERT INTO City VALUES(107, "Praia da Vitória");
INSERT INTO City VALUES(108, "Quarteira");
INSERT INTO City VALUES(109, "Queluz");
INSERT INTO City VALUES(110, "Rebordosa");
INSERT INTO City VALUES(111, "Reguengos de Monsaraz");
INSERT INTO City VALUES(112, "Ribeira Grande");
INSERT INTO City VALUES(113, "Rio Maior");
INSERT INTO City VALUES(114, "Rio Tinto");
INSERT INTO City VALUES(115, "Sabugal");
INSERT INTO City VALUES(116, "Sacavém");
INSERT INTO City VALUES(117, "Samora Correia");
INSERT INTO City VALUES(118, "Santa Comba Dão");
INSERT INTO City VALUES(119, "Santa Cruz");
INSERT INTO City VALUES(120, "Santana");
INSERT INTO City VALUES(121, "Santarém");
INSERT INTO City VALUES(122, "Santiago do Cacém");
INSERT INTO City VALUES(123, "São João da Madeira");
INSERT INTO City VALUES(124, "São Mamede de Infesta");
INSERT INTO City VALUES(125, "São Pedro do Sul");
INSERT INTO City VALUES(126, "São Salvador de Lordelo");
INSERT INTO City VALUES(127, "Seia");
INSERT INTO City VALUES(128, "Seixal");
INSERT INTO City VALUES(129, "Senhora da Hora");
INSERT INTO City VALUES(130, "Serpa");
INSERT INTO City VALUES(131, "Setúbal");
INSERT INTO City VALUES(132, "Silves");
INSERT INTO City VALUES(133, "Sines");
INSERT INTO City VALUES(134, "Tarouca");
INSERT INTO City VALUES(135, "Tavira");
INSERT INTO City VALUES(136, "Tomar");
INSERT INTO City VALUES(137, "Tondela");
INSERT INTO City VALUES(138, "Torres Novas");
INSERT INTO City VALUES(139, "Torres Vedras");
INSERT INTO City VALUES(140, "Trancoso");
INSERT INTO City VALUES(141, "Valbom");
INSERT INTO City VALUES(142, "Vale de Cambra");
INSERT INTO City VALUES(143, "Valença");
INSERT INTO City VALUES(144, "Valongo");
INSERT INTO City VALUES(145, "Valpaços");
INSERT INTO City VALUES(146, "Vendas Novas");
INSERT INTO City VALUES(147, "Viana do Castelo");
INSERT INTO City VALUES(148, "Vila do Conde");
INSERT INTO City VALUES(149, "Vila Franca de Xira");
INSERT INTO City VALUES(150, "Vila Nova de Famalicão");
INSERT INTO City VALUES(151, "Vila Nova de Foz Côa");
INSERT INTO City VALUES(152, "Vila Nova de Gaia");
INSERT INTO City VALUES(153, "Vila Nova de Santo André");
INSERT INTO City VALUES(154, "Santiago do Cacém");
INSERT INTO City VALUES(155, "Vila Real");
INSERT INTO City VALUES(156, "Vila Real de Santo António");
INSERT INTO City VALUES(157, "Faro");
INSERT INTO City VALUES(158, "Viseu");
INSERT INTO City VALUES(159, "Vizela");

-- Animal
-- id   name
INSERT INTO Animal VALUES(1, "Dog");
INSERT INTO Animal VALUES(2, "Cat");
INSERT INTO Animal VALUES(3, "Bird");
INSERT INTO Animal VALUES(4, "Turtle");
INSERT INTO Animal VALUES(5, "Hamster");
INSERT INTO Animal VALUES(6, "Snake");
INSERT INTO Animal VALUES(7, "Lizzard");

-- Species
-- id   name    animal_id
INSERT INTO Species VALUES(4, "Golden Retriever", 1);
INSERT INTO Species VALUES(9, "Unknown", 1);
INSERT INTO Species VALUES(10, "Mixed", 1);
INSERT INTO Species VALUES(12, "Basenji", 1);
INSERT INTO Species VALUES(13, "Labrador Retriever", 1);
INSERT INTO Species VALUES(14, "English Cocker Spaniel", 1);
INSERT INTO Species VALUES(15, "English Springer Spaniel", 1);
INSERT INTO Species VALUES(16, "German Shepherd", 1);
INSERT INTO Species VALUES(17, "Staffordshire Bull Terrier", 1);
INSERT INTO Species VALUES(18, "Cavalier King Charles Spaniel", 1);
INSERT INTO Species VALUES(19, "West Highland White Terrier", 1);
INSERT INTO Species VALUES(20, "Boxer", 1);
INSERT INTO Species VALUES(21, "Border Terrier", 1);
INSERT INTO Species VALUES(22, "Yorkshire Terrier", 1);
INSERT INTO Species VALUES(23, "Beagle", 1);
INSERT INTO Species VALUES(24, "Dachshund", 1);
INSERT INTO Species VALUES(25, "Poodle", 1);
INSERT INTO Species VALUES(26, "Shih Tzu", 1);
INSERT INTO Species VALUES(27, "Miniature Schnauzer", 1);
INSERT INTO Species VALUES(28, "Other", 1);

INSERT INTO Species VALUES(1, "Bombay", 2);
INSERT INTO Species VALUES(2, "Cyprus", 2);
INSERT INTO Species VALUES(3, "Persian", 2);
INSERT INTO Species VALUES(8, "Unknown", 2);
INSERT INTO Species VALUES(11, "Mixed", 2);
INSERT INTO Species VALUES(29, "Other", 2);
INSERT INTO Species VALUES(30, "Abyssinian", 2);
INSERT INTO Species VALUES(31, "American Bobtain", 2);
INSERT INTO Species VALUES(32, "American Shorthair", 2);
INSERT INTO Species VALUES(33, "Balinese", 2);
INSERT INTO Species VALUES(34, "Bengal", 2);
INSERT INTO Species VALUES(35, "Birman", 2);
INSERT INTO Species VALUES(36, "British Shorthair", 2);
INSERT INTO Species VALUES(37, "Devon Rex", 2);
INSERT INTO Species VALUES(38, "Domestic Longhair", 2);
INSERT INTO Species VALUES(39, "Exotic Shorthair", 2);
INSERT INTO Species VALUES(40, "Himalayan", 2);

INSERT INTO Species VALUES(5, "Parrot", 3);
INSERT INTO Species VALUES(7, "Other", 3);
INSERT INTO Species VALUES(41, "Unknown", 3);
INSERT INTO Species VALUES(42, "Macaw", 3);

INSERT INTO Species VALUES(6, "Any", 4);
INSERT INTO Species VALUES(43, "Any", 5);
INSERT INTO Species VALUES(44, "Any", 6);
INSERT INTO Species VALUES(45, "Any", 7);

-- PetPost
-- id   name    age    gender   size    description   date    color_id    species_id  city_id    user_id
INSERT INTO PetPost VALUES(1, "Pantufa", "2011-11-09", 0, 3, "Gatus Gordus", "10/08/2020", 3, 1, 2, 4);
INSERT INTO PetPost VALUES(2, "Bobi", "2015-05-02", 0, 2, "Good doggo pls adopt.", "01/08/2020", 2, 4, 1, 3);
INSERT INTO PetPost VALUES(3, "Poki", "2013-01-05", 0, 1, "Poki is a very lazy cat.", "01/09/2020", 3, 2, 3, 1);
INSERT INTO PetPost VALUES(4, "Lourito", "2008-09-20", 0, 2, "This parrot is really cool and will keep you company!", "14/09/2020", 4, 5, 4, 7);
INSERT INTO PetPost VALUES(5, "Sisel", "2019-12-02", 1, 1, "A young cat that loves to play!", "14/11/2020", 5, 3, 5, 8);
INSERT INTO PetPost VALUES(6, "Ninja", "2017-04-15", 0, 3, "Ninja likes to sleep a lot but is always ready to play!", "20/11/2020", 6, 6, 6, 8);
INSERT INTO PetPost VALUES(7, "Bolinhas", "2013-06-12", 1, 2, "She's a very calm and amicable kitten (nya~). Everyone loves her constantly surprised look.", "01/11/2020", 5, 11, 5, 5);
INSERT INTO PetPost VALUES(8, "Daisy", "2020-09-08", 1, 1, "Daisy is really sweat and loves attention", "01/11/2020", 1, 11, 7, 9);
INSERT INTO PetPost VALUES(9, "Mia", "2011-03-03", 1, 1, "Mia loves being outside! She would love living in a house with a big garden!", "03/11/2020", 1, 11, 7, 9);
INSERT INTO PetPost VALUES(10, "Spot", "2020-10-09", 0, 2, "Spot is a playful who is looking for someone to play with him. He enjoys going on walks and meeting other dogs. He is very good with children of all ages and is sure to bring smiles to your household!", "03/10/2020", 1, 12, 1, 10);
INSERT INTO PetPost VALUES(11, "Golden", "2011-09-13", 0, 2, "Golden was abandoned during is childhood. Luckily, we found him! He loves meeting new people and he would love to meet his new family soon :)", "09/10/2020", 1, 4, 1, 10);
INSERT INTO PetPost VALUES(12, "Bazinga", "2020-11-29", 0, 1, "Bazinga is looking for a new home!", "29/11/2020", 6, 6, 7, 1);
INSERT INTO PetPost VALUES(13, "Chico", "2013-08-06", 0, 2, "Chico was living on the streets but now he is too old to find food for himself He is looking for someone who can give him lots of love and delicious food!", "29/12/2020", 3, 11, 1, 10);
INSERT INTO PetPost VALUES(14, "Gatoplank", "2009-10-26", 0, 2, "Well behaved cat. He is really good with children.", "20/12/2020", 5, 11, 3, 2);

-- Photo
-- id   post_id extension  date
INSERT INTO PetPhoto VALUES(NULL, 1, "jpg", "2020-08-10");
INSERT INTO PetPhoto VALUES(NULL, 1, "jpg", "2020-08-10");
INSERT INTO PetPhoto VALUES(NULL, 2, "jpg", "2020-08-01");
INSERT INTO PetPhoto VALUES(NULL, 3, "jpg", "2020-09-01");
INSERT INTO PetPhoto VALUES(NULL, 4, "jpg", "2020-09-14");
INSERT INTO PetPhoto VALUES(NULL, 4, "jpg", "2020-09-15");
INSERT INTO PetPhoto VALUES(NULL, 5, "jpg", "2020-09-14");
INSERT INTO PetPhoto VALUES(NULL, 6, "jpg", "2020-11-22");
INSERT INTO PetPhoto VALUES(NULL, 7, "jpg", "2020-11-01");
INSERT INTO PetPhoto VALUES(NULL, 8, "png", "2020-11-01");
INSERT INTO PetPhoto VALUES(NULL, 9, "jpg", "2020-11-03");
INSERT INTO PetPhoto VALUES(NULL, 9, "jpg", "2020-11-03");
INSERT INTO PetPhoto VALUES(NULL, 10, "png", "2020-10-03");
INSERT INTO PetPhoto VALUES(NULL, 11, "png", "2020-10-09");
INSERT INTO PetPhoto VALUES(NULL, 12, "jpg", "2020-11-29");
INSERT INTO PetPhoto VALUES(NULL, 13, "jpg", "2020-12-31");
INSERT INTO PetPhoto VALUES(NULL, 14, "png", "2020-12-20");

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


