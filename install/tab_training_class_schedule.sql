/*
Navicat PGSQL Data Transfer

Source Server         : （AliYun）115.28.76.20
Source Server Version : 90304
Source Host           : 115.28.76.20:5432
Source Database       : mydb
Source Schema         : public

Target Server Type    : PGSQL
Target Server Version : 90304
File Encoding         : 65001

Date: 2015-03-18 17:29:57
*/


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
-- Alter Sequences Owned By 
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table tab_training_class_schedule
-- ----------------------------
ALTER TABLE "public"."tab_training_class_schedule" ADD PRIMARY KEY ("id");
