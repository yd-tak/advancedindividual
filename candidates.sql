
# Dump of table candidate_educations
# ------------------------------------------------------------

CREATE TABLE `candidate_educations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `candidateid` int DEFAULT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `field`varchar(255) DEFAULT NULL,
  `institution` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `notes` text COLLATE utf8mb4_general_ci,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table candidate_skills
# ------------------------------------------------------------

CREATE TABLE `candidate_skills` (
  `id` int NOT NULL AUTO_INCREMENT,
  `candidateid` int DEFAULT NULL,
  `skill` varchar(255) DEFAULT NULL,
  `proficiencylevel` enum('Beginner','Intermediate','Advanced','Expert') COLLATE utf8mb4_general_ci NOT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table candidate_workexps
# ------------------------------------------------------------

CREATE TABLE `candidate_workexps` (
  `id` int NOT NULL AUTO_INCREMENT,
  `candidateid` int DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `responsibilities` text COLLATE utf8mb4_general_ci,
  `achievements` text COLLATE utf8mb4_general_ci,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table candidates
# ------------------------------------------------------------

CREATE TABLE `candidates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_general_ci,
  `status` enum('Available','Hired','Not Available') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Available',
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Add foreign key to 'candidate_educations'
ALTER TABLE candidate_educations
ADD CONSTRAINT fk_candidate_educations_candidateid
FOREIGN KEY (candidateid) REFERENCES candidates(id);

-- Add foreign key to 'candidate_skills'
ALTER TABLE candidate_skills
ADD CONSTRAINT fk_candidate_skills_candidateid
FOREIGN KEY (candidateid) REFERENCES candidates(id);

-- Add foreign key to 'candidate_workexps'
ALTER TABLE candidate_workexps
ADD CONSTRAINT fk_candidate_workexps_candidateid
FOREIGN KEY (candidateid) REFERENCES candidates(id);