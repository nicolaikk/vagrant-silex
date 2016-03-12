USE silex;

-- PREFILL YOUR TABLES HERE
INSERT INTO blog_post (title, text) VALUES ('New Title', 'This is the content');
INSERT INTO account (username, email, password) VALUE ('admin', 'admin@producify.io', 'admin');
INSERT INTO comment (blog_post, title, text) VALUE (1, 'Testkommentar', 'Hallo Welt, das ist ein Test');