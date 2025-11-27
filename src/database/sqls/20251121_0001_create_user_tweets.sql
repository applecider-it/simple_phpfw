CREATE TABLE user_tweets (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP,
    INDEX idx_user_id (user_id),
    CONSTRAINT fk_user_tweets_user
        FOREIGN KEY (user_id) REFERENCES users(id)
        ON DELETE CASCADE
);
