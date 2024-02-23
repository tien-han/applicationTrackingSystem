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
DROP TABLE IF EXISTS users;
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
    `user_deleted` BOOLEAN DEFAULT FALSE,
    `user_deleted_at` DATETIME DEFAULT NULL,
    `user_hard_delete` BOOLEAN DEFAULT FALSE, 
    `admin_deleted` BOOLEAN DEFAULT FALSE,
    `admin_deleted_at` DATETIME DEFAULT NULL,
    `admin_hard_delete` BOOLEAN DEFAULT FALSE,
    `created_at` DATETIME DEFAULT NULL,
    `deleted_at` DATETIME DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `users`
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
    'Looking',
    'Full time'
), (
    'Miedrail Pelilde',
    'm.pelilde@student.greenriver.edu',
    11,
    'Looking',
    'Full time'
), (
    'Am Raingloom',
    'rgloom@student.greenriver.edu',
    11,
    'Looking',
    'Full time'
), (
    'Ufuh Rolod',
    'ufuhrolod@student.greenriver.edu',
    11,
    'Looking',
    'Full time'
), (
    'Nia Uy',
    'nia@student.greenriver.edu',
    11,
    'Looking',
    'Full time' 
), (
    'Mildred',
    'milly@student.greenriver.edu',
    11,
    'Looking',
    'Full time' 
), (
    'Anna',
    'anna@student.greenriver.edu',
    11,
    'Looking',
    'Full time' 
), (
    'Keith',
    'kelly@student.greenriver.edu',
    11,
    'Looking',
    'Full time' 
), (
    'Melyvr',
    'melly@student.greenriver.edu',
    11,
    'Looking',
    'Full time' 
), (
    'Jona',
    'jojo@student.greenriver.edu',
    11,
    'Looking',
    'Full time' 
), (
    'Zach the Crab',
    'crabby@student.greenriver.edu',
    11,
    'Looking',
    'Full time' 
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