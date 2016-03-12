USE silex;

-- CREATE YOUR TABLES HERE
CREATE TABLE blog_post (
  id         INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  author     VARCHAR(255),
  title      VARCHAR(255),
  text       TEXT,
  created_at DATE
);

CREATE TABLE account (
  id         INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username   VARCHAR(255),
  email      VARCHAR(255),
  password   VARCHAR(255),
  created_at DATE
);

CREATE TABLE comment (
  id         INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  blog_post  INT,
  title      VARCHAR(255),
  text       TEXT,
  created_at DATE
);
