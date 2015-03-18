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

Date: 2015-03-18 17:29:47
*/


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
-- Alter Sequences Owned By 
-- ----------------------------

-- ----------------------------
-- Uniques structure for table tab_training_class_relation_between_class_name_and_course
-- ----------------------------
ALTER TABLE "public"."tab_training_class_relation_between_class_name_and_course" ADD UNIQUE ("class_name_id", "course_id");
