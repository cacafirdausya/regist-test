<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class DbService
{
    protected $connection;

    public function __construct()
    {
        $this->connection = DB::connection('mysql');
    }

    public function getAll($tableName)
    {
        return $this->connection->table($tableName)->get();
    }

    public function getById($tableName, $id)
    {
        return $this->connection->table($tableName)->where('id', $id)->first();
    }

    public function getByEmailUsername($tableName, $item)
    {
        return $this->connection->table($tableName)->where('email', $item)
            ->orWhere('username', $item)
            ->first();
    }

    public function createData($tableName, $data)
    {
        return $this->connection->table($tableName)->insert($data);
    }

    public function updateData($tableName, $id, $data)
    {
        return $this->connection->table($tableName)->where('id', $id)->update($data);
    }

    public function deleteData($tableName, $id)
    {
        return $this->connection->table($tableName)->where('id', $id)->delete();
    }
}
