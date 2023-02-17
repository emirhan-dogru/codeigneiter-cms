<?php
class Product_image_model extends CI_Model
{
    public $tableName = "product_images";

    public function __construct()
    {
        parent::__construct();
    }

    public function get($where = [])
    {
        return $this->db->where($where)->get($this->tableName)->row();
    }

    public function get_all($where = [], $order = 'id ASC')
    {
        return $this->db->where($where)->order_by($order)->get($this->tableName)->result();
    }

    public function add($data = [])
    {
        return $this->db->insert($this->tableName, $data);
    }

    public function update($where = [], $data = [])
    {
        return $this->db->where($where)->update($this->tableName, $data);
    }

    public function delete($where = [])
    {
        return $this->db->where($where)->delete($this->tableName);
    }
}
