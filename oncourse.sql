-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 18, 2021 at 07:30 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oncourse`
--
CREATE DATABASE IF NOT EXISTS `oncourse` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `oncourse`;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--
-- Creation: Dec 08, 2020 at 01:15 AM
--

CREATE TABLE `courses` (
  `code` varchar(8) NOT NULL COMMENT 'Format: ABC 1234',
  `field` varchar(3) NOT NULL,
  `num` int(4) NOT NULL,
  `name` varchar(200) NOT NULL,
  `hours` int(11) NOT NULL,
  `instructor` varchar(200) NOT NULL,
  `geneds` varchar(200) NOT NULL,
  `description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`code`, `field`, `num`, `name`, `hours`, `instructor`, `geneds`, `description`) VALUES
('CHE 1005', 'CHE', 1005, 'Chemistry of Food and Cooking', 4, 'Bromfield Lee', 'NW', 'Exploration of the science of food from a basic chemical perspective. Through the course, students will examine the components of food, including spices and other additives, and the preparation of food. The course specifically addresses the physical and chemical changes associated with food preparation at a basic level, in addition to food storage or preservation and trends in food industry as it pertains to chemistry. This course uses some hands-on activities which will require in-lab activities and demonstrations.'),
('CSC 2100', 'CSC', 2100, 'Discrete Structures', 4, 'Eicholtz', 'Qn', 'Same as MAT 2100. An introduction to discrete mathematics. Topics include logic, set theory, basic proofs, mathematical induction and recursion, counting principles and probability.'),
('CSC 3350', 'CSC', 3350, 'Computer Game Design', 4, 'Roberson', 'EC-B', 'Storyboarding, technology, science, and graphics involved in the creation of computer games. Emphasis on hands-on design and development of games. Design and analysis of algorithms and data structures, including asymptotic analysis, sorting, selection, graph algorithms, recurrence relations, divide-and-conquer algorithms, greedy algorithms, search trees, NP-completeness.'),
('CSC 3610', 'CSC', 3610, 'Introduction to Web Development', 4, 'Roberson', 'N/A', 'Study the basic principles of web development beginning with an introduction to modern markup and styling languages. Learn how to create static pages and how to implement designs consistent with web standards and best practices. Explore the tools used to provide feedback on the quality of a page’s HTML and CSS to ensure accessibility and accuracy. Finally, learn introductory server-side scripting for developing dynamic web content.'),
('CSC 3620', 'CSC', 3620, 'Web Application Architectures', 4, 'Roberson', 'N/A', 'Building on technologies introduced in CSC 3610, this course goes into greater detail and focuses on building large-scale web applications. Learn to leverage frameworks to build sites that work across browsers and platforms as well as fundamental JavaScript concepts and how to use PHP test-driven development, regular expressions, and security techniques as best practices for engineering high performance web solutions.'),
('CSC 4610', 'CSC', 4610, 'Advanced Topics in Web Development', 4, 'Roberson', 'N/A', 'In-depth examination of a current topic in web development and cloud computing, such as web security, user experience, mobile app development, and web engineering.'),
('CSC 4899', 'CSC', 4899, 'Senior Project', 4, 'Roberson', 'EC-C', 'In this capstone design experience, students work independently to identify a significant computing problem, analyze it, design a solution, and implement it. Coursework culminates in a formal, public presentation/demonstration of the student’s original work. The class will meet weekly to discuss topics related to investigation, research and development, effective presentations, and job search and interview skills. Students will give regular progress reports to the class.'),
('ENG 1005', 'ENG', 1005, 'Writing About Topics', 4, 'Bravard', 'EC-A', 'Instruction and practice in writing short personal, informative, and persuasive essays about a selected topic that is the focus for the semester. The selected topic engages students intellectually and imaginatively while developing their skills as they consider various aspects of the course topic. Formal research is part of the course. Specific topic at the discretion of the instructor. Course number can be taken more than once under different topics.'),
('PED 1005', 'PED', 1005, 'Wellness Management', 2, 'Tremble', 'Well', 'Wellness concepts and activities designed to provide students with lifetime skills for optimal health. Requires participation in organized Wellness Center activities.'),
('PHI 3359', 'PHI', 3359, 'Aesthetics', 4, 'Nethery', 'MV, SW, FA, Ql', 'A survey of the major theories in aesthetics from the history of philosophy as well as contemporary issues in the field. This course also relates aesthetic theory to specific art forms (e.g., painting, literature, theatre, music, film.) Among the topics addressed are the relationships among art, beauty, and reality, the roles of feeling, emotion, and cognition in artistic experience and creation, the connections between art and interpretation, and the mutual relevance of art and philosophy.'),
('PSY 1106', 'PSY', 1106, 'Psychology and the Social World', 4, 'Wilkinson', 'SW', 'Survey of major areas in psychology with emphasis on current foundational areas of the field, including but not limited to the following: theoretical/methodological, developmental, cognitive, social and cultural, and clinical foundations of behavior.'),
('REL 1108', 'REL', 1108, 'What is Religion?', 4, 'Ewing', 'MV, Ql', 'An introduction to religion through an inquiry of ultimate questions, the sacred and the divine, and religious belief and practice. Students critically examine sacred texts, religious experience, theology, ritual, and ethics within religious traditions.'),
('WST 2200', 'WST', 2200, 'Introduction to Women and Gender Studies', 4, 'Nethery, Kjellmark, Moffitt', 'SW, Ql', 'Taught by a team of professors from different disciplines, this class presents a variety of perspectives about the roles of women in such diverse fields as art, biology, business, criminology, economics, history, law, literature, music, philosophy, political science, psychology, religion, and sociology. In the liberal arts tradition, students develop awareness about issues in women and gender studies and engage in analysis of these issues from various scholarly perspectives. Collections of readings in each discipline, which represent past and present contexts, form the basis for discussion and critical thinking.');

-- --------------------------------------------------------

--
-- Table structure for table `fields_study`
--
-- Creation: Dec 04, 2020 at 02:40 AM
--

CREATE TABLE `fields_study` (
  `abbr` varchar(3) NOT NULL,
  `field` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fields_study`
--

INSERT INTO `fields_study` (`abbr`, `field`) VALUES
('ACC', 'Accounting'),
('ARA', 'Arabic'),
('ARH', 'Art History'),
('ART', 'Art'),
('AST', 'Astronomy'),
('BIO', 'Biology'),
('BUS', 'Business Administration'),
('CHE', 'Chemistry'),
('CHN', 'Chinese'),
('CIT', 'Citrus'),
('COM', 'Communication'),
('CRM', 'Criminology'),
('CSC', 'Computer Science'),
('DAN', 'Dance'),
('ECO', 'Economics'),
('EDU', 'Education'),
('ENG', 'English'),
('ENT', 'Entrepreneurship'),
('EXS', 'Exercise Science'),
('FRE', 'French'),
('FSC', 'FSC General College Courses'),
('GEO', 'Geography'),
('GER', 'German'),
('GRE', 'Greek'),
('HCA', 'Healthcare Administration'),
('HIS', 'History'),
('HON', 'Honors Program'),
('HRT', 'Horticulture'),
('HUM', 'Humanities'),
('JPN', 'Japanese'),
('LAS', 'Latin American Studies'),
('LIB', 'Library'),
('MAT', 'Mathematics'),
('MKT', 'Marketing'),
('MLS', 'Medical Laboratory Science'),
('MSL', 'Military Science and Leadership'),
('MUS', 'Music'),
('NUR', 'Nursing'),
('PED', 'Physical Education'),
('PHI', 'Philosophy'),
('PHP', 'Pre-Health Professions'),
('PHY', 'Physics'),
('POR', 'Portuguese'),
('POS', 'Political Science'),
('PSY', 'Psychology'),
('REL', 'Religion'),
('RUS', 'Russian'),
('RYM', 'Religion: Youth Ministry'),
('SOC', 'Sociology'),
('SPA', 'Spanish'),
('SPM', 'Sport Business Management'),
('THE', 'Theatre Arts'),
('WST', 'Women and Gender Studies');

-- --------------------------------------------------------

--
-- Table structure for table `geneds`
--
-- Creation: Dec 08, 2020 at 03:24 AM
--

CREATE TABLE `geneds` (
  `abbr` varchar(4) NOT NULL,
  `name` varchar(200) NOT NULL,
  `hours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `geneds`
--

INSERT INTO `geneds` (`abbr`, `name`, `hours`) VALUES
('EC-A', 'Effective Communication A', 4),
('EC-B', 'Effective Communication B', 4),
('EC-C', 'Effective Communication C', 4),
('FA', 'Fine Arts Appreciation', 4),
('MV', 'Meaning and Value', 8),
('N/A', 'None', 0),
('NW', 'The Natural World', 8),
('Ql', 'Qualitative', 4),
('Qn', 'Quantitative', 4),
('SW', 'The Social World', 8),
('Well', 'Personal Wellness', 2);

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--
-- Creation: Oct 29, 2020 at 06:15 PM
--

CREATE TABLE `majors` (
  `major` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`major`) VALUES
('Accounting'),
('Applied Mathematics and Statistics: Actuarial Foundations'),
('Applied Mathematics and Statistics: Business and Finance'),
('Applied Mathematics and Statistics: Data Analytics'),
('Applied Mathematics and Statistics: Science and Engineering'),
('Art Education'),
('Art History and Museum Studies'),
('Biochemistry and Molecular Biology'),
('Biology'),
('Biotechnology'),
('Business Administration'),
('Chemistry'),
('Chemistry: Environmental Chemistry'),
('Chemistry: Forensic Chemistry'),
('Citrus and Horticultural Science: Biotechnology'),
('Citrus and Horticultural Science: Business'),
('Citrus and Horticultural Science: Citrus'),
('Citrus and Horticultural Science: Pre-Graduate Studies'),
('Communications'),
('Communications: Advertising and Public Relations'),
('Communications: Digital Media'),
('Communications: Interpersonal and Organizational Communication'),
('Communications: Multimedia Journalism'),
('Computer Science'),
('Computer Science: Artificial Intelligence and Machine Learning'),
('Computer Science: Cybersecurity'),
('Computer Science: Web and Cloud Computing'),
('Criminology'),
('Dance Performance and Choreography'),
('Dance Studies'),
('Economics and Finance'),
('Education: Secondary Biology'),
('Education: Secondary English'),
('Education: Secondary Mathematics'),
('Education: Secondary Social Science/History'),
('Elementary Education'),
('English: Literature'),
('English: Writing'),
('Environmental Studies'),
('Exercise Science'),
('Film'),
('Graphic Design'),
('History'),
('Humanities'),
('Integrative Biology'),
('Interactive and Game Design: Art and Cinema'),
('Interactive and Game Design: Programming'),
('Marine Biology'),
('Marketing'),
('Mathematics'),
('Medical Laboratory Sciences'),
('Music'),
('Music Education'),
('Music Management'),
('Music Performance: Instrumental'),
('Music Performance: Vocal'),
('Nursing'),
('Philosophy'),
('Political Communication: Media'),
('Political Communication: Organizational Communication'),
('Political Communication: Public Affairs'),
('Political Science'),
('Psychology'),
('Religion'),
('Religion: Youth Ministry'),
('Self-Designed Major'),
('Social Sciences'),
('Spanish'),
('Sport Business Management'),
('Sports Communication and Marketing'),
('Studio Art'),
('Theatre Arts'),
('Theatre Arts: Musical Theatre'),
('Theatre Arts: Technical Theatre/Design'),
('Theatre Arts: Theatre Performance');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--
-- Creation: Nov 05, 2020 at 03:19 PM
--

CREATE TABLE `semesters` (
  `semester` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`semester`) VALUES
('Fall 2018'),
('Fall 2019'),
('Fall 2020'),
('Spring 2019'),
('Spring 2020'),
('Spring 2021');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Dec 08, 2020 at 04:42 AM
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `major` varchar(200) NOT NULL,
  `credits` int(11) NOT NULL DEFAULT '0',
  `gened_credits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_courses`
--
-- Creation: Dec 10, 2020 at 02:16 AM
--

CREATE TABLE `user_courses` (
  `coursecode` varchar(8) NOT NULL COMMENT 'Format: ABC 1234',
  `userid` int(11) NOT NULL,
  `current` tinyint(1) NOT NULL,
  `taken` tinyint(1) NOT NULL,
  `semester` varchar(200) NOT NULL DEFAULT 'Fall 2020',
  `gened` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_courses`
--

INSERT INTO `user_courses` (`coursecode`, `userid`, `current`, `taken`, `semester`, `gened`) VALUES
('CHE 1005', 1, 1, 1, 'Fall 2020', 'NW'),
('CHE 1005', 3, 1, 1, 'Fall 2020', 'NW'),
('CSC 2100', 1, 0, 1, 'Spring 2019', 'Qn'),
('CSC 3350', 1, 1, 1, 'Fall 2020', 'EC-B'),
('CSC 3350', 3, 1, 1, 'Fall 2020', 'EC-B'),
('CSC 3610', 1, 0, 1, 'Fall 2019', 'N/A'),
('CSC 3620', 1, 0, 1, 'Spring 2020', 'N/A'),
('CSC 4610', 1, 1, 1, 'Fall 2020', 'N/A'),
('PED 1005', 1, 0, 1, 'Fall 2019', 'Well'),
('PHI 3359', 1, 0, 1, 'Spring 2019', 'FA'),
('PSY 1106', 1, 0, 1, 'Fall 2018', 'SW'),
('REL 1108', 1, 0, 1, 'Spring 2020', 'MV'),
('WST 2200', 1, 0, 1, 'Fall 2018', 'SW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`code`),
  ADD KEY `field` (`field`);

--
-- Indexes for table `fields_study`
--
ALTER TABLE `fields_study`
  ADD PRIMARY KEY (`abbr`);

--
-- Indexes for table `geneds`
--
ALTER TABLE `geneds`
  ADD PRIMARY KEY (`abbr`),
  ADD KEY `abbr` (`abbr`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`major`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`semester`),
  ADD KEY `semester` (`semester`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `major` (`major`);

--
-- Indexes for table `user_courses`
--
ALTER TABLE `user_courses`
  ADD PRIMARY KEY (`coursecode`,`userid`),
  ADD KEY `semester` (`semester`),
  ADD KEY `semester_2` (`semester`),
  ADD KEY `coursecode` (`coursecode`),
  ADD KEY `userid` (`userid`),
  ADD KEY `gened` (`gened`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `field` FOREIGN KEY (`field`) REFERENCES `fields_study` (`abbr`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `major_fkey` FOREIGN KEY (`major`) REFERENCES `majors` (`major`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `user_courses`
--
ALTER TABLE `user_courses`
  ADD CONSTRAINT `code_fkey` FOREIGN KEY (`coursecode`) REFERENCES `courses` (`code`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gened_fkey` FOREIGN KEY (`gened`) REFERENCES `geneds` (`abbr`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `id_fkey` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sem_fkey` FOREIGN KEY (`semester`) REFERENCES `semesters` (`semester`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
