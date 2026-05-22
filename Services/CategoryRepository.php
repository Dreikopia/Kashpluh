<?php

namespace Services;

use Core\App;
use Core\Database;

class CategoryRepository
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function all()
    {
        return $this->db->query("SELECT * FROM categories")->findAll();
    }
}
