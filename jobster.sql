CREATE TABLE `Student` (
  `sid` VARCHAR(10) NOT NULL,
  `sname` VARCHAR(20) NOT NULL,
  `spassword` VARCHAR(45) NOT NULL,
  `gpa` VARCHAR(10) NULL,
  `university` VARCHAR(25) NULL,
  `major` VARCHAR(25) NULL,
  `phone` VARCHAR(15) NULL,
  `email` VARCHAR(45) NULL,
  `interests` VARCHAR(1000) NULL,
 `qualification` VARCHAR(1000) NULL,
  `resume` VARCHAR(1000) NULL,
  `security` ENUM('allow', 'not allow')  NULL,
  PRIMARY KEY (`sid`));


  INSERT INTO `Student` VALUES ('mz1893', 'Mengyuan Zhu', 'mengyuan123', '3.8', 'New York University', 'Computer Engineer', '3658457548', 'mz1893@nyu.edu', 'java, machine learning', 'intern at amazon', 'Deep learning 04/2017 – 06/2017
 Evaluated the performance of two regularization ways dropout and adding uncertainty factor.
 Constructed different scales of CNNs used torch to train MINST datasets to evaluate these two regularizations.
 Trained and tested different scales of CNNs form 2000 weights to 10000000 weights with different factors used SDG
in about 2 weeks running with GPU 1080-ti.
 Proved that dropout with p=0.5 improved the correctness by about 0.1% which has the best performance. and database systems','not allow');
  INSERT INTO `Student` VALUES ('sm7065', 'Shaowei Man', 'shaowei123', '3.8', 'Stanford', 'Computer Science', '2565458865', 'sm7065@nyu.edu', 'C++, machine learning', 'intern at Google', 'Database Systems reserch','allow');
  INSERT INTO `Student` VALUES ('yc1234', 'Yancheng Chen', 'yancheng123', '3.4', 'New York University', 'Electronic Engineer', '3658456547', 'yc1234@nyu.edu', 'python OS', 'intern at amazon', 'Database Systems relative','allow');
  INSERT INTO `Student` VALUES ('aw2675', 'Asan Wu', 'asan123', '3.3', 'MIT', 'Financial Engineer', '3654258745', 'aw2675@nyu.edu', 'scala, python', 'intern at BOA','students with a solid foundation in mathematics, and in doing so provide them with practical knowledge that they can successfully apply to complicated financial models.','allow');





  
  CREATE TABLE `Friend`(
    `sid` VARCHAR(10) NOT NULL,
   `fid` VARCHAR(10) NOT NULL,
   `fstatus` ENUM('request', 'accepted', 'deny')  NOT NULL,
   `ftime` DATETIME NOT NULL,
   PRIMARY KEY (`sid`, `fid`),
   FOREIGN KEY (`sid`) REFERENCES `Student` (`sid`),
    FOREIGN KEY (`fid`) REFERENCES `Student` (`sid`));


    Insert Into `Friend` VALUES('mz1893', 'sm7065', 'accepted', '2018-03-31');
    Insert Into `Friend` VALUES('sm7065', 'mz1893', 'accepted', '2018-03-31');
    Insert Into `Friend` VALUES('yc1234', 'sm7065', 'request', '2018-04-02');
    Insert Into `Friend` VALUES('aw2675', 'sm7065', 'request', '2018-02-02');


CREATE TABLE `Company` (
  `cid` VARCHAR(10) NOT NULL,
  `cpassword` VARCHAR(45) NOT NULL,
  `cname` VARCHAR(20) NOT NULL,
  `clocation` VARCHAR(20) NOT NULL,
  `industry` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`cid`));

  Insert Into `Company` VALUES('001', 'micro123', 'Microsoft', 'New York', 'IT');
  Insert Into `Company` VALUES('002', 'google123', 'Google', 'Moutain view', 'IT');
  Insert Into `Company` VALUES('003', 'amazon123', 'Amazon', 'Seatle', 'IT');
  Insert Into `Company` VALUES('004', 'uber123', 'Uber', 'San Jose', 'IT');
  Insert Into `Company` VALUES('005', 'citi123', 'Citi', 'New York', 'Bank');
  Insert Into `Company` VALUES('006', 'cola123', 'Cocacola', 'Atlanta', 'Food');
  Insert Into `Company` VALUES('007', 'united123', 'United', 'New Jersy', 'Flight');




CREATE TABLE `Job` (
  `jid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cid` VARCHAR(10) NOT NULL,
  `title` VARCHAR(45) NOT NULL,
  `salary` VARCHAR(10) NOT NULL,
  `requirements` VARCHAR(200) NOT NULL,
  `descriptions` VARCHAR(200) NOT NULL,
  `jdate` DATETIME NOT NULL,
  `due` DATETIME NOT NULL,
  PRIMARY KEY (`jid`),
  FOREIGN KEY (`cid`) REFERENCES `Company` (`cid`));

  



CREATE TABLE `Apply` (
  `sid` VARCHAR(10) NOT NULL,
  `jid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `astatus`  ENUM('pending', 'reject', 'accepted')  NOT NULL,
  PRIMARY KEY (`sid`,`jid`),
  FOREIGN KEY (`sid`) REFERENCES `Student` (`sid`),
  FOREIGN KEY (`jid`) REFERENCES `Job` (`jid`));








CREATE TABLE `Follow` (
  `sid` VARCHAR(10) NOT NULL,
  `cid` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`sid`, `cid`),
  FOREIGN KEY (`sid`) REFERENCES `Student` (`sid`),
  FOREIGN KEY (`cid`) REFERENCES `Company` (`cid`));

  INSERT INTO `Follow` VALUES('mz1893','001');
  INSERT INTO `Follow` VALUES('mz1893','002');
  INSERT INTO `Follow` VALUES('mz1893','003');
  INSERT INTO `Follow` VALUES('sm7065','001');
  INSERT INTO `Follow` VALUES('sm7065','002');





CREATE TABLE `Notification` (
 `jid` bigint(20) unsigned NOT NULL,
 `sid` VARCHAR(10) NOT NULL,
 `nstatus` ENUM('not show again', 'not viewed') NOT NULL,
  PRIMARY KEY (`sid`,`jid`),
  FOREIGN KEY (`sid`) REFERENCES `Student` (`sid`),
  FOREIGN KEY (`jid`) REFERENCES `Job` (`jid`));



  



CREATE TABLE `Message` (
  `mtime` DATETIME NOT NULL,
 `sender` VARCHAR(10) NOT NULL,
 `receiver` VARCHAR(10) NOT NULL,
 `contents` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`mtime`,`sender`),
  FOREIGN KEY (`sender`) REFERENCES `Student` (`sid`),
  FOREIGN KEY (`receiver`) REFERENCES `Student` (`sid`));
  
  INSERT INTO `Message` VALUES('2018-02-01','mz1893','sm7065','hello!');
  INSERT INTO `Message` VALUES('2018-02-03','mz1893','sm7065','hi!');
  INSERT INTO `Message` VALUES('2018-02-04','mz1893','sm7065','how are you!');
  INSERT INTO `Message` VALUES('2018-02-05','sm7065','mz1893','im fine');



  




CREATE TABLE `Forward` (
 `jid` bigint(20) unsigned NOT NULL,
 `sender` VARCHAR(10) NOT NULL,
 `receiver` VARCHAR(10) NOT NULL,
 `fostatus`  ENUM('not show again', 'not viewed')  NOT NULL,
  PRIMARY KEY (`jid`,`sender`,`receiver`),
  FOREIGN KEY (`sender`) REFERENCES `Student` (`sid`),
  FOREIGN KEY (`receiver`) REFERENCES `Student` (`sid`),
  FOREIGN KEY (`jid`) REFERENCES `Job` (`jid`));
  

