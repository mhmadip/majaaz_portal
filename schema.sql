CREATE DATABASE IF NOT EXISTS majaaz_portal
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE majaaz_portal;

CREATE TABLE IF NOT EXISTS users (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  name          VARCHAR(120) NOT NULL,
  email         VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role          ENUM('admin','jury') NOT NULL DEFAULT 'jury',
  created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS projects (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  name       VARCHAR(190) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS project_images (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  project_id  INT NOT NULL,
  file_path   VARCHAR(255) NOT NULL,
  description VARCHAR(255) NULL,
  is_cover    TINYINT(1) NOT NULL DEFAULT 0,
  uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_images_project FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS evaluations (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  project_id  INT NOT NULL,
  jury_id     INT NOT NULL,
  scores_json JSON NOT NULL,
  raw_score   INT NOT NULL,
  comment     TEXT NULL,
  published   TINYINT(1) NOT NULL DEFAULT 0,
  saved_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY uniq_project_jury (project_id, jury_id),
  CONSTRAINT fk_eval_project FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
  CONSTRAINT fk_eval_user    FOREIGN KEY (jury_id)    REFERENCES users(id)    ON DELETE CASCADE
);

/* ══ RATE LIMITING — tracks failed login attempts by IP ══ */
CREATE TABLE IF NOT EXISTS login_attempts (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  ip           VARCHAR(45) NOT NULL,
  attempted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_ip_time (ip, attempted_at)
);
