CREATE TABLE IF NOT EXISTS settings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  setting_key VARCHAR(100) NOT NULL UNIQUE,
  setting_value TEXT NULL,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS projects (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(150) NOT NULL,
  status VARCHAR(80) DEFAULT '',
  tagline VARCHAR(255) DEFAULT '',
  description TEXT NOT NULL,
  short_description TEXT,
  image VARCHAR(255) DEFAULT '',
  tags TEXT,
  tech_stack TEXT,
  content JSON NULL,
  repo_url VARCHAR(255) DEFAULT '',
  demo_url VARCHAR(255) DEFAULT '',
  sort_order INT DEFAULT 0,
  is_active TINYINT(1) DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS faqs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  question VARCHAR(255) NOT NULL,
  answer TEXT NOT NULL,
  sort_order INT DEFAULT 0,
  is_active TINYINT(1) DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS leads (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL, email VARCHAR(150) NOT NULL, phone VARCHAR(30) DEFAULT '', company VARCHAR(100) DEFAULT '',
  project_type VARCHAR(100) DEFAULT '', budget VARCHAR(80) DEFAULT '', preferred_contact VARCHAR(30) DEFAULT '', deadline DATE NULL,
  message TEXT NOT NULL, attachment VARCHAR(255) DEFAULT '', status ENUM('new','contacted','discussion','proposal','client','completed','rejected') DEFAULT 'new',
  admin_notes TEXT, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS portfolio_stats (
  id INT AUTO_INCREMENT PRIMARY KEY, number_value INT NOT NULL, label VARCHAR(100) NOT NULL, description VARCHAR(255), sort_order INT DEFAULT 0,
  is_active TINYINT(1) DEFAULT 1, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS assistant_knowledge (
  id INT AUTO_INCREMENT PRIMARY KEY, question_pattern VARCHAR(255) NOT NULL, answer TEXT NOT NULL, category VARCHAR(50), is_suggested TINYINT(1) DEFAULT 0,
  sort_order INT DEFAULT 0, is_active TINYINT(1) DEFAULT 1, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS terminal_commands (
  id INT AUTO_INCREMENT PRIMARY KEY, command VARCHAR(50) NOT NULL UNIQUE, description VARCHAR(255), output TEXT NOT NULL, category VARCHAR(50),
  sort_order INT DEFAULT 0, is_active TINYINT(1) DEFAULT 1, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO settings (setting_key, setting_value) VALUES
('site_title','Muhammad Harmain — Full Stack Developer'),
('site_description','Full stack developer building business management systems, dashboards, portals, and practical web applications with PHP, Laravel, MySQL, and JavaScript.'),
('contact_email','mharmainfarooq1809@gmail.com'),
('admin_emails','') ON DUPLICATE KEY UPDATE setting_value = COALESCE(NULLIF(setting_value, ''), VALUES(setting_value));

INSERT INTO portfolio_stats (number_value,label,description,sort_order) SELECT 4,'Shipped systems','Total systems delivered',1 WHERE NOT EXISTS (SELECT 1 FROM portfolio_stats);
INSERT INTO assistant_knowledge (question_pattern,answer,category,is_suggested,sort_order) SELECT 'skills|technologies|stack','Core stack: PHP, Laravel, MySQL, JavaScript, Bootstrap, REST APIs, AI Integration.','skills',1,1 WHERE NOT EXISTS (SELECT 1 FROM assistant_knowledge);
INSERT INTO terminal_commands (command,description,output,category,sort_order) VALUES
('help','Show available commands','Available commands: help, about, projects, skills, services, contact, resume, clear','system',1),
('about','About Harmain','Full stack developer focused on PHP and Laravel, building business management systems.','info',2),
('projects','List projects','Union Enterprises, Online Movie Booking System, Jewelry Website, Aniwear.','info',3),
('skills','Tech stack','PHP, Laravel, MySQL, JavaScript, Bootstrap, REST APIs, AI Integration.','info',4),
('contact','Contact Harmain','Email: mharmainfarooq1809@gmail.com','info',5)
ON DUPLICATE KEY UPDATE command = VALUES(command);
