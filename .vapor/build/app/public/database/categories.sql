-- -------------------------------------------------------------
-- TablePlus 2.10(270)
--
-- https://tableplus.com/
--
-- Database: pauzr
-- Generation Time: 2019-11-15 09:40:44.5500
-- -------------------------------------------------------------


DROP TABLE IF EXISTS "public"."categories";
-- This script only contains the table creation statements and does not fully represent the table in the database. It's still missing: indices, triggers. Do not use it as a backup.

-- Table Definition
CREATE TABLE "public"."categories" (
    "id" uuid NOT NULL,
    "name" varchar(255) NOT NULL,
    "background_image" varchar(255),
    "background_color" varchar(255),
    PRIMARY KEY ("id")
);

INSERT INTO "public"."categories" ("id", "name", "background_image", "background_color") VALUES ('85b3cfac-c766-4349-8a25-b05712effa25', 'Food', NULL, NULL),
('e2b7ae10-3d66-4a50-aebd-32e713cabde4', 'General', NULL, NULL);
