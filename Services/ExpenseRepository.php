<?php

namespace Services;

use Core\App;
use Core\Database;
use Core\Response;

class ExpenseRepository
{
    public Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function create($date, $category, $cost, $description)
    {
        $db = App::resolve(Database::class);

        $userId = 1;
        $user = $db->query("SELECT * FROM users WHERE id = :id", [
            'id' => $userId
        ])->find();

        authorize($user === null, Response::UNAUTHORIZED); // fix: check not found

        $query = "INSERT INTO expenses (date, category_id, cost, description)
                  VALUES (:date, :category_id, :cost, :description)";

        $db->query($query, [
            ':date'          => $date,
            ':category_id' => $category,
            ':cost'          => $cost,
            ':description'   => $description
        ]);

        return true; // fix: return so the controller can redirect
    }

    public function all(): array
    {
        return $this->db->query(
            "SELECT expenses.*, categories.category_name
             FROM expenses
             JOIN categories ON expenses.category_id = categories.id"
        )->findAll();
    }

    public function allcategories()
    {
        return $this->db->query("SELECT * FROM categories")->findAll();
    }

    public function update($id, $data)
    {
        return $this->db->query("UPDATE expenses SET date = :date, category_id = :category_id, cost = :cost, description = :description WHERE id = :id", [
            'id'            => $id,
            'date'          => $_POST['date'],
            'category_id' => $_POST['category_id'],
            'cost'          => $_POST['cost'],
            'description'   => $_POST['description'],
        ]);
    }

    public function delete($id)
    {
        $this->db->query("DELETE FROM expenses WHERE id =:id", [
            'id' => $id
        ]);
    }
}
