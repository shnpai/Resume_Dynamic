CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(100) NOT NULL UNIQUE,
  `password_hash` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `about` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `interests` TEXT DEFAULT NULL,
  `life_motto` TEXT DEFAULT NULL,
  `bucket_list` TEXT DEFAULT NULL,
  `strengths` TEXT DEFAULT NULL,
  `weaknesses` TEXT DEFAULT NULL,
  `soft_skills` TEXT DEFAULT NULL,
  `greatest_fear` TEXT DEFAULT NULL,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `skills` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(200) NOT NULL,
  `level` INT DEFAULT 0,
  `meta` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `projects` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT,
  `tech` VARCHAR(255),
  `image` VARCHAR(255),
  `link` VARCHAR(255),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `education` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `category` ENUM('education','certification') DEFAULT 'education',
  `title` VARCHAR(255) NOT NULL,
  `institution` VARCHAR(255),
  `description` TEXT,
  `year` VARCHAR(50),
  `link` VARCHAR(255),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


