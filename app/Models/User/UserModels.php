<?php

namespace App\Models\User;

use CodeIgniter\Model;

class UserModels extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tb_users';
    protected $primaryKey       = 'user_id';
    protected $allowedFields    = [ 'nama', 'username','password','role','sts_aktif','akses_menu','email','akses_tombol','dashboard','unit','bagian','locked_until'];

    // Aturan validasi
    protected $validationRules = [
        'username' => [
            'rules' => 'required|is_unique[tb_users.username,user_id,{user_id}]',
            'errors' => [
                'required' => 'Username wajib diisi.',
                'is_unique' => 'Username sudah tersedia, silakan gunakan username yang lain.',
            ],
        ],
        'email' => [
            'rules' => 'required|valid_email|is_unique[tb_users.email,user_id,{user_id}]',
            'errors' => [
                'required' => 'Email wajib diisi.',
                'valid_email' => 'Masukkan email yang valid.',
                'is_unique' => 'Email sudah tersedia, silakan gunakan email yang lain.',
            ],
        ],
        'nama' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama lengkap wajib diisi.',
            ],
        ],
        'password' => [
            'rules' => 'permit_empty|min_length[8]',
            'errors' => [
                
                'min_length'  => 'Password minimal 8 karakter.'
            ],
        ],
        'role' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Role wajib dipilih.',
            ],
        ],
        'dashboard' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Dashboard wajib diisi.',
            ],
        ],
    ];
      protected $validationMessages   = [];
      protected $skipValidation       = false;
     // protected $cleanValidationRules = true;

     // Menambahkan event untuk hashing password
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    // Callback untuk hashing password
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'],  PASSWORD_BCRYPT);
        }
        return $data;
    }


    public function getData($perPage, $start, $search = '')
    {
	
        $builder = $this->table($this->table)->where(['role !=' => 'super admin']);
			 
        if (!empty($search)) {
            $builder->like('nama', $search)
                ->orLike('username', $search);        
            // ...
        }

        $builder->limit($perPage, $start);
        $query = $builder->get();
        return $query->getResult();
    }

    public function getDataCount($search = '')
    {	
        $builder = $this->table($this->table)->where(['role !=' => 'super admin']);
        if (!empty($search)) {
            $builder->like('nama', $search)
                ->orLike('username', $search);
        }
        return $builder->countAllResults();
    }
  
}
