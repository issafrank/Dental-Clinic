<?php
declare(strict_types=1);

namespace App\Core;

use PDO;

abstract class Model
{
    protected string $table = '';
    protected string $primaryKey = 'id';

    protected function db(): PDO
    {
        return Database::connection();
    }

    public function all(string $orderBy = 'id', string $dir = 'DESC'): array
    {
        $stmt = $this->db()->query("SELECT * FROM {$this->table} ORDER BY {$orderBy} {$dir}");
        return $stmt->fetchAll() ?: [];
    }

    public function find(int|string $id): ?array
    {
        $stmt = $this->db()->prepare("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }

    public function where(string $col, $value): array
    {
        $stmt = $this->db()->prepare("SELECT * FROM {$this->table} WHERE {$col} = :v");
        $stmt->execute(['v' => $value]);
        return $stmt->fetchAll() ?: [];
    }

    public function create(array $data): int
    {
        $cols = array_keys($data);
        $placeholders = array_map(fn($c) => ":$c", $cols);
        $sql = "INSERT INTO {$this->table} (" . implode(',', $cols) . ") VALUES (" . implode(',', $placeholders) . ")";
        $stmt = $this->db()->prepare($sql);
        $stmt->execute($data);
        return (int) $this->db()->lastInsertId();
    }

    public function update(int|string $id, array $data): bool
    {
        $set = implode(', ', array_map(fn($c) => "$c = :$c", array_keys($data)));
        $sql = "UPDATE {$this->table} SET {$set} WHERE {$this->primaryKey} = :_id";
        $stmt = $this->db()->prepare($sql);
        $data['_id'] = $id;
        return $stmt->execute($data);
    }

    public function delete(int|string $id): bool
    {
        $stmt = $this->db()->prepare("DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id");
        return $stmt->execute(['id' => $id]);
    }
}
