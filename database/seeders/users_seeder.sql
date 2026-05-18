-- Default users (passwords are bcrypt hashes of "password123")
INSERT IGNORE INTO users (name, email, password, role) VALUES
('Dr. Jane Cruz',    'dentist@clinic.local',  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'dentist'),
('Front Desk',       'staff@clinic.local',    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'staff'),
('Juan Dela Cruz',   'patient@clinic.local',  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'patient');
