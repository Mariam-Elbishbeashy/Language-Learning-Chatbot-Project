-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2024 at 03:54 PM

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
-- Database: `llchatbot_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `activity_id` int(11) NOT NULL,
  `activity_type` enum('quiz','challenge','reading','vocabGame') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `challenge_data`
--

CREATE TABLE `challenge_data` (
  `user_id` int(11) NOT NULL,
  `challenge_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_input` text NOT NULL,
  `ai_feedback` text NOT NULL,
  `challenge_score` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
--
-- Table structure for table `forum_comments`
--

CREATE TABLE `forum_comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forum_posts`
--

CREATE TABLE `forum_posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for table `challenge_question`
--

CREATE TABLE `challenge_question` (
  `question_id` int(11) NOT NULL,
  `challenge_category` varchar(20) NOT NULL,
  `difficulty_level` varchar(20) NOT NULL,
  `question_text` text NOT NULL,
  `language_category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
--
-- Table structure for table Chats
--
CREATE TABLE Chats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- --------------------------------------------------------

--
-- Table structure for table `ChatMessages`
--
CREATE TABLE ChatMessages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    chat_id INT NOT NULL, -- Link to the Chats table
    user_id INT NOT NULL,
    message TEXT NOT NULL,
    response TEXT NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (chat_id) REFERENCES Chats(id) ON DELETE CASCADE
);


-- --------------------------------------------------------

--
-- Table structure for table `language_analysis`
--

CREATE TABLE `language_analysis` (
  `languageAnalysis_id` int(11) NOT NULL,
  `language_name` varchar(50) NOT NULL,
  `usage_percentage` decimal(5,2) NOT NULL,
  `common_topics` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `question_id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `question_type` enum('MCQ','fill-in-the-blank','true/false') NOT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `correct_answer` varchar(255) NOT NULL,
  `difficulty_level` varchar(20) NOT NULL,
  `language_category` varchar(20) NOT NULL,
  `points` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_solved_questions`
--

CREATE TABLE `user_solved_questions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_answer` text NOT NULL,
  `solved_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `confirmPassword` varchar(128) NOT NULL,
  `firstName` text NOT NULL,
  `lastName` text NOT NULL,
  `gender` text NOT NULL,
  `role` text NOT NULL,
  `language` text NOT NULL,
  `score` text NOT NULL,
  `profileImage` text NOT NULL,
  `progress` int(11) NOT NULL,
  `postsCount` int(11) NOT NULL,
  `difficulty_level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



--
-- Table structure for table `user_progress`
--

CREATE TABLE `user_progress` (
  `user_progress_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `conversation_date` date NOT NULL,
  `conversation_score` int(11) NOT NULL,
  `vocabulary_focus_grammar` int(11) NOT NULL,
  `vocabulary_focus_pronunciation` int(11) NOT NULL,
  `vocabulary_focus_vocabulary` int(11) NOT NULL,
  `correction_grammar` int(11) NOT NULL,
  `correction_pronunciation` int(11) NOT NULL,
  `correction_vocabulary` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vocabulary`
--

CREATE TABLE `vocabulary` (
  `vocab_gane_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `game_name` int(11) NOT NULL,
  `game_description` int(11) NOT NULL,
  `vocab_list` int(11) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `challenge_data`
--
ALTER TABLE `challenge_data`
  ADD PRIMARY KEY (`challenge_id`),
  ADD KEY `fk_challenges_question_id` (`question_id`),
  ADD KEY `foreign_key_user` (`user_id`);

--
-- Indexes for table `challenge_question`
--
ALTER TABLE `challenge_question`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `forum_comments`
--
ALTER TABLE `forum_comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `forum_posts`
--
ALTER TABLE `forum_posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `challenge_data`
--
ALTER TABLE `challenge_data`
  MODIFY `challenge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `challenge_question`
--
ALTER TABLE `challenge_question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forum_comments`
--
ALTER TABLE `forum_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forum_posts`
--
ALTER TABLE `forum_posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Indexes for table `user_solved_questions`
--
ALTER TABLE `user_solved_questions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_question` (`user_id`,`question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_solved_questions`
--
ALTER TABLE `user_solved_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `challenge_data`
--
ALTER TABLE `challenge_data`
  ADD CONSTRAINT `fk_challenges_question_id` FOREIGN KEY (`question_id`) REFERENCES `challenge_question` (`question_id`),
  ADD CONSTRAINT `foreign_key_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id`);

--
-- Constraints for table `chathistory`
--
ALTER TABLE `chathistory`
  ADD CONSTRAINT `foreign_keyyy` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id`);

--
-- Constraints for table `language_analysis`
--
ALTER TABLE `language_analysis`
  ADD CONSTRAINT `foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id`);

--
-- Constraints for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD CONSTRAINT `Test_quiz` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`activity_id`);

--
-- Constraints for table `user_progress`
--
ALTER TABLE `forum_comments`
  ADD CONSTRAINT `forum_comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `forum_posts` (`post_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forum_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `forum_posts`
--
ALTER TABLE `forum_posts`
  ADD CONSTRAINT `forum_posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
