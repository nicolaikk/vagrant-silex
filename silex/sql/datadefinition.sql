USE silex;

-- CREATE YOUR TABLES HERE
CREATE TABLE blog_post (
  id         INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  author     INT,
  title      VARCHAR(255),
  text       TEXT,
  created_at TIMESTAMP DEFAULT NOW()
);

CREATE TABLE account (
  id         INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username   VARCHAR(255),
  email      VARCHAR(255),
  password   VARCHAR(255),
  created_at TIMESTAMP DEFAULT NOW()
);

CREATE TABLE comment (
  id         INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  blog_post  INT,
  author     INT,
  title      VARCHAR(255),
  text       TEXT,
  created_at TIMESTAMP DEFAULT NOW()
);
