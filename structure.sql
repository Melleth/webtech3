CREATE TABLE "brands" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "name" TEXT
);
CREATE TABLE sqlite_sequence(name,seq);
CREATE TABLE "brand_likes" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "brand_id" INTEGER,
    "user_id" INTEGER
);
CREATE TABLE "likes" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "liker" INTEGER,
    "likes" INTEGER
);
CREATE TABLE "profile" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "nickname" TEXT,
    "name" TEXT,
    "password" TEXT,
    "email" TEXT,
    "gender" INTEGER,
    "birthdate" TEXT,
    "profile_pic" TEXT,
    "description" BLOB,
    "preferences" INTEGER,
    "preferredagelow" INTEGER,
    "preferredagehigh" INTEGER,
    "personality" TEXT,
    "personality_lookingfor" TEXT,
    "admin" INTEGER
);
CREATE TABLE "messages" (
    "msg_id" INTEGER PRIMARY KEY AUTOINCREMENT,
    "msg_from" INTEGER,
    "msg_to" INTEGER,
    "subject" TEXT,
    "body" BLOB
);
