/*
Navicat PGSQL Data Transfer

Source Server         : 115.28.76.20
Source Server Version : 90304
Source Host           : 115.28.76.20:5432
Source Database       : mydb
Source Schema         : public

Target Server Type    : PGSQL
Target Server Version : 90304
File Encoding         : 65001

Date: 2015-03-29 22:54:12
*/


-- ----------------------------
-- Table structure for tab_training_class_classname
-- ----------------------------
DROP TABLE IF EXISTS "public"."tab_training_class_classname";
CREATE TABLE "public"."tab_training_class_classname" (
"id" int8 DEFAULT nextval('tab_training_class_classname_id_seq'::regclass) NOT NULL,
"class_name" varchar(255) COLLATE "default" NOT NULL,
"index" int8 DEFAULT 0
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for tab_training_class_comment
-- ----------------------------
DROP TABLE IF EXISTS "public"."tab_training_class_comment";
CREATE TABLE "public"."tab_training_class_comment" (
"id" int8 DEFAULT nextval('tab_training_class_comment_id_seq'::regclass) NOT NULL,
"company_id" int8 NOT NULL,
"comment" text COLLATE "default" NOT NULL,
"timestamp" timestamp(6) DEFAULT now() NOT NULL,
"user_id" int8 NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for tab_training_class_course
-- ----------------------------
DROP TABLE IF EXISTS "public"."tab_training_class_course";
CREATE TABLE "public"."tab_training_class_course" (
"id" int8 DEFAULT nextval('tab_training_class_course_id_seq'::regclass) NOT NULL,
"course" varchar(255) COLLATE "default",
"index" int8 DEFAULT 0
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for tab_training_class_db
-- ----------------------------
DROP TABLE IF EXISTS "public"."tab_training_class_db";
CREATE TABLE "public"."tab_training_class_db" (
"id" int4 DEFAULT nextval('tab_training_class_id_seq'::regclass) NOT NULL,
"release_time" timestamp(6),
"regist_time" timestamp(6),
"company" varchar(128) COLLATE "default" NOT NULL,
"url_home" varchar(128) COLLATE "default",
"contact" varchar(128) COLLATE "default",
"text" text COLLATE "default",
"catalog" varchar(128) COLLATE "default",
"taught" varchar(128) COLLATE "default",
"curriculum" varchar(128) COLLATE "default",
"tel" varchar(128) COLLATE "default",
"address" varchar(128) COLLATE "default",
"url" text COLLATE "default",
"url_cofrom" varchar(128) COLLATE "default" NOT NULL,
"web_in_uid" varchar(64) COLLATE "default" NOT NULL,
"postcode" varchar(16) COLLATE "default",
"coordinate" point DEFAULT point((0.0)::double precision, (0.0)::double precision) NOT NULL,
"elevation" numeric DEFAULT 0.0,
"cofrom" varchar(20) COLLATE "default" NOT NULL,
"logo_image" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for tab_training_class_image
-- ----------------------------
DROP TABLE IF EXISTS "public"."tab_training_class_image";
CREATE TABLE "public"."tab_training_class_image" (
"id" int8 DEFAULT nextval('tab_training_class_image_id_seq'::regclass) NOT NULL,
"imagetype" varchar(32) COLLATE "default" NOT NULL,
"imagedata" text COLLATE "default",
"imageurl" text COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for tab_training_class_relation_between_class_name_and_course
-- ----------------------------
DROP TABLE IF EXISTS "public"."tab_training_class_relation_between_class_name_and_course";
CREATE TABLE "public"."tab_training_class_relation_between_class_name_and_course" (
"id" int8 DEFAULT nextval('tab_training_class_relation_between_class_name_and_cours_id_seq'::regclass) NOT NULL,
"class_name_id" int8 NOT NULL,
"course_id" int8 NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for tab_training_class_reservation
-- ----------------------------
DROP TABLE IF EXISTS "public"."tab_training_class_reservation";
CREATE TABLE "public"."tab_training_class_reservation" (
"id" int8 DEFAULT nextval('"tab_training_class_reservation\_id_seq"'::regclass) NOT NULL,
"user_id" int8 NOT NULL,
"teacher_id" int8 NOT NULL,
"reservation_time" timestamp(6)
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for tab_training_class_schedule
-- ----------------------------
DROP TABLE IF EXISTS "public"."tab_training_class_schedule";
CREATE TABLE "public"."tab_training_class_schedule" (
"id" int8 DEFAULT nextval('tab_training_class_schedule_id_seq'::regclass) NOT NULL,
"course_id" int8 NOT NULL,
"week0" varchar(255) COLLATE "default",
"week1" varchar(255) COLLATE "default",
"week2" varchar(255) COLLATE "default",
"week3" varchar(255) COLLATE "default",
"week4" varchar(255) COLLATE "default",
"week5" varchar(255) COLLATE "default",
"week6" varchar(255) COLLATE "default",
"class_id" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for tab_training_class_teacher
-- ----------------------------
DROP TABLE IF EXISTS "public"."tab_training_class_teacher";
CREATE TABLE "public"."tab_training_class_teacher" (
"id" int8 DEFAULT nextval('tab_training_class_teacher_id_seq'::regclass) NOT NULL,
"teacher" varchar(255) COLLATE "default",
"company_id" int8 NOT NULL,
"schedule_id" int8
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Table structure for tab_training_class_user
-- ----------------------------
DROP TABLE IF EXISTS "public"."tab_training_class_user";
CREATE TABLE "public"."tab_training_class_user" (
"id" int8 DEFAULT nextval('tab_training_class_user_id_seq'::regclass) NOT NULL,
"username" varchar(255) COLLATE "default",
"tel" varchar(32) COLLATE "default" NOT NULL,
"weixin" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Alter Sequences Owned By 
-- ----------------------------

-- ----------------------------
-- Indexes structure for table tab_training_class_classname
-- ----------------------------
CREATE INDEX "tab_training_class_classname_id_idx" ON "public"."tab_training_class_classname" USING btree (id);

-- ----------------------------
-- Primary Key structure for table tab_training_class_classname
-- ----------------------------
ALTER TABLE "public"."tab_training_class_classname" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table tab_training_class_comment
-- ----------------------------
ALTER TABLE "public"."tab_training_class_comment" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table tab_training_class_course
-- ----------------------------
CREATE INDEX "tab_training_class_course_id_idx" ON "public"."tab_training_class_course" USING btree (id);

-- ----------------------------
-- Primary Key structure for table tab_training_class_course
-- ----------------------------
ALTER TABLE "public"."tab_training_class_course" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Indexes structure for table tab_training_class_db
-- ----------------------------
CREATE INDEX "tab_training_class_time" ON "public"."tab_training_class_db" USING btree (release_time);
CREATE INDEX "tab_training_class_time2" ON "public"."tab_training_class_db" USING btree (regist_time);

-- ----------------------------
-- Primary Key structure for table tab_training_class_db
-- ----------------------------
ALTER TABLE "public"."tab_training_class_db" ADD PRIMARY KEY ("url_cofrom", "web_in_uid") WITH (fillfactor=100);

-- ----------------------------
-- Primary Key structure for table tab_training_class_image
-- ----------------------------
ALTER TABLE "public"."tab_training_class_image" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Uniques structure for table tab_training_class_relation_between_class_name_and_course
-- ----------------------------
ALTER TABLE "public"."tab_training_class_relation_between_class_name_and_course" ADD UNIQUE ("class_name_id", "course_id");

-- ----------------------------
-- Primary Key structure for table tab_training_class_reservation
-- ----------------------------
ALTER TABLE "public"."tab_training_class_reservation" ADD PRIMARY KEY ("user_id", "teacher_id");

-- ----------------------------
-- Primary Key structure for table tab_training_class_schedule
-- ----------------------------
ALTER TABLE "public"."tab_training_class_schedule" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table tab_training_class_teacher
-- ----------------------------
ALTER TABLE "public"."tab_training_class_teacher" ADD PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table tab_training_class_user
-- ----------------------------
ALTER TABLE "public"."tab_training_class_user" ADD PRIMARY KEY ("id");
