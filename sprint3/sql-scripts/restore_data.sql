-- Backup for Users Table
-- This script drops existing tables and re-creates them with relevant test data

-- Drop existing users table
DROP TABLE IF EXISTS users;

-- Create new users table
CREATE TABLE IF NOT EXISTS `users`(
                                      `userId` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                      `name` VARCHAR(255) DEFAULT NULL,
                                      `email` VARCHAR(255) DEFAULT NULL,
                                      `cohort` INT DEFAULT NULL,
                                      `status` VARCHAR(255) DEFAULT NULL,
                                      `roles` VARCHAR(255) DEFAULT NULL,
                                      `created_at` DATETIME DEFAULT NULL,
                                      `deleted_at` DATETIME DEFAULT NULL
) ENGINE = MariaDB DEFAULT CHARSET = latin1;

-- Insert test data into users table
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
       );

-- Backup for Applications Table
-- This script drops existing applications table and re-creates it with relevant test data

-- Drop existing applications table
DROP TABLE IF EXISTS applications;

-- Create new applications table
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
) ENGINE = MariaDB DEFAULT CHARSET = latin1;

-- Insert test data into applications table
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
           '2024-02-03 12:42:54',
           'GRC',
           1
       );
