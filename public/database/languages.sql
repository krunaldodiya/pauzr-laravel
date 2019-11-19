-- -------------------------------------------------------------
-- TablePlus 2.10(270)
--
-- https://tableplus.com/
--
-- Database: pauzr
-- Generation Time: 2019-11-12 19:21:06.9480
-- -------------------------------------------------------------


DROP TABLE IF EXISTS "public"."languages";
-- This script only contains the table creation statements and does not fully represent the table in the database. It's still missing: indices, triggers. Do not use it as a backup.

-- Table Definition
CREATE TABLE "public"."languages" (
    "id" uuid NOT NULL,
    "name" varchar(255),
    "nickname" varchar(255),
    "shortname" varchar(255),
    "background_image" varchar(255),
    "background_color" varchar(255),
    "order" int4,
    PRIMARY KEY ("id")
);

INSERT INTO "public"."languages" ("id", "name", "nickname", "shortname", "background_image", "background_color", "order") VALUES ('2cbe9328-d671-4c16-9341-057cd0240ced', 'Hindi', 'हिन्दी', 'hi', NULL, NULL, NULL),
('640a547f-97c9-4b05-8b8e-e2b10f797b0f', 'English', 'English', 'en', NULL, NULL, NULL),
('8f85e551-28a6-4212-9be9-7e70fcc04d8c', 'Gujarati', 'ગુજરાતી', 'gu', NULL, NULL, NULL);
