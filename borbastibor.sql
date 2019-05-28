-- 1. borbastibor nevű adatbázis séma törlése ha létezik
DROP DATABASE IF EXISTS borbastibor;

-- 2. borbastibor nevű adatbázis séma létrehozása ha nem létezik
CREATE DATABASE IF NOT EXISTS borbastibor
	CHARACTER SET utf8
    COLLATE utf8_hungarian_ci;
    
-- 3. a borbastibor adatbázis alapértelmezett használata
USE borbastibor;

-- 4. a users tábla törlése ha létezik
DROP TABLE IF EXISTS users;

-- 5. a user tábla létrehozása ha nem létezik
CREATE TABLE IF NOT EXISTS users (
    userid INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    userfirstname VARCHAR(25) NOT NULL,
    userfamilyname VARCHAR(25) NOT NULL,
    useremail VARCHAR(50) NOT NULL,
    userpassword VARCHAR(30) NOT NULL
) ENGINE = INNODB;

-- 6. a message tábla törlése ha létezik
DROP TABLE IF EXISTS messages;

-- 7. a message tábla létrehozása ha nem létezik
CREATE TABLE IF NOT EXISTS messages (
    msgid INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    msgsendername VARCHAR(50) NOT NULL,
    msgsenderemail VARCHAR(50) NOT NULL,
    msgtext TEXT NOT NULL
) ENGINE = INNODB;

-- 8. a users tábla néhány adattal történő feltöltése
INSERT INTO users(username,userfirstname,userfamilyname,useremail,userpassword)
    VALUES('kecske','Elek','Mekk','mekk.elek@gmail.com','123456aA'),('róka','Vuk','Kis','kis.vuk@outlook.hu','123456aA'),
    ('döbrögi','Matyi','Ludas','ludas.matyi@freemail.com','123456aA'),('aladár','Géza','Mézga','mezga.geza@gmail.com','123456aA');

-- 9. a messages tábla néhány adattal történő feltöltése
INSERT INTO messages(msgsendername,msgsenderemail,msgtext)
    VALUES('Balu kapitány','balu.kapitany@gmail.com','Ez egy tesztüzenet!'),('Misi Mókus','misi.mokus@gmail.com','Ez a második tesztüzenet!'),('Tapsi Hapsi','tapsi.hapsi@gmail.com','Ez már a harmadik tesztüzenet!'),('Tuskó Hopkins','tusko.hopkins@gmail.com','Ez a negyedik és egyben az utolsó előre legyártott tesztüzenet!');