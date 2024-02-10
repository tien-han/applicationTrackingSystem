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
-- Database: `pizza`
--
-- Drop existing tables
DROP TABLE IF EXISTS Orders;
DROP TABLE IF EXISTS Customers;
DROP TABLE IF EXISTS Promos;
DROP TABLE IF EXISTS Prices;
-- --------------------------------------------------------
--
-- Table structure for table `Customers`
--
CREATE TABLE IF NOT EXISTS `Customers`(
    `customerID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) DEFAULT NULL,
    `streetAddress` VARCHAR(255) DEFAULT NULL,
    `city` VARCHAR(255) DEFAULT NULL,
    `state` VARCHAR(10) DEFAULT NULL,
    `phone` VARCHAR(10) DEFAULT NULL,
    `email` VARCHAR(255) DEFAULT NULL,
    `instructions` VARCHAR(255) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;
--
-- Dumping data for table `Customers`
--
INSERT INTO `Customers`(
    `customerId`,
    `name`,
    `streetAddress`,
    `city`,
    `state`,
    `phone`,
    `email`,
    `instructions`
)
VALUES(
    1,
    'Annie Appletree',
    '1 Apple St',
    'Apple City',
    'Washington',
    '1234567890',
    'annie@apple.com',
    'I do not actually want toppings'
),(
    2,
    'Bonnie Branch',
    '1 Branch St',
    'Branch City',
    'Washington',
    '0987654321',
    'bonnie@branch.com',
    ''
);
-- --------------------------------------------------------
--
-- Table structure for table `Prices`
--
CREATE TABLE Prices (
    priceID INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(255),
    description VARCHAR(255),
    price DECIMAL(4, 2) 
);
--
-- Dumping data for table `Prices`
--
INSERT INTO Prices (category, description, price) VALUES ('PizzaSize', 'Large', 50.00);
INSERT INTO Prices (category, description, price) VALUES ('PizzaSize', 'Medium', 30.00);
INSERT INTO Prices (category, description, price) VALUES ('PizzaSize', 'small', 15.00);
INSERT INTO Prices (category, description, price) VALUES ('Delivery', 'Standard Delivery', 5.00);
-- --------------------------------------------------------
--
-- Table structure for table `Promos`
--
CREATE TABLE Promos (
    promoID int AUTO_INCREMENT PRIMARY KEY,
    date DATETIME,
    code varchar(255),
    active BOOLEAN,
    discount DECIMAL(4,2)
);
--
-- Dumping data for table `Promos`
--
INSERT INTO Promos(promoID, date, code, active, discount)
Values(1, '2024-1-25 16:32:27', 'Cicada', TRUE, 5.50), (2, '2024-1-25 16:32:27', 'Flea', FALSE, 6.73);
-- --------------------------------------------------------
--
-- Table structure for table `Orders`
--
CREATE TABLE IF NOT EXISTS Orders (
    orderID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    customerID int NOT NULL,
    promoID int,
    priceID int NOT NULL,
    topping1 VARCHAR(255),
    topping2 VARCHAR(255),
    topping3 VARCHAR(255),
    order_placed DATETIME,
    delivery BOOLEAN,
    FOREIGN KEY (customerID) REFERENCES Customers(customerID),
    FOREIGN KEY (promoID) REFERENCES Promos(promoID),
    FOREIGN KEY (priceID) REFERENCES Prices(priceID)
    );
--
-- Dumping data for table `Orders`
--
INSERT INTO Orders (delivery, customerID, promoID, priceID, order_placed, topping1, topping2, topping3) 
VALUES (FALSE, 1, 1, 3, '2024-1-25 16:32:27', 'pepperoni', 'pineapple', 'ham');

INSERT INTO Orders (delivery, customerID, promoID, priceID, order_placed, topping1, topping2, topping3) 
VALUES (TRUE, 2, 2, 1, '2024-2-3 12:42:54', 'beef', 'peppers', 'bacon');
-- --------------------------------------------------------