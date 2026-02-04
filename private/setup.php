<?php

function set_up_jokes_table(PDO $pdo) : void {
    $query = "CREATE TABLE IF NOT EXISTS jokes (
	id INTEGER auto_increment PRIMARY KEY,
    setup VARCHAR(1024),
    punchline VARCHAR(256)
    );";

    $pdo->exec($query);
}

function set_up_db_schema(PDO $pdo) : void {
    set_up_jokes_table($pdo);
}