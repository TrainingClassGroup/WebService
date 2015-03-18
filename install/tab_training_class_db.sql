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

Date: 2015-03-18 17:29:38
*/


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
"cofrom" varchar(20) COLLATE "default" NOT NULL
)
WITH (OIDS=FALSE)

;

-- ----------------------------
-- Alter Sequences Owned By 
-- ----------------------------

-- ----------------------------
-- Indexes structure for table tab_training_class_db
-- ----------------------------
CREATE INDEX "tab_training_class_time" ON "public"."tab_training_class_db" USING btree (release_time);
CREATE INDEX "tab_training_class_time2" ON "public"."tab_training_class_db" USING btree (regist_time);

-- ----------------------------
-- Primary Key structure for table tab_training_class_db
-- ----------------------------
ALTER TABLE "public"."tab_training_class_db" ADD PRIMARY KEY ("url_cofrom", "web_in_uid") WITH (fillfactor=100);
