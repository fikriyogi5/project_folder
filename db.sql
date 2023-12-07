CREATE TABLE settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_name VARCHAR(50) NOT NULL,
    setting_value VARCHAR(10) NOT NULL
);

INSERT INTO settings (setting_name, setting_value) VALUES
('otp_enabled', 'true'),
('captcha_enabled', 'false');

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    drive_size INT DEFAULT 0,
    membership_level INT DEFAULT 1, -- Membership level
    payment_status INT DEFAULT 0 -- Payment status (0: Not paid, 1: Paid)
);