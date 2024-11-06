<?php

namespace App\Models\Generator;

use CodeIgniter\Model;
use Config\Database;

class Generator extends Model
{
    protected $DBGroup          = 'default';
  
    public function getDatabaseNames()
    {
      
        // Jalankan query SQL untuk mendapatkan daftar nama database
        $query =  $this->db->query('SHOW DATABASES');

        $databases = $query->getResultArray();

        return  $databases ;
    }

    public function getTableNames($database)
    {
        // Menggunakan konfigurasi database default
        $db = Database::connect();
        // Jalankan query SQL untuk mendapatkan daftar nama database
        $query =  $this->db->query("SHOW TABLES  FROM $database");

        $tables = $query->getResultArray();
         // Ekstrak nama-nama tabel dari hasil query
        $tableNames = array_column($tables, "Tables_in_$database");

        return  $tableNames ;
    }

    public function getPrimaryKey($tableName)
    {
    
        // Jalankan query SQL untuk mendapatkan primary key
        $query = $this->db->query("SHOW KEYS FROM $tableName WHERE Key_name = 'PRIMARY'");

        $primaryKey = $query->getResultArray();

        // Jika ada primary key, ambil nama kolomnya
        if (!empty($primaryKey)) {
            $primaryKeyColumnName = $primaryKey[0]['Column_name'];
            return $primaryKeyColumnName;
        } else {
            return null; // Tidak ada primary key
        }
       
    }
    public function getTableColumns($tableName)
    {
       
        
        // Ambil informasi skema tabel dari database
        $fields = $this->db->getFieldData($tableName);

        // Ekstrak nama kolom dari informasi skema
        $columnNames = [];
        foreach ($fields as $field) {
            $columnNames[] = $field->name;
        }

        return $columnNames;
    }
}
