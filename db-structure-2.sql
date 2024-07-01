
# Dump of table candidate_awards
# ------------------------------------------------------------

CREATE TABLE `candidate_awards` (
  `id` int NOT NULL AUTO_INCREMENT,
  `candidateid` int DEFAULT NULL,
  `awardname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `awardingorganization` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `dateawarded` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table candidate_educations
# ------------------------------------------------------------

CREATE TABLE `candidate_educations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `candidateid` int DEFAULT NULL,
  `degreeid` int DEFAULT NULL,
  `fieldid` int DEFAULT NULL,
  `institution` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `notes` text COLLATE utf8mb4_general_ci,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table candidate_projects
# ------------------------------------------------------------

CREATE TABLE `candidate_projects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `candidateid` int DEFAULT NULL,
  `projectname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `outcomes` text COLLATE utf8mb4_general_ci,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table candidate_publications
# ------------------------------------------------------------

CREATE TABLE `candidate_publications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `candidateid` int DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `publicationdate` date DEFAULT NULL,
  `publisher` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `link` text COLLATE utf8mb4_general_ci,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table candidate_refs
# ------------------------------------------------------------

CREATE TABLE `candidate_refs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `candidateid` int DEFAULT NULL,
  `referencename` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `relationship` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
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
  `skillid` int DEFAULT NULL,
  `proficiencylevel` enum('Beginner','Intermediate','Advanced','Expert') COLLATE utf8mb4_general_ci NOT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table candidate_socmeds
# ------------------------------------------------------------

CREATE TABLE `candidate_socmeds` (
  `id` int NOT NULL AUTO_INCREMENT,
  `candidateid` int DEFAULT NULL,
  `platform` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `profileurl` text COLLATE utf8mb4_general_ci NOT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table candidate_volunteerworks
# ------------------------------------------------------------

CREATE TABLE `candidate_volunteerworks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `candidateid` int DEFAULT NULL,
  `organization` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
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



# Dump of table ci_sessions
# ------------------------------------------------------------

CREATE TABLE `ci_sessions` (
  `id` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `timestamp` int unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table degrees
# ------------------------------------------------------------

CREATE TABLE `degrees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `degreename` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table departments
# ------------------------------------------------------------

CREATE TABLE `departments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



# Dump of table employees
# ------------------------------------------------------------

CREATE TABLE `employees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userid` int DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_general_ci,
  `roleid` int DEFAULT NULL,
  `active_employee_kpi_template_id` int DEFAULT NULL,
  `jobpositionid` int DEFAULT NULL,
  `supervisorid` int DEFAULT NULL,
  `departmentid` int DEFAULT NULL,
  `locationid` int DEFAULT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`userid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table fields_of_study
# ------------------------------------------------------------

CREATE TABLE `fields_of_study` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fieldname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table job_role_kpi_templates
# ------------------------------------------------------------

CREATE TABLE `job_role_kpi_templates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jobpositionid` int DEFAULT NULL,
  `kpitemplateid` int DEFAULT NULL,
  `weight` decimal(5,2) NOT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table job_roles
# ------------------------------------------------------------

CREATE TABLE `job_roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `departmentid` int DEFAULT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table kpi_score_attributes
# ------------------------------------------------------------

CREATE TABLE `kpi_score_attributes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kpiscoretemplateid` int DEFAULT NULL,
  `kpiattributeid` int DEFAULT NULL,
  `score` decimal(5,2) NOT NULL,
  `weighted_score` decimal(5,2) NOT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table kpi_score_templates
# ------------------------------------------------------------

CREATE TABLE `kpi_score_templates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kpiscoreid` int DEFAULT NULL,
  `kpitemplateid` int DEFAULT NULL,
  `score` decimal(5,2) NOT NULL,
  `weighted_score` decimal(5,2) NOT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table kpi_scores
# ------------------------------------------------------------

CREATE TABLE `kpi_scores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employeeid` int DEFAULT NULL,
  `scorerid` int DEFAULT NULL,
  `jobpositionid` int DEFAULT NULL,
  `score` decimal(5,2) NOT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table kpi_template_attributes
# ------------------------------------------------------------

CREATE TABLE `kpi_template_attributes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kpitemplateid` int DEFAULT NULL,
  `attributename` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table kpi_templates
# ------------------------------------------------------------

CREATE TABLE `kpi_templates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `templatename` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table locations
# ------------------------------------------------------------

CREATE TABLE `locations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



# Dump of table recruitment_stages
# ------------------------------------------------------------

CREATE TABLE `recruitment_stages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `stagename` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table recruitment_template_stages
# ------------------------------------------------------------

CREATE TABLE `recruitment_template_stages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `templateid` int DEFAULT NULL,
  `stageid` int DEFAULT NULL,
  `stageorder` int NOT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table recruitment_templates
# ------------------------------------------------------------

CREATE TABLE `recruitment_templates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `templatename` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `department` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table skills
# ------------------------------------------------------------

CREATE TABLE `skills` (
  `id` int NOT NULL AUTO_INCREMENT,
  `skillname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `skilltype` enum('Technical','Soft','Certification','Language') COLLATE utf8mb4_general_ci NOT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table user_roles
# ------------------------------------------------------------

CREATE TABLE `user_roles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rolename` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table users
# ------------------------------------------------------------

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `salt` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table vacancies
# ------------------------------------------------------------

CREATE TABLE `vacancies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `job_description` text COLLATE utf8mb4_general_ci,
  `responsibilities` text COLLATE utf8mb4_general_ci,
  `status` enum('Open','Closed','Paused') COLLATE utf8mb4_general_ci NOT NULL,
  `opendate` date DEFAULT NULL,
  `closedate` date DEFAULT NULL,
  `templateid` int DEFAULT NULL,
  `requested_by` int DEFAULT NULL,
  `decision_maker` int DEFAULT NULL,
  `salary_min` decimal(10,2) DEFAULT NULL,
  `salary_max` decimal(10,2) DEFAULT NULL,
  `currency` varchar(3) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table vacancy_candidates
# ------------------------------------------------------------

CREATE TABLE `vacancy_candidates` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vacancyid` int DEFAULT NULL,
  `candidateid` int DEFAULT NULL,
  `status` enum('Recruited','In Progress','Rejected') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'In Progress',
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table vacancy_educations
# ------------------------------------------------------------

CREATE TABLE `vacancy_educations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vacancyid` int DEFAULT NULL,
  `degreeid` int DEFAULT NULL,
  `fieldid` int DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table vacancy_qualifications
# ------------------------------------------------------------

CREATE TABLE `vacancy_qualifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vacancyid` int DEFAULT NULL,
  `qualification_type` enum('Age','Gender','Education Level','Work Experience','Skill','Certification','Language') COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `required` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table vacancy_skills
# ------------------------------------------------------------

CREATE TABLE `vacancy_skills` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vacancyid` int DEFAULT NULL,
  `skillid` int DEFAULT NULL,
  `proficiencylevel` enum('Beginner','Intermediate','Advanced','Expert') COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Dump of table vacancy_stages
# ------------------------------------------------------------

CREATE TABLE `vacancy_stages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vacancycandidateid` int DEFAULT NULL,
  `stageid` int DEFAULT NULL,
  `dateentered` date DEFAULT NULL,
  `datecompleted` date DEFAULT NULL,
  `categoryid` int DEFAULT NULL,
  `score` int DEFAULT NULL,
  `notes` text COLLATE utf8mb4_general_ci,
  `createdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `updatedate` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
