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

Date: 2015-03-24 09:35:59
*/


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
-- Alter Sequences Owned By 
-- ----------------------------

-- ----------------------------
-- Primary Key structure for table tab_training_class_comment
-- ----------------------------
ALTER TABLE "public"."tab_training_class_comment" ADD PRIMARY KEY ("id");
