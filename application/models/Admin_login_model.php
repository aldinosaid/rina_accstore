<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
* Class for registration model
*/
class Admin_login_model extends CI_Model
{
    
    public function getAdminLoginById($id = '')
    {
        return $this->db
                ->where('id', $id)
                ->get('admin_login')
                ->result();
    }

    public function add($data)
    {
        return $this->db
                    ->insert('admin_login', $data);
    }

    public function update($args, $id)
    {
        return $this->db
                    ->update('admin_login', $args, array('id' => $id));
    }

    public function getAllAdminLogin()
    {
        return $this->db
                    ->select('*')
                    ->from('admin_login')
                    ->get()
                    ->result();
    }

    public function checkUser($email, $password)
    {
        $data = [
            'email' => $email,
            'pass' => sha1(trim($password))
        ];
        $query = $this->db
                    ->where($data)
                    ->get('admin_login');

        if ($user = $query->row()) {
            set_session('user_id', $user->id);
            set_session('username', $user->name);
            set_session('email', $email);
            set_session('level', $user->level);
            return true;
        } else {
            return false;
        }
    }
}
