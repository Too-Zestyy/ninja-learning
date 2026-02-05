<?php

const JOKE_PAGE_SIZE = 12;

function get_joke_page(PDO $pdo, int $page = 1) {
    if ($page < 1) {
        throw new ValueError("page number must be at least 1");
    }

    $offset = JOKE_PAGE_SIZE * ($page - 1);

    $stmt = $pdo->prepare("SELECT id, setup, punchline FROM jokes LIMIT :page_count OFFSET :query_offset");
    $stmt->bindValue(":page_count", JOKE_PAGE_SIZE, PDO::PARAM_INT);
    $stmt->bindValue(":query_offset", $offset, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function get_joke_page_count(PDO $pdo): int {
    $count = $pdo->query("SELECT COUNT(*) FROM jokes")->fetchColumn();

    return ceil($count / JOKE_PAGE_SIZE);
}