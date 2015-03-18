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

Date: 2015-03-18 17:30:06
*/


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
-- Alter Sequences Owned By 
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table tab_training_class_teacher
-- ----------------------------
ALTER TABLE "public"."tab_training_class_teacher" ADD PRIMARY KEY ("id");
