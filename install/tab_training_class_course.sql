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

Date: 2015-03-18 17:29:24
*/


-- ----------------------------
-- Table structure for tab_training_class_course
-- ----------------------------
DROP TABLE IF EXISTS "public"."tab_training_class_course";
CREATE TABLE "public"."tab_training_class_course" (
"id" int8 DEFAULT nextval('tab_training_class_course_id_seq'::regclass) NOT NULL,
"course" varchar(255) COLLATE "default"
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Alter Sequences Owned By 
-- ----------------------------

-- ----------------------------
-- Indexes structure for table tab_training_class_course
-- ----------------------------
CREATE INDEX "tab_training_class_course_id_idx" ON "public"."tab_training_class_course" USING btree (id);

-- ----------------------------
-- Primary Key structure for table tab_training_class_course
-- ----------------------------
ALTER TABLE "public"."tab_training_class_course" ADD PRIMARY KEY ("id");
