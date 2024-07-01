CREATE TABLE skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    skillname VARCHAR(255) NOT NULL,
    skilltype ENUM('Technical', 'Soft', 'Certification', 'Language') NOT NULL,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE candidates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    status ENUM('Available', 'Hired','Not Available') NOT NULL DEFAULT 'Available',
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE candidate_skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    candidateid INT,
    skillid INT,
    proficiencylevel ENUM('Beginner', 'Intermediate', 'Advanced', 'Expert') NOT NULL,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE candidate_refs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    candidateid INT,
    referencename VARCHAR(255) NOT NULL,
    relationship VARCHAR(255),
    company VARCHAR(255),
    position VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(50),
    notes TEXT,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE candidate_projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    candidateid INT,
    projectname VARCHAR(255) NOT NULL,
    role VARCHAR(255),
    description TEXT,
    startdate DATE,
    enddate DATE,
    outcomes TEXT,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE candidate_awards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    candidateid INT,
    awardname VARCHAR(255) NOT NULL,
    awardingorganization VARCHAR(255),
    dateawarded DATE,
    description TEXT,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE candidate_volunteerworks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    candidateid INT,
    organization VARCHAR(255) NOT NULL,
    role VARCHAR(255),
    startdate DATE,
    enddate DATE,
    description TEXT,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE candidate_publications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    candidateid INT,
    title VARCHAR(255) NOT NULL,
    publicationdate DATE,
    publisher VARCHAR(255),
    description TEXT,
    link TEXT,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
CREATE TABLE candidate_socmeds (
    id INT AUTO_INCREMENT PRIMARY KEY,
    candidateid INT,
    platform VARCHAR(255) NOT NULL,
    profileurl TEXT NOT NULL,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE degrees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    degreename VARCHAR(255) NOT NULL,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE fields_of_study (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fieldname VARCHAR(255) NOT NULL,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE candidate_educations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    candidateid INT,
    degreeid INT,
    fieldid INT,
    institution VARCHAR(255) NOT NULL,
    startdate DATE,
    enddate DATE,
    notes TEXT,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE candidate_workexps (
    id INT AUTO_INCREMENT PRIMARY KEY,
    candidateid INT,
    company VARCHAR(255) NOT NULL,
    position VARCHAR(255),
    startdate DATE,
    enddate DATE,
    responsibilities TEXT,
    achievements TEXT,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE recruitment_stages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    stagename VARCHAR(255) NOT NULL,
    description TEXT,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE recruitment_templates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    templatename VARCHAR(255) NOT NULL,
    description TEXT,
    department VARCHAR(255),
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE recruitment_template_stages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    templateid INT,
    stageid INT,
    stageorder INT NOT NULL,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE vacancy_candidates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vacancyid INT,
    candidateid INT,
    status ENUM('Recruited', 'In Progress','Rejected') NOT NULL DEFAULT 'In Progress',
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE vacancy_stages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vacancycandidateid INT,
    stageid INT,
    dateentered DATE,
    datecompleted DATE,
    categoryid INT,
    score INT,
    notes TEXT,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE vacancies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    department VARCHAR(255),
    job_description TEXT,
    responsibilities TEXT,
    status ENUM('Open', 'Closed', 'Paused') NOT NULL,
    opendate DATE,
    closedate DATE,
    templateid INT, -- Link to the recruitment template
    requested_by INT,
    decision_maker INT,
    salary_min DECIMAL(10,2),
    salary_max DECIMAL(10,2),
    currency VARCHAR(3),
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE vacancy_qualifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vacancyid INT,
    qualification_type ENUM('Age', 'Gender', 'Education Level', 'Work Experience', 'Skill', 'Certification', 'Language') NOT NULL,
    description TEXT,
    required BOOLEAN DEFAULT TRUE
);
CREATE TABLE vacancy_skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vacancyid INT,
    skillid INT,
    proficiencylevel ENUM('Beginner', 'Intermediate', 'Advanced', 'Expert') NOT NULL
);

CREATE TABLE vacancy_educations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    vacancyid INT,
    degreeid INT,
    fieldid INT,
    description TEXT, -- Additional details about the requirement, if needed
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    salt VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    fullname VARCHAR(255),
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE user_roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rolename VARCHAR(255) NOT NULL,
    description TEXT,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNIQUE, -- Reference to the user table
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE,
    phone VARCHAR(20),
    address TEXT,
    roleid INT, -- Reference to the user_roles table
    active_employee_kpi_template_id INT,
    jobpositionid INT,
    supervisorid INT,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP,
    updatedate DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE kpi_templates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    templatename VARCHAR(255) NOT NULL,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE kpi_template_attributes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kpitemplateid INT,
    attributename VARCHAR(255) NOT NULL,
    weight DECIMAL(5,2) NOT NULL,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE job_roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    positionname VARCHAR(255) NOT NULL,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE job_role_kpi_templates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jobpositionid INT,
    kpitemplateid INT,
    weight DECIMAL(5,2) NOT NULL,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE kpi_scores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employeeid INT,
    scorerid INT,
    jobpositionid INT,
    score DECIMAL(5,2) NOT NULL,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE kpi_score_templates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kpiscoreid INT,
    kpitemplateid INT,
    score DECIMAL(5,2) NOT NULL,
    weighted_score DECIMAL(5,2) NOT NULL,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE kpi_score_attributes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kpiscoretemplateid INT,
    kpiattributeid INT,
    score DECIMAL(5,2) NOT NULL,
    weighted_score DECIMAL(5,2) NOT NULL,
    createdate DATETIME DEFAULT CURRENT_TIMESTAMP
);
