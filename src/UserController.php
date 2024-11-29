<?php
class UserController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function updateUser($params) {
        $id = $params['id'] ?? null;
    
        if (!$id) {
            throw new Exception("ID пользователя обязателен");
        }
    
        // Проверяем, существует ли пользователь
        $query = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $query->execute(['id' => $id]);
        if (!$query->fetch()) {
            throw new Exception("Пользователь с ID $id не найден");
        }
    
        // Разрешенные поля для обновления
        $allowedFields = ['name', 'email'];
        $fields = [];
        $values = ['id' => $id];
    
        // Отбираем только допустимые параметры
        foreach ($allowedFields as $field) {
            if (isset($params[$field])) {
                $fields[] = "$field = :$field";
                $values[$field] = $params[$field];
            }
        }
    
        if (empty($fields)) {
            throw new Exception("Нет данных для обновления");
        }
    
        // Формируем SQL-запрос
        $sql = "UPDATE users SET " . implode(', ', $fields) . " WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute($values);
    
        return "Пользователь с ID $id обновлен";
    }

    public function deleteUser($params) {
        $id = $params['id'] ?? null;
        if (!$id) {
            throw new Exception("ID пользователя обязателен");
        }

        $query = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $query->execute(['id' => $id]);
        if (!$query->fetch()) {
            throw new Exception("Пользователь с ID $id не найден");
        }

        $query = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $query->execute(['id' => $id]);

        return "Пользователь с ID $id удален";
    }
}
