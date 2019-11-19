-- -------------------------------------------------------------
-- TablePlus 2.10(270)
--
-- https://tableplus.com/
--
-- Database: pauzr
-- Generation Time: 2019-11-01 13:59:08.7920
-- -------------------------------------------------------------


DROP TABLE IF EXISTS "public"."users";
-- This script only contains the table creation statements and does not fully represent the table in the database. It's still missing: indices, triggers. Do not use it as a backup.

-- Table Definition
CREATE TABLE "public"."users"
(
    "id" uuid NOT NULL,
    "email" varchar(255),
    "email_verified_at" timestamp(0),
    "mobile" varchar(255),
    "mobile_verified_at" timestamp(0),
    "username" varchar(255),
    "password" varchar(255) NOT NULL,
    "name" varchar(255),
    "dob" varchar(255) NOT NULL DEFAULT '01-01-1990'
    ::character varying,
    "gender" varchar
    (255) NOT NULL DEFAULT 'None'::character varying,
    "avatar" varchar
    (255),
    "bio" text,
    "language" varchar
    (255),
    "country_id" uuid NOT NULL,
    "version" varchar
    (255),
    "fcm_token" varchar
    (255),
    "status" bool NOT NULL DEFAULT true,
    "remember_token" varchar
    (100),
    "created_at" timestamp
    (0),
    "updated_at" timestamp
    (0),
    PRIMARY KEY
    ("id")
);

