-- =====================================================================
-- Dental Clinic Management System - Schema
-- MySQL 8 / MariaDB 10.4+
-- =====================================================================

CREATE DATABASE IF NOT EXISTS `dental_clinic` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `dental_clinic`;

SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- users
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `users` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`       VARCHAR(150) NOT NULL,
    `email`      VARCHAR(150) NOT NULL UNIQUE,
    `phone`      VARCHAR(50)  NULL,
    `password`   VARCHAR(255) NOT NULL,
    `role`       ENUM('admin','dentist','staff','patient') NOT NULL DEFAULT 'patient',
    `is_active`  TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- patients
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `patients` (
    `id`              INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id`         INT UNSIGNED NULL,
    `name`            VARCHAR(150) NOT NULL,
    `email`           VARCHAR(150) NULL,
    `phone`           VARCHAR(50)  NULL,
    `birthdate`       DATE NULL,
    `gender`          ENUM('male','female','other') NULL,
    `address`         TEXT NULL,
    `medical_history` TEXT NULL,
    `allergies`       TEXT NULL,
    `created_at`      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at`      TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_patient_name` (`name`),
    CONSTRAINT `fk_patient_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- dentists
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `dentists` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id`    INT UNSIGNED NULL,
    `name`       VARCHAR(150) NOT NULL,
    `email`      VARCHAR(150) NULL,
    `phone`      VARCHAR(50)  NULL,
    `specialty`  VARCHAR(150) NULL,
    `license_no` VARCHAR(100) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_dentist_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- staff
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `staff` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id`    INT UNSIGNED NULL,
    `name`       VARCHAR(150) NOT NULL,
    `email`      VARCHAR(150) NULL,
    `phone`      VARCHAR(50)  NULL,
    `position`   VARCHAR(100) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_staff_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- services
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `services` (
    `id`           INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`         VARCHAR(150) NOT NULL,
    `description`  TEXT NULL,
    `price`        DECIMAL(10,2) NOT NULL DEFAULT 0,
    `duration_min` INT NOT NULL DEFAULT 30,
    `is_active`    TINYINT(1) NOT NULL DEFAULT 1,
    `created_at`   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- appointments
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `appointments` (
    `id`           INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `patient_id`   INT UNSIGNED NOT NULL,
    `dentist_id`   INT UNSIGNED NOT NULL,
    `service_id`   INT UNSIGNED NULL,
    `scheduled_at` DATETIME NOT NULL,
    `status`       ENUM('pending','confirmed','completed','cancelled','no_show') NOT NULL DEFAULT 'pending',
    `notes`        TEXT NULL,
    `created_at`   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at`   TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_appt_date` (`scheduled_at`),
    CONSTRAINT `fk_appt_patient` FOREIGN KEY (`patient_id`) REFERENCES `patients`(`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_appt_dentist` FOREIGN KEY (`dentist_id`) REFERENCES `dentists`(`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_appt_service` FOREIGN KEY (`service_id`) REFERENCES `services`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- treatments
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `treatments` (
    `id`             INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `patient_id`     INT UNSIGNED NOT NULL,
    `dentist_id`     INT UNSIGNED NULL,
    `appointment_id` INT UNSIGNED NULL,
    `service_id`     INT UNSIGNED NULL,
    `tooth_number`   VARCHAR(10) NULL,
    `diagnosis`      VARCHAR(255) NULL,
    `procedure`      VARCHAR(255) NULL,
    `notes`          TEXT NULL,
    `performed_at`   DATETIME NOT NULL,
    `created_at`     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_tx_patient` FOREIGN KEY (`patient_id`) REFERENCES `patients`(`id`) ON DELETE CASCADE,
    CONSTRAINT `fk_tx_dentist` FOREIGN KEY (`dentist_id`) REFERENCES `dentists`(`id`) ON DELETE SET NULL,
    CONSTRAINT `fk_tx_appt`    FOREIGN KEY (`appointment_id`) REFERENCES `appointments`(`id`) ON DELETE SET NULL,
    CONSTRAINT `fk_tx_service` FOREIGN KEY (`service_id`) REFERENCES `services`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- dental_charts
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `dental_charts` (
    `id`           INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `patient_id`   INT UNSIGNED NOT NULL,
    `tooth_number` VARCHAR(10) NOT NULL,
    `condition`    ENUM('healthy','caries','filled','crown','missing','extracted','other') NOT NULL DEFAULT 'healthy',
    `notes`        TEXT NULL,
    `created_at`   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at`   TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uniq_patient_tooth` (`patient_id`, `tooth_number`),
    CONSTRAINT `fk_chart_patient` FOREIGN KEY (`patient_id`) REFERENCES `patients`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- invoices
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `invoices` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `patient_id` INT UNSIGNED NOT NULL,
    `total`      DECIMAL(10,2) NOT NULL DEFAULT 0,
    `status`     ENUM('unpaid','partial','paid','void') NOT NULL DEFAULT 'unpaid',
    `notes`      TEXT NULL,
    `issued_at`  DATETIME NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_invoice_patient` FOREIGN KEY (`patient_id`) REFERENCES `patients`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- payments
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `payments` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `invoice_id` INT UNSIGNED NOT NULL,
    `amount`     DECIMAL(10,2) NOT NULL,
    `method`     ENUM('cash','card','gcash','maya','bank_transfer','other') NOT NULL DEFAULT 'cash',
    `paid_at`    DATETIME NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_payment_invoice` FOREIGN KEY (`invoice_id`) REFERENCES `invoices`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- inventory_items
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `inventory_items` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name`       VARCHAR(150) NOT NULL,
    `sku`        VARCHAR(100) NULL,
    `quantity`   INT NOT NULL DEFAULT 0,
    `unit`       VARCHAR(50) NULL,
    `reorder_at` INT NOT NULL DEFAULT 0,
    `notes`      TEXT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- audit_logs
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `audit_logs` (
    `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id`    INT UNSIGNED NULL,
    `action`     VARCHAR(100) NOT NULL,
    `model`      VARCHAR(100) NULL,
    `model_id`   INT UNSIGNED NULL,
    `payload`    JSON NULL,
    `ip`         VARCHAR(45) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_audit_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- settings
-- ---------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `settings` (
    `key`        VARCHAR(100) NOT NULL,
    `value`      TEXT NULL,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`key`)
) ENGINE=InnoDB;

SET FOREIGN_KEY_CHECKS = 1;

-- ---------------------------------------------------------------------
-- Seed: default admin account (password: admin123)
-- ---------------------------------------------------------------------
-- Password: admin123  (bcrypt)
INSERT IGNORE INTO `users` (`name`, `email`, `password`, `role`)
VALUES ('Administrator', 'admin@clinic.local',
        '$2y$10$ISTeN6fPCApQnhEI95G2H.5U1kwvspnPY6nEMjbt1Giw518Si2q2S', 'admin');

INSERT IGNORE INTO `services` (`name`, `description`, `price`, `duration_min`) VALUES
    ('Dental Cleaning', 'Routine prophylaxis', 1500.00, 45),
    ('Tooth Extraction', 'Simple extraction', 1200.00, 30),
    ('Dental Filling', 'Composite filling', 1800.00, 45),
    ('Root Canal', 'Endodontic treatment', 8000.00, 90),
    ('Teeth Whitening', 'In-office whitening', 6500.00, 60),
    ('Braces Adjustment', 'Orthodontic adjustment', 2000.00, 30);

INSERT IGNORE INTO `settings` (`key`, `value`) VALUES
    ('clinic_name', 'Dental Clinic'),
    ('currency', 'PHP');
