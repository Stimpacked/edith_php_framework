-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 05 jun 2017 kl 21:37
-- Serverversion: 10.1.16-MariaDB
-- PHP-version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `mvc`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_desc`) VALUES
(1, 'MVC', 'Anything Model-View-Controller related'),
(2, 'Webdevelopment', 'How to develop the web');

-- --------------------------------------------------------

--
-- Tabellstruktur `replies`
--

CREATE TABLE `replies` (
  `reply_id` int(11) NOT NULL,
  `reply_content` varchar(255) NOT NULL,
  `reply_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reply_topic` int(11) NOT NULL,
  `reply_author` int(11) NOT NULL,
  `reply_username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `replies`
--

INSERT INTO `replies` (`reply_id`, `reply_content`, `reply_date`, `reply_topic`, `reply_author`, `reply_username`) VALUES
(1, 'This is a reply.', '2017-06-05 21:34:47', 1, 1, 'Edith'),
(2, 'Here''s another reply', '2017-06-05 21:34:59', 3, 1, 'Edith');

-- --------------------------------------------------------

--
-- Tabellstruktur `topics`
--

CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL,
  `topic_title` varchar(255) NOT NULL,
  `topic_content` varchar(255) NOT NULL,
  `topic_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic_cat` int(11) NOT NULL,
  `topic_author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_title`, `topic_content`, `topic_date`, `topic_cat`, `topic_author`) VALUES
(1, 'This is a Topic', 'This is the content.', '2017-06-03 21:23:17', 1, 1),
(3, 'Another day another topic', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eleifend dictum metus, a varius eros ornare id. Donec vitae tortor malesuada, vehicula mi nec, varius eros. Sed et velit volutpat leo porta porttitor sed et mauris. Curabitur condimentum eros', '2017-06-04 13:48:16', 1, 1),
(6, 'Yet again, another topic', 'This is the content of the topic i just made', '2017-06-04 19:31:35', 1, 2);

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','moderator','member') NOT NULL DEFAULT 'member'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'Edith', '$2y$10$V5LvOk7LWrNjOHBGS/KXt.nZU9Y3xW8IyEPvfE.G1ILWyAkgTR8iy', 'admin'),
(2, 'Stefan', '$2y$10$bc8qVLOtVmt.pPTtJgkTGu3Ni0A7r0jlxVDXx/eDrg3hm1LT1GFyq', 'moderator');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Index för tabell `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`reply_id`);

--
-- Index för tabell `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT för tabell `replies`
--
ALTER TABLE `replies`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT för tabell `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
