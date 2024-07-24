<?php
$db = new SQLite3('users.db');

$db->exec("CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    email TEXT UNIQUE NOT NULL,
    verification_code TEXT UNIQUE NOT NULL,
    verified INTEGER DEFAULT 0
)");
?>
