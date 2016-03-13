USE silex;

-- PREFILL YOUR TABLES HERE
INSERT INTO blog_post (title, text, author) VALUES ('New Title', 'This is the content', 1);
INSERT INTO account (username, email, password) VALUE ('admin', 'admin@producify.io', 'admin');
INSERT INTO comment (blog_post, title, text, author) VALUE (1, 'Testkommentar', 'Hallo Welt, das ist ein Test', 1);