-- Run this if you already imported schema.sql with the old (broken) hash.
-- Email:    admin@clinic.local
-- Password: admin123
USE `dental_clinic`;

UPDATE `users`
SET `password` = '$2y$10$ISTeN6fPCApQnhEI95G2H.5U1kwvspnPY6nEMjbt1Giw518Si2q2S'
WHERE `email` = 'admin@clinic.local';

-- If walang admin row pa:
INSERT IGNORE INTO `users` (`name`, `email`, `password`, `role`)
VALUES ('Administrator', 'admin@clinic.local',
        '$2y$10$ISTeN6fPCApQnhEI95G2H.5U1kwvspnPY6nEMjbt1Giw518Si2q2S', 'admin');
