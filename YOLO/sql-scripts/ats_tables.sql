-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 28, 2014 at 11:13 AM
-- Server version: 5.1.73
-- PHP Version: 5.3.2-1ubuntu4.27
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `ats`
--
-- Drop existing tables
DROP TABLE IF EXISTS applications;
DROP TABLE IF EXISTS user_roles;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS roles;

-- --------------------------------------------------------
--
-- Table structure for table `roles`
--
CREATE TABLE IF NOT EXISTS `roles`(
    `roleId` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `role_name` VARCHAR(255) NOT NULL UNIQUE,
    `role_description` VARCHAR(255) DEFAULT NULL,
    `created_at` DATETIME DEFAULT NULL,
    `deleted_at` DATETIME DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `roles`
--
INSERT INTO `roles`(
    `role_name`,
    `role_description`,
    `created_at`
)
VALUES (
    'Admin',
    'Has the ability to add applications and edit/delete users and applications.',
    '2024-2-26 12:00:00'
), (
    'User',
    'Has the ability to add applications and edit/delete their added applications.',
    '2024-2-26 12:00:00'
);

-- --------------------------------------------------------
--
-- Table structure for table `users`
--
CREATE TABLE IF NOT EXISTS `users`(
    `userId` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) DEFAULT NULL,
    `email` VARCHAR(255) DEFAULT NULL,
    `cohort` INT DEFAULT NULL,
    `status` VARCHAR(255) DEFAULT NULL,
    `roles` VARCHAR(255) DEFAULT NULL,
    `created_at` DATETIME DEFAULT NULL,
    `user_deleted` BOOLEAN DEFAULT FALSE,
    `user_deleted_at` DATETIME DEFAULT NULL,
    `user_hard_delete` BOOLEAN DEFAULT FALSE, 
    `admin_deleted` BOOLEAN DEFAULT FALSE,
    `admin_deleted_at` DATETIME DEFAULT NULL,
    `admin_hard_delete` BOOLEAN DEFAULT FALSE,
    `deleted_at` DATETIME DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `users` (students)
--
INSERT INTO `users`(
    `name`,
    `email`,
    `cohort`,
    `status`,
    `roles`
)
VALUES (
    'Annie Appletree',
    'annie@apple.com',
    10,
    'Seeking Internship',
    'Full time'
), (
    'Miedrail Pelilde',
    'm.pelilde@student.greenriver.edu',
    11,
    'Seeking Job',
    'Full time'
), (
    'Am Raingloom',
    'rgloom@student.greenriver.edu',
    11,
    'Not Actively Searching',
    'Full time'
), (
    'Ufuh Rolod',
    'ufuhrolod@student.greenriver.edu',
    11,
    'Seeking Internship',
    'Full time'
), (
    'Nia Uy',
    'nia@student.greenriver.edu',
    11,
    'Not Actively Searching',
    'Full time'
), (
    'Mildred',
    'milly@student.greenriver.edu',
    11,
    'Seeking Job',
    'Full time'
), (
    'Anna',
    'anna@student.greenriver.edu',
    11,
    'Seeking Internship',
    'Full time'
), (
    'Keith',
    'kelly@student.greenriver.edu',
    11,
    'Not Actively Searching',
    'Full time'
), (
    'Melyvr',
    'melly@student.greenriver.edu',
    11,
    'Seeking Job',
    'Full time'
), (
    'Zach the Crab',
    'crabby@student.greenriver.edu',
    11,
    'Seeking Job',
    'Full time'
);

--
-- Dumping data for table `users` (will be admin)
--
INSERT INTO `users`(
    `name`,
    `email`
)
VALUES (
    'Prof. Layton',
    'layton.mobile@teachersRUs.com'
);

-- --------------------------------------------------------
--
-- Table structure for table `user_roles`
--
CREATE TABLE IF NOT EXISTS `user_roles`(
    `userRoleId` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `userId` INT NOT NULL REFERENCES users(userId),
    `roleId` INT NOT NULL REFERENCES roles(roleId),
    `created_at` DATETIME DEFAULT NULL,
    `deleted_at` DATETIME DEFAULT NULL,
    UNIQUE(userId, roleId)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `user_roles`
--
INSERT INTO `user_roles`(
    `userId`,
    `roleId`,
    `created_at`
)
VALUES (
    1,
    1,
    '2024-2-26 12:00:00'
), (
    2,
    2,
    '2024-2-26 12:00:00'
), (
    3,
    2,
    '2024-2-26 12:00:00'
), (
    4,
    2,
    '2024-2-26 12:00:00'
), (
    5,
    1,
    '2024-2-26 12:00:00'
), (
    5,
    2,
    '2024-2-26 12:00:00'
), (
    6,
    2,
    '2024-2-26 12:00:00'
), (
    7,
    2,
    '2024-2-26 12:00:00'
), (
    8,
    2,
    '2024-2-26 12:00:00'
), (
    9,
    2,
    '2024-2-26 12:00:00'
), (
    10,
    2,
    '2024-2-26 12:00:00'
), (
    11,
    1,
    '2024-2-26 12:00:00'
);

-- --------------------------------------------------------
--
-- Table structure for table `applications`
--
CREATE TABLE IF NOT EXISTS `applications`(
    `applicationsId` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `userId` INT NOT NULL,
    `role_name` VARCHAR(255) DEFAULT NULL,
    `job_description` VARCHAR(255) DEFAULT NULL,
    `application_date` DATETIME DEFAULT NULL,
    `follow_up_date` DATETIME DEFAULT NULL,
    `contact_name` VARCHAR(255) DEFAULT NULL,
    `contact_email` VARCHAR(255) DEFAULT NULL,
    `contact_phone` VARCHAR(255) DEFAULT NULL,
    `employer_name` VARCHAR(255) DEFAULT NULL,
    `status` VARCHAR(255) DEFAULT NULL,
    `notes` VARCHAR(255) DEFAULT NULL,
    `created_at` DATETIME DEFAULT NULL,
    `user_deleted` BOOLEAN DEFAULT FALSE,
    `user_deleted_at` DATETIME DEFAULT NULL,
    `user_hard_delete` BOOLEAN DEFAULT FALSE, 
    `admin_deleted` BOOLEAN DEFAULT FALSE,
    `admin_deleted_at` DATETIME DEFAULT NULL,
    `admin_hard_delete` BOOLEAN DEFAULT FALSE,
    `deleted_at` DATETIME DEFAULT NULL,
    FOREIGN KEY (userId) REFERENCES users(userId)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `applications`
--
INSERT INTO `applications`(
    `role_name`,
    `job_description`,
    `application_date`,
    `employer_name`,
    `userId`
)
VALUES (
    'SWE I',
    'Software stuff',
    '2024-2-3 12:42:54',
    'GRC',
    1
);