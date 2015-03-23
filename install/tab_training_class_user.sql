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

Date: 2015-03-24 09:35:41
*/


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
-- Primary Key structure for table tab_training_class_user
-- ----------------------------
ALTER TABLE "public"."tab_training_class_user" ADD PRIMARY KEY ("id");
