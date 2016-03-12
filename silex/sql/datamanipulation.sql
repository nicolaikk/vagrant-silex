USE silex;

-- PREFILL YOUR TABLES HERE
INSERT INTO blog_post (title, text, created_at) VALUES ('New Title', 'This is the content', CURRENT_DATE);
INSERT INTO account (username, email, password, created_at) VALUE ('admin', 'admin@producify.io', 'admin', CURRENT_DATE);
INSERT INTO comment (blog_post, title, text, created_at) VALUE (1, 'Testkommentar', 'Hallo Welt, das ist ein Test', CURRENT_DATE);