-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2024 at 03:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quizard`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` varchar(10) NOT NULL,
  `adminName` varchar(100) NOT NULL,
  `adminIC` varchar(14) NOT NULL,
  `adminPhone` varchar(14) DEFAULT NULL,
  `adminAddress` varchar(100) DEFAULT NULL,
  `adminEmail` varchar(40) DEFAULT NULL,
  `adminQualification` varchar(100) DEFAULT NULL,
  `adminMajor` varchar(100) DEFAULT NULL,
  `adminPic` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminName`, `adminIC`, `adminPhone`, `adminAddress`, `adminEmail`, `adminQualification`, `adminMajor`, `adminPic`, `password`) VALUES
('abil04', 'Rizaliff Nabil Bin Muhammad Mukhriz Murugan', '041111140285', '01164125546', 'Lot 3-A,Seri Aset Utama', 'riznabil@gmail.com', 'Degree', 'Bachelor of Science and Mathematics (Hons.) ', 'image/abil04.png', '550a141f12de6341fba65b0ad0433500'),
('capiq02', 'Muhammad Syafiq Bin Syahromsyah', '041211041127', '01126678737', 'Blok 39-1-2,Perumahan Awan Seri Midah', 'syafiq@gmail.com', 'Degree', 'Bachelor of Science (Hons.)', 'image/capiq02.png', '310dcbbf4cce62f762a2aaa148d556bd'),
('mamal00', 'Muhammad Akhmal Bin Mohamad Hussin', '0404072140275', '01151871016', 'Blok 2-4-7 Perumahan Megah Holdings, KL', 'akhmal@gmail.com', 'Degree', 'Banchelor of Computer Science (Hons.)', 'image/mamal00.png', '698d51a19d8a121ce581499d7b701668'),
('ucup12', 'Nik Yusuf Bin Nik Mohamed Nizan', '0405122070233', '01165545300', 'Blok 12,Seri Kos Rendah Awam', 'nyusuf@gmail.com', 'Degree', 'Banchelor of English for Professional Communication (Hons.)', 'image/ucup12.png', 'bcbe3365e6ac95ea2c0343a2395834dd');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payID` int(11) NOT NULL,
  `bankName` varchar(30) DEFAULT NULL,
  `bankAcc` varchar(50) DEFAULT NULL,
  `payDate` date NOT NULL,
  `studID` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payID`, `bankName`, `bankAcc`, `payDate`, `studID`) VALUES
(1, 'RHB', '11445785512', '2024-06-09', 'adil02'),
(2, 'CIMB', '22568543221', '2024-06-09', 'ApisA'),
(3, 'TNG E-Wallet', '12234686564', '2024-06-09', 'zaza12'),
(4, 'Hong Leong', '17895645664', '2024-06-09', 'RailFy');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `quesID` varchar(10) NOT NULL,
  `quesAsk` varchar(150) NOT NULL,
  `ansA` varchar(50) DEFAULT NULL,
  `ansB` varchar(50) DEFAULT NULL,
  `ansC` varchar(50) DEFAULT NULL,
  `ansD` varchar(50) DEFAULT NULL,
  `ansCorrect` varchar(1) DEFAULT NULL,
  `topID` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`quesID`, `quesAsk`, `ansA`, `ansB`, `ansC`, `ansD`, `ansCorrect`, `topID`) VALUES
('Q100', 'Which part of the computer is known as the brain?', 'Monitor', 'Keyboard', 'CPU', 'Mouse', 'C', 'T100'),
('Q101', 'What does RAM stand for?', 'Random Access Memory', 'Read Access Memory', 'Run Access Memory ', 'Ready Access Memory', 'A', 'T100'),
('Q102', 'Which device is used to point and click?', 'Monitor', 'Keyboard', 'Mouse', 'Printer', 'C', 'T100'),
('Q103', ' What part of the computer displays images and text?', 'Keyboard', 'Monitor', 'CPU', 'Mouse', 'B', 'T100'),
('Q104', ' Which device is used to type text?', 'Monitor', 'Keyboard', 'Mouse', 'Speaker', 'B', 'T100'),
('Q105', 'What does CPU stand for?', 'Central Processing Unit', 'Computer Personal Unit', 'Central Personal Unit', 'Computer Processing Unit', 'A', 'T100'),
('Q106', 'Which part of the computer is used to print documents?', 'Monitor', 'Keyboard', 'Mouse', 'Printer', 'D', 'T100'),
('Q107', 'What does \'www\' stand for in a web address?', 'World Wide Web', 'Web World Wide', 'World Web Wide', 'Wide Web World', 'A', 'T101'),
('Q108', 'Which browser is NOT commonly used to access the internet?', 'Google Chrome', 'Mozilla Firefox', 'Microsoft Word', 'Safari', 'C', 'T101'),
('Q109', 'What is an email?', ' A type of web browser', 'An online shopping site', 'Electronic mail', ' A computer gamee', 'C', 'T101'),
('Q110', 'Which of these is a search engine?', 'Gmail', 'Facebook', 'Wikipedia', 'Google', 'D', 'T101'),
('Q111', 'What is used to send and receive messages online?', ' Email', 'Monitor', 'Keyboard', 'Printer', 'A', 'T101'),
('Q112', 'Which of these can you use to search for information online?', 'Calculator', 'Search engine', 'text editor', 'Music Player', 'B', 'T101'),
('Q113', 'What do you need to connect to the internet?', 'A book', 'A pen', 'An internet connection', 'A lamp', 'C', 'T101'),
('Q114', 'What is the main function of a word processor?', 'To play music', 'To browse the internet', 'To create and edit text documents', 'To watch videos', 'C', 'T102'),
('Q115', 'Which software is used for creating spreadsheets?', 'Microsoft Word', 'Microsoft Excel', 'Adobe Photoshop', 'Mozilla Firefox', 'B', 'T102'),
('Q116', 'What type of software is used for image editing?', 'Microsoft Word', 'Adobe Photoshop', 'Google Chrome', 'Windows Media Player', 'B', 'T102'),
('Q117', 'Which of the following is an operating system?', 'Windows 10', 'Google', 'Facebook', 'Microsoft Office', 'A', 'T102'),
('Q118', 'What is the primary function of an antivirus program?', 'To edit documents', 'To browse the internet', 'To protect the computer from malware', 'To play games', 'C', 'T102'),
('Q119', 'Which application is commonly used for presentations?', 'Microsoft Word', 'Microsoft Excel', 'Microsoft PowerPoint', 'Microsoft Access', 'C', 'T102'),
('Q120', 'What software would you use to manage a database?', 'Microsoft Word', 'Microsoft Excel', 'Microsoft Access', 'Microsoft Outlook', 'C', 'T102'),
('Q121', 'What does HTML stand for?', 'Hypertext Markup Language', 'Hyperlink and Text Markup Language', 'Home Tool Markup Language', 'Hyperlink Markup Language', 'A', 'T103'),
('Q122', 'Which of the following is a programming language?', 'HTML', 'CSS', 'JavaScript', 'HTTP', 'C', 'T103'),
('Q123', 'What is the function of a compiler?', 'To write code', 'To execute code', 'To convert high-level code into machine code', 'To debug code', 'C', 'T103'),
('Q124', 'Which symbol is used to start a comment in most programming languages?', '//', '**', '==', '<>', 'A', 'T103'),
('Q125', 'What is a loop in programming?', 'A sequence of instructions that is executed once', 'A sequence of instructions that is repeated until ', 'A sequence of instructions that is skipped', 'A sequence of instructions that terminates the pro', 'B', 'T103'),
('Q126', 'What does \'bug\' refer to in programming?', 'A feature in the software', 'An error in the software', 'A user of the software', 'A tool used in programming', 'B', 'T103'),
('Q127', 'What does IDE stand for in the context of programming?', 'Internet Development Environment', 'Integrated Development Environment', 'Internal Development Environment', 'Independent Development Environment', 'B', 'T103'),
('Q128', 'Which organ pumps blood throughout the body?', 'Brain', 'Heart', 'Lungs', 'Stomach', 'B', 'T104'),
('Q129', 'What do humans use to breathe?', 'Heart', 'Lungs', 'Stomach', 'Brain', 'B', 'T104'),
('Q130', 'Which part of the body helps you think?', 'Heart', 'Lungs', 'Brain', 'Liver', 'C', 'T104'),
('Q131', 'What do you use to see?', 'Ears', 'Eyes', 'Nose', 'Mouth', 'B', 'T104'),
('Q132', 'Which part of the body helps you digest food?', 'Heart', 'Lungs', 'Stomach', 'Brain', 'C', 'T104'),
('Q133', 'What do you use to hear?', 'Ears', 'Eye', 'Nose', 'Mouth', 'A', 'T104'),
('Q134', 'Which organ is part of the digestive system?', 'Lungs', 'Heart', 'Liver', 'Poop', 'C', 'T104'),
('Q135', 'What do plants need to make food?', 'Water', 'Sunlight', 'Soil', 'All of the above', 'D', 'T105'),
('Q136', 'Which part of the plant absorbs water?', 'Leaves', 'Stem', 'Roots', 'Flowers', 'C', 'T105'),
('Q137', 'What part of the plant makes seeds?', 'Leaves', 'Stem', 'Roots', 'Flowers', 'D', 'T105'),
('Q138', 'What do leaves use to make food?', 'Water and sunlight', 'Soil and water', 'Sunlight and soil', 'Roots and soil', 'D', 'T105'),
('Q139', 'Which part of the plant supports it?', 'Leaves', 'Stem', 'Roots', 'Flowers', 'B', 'T105'),
('Q140', 'What is the process of making food in plants called?', 'Photosynthesis', 'Digestion', 'Respiration', 'Transpiration', 'A', 'T105'),
('Q141', 'Which part of the plant can turn into a new plant?', 'Seeds', 'Stem', 'Roots', 'Leaves', 'A', 'T105'),
('Q142', 'Which planet is closest to the Sun?', 'Mercury', 'Earth', 'Mars', 'Venus', 'A', 'T106'),
('Q143', 'Which planet is known as the Red Planet?', 'Venus', 'Jupiter', 'Mars', 'Saturn', 'C', 'T106'),
('Q144', 'What is the largest planet in our solar system?', 'Earth', 'Jupiter', 'Saturn', 'Uranus', 'B', 'T106'),
('Q145', 'Which planet has rings around it?', 'Mars', 'Venus', 'Saturn', 'Neptune', 'C', 'T106'),
('Q146', 'How many planets are in our solar system?', '7', '10', '9', '8', 'D', 'T106'),
('Q147', 'Which planet is known as the Earth\'s twin?', 'Venus', 'Mercury', 'Mars', 'Neptune', 'A', 'T106'),
('Q148', 'What is the smallest planet in our solar system?', 'Mars', 'Mercury', 'Neptune', 'Pluto', 'B', 'T106'),
('Q149', 'Which animal is known as the King of the Jungle?', 'Lion', 'Elephant', 'Tiger', 'Bear', 'A', 'T107'),
('Q150', 'Which animal is the largest mammal?', 'Elephant', 'Whale', 'Giraffe', 'Hippopotamus', 'B', 'T107'),
('Q151', 'What do pandas primarily eat?', 'Fish', 'Bamboo', 'Insects', 'Fruits', 'B', 'T107'),
('Q152', 'Which animal is known for its ability to change color?', 'Frog', 'Snake', 'Chameleon', 'Lizard', 'C', 'T107'),
('Q153', 'What type of animal is a frog?', 'Mammal', 'Bird', 'Reptile', 'Amphibian', 'D', 'T107'),
('Q154', 'Which bird is known for its colorful feathers and ability to mimic sounds?', 'Crow', 'Parrot', 'Sparrow', 'Owl', 'B', 'T107'),
('Q155', 'What is the fastest land animal?', 'Cheetah', 'Tiger', 'Lion', 'Leopard', 'A', 'T107'),
('Q156', 'Which of the following is a common noun?', 'John', 'London', 'Dog', 'Eiffel Tower', 'C', 'T112'),
('Q157', 'Which sentence uses a proper noun correctly?', 'The cat is sleeping.', 'My favorite book is Harry Potter.', 'She bought a car.', 'They went to the park.', 'B', 'T112'),
('Q158', 'Identify the proper noun in the sentence: \'Sara is going to Paris.\'', 'Sara', 'going', 'to', 'Paris', 'A', 'T112'),
('Q159', 'Which word is a proper noun?', 'school', 'New York', 'teacher', 'book', 'B', 'T112'),
('Q160', 'Choose the sentence with a common noun.', 'The Golden Gate Bridge is beautiful.', 'My friend lives in London.', 'Mount Everest is the highest mountain.', 'I saw an elephant at the zoo.', 'D', 'T112'),
('Q161', 'Identify the common noun in the sentence: \'The library has many books.\'', 'library', 'has', 'many', 'books', 'A', 'T112'),
('Q162', 'Which of these words is NOT a common noun?', 'apple', 'tree', 'city', 'Mary', 'D', 'T112'),
('Q163', 'What is a synonym for \'happy\'?', 'sad', 'joyful', 'angry', 'tired', 'B', 'T113'),
('Q164', 'Which word means the same as \'big\'?', 'huge', 'small', 'tiny', 'little', 'A', 'T113'),
('Q165', 'Choose the synonym for \'quick\'.', 'slow', 'fast', 'weak', 'loud', 'B', 'T113'),
('Q166', 'What is a synonym for \'smart\'?', 'foolish', 'dull', 'lazy', 'intelligent', 'D', 'T113'),
('Q167', 'Which word means the same as \'angry\'?', 'calm', 'happy', 'furious', 'peaceful', 'C', 'T113'),
('Q168', 'Select the synonym for \'cold\'.', 'hot', 'warm', 'chilly', 'mild', 'C', 'T113'),
('Q169', 'What is a synonym for \'difficult\'?', 'hard', 'easy', 'simple', 'light', 'A', 'T113'),
('Q170', 'Which sentence is in the present tense?', 'She will go to the store.', 'She goes to the store.', 'She went to the store.', 'She was going to the store.', 'B', 'T114'),
('Q171', 'Which sentence is in the past tense?', 'He plays football.', 'He will play football.', 'He is playing football.', 'He played football.', 'D', 'T114'),
('Q172', 'Identify the future tense sentence.', 'They will cook dinner.', 'They are cooking dinner.', 'They cooked dinner.', 'They cook dinner.', 'A', 'T114'),
('Q173', 'Which sentence is in the present continuous tense?', 'She will read a book.', 'She read a book.', 'She is reading a book.', 'She reads a book.', 'C', 'T114'),
('Q174', 'Identify the past continuous tense sentence.', 'He was watching TV.', 'He watches TV.', 'He will watch TV.', 'He is watching TV.', 'A', 'T114'),
('Q175', 'Which sentence is in the present perfect tense?', 'I am eating dinner.', 'I ate dinner.', 'I will eat dinner.', 'I have eaten dinner.', 'D', 'T114'),
('Q176', 'Choose the correct past perfect tense sentence.', 'They had finished their work.', 'They have finished their work.', 'They are finishing their work.', 'They will finish their work.', 'A', 'T114'),
('Q177', 'Which word is an adjective?', 'Beautiful', 'Run', 'Quickly', 'Happiness', 'A', 'T115'),
('Q178', 'Identify the adjective in the sentence: \'The sky is blue.\'', 'Sky', 'Is', 'Blue', 'The', 'C', 'T115'),
('Q179', 'Which sentence uses an adjective correctly?', 'The dog is run.', 'He will walk.', 'They are going.', 'She is happy.', 'D', 'T115'),
('Q180', 'Choose the sentence with a comparative adjective.', 'This cake is sweet.', 'This cake is sweeter than that one.', 'This cake is the sweetest.', 'This cake was sweet.', 'B', 'T115'),
('Q181', 'Identify the superlative adjective in the sentence: \'This is the tallest building.\'', 'This', 'Tallest', 'Building', 'Is', 'B', 'T115'),
('Q182', 'Which word is NOT an adjective?', 'Fast', 'Bright', 'Slowly', 'Tall', 'C', 'T115'),
('Q183', 'Choose the sentence that uses an adjective correctly.', 'He is a tall boy.', 'She sings beautifully.', 'They run quickly.', 'She is smartly.', 'A', 'T115'),
('Q184', 'What is 5 + 3?', '6', '7', '8', '9', 'C', 'T108'),
('Q185', 'What is 10 - 4?', '6', '8', '7', '5', 'A', 'T108'),
('Q186', 'What is 3 x 3?', '6', '9', '12', '8', 'B', 'T108'),
('Q187', 'What is 16 ÷ 4?', '3', '6', '5', '4', 'D', 'T108'),
('Q188', 'What is 7 + 2?', '8', '9', '10', '11', 'B', 'T108'),
('Q189', 'What is 15 - 5?', '10', '8', '12', '9', 'A', 'T108'),
('Q190', 'What is 2 x 5?', '8', '7', '10', '11', 'C', 'T108'),
('Q191', 'How many sides does a triangle have?', '3', '4', '5', '6', 'A', 'T109'),
('Q192', 'Which shape has four equal sides?', 'Rectangle', 'Triangle', 'Square', 'Circle', 'C', 'T109'),
('Q193', 'What shape is a ball?', 'Cube', 'Cylinder', 'Pyramid', 'Sphere', 'D', 'T109'),
('Q194', 'How many sides does a pentagon have?', '4', '5', '6', '8', 'B', 'T109'),
('Q195', 'Which shape has no corners?', 'Square', 'Triangle', 'Rectangle', 'Circle', 'D', 'T109'),
('Q196', 'What shape is a dice?', 'Sphere', 'Pyramid', 'Cube', 'Cone', 'C', 'T109'),
('Q197', 'Which shape has six sides?', 'Pentagon', 'Hexagon', 'Heptagon', 'Octagon', 'B', 'T109'),
('Q198', 'What is 1/2 + 1/2?', '1', '2', '1/2', '3/2', 'A', 'T110'),
('Q199', 'Simplify the fraction 4/8.', '1/2', '3/4', '2/4', '4/4', 'A', 'T110'),
('Q200', 'What is 3/4 - 1/4?', '1/4', '1/2', '2/4', '3/4', 'B', 'T110'),
('Q201', 'Which fraction is equivalent to 2/3?', '2/4', '3/5', '4/6', '5/6', 'C', 'T110'),
('Q202', 'What is 1/3 + 1/6?', '1/2', '2/3', '1/6', '3/6', 'A', 'T110'),
('Q203', 'Convert 3/4 to a decimal.', '0.5', '0.75', '0.25', '0.6', 'B', 'T110'),
('Q204', 'What is 5/8 as a percentage?', '80%', '50%', '75%', '62.5%', 'D', 'T110'),
('Q205', 'How many minutes are in an hour?', '60', '30', '45', '90', 'A', 'T111'),
('Q206', 'What time is it if the clock shows 3:30 PM?', 'Half past three in the morning', 'Three thirty in the afternoon', 'Three o\'clock in the morning', 'Half past three in the afternoon', 'D', 'T111'),
('Q207', 'How many seconds are in a minute?', '30', '45', '60', '90', 'C', 'T111'),
('Q208', 'If it is 2:00 PM now, what time will it be in 5 hours?', '7:00 PM', '6:00 PM', '5:00 PM', '8:00 PM', 'A', 'T111'),
('Q209', 'What is the equivalent of 3:45 in a 24-hour clock?', '13:45', '14:45', '15:45', '16:45', 'C', 'T111'),
('Q210', 'How many hours are there in a day?', '12', '24', '48', '36', 'B', 'T111'),
('Q211', 'If a movie starts at 7:15 PM and lasts for 2 hours and 30 minutes, what time does it end?', '9:15 PM', '9:45 PM', '10:15 PM', '10:45 PM', 'B', 'T111'),
('Q212', 'What is the highest mountain in the world?', 'Mount Kilimanjaro', 'Mount Everest', 'Mount Fuji', 'Mount McKinley', 'B', 'T116'),
('Q213', 'Which river is the longest in the world?', 'Amazon River', 'Yangtze River', 'Mississippi River', 'Nile River', 'D', 'T116'),
('Q214', 'What is a large, dry area of land with little rainfall called?', 'Forest', 'Desert', 'Wetland', 'Grassland', 'B', 'T116'),
('Q215', 'Which desert is the largest hot desert in the world?', 'Gobi Desert', 'Sahara Desert', 'Kalahari Desert', 'Arabian Desert', 'B', 'T116'),
('Q216', 'What do you call a landform that rises significantly above its surroundings and has a peak?', 'Valley', 'Plateau', 'Mountain', 'Hill', 'C', 'T116');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studID` varchar(10) NOT NULL,
  `studName` varchar(50) NOT NULL,
  `studPhone` varchar(12) DEFAULT NULL,
  `studEmail` varchar(30) DEFAULT NULL,
  `studSchool` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `isPremium` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studID`, `studName`, `studPhone`, `studEmail`, `studSchool`, `password`, `isPremium`) VALUES
('adil02', 'Muhammad Adil Bin Abu', '01151881916', 'adliabu@gmail.com', 'SMK Seri Paya 3', '0a7ad7a42cd7310e3d581e3d9fb82c33', 1),
('amAni', 'Aniq Anuar Bin Amrin ', '01819912827', 'aniqamrin@gmail.com', 'SMK Batu Cave (2)', 'b4318f1607e86cb3188e6aecf62838d0', 0),
('ApisA', 'Muhammad Nafis Bin Umbun', '0163891822', 'nafis02@gmail.com', 'SMK Taman Midah', 'f5a3fa1fbc0b4b09e4232b1eeedac98a', 1),
('b@nun', 'Siti Bainun Binti Faiz', '01234981019', 'bainunKetuw@gmail.com', 'SBP Kuala Selangor', 'b6c188d5ed70f956a62c3dccd174374e', 0),
('nurinA', 'Nurin Adira Binti Syahir', '01151231188', 'nuririn@gmail.com', 'MRSM Langkawi', 'f3ab17f2dc6256600224c5e4116b7eca', 0),
('qalqal', 'Qalisyah Maisarah Binti Hijaz', '01181662190', 'qalisyasya@gmail.com', 'SMK Setapak', '13fdf9482b957e93da6ab15fc14fa658', 0),
('RailFy', 'Azrail Hafiy Bin Haziq', '01918229025', 'azfiy@gmail.com', 'SMK Bandar Seri Inda', 'b7e78c940ae897926ba1266e34a3509e', 1),
('Shauq', 'Muhammad Shauqi Bin Ramadan', '01571892265', 'shauqi@gmail.com', 'SMK Sultan Idris Sha', '1b0bfdd5021c68238ea86436932ec259', 0),
('timah', 'Fatihah Binti Khamis', '01982996555', 'fatehia@gmail.com', 'MRSM Taiping', '976d48a335e002d5dfb4a23c286def91', 0),
('zaza12', 'Muhammad Zarith Adha Bin Mustapha', '0181195543', 'zarithad@gmail.com', 'SMK Presint 9', 'db1399ecc09fc04332db39bd2ac23bdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stud_answer`
--

CREATE TABLE `stud_answer` (
  `studID` varchar(10) NOT NULL,
  `quesID` varchar(10) NOT NULL,
  `dateAns` date NOT NULL,
  `studAnswer` varchar(50) DEFAULT NULL,
  `point` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stud_answer`
--

INSERT INTO `stud_answer` (`studID`, `quesID`, `dateAns`, `studAnswer`, `point`) VALUES
('adil02', 'Q100', '2024-06-09', 'A', 0),
('adil02', 'Q101', '2024-06-09', 'B', 0),
('adil02', 'Q102', '2024-06-09', 'B', 0),
('adil02', 'Q103', '2024-06-09', 'D', 0),
('adil02', 'Q104', '2024-06-09', 'C', 0),
('adil02', 'Q105', '2024-06-09', 'B', 0),
('adil02', 'Q106', '2024-06-09', 'D', 1),
('adil02', 'Q156', '2024-06-09', 'C', 1),
('adil02', 'Q157', '2024-06-09', 'B', 1),
('adil02', 'Q158', '2024-06-09', 'A', 1),
('adil02', 'Q159', '2024-06-09', 'B', 1),
('adil02', 'Q160', '2024-06-09', 'D', 1),
('adil02', 'Q161', '2024-06-09', 'A', 1),
('adil02', 'Q162', '2024-06-09', 'D', 1),
('ApisA', 'Q100', '2024-06-09', 'C', 1),
('ApisA', 'Q101', '2024-06-09', 'A', 1),
('ApisA', 'Q102', '2024-06-09', 'C', 1),
('ApisA', 'Q103', '2024-06-09', 'B', 1),
('ApisA', 'Q104', '2024-06-09', 'B', 1),
('ApisA', 'Q105', '2024-06-09', 'A', 1),
('ApisA', 'Q106', '2024-06-09', 'D', 1),
('ApisA', 'Q198', '2024-06-09', 'A', 1),
('ApisA', 'Q199', '2024-06-09', 'A', 1),
('ApisA', 'Q200', '2024-06-09', 'B', 1),
('ApisA', 'Q201', '2024-06-09', 'C', 1),
('ApisA', 'Q202', '2024-06-09', 'A', 1),
('ApisA', 'Q203', '2024-06-09', 'B', 1),
('ApisA', 'Q204', '2024-06-09', 'D', 1),
('ApisA', 'Q212', '2024-06-09', 'B', 1),
('ApisA', 'Q213', '2024-06-09', 'D', 1),
('ApisA', 'Q214', '2024-06-09', 'B', 1),
('ApisA', 'Q215', '2024-06-09', 'B', 1),
('ApisA', 'Q216', '2024-06-09', 'C', 1),
('b@nun', 'Q149', '2024-06-09', 'A', 1),
('b@nun', 'Q150', '2024-06-09', 'B', 1),
('b@nun', 'Q151', '2024-06-09', 'B', 1),
('b@nun', 'Q152', '2024-06-09', 'C', 1),
('b@nun', 'Q153', '2024-06-09', 'A', 0),
('b@nun', 'Q154', '2024-06-09', 'A', 0),
('b@nun', 'Q155', '2024-06-09', 'A', 1),
('RailFy', 'Q205', '2024-06-09', 'A', 1),
('RailFy', 'Q206', '2024-06-09', 'D', 1),
('RailFy', 'Q207', '2024-06-09', 'C', 1),
('RailFy', 'Q208', '2024-06-09', 'A', 1),
('RailFy', 'Q209', '2024-06-09', 'C', 1),
('RailFy', 'Q210', '2024-06-09', 'B', 1),
('RailFy', 'Q211', '2024-06-09', 'A', 0),
('timah', 'Q177', '2024-06-09', 'A', 1),
('timah', 'Q178', '2024-06-09', 'C', 1),
('timah', 'Q179', '2024-06-09', 'D', 1),
('timah', 'Q180', '2024-06-09', 'B', 1),
('timah', 'Q181', '2024-06-09', 'A', 0),
('timah', 'Q182', '2024-06-09', 'C', 1),
('timah', 'Q183', '2024-06-09', 'B', 0),
('zaza12', 'Q142', '2024-06-09', 'A', 1),
('zaza12', 'Q143', '2024-06-09', 'C', 1),
('zaza12', 'Q144', '2024-06-09', 'B', 1),
('zaza12', 'Q145', '2024-06-09', 'A', 0),
('zaza12', 'Q146', '2024-06-09', 'C', 0),
('zaza12', 'Q147', '2024-06-09', 'A', 1),
('zaza12', 'Q148', '2024-06-09', 'D', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subID` varchar(10) NOT NULL,
  `subName` varchar(50) NOT NULL,
  `subCreate` date NOT NULL,
  `subDesc` varchar(255) DEFAULT NULL,
  `subBan` varchar(255) DEFAULT NULL,
  `adminID` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subID`, `subName`, `subCreate`, `subDesc`, `subBan`, `adminID`) VALUES
('U100', 'Computer Science', '2024-05-21', 'Covers basic and advanced computer concepts, including hardware, software, programming and internet.', 'image/U100.jpg', 'mamal00'),
('U101', 'Science', '2024-05-22', 'Studies natural phenomena, including plants, animal sounds, and earth structures in sciences.', 'image/U101.jpg', 'capiq02'),
('U102', 'Mathematics Science', '2024-05-23', 'Explores fundamental mathematical concepts and operations, including arithmetic etc. ', 'image/U102.jpg', 'abil04'),
('U103', 'English', '2024-05-24', 'Develops language skills, including grammar, vocabulary and reading comprehension.', 'image/U103.jpg', 'ucup12'),
('U104', 'Geography', '2024-06-07', 'Explores the Earth\'s landscapes, environments, and the relationships between people and enviroment.', 'image/U104.jpg', 'mamal00');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `topID` varchar(10) NOT NULL,
  `topName` varchar(50) NOT NULL,
  `topCreate` date NOT NULL,
  `topDesc` varchar(255) DEFAULT NULL,
  `subID` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`topID`, `topName`, `topCreate`, `topDesc`, `subID`) VALUES
('T100', 'Basic Computer Components', '2024-05-19', 'This topic covers the fundamental parts of a computer system, such as the CPU, RAM, hard drive, and motherboard.', 'U100'),
('T101', 'Internet Basics', '2024-05-19', 'Explains the foundational concepts of the internet, including how it works, common terminologies and URLs, and the use of web browsers.', 'U100'),
('T102', 'Software and Applications', '2024-05-19', 'This topic explores the difference between software and hardware, types of software (like operating system)', 'U100'),
('T103', 'Programming Basics', '2024-05-19', 'It introduces the basics of programming, including concepts like algorithms, variables, data types, and control structures.', 'U100'),
('T104', 'The Human Body', '2024-05-20', 'This topic covers the various systems of the human body, such as the skeletal, muscular and body parts.', 'U101'),
('T105', 'Plants', '2024-05-20', 'Discusses the different parts of plants, their functions, and the process of photosynthesis.', 'U101'),
('T106', 'The Solar System', '2024-05-20', 'This topic explores the sun, planets, moons, asteroids, and comets that make up our solar system.', 'U101'),
('T107', 'Animals', '2024-05-20', 'Covers the classification of animals category, their habitats, behaviors, and animal sounds.', 'U101'),
('T108', 'Basic Arithmetic', '2024-05-21', 'This topic includes the four fundamental operations of addition, subtraction, multiplication, and division.', 'U102'),
('T109', 'Shapes', '2024-05-21', 'Discusses different types of shapes, their properties, and how they can be classified types of shape.', 'U102'),
('T110', 'Fractions', '2024-05-21', 'This topic explains what fractions are, how to represent them, and how to perform basic operations.', 'U102'),
('T111', 'Time', '2024-05-21', 'It covers concepts related to time, such as telling time, units of time (like seconds, minutes, hours).', 'U102'),
('T112', 'Grammar (Nouns)', '2024-05-22', 'This topic focuses on nouns, which are words used to identify people, places, things, or ideas, and actions.', 'U103'),
('T113', 'Vocabulary (Synonyms)', '2024-05-22', 'Explores synonyms, which are words that have similar meanings, and how they can be used to enhance vocabulary skills.', 'U103'),
('T114', 'Tenses', '2024-05-22', 'Covers the different tenses in English, such as past, present, and future, and how they are used to indicate when an action takes place.\n', 'U103'),
('T115', 'Adjectives', '2024-05-22', 'This topic describes adjectives, which are words used to give more information about nouns, such as their size, color, shape, feelings and etc.         ', 'U103'),
('T116', 'Landfroms', '2024-06-07', 'Explores both the physical properties of Earths surface and the human societies.', 'U104');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payID`),
  ADD KEY `studID` (`studID`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`quesID`),
  ADD KEY `topID` (`topID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studID`);

--
-- Indexes for table `stud_answer`
--
ALTER TABLE `stud_answer`
  ADD PRIMARY KEY (`studID`,`quesID`),
  ADD KEY `quesID` (`quesID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subID`),
  ADD KEY `adminID` (`adminID`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`topID`),
  ADD KEY `subID` (`subID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`studID`) REFERENCES `student` (`studID`);

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`topID`) REFERENCES `topic` (`topID`);

--
-- Constraints for table `stud_answer`
--
ALTER TABLE `stud_answer`
  ADD CONSTRAINT `stud_answer_ibfk_1` FOREIGN KEY (`studID`) REFERENCES `student` (`studID`),
  ADD CONSTRAINT `stud_answer_ibfk_2` FOREIGN KEY (`quesID`) REFERENCES `question` (`quesID`);

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`adminID`) REFERENCES `admin` (`adminID`);

--
-- Constraints for table `topic`
--
ALTER TABLE `topic`
  ADD CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`subID`) REFERENCES `subject` (`subID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
