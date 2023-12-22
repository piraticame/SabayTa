-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2023 at 01:07 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sabaytadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `joined`
--

CREATE TABLE `joined` (
  `id` int(6) UNSIGNED NOT NULL,
  `user_id` int(6) UNSIGNED NOT NULL,
  `post_id` int(6) UNSIGNED NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `joined`
--

INSERT INTO `joined` (`id`, `user_id`, `post_id`, `createdAt`) VALUES
(1, 1, 1, '2023-12-21 19:53:53');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(6) UNSIGNED NOT NULL,
  `user_id` int(6) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `meetingTime` time NOT NULL,
  `fromLocation` varchar(255) DEFAULT NULL,
  `toLocation` varchar(255) DEFAULT NULL,
  `joinedcount` int(6) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user_id`, `name`, `meetingTime`, `fromLocation`, `toLocation`, `joinedcount`, `status`, `createdAt`) VALUES
(1, 1, 'Mohammad Jimenez', '03:54:00', 'Duis quis dolore ab ', 'Nostrud in ut doloru', 1, 'Deleted', '2023-12-21 23:47:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `middlename`, `lastname`, `gender`, `phone`, `birthdate`, `profile`, `reg_date`) VALUES
(1, 'a', '9ba9635515c07f2e34d72527df64c670367eee726737204e9f1e9b52e7fd469ae04f41', '5e2cd3950af93db5d8611e6203d9dd96729e5fc8cc27540b91925f02def03409cbfbffbe526ca9ee91c984', 'b1a8d0490013cfe8f316ab025b57d9d1c078191ca5bdc6448cabfab3a3fc3fb3ddebf56c0086362d725d01c1314eff6a', '48d42f2b8e257c502619a17e8b71d6ff93a9ebaa221d3d4e4d4d6e3474dade62f62c403cd4a202', 'e31e8ba278e95789233fdb3010a9fbd9d872e8beadbd179ddb7703376846255d3b89fe41bb8c', '35832d78d977a147179056de45f4ce1bb7ee12117da19ad3e2d03ed64d0e891ea98214b3f3c284d4ce1f00918fc08b88b4d624', NULL, 'bf5f723b4cc3385e531b52435909b56155016a3eaf7241fa5f1215e39b693feaf03976f91e31292c767ea05e9f3f0ff1f06a0c740b9fd15c977b1e24d54e565efc6158aea8846c1e428a0e78dae85be22aaaf1e41a6666e01430', '2023-12-21 19:53:35'),
(2, 'aw', '1628fbfb2447e8e556c68f1fabf06f21a9cb14035ab162f2099c4c06661cd2990330cdf9', '96bf139145ae8d69013893acb9161d83bce52cf8f06ed671be52014452f6da6d91e1becd63b4885f', '503ad98d73e0a92d1061738b4ef907bcbe1f99538d9fe08bb173ef85a7f2510bd418831472928e135c068f3861ae0d3c0370', '64f1370f875be0a457cef4ffad594e671f8ca11b6c7d088351bf78116af10e8dda4662a81388e66b2e02', '5becf89a4b95cfac8118b19bdcd35fb9197b4f284d006c6d258d3de49b6725830ad3e149154d', '140a30d2ce7f102db9d62f67a34fa44c38256cbf9fdf0acf19d7ef892462b5967f2275e2912c2b9d433cf4411980d2b61eb151', NULL, '7db9cc646af3e2eaa06c0f199421ea3f9b9eded7b3d10ea208d86cedb376f80710002600f0a719032b9e5195a952345cf96c118c5a03f2deca2d9b11e36c5b6b3043ad565d2c19e5af5c046e2824444d30a9011fa860dc5c7e5c6a20fc2842f4a57e', '2023-12-21 23:53:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `joined`
--
ALTER TABLE `joined`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `joined`
--
ALTER TABLE `joined`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `joined`
--
ALTER TABLE `joined`
  ADD CONSTRAINT `joined_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `joined_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`);

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `update_post_status_event` ON SCHEDULE EVERY 1 MINUTE STARTS '2023-12-22 03:53:23' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
            UPDATE post SET status = 'Done' WHERE meetingTime < CURTIME() AND status <> 'Done' AND status <> 'Deleted';
        END$$

CREATE DEFINER=`root`@`localhost` EVENT `update_post_status_deleted_event` ON SCHEDULE EVERY 1 MINUTE STARTS '2023-12-22 03:53:23' ON COMPLETION NOT PRESERVE ENABLE DO BEGIN
                UPDATE post SET status = 'Deleted' 
                WHERE TIMESTAMPDIFF(HOUR, CONCAT(CURDATE(), ' ', meetingTime), NOW()) >= 2 
                AND status NOT IN ('Deleted', 'Done');
            END$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
