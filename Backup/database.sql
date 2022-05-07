DROP DATABASE glory;
CREATE DATABASE glory;
USE glory;

CREATE TABLE account (
        id int NOT NULL AUTO_INCREMENT,
        email varchar(100) NOT NULL,
        un varchar(12) NOT NULL,
        pw varchar(12) NOT NULL,
        PRIMARY KEY (id)
        );

CREATE TABLE chara (
        charid int NOT NULL AUTO_INCREMENT,
        accid int NOT NULL,
        job varchar(30),
        health int NOT NULL,
        mana int NOT NULL,
        atk int NOT NULL,
        matk int NOT NULL,
        def int NOT NULL,
        mdef int NOT NULL,
        potion int NOT NULL,
        revita int NOT NULL,
        remagic int NOT NULL,
        gold int NOT NULL,
        img varchar(100),
        PRIMARY KEY (charid);
        );

CREATE TABLE monster (
        monsId int NOT NULL  AUTO_INCREMENT,
        ename varchar(30) NOT NULL,
        health int NOT NULL,
        mana int NOT NULL,
        atk int NOT NULL,
        matk int NOT NULL,
        def int NOT NULL,
        mdef int NOT NULL,
        gold int NOT NULL,
        img varchar(100) NOT NULL,
        width int NOT NULL,
        height int NOT NULL,
        PRIMARY KEY (MonsId)
        );

CREATE TABLE shop (
        itemId int NOT NULL  AUTO_INCREMENT,
        iname varchar(30) NOT NULL,
        price int NOT NULL,
        PRIMARY KEY (itemId)
        );

CREATE TABLE current (
        currentId int NOT NULL ,
        ename varchar(30) NOT NULL,
        health int NOT NULL,
        mana int NOT NULL,
        atk int NOT NULL,
        matk int NOT NULL,
        def int NOT NULL,
        mdef int NOT NULL,
        gold int NOT NULL,
        width int NOT NULL,
        height int NOT NULL,
        img varchar(100) NOT NULL
          );
