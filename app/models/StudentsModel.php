<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: StudentsModel
 * 
 * Automatically generated via CLI.
 */
class StudentsModel extends Model {
    protected $table = 'profile';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    public function create($first_name, $last_name, $course, $year, $section, $email, $contact) {
        $data = array(
            'first_name' => $first_name,
            'last_name'  => $last_name,
            'course'     => $course,
            'year'       => $year,
            'section'    => $section,
            'email'      => $email,
            'contact'    => $contact
        );
        
        return $this->db->table($this->table)->insert($data);
    }

    public function update($id, $data) {
        return $this->db->table($this->table)
                       ->where('id', $id)
                       ->update($data);
    }

    public function delete($id) {
        return $this->db->table($this->table)
                       ->soft_delete($id);
    }

    public function getAllStudents()
    {
        return $this->db->table($this->table)->where_null('deleted_at')->get_all();
    }

    public function getStudentById($id)
    {
        return $this->db->table($this->table)
                       ->where('id', $id)
                       ->get();
    }

    public function getNewStudentsCount()
    {
        date_default_timezone_set('Asia/Manila');
        $today_start = date('Y-m-d 00:00:00');
        $today_end = date('Y-m-d 23:59:59');

        $result = $this->db->table($this->table)
                ->between('created_at', $today_start, $today_end)
                ->where_null('deleted_at')
                ->get_all();
        return count($result);
    }

    public function getLatestStudents($limit = 5)
    {
        return $this->db->table($this->table)
                       ->where_null('deleted_at')
                       ->order_by('created_at', 'DESC')
                       ->limit($limit)
                       ->get_all();
    }

    public function getStudentsWithPagination($search = '', $per_page = 10, $page = 1)
    {
        // Create the base query
        $query = $this->db->table($this->table)->where_null('deleted_at');
        
        // Apply search filter if provided
        if (!empty($search)) {
            $query->like('id', '%'.$search.'%')
                  ->or_like('first_name', '%'.$search.'%')
                  ->or_like('last_name', '%'.$search.'%')
                  ->or_like('course', '%'.$search.'%')
                  ->or_like('year', '%'.$search.'%')
                  ->or_like('section', '%'.$search.'%')
                  ->or_like('email', '%'.$search.'%');
        }
        
        // Clone the query before pagination to get total count
        $countQuery = clone $query;
        
        // Get total records for pagination
        $total_rows = $countQuery->select_count('*', 'count')->get()['count'];
        
        // Get paginated records
        $records = $query->order_by('id', 'ASC')
                         ->pagination($per_page, $page)
                         ->get_all();
        
        return [
            'records' => $records,
            'total_rows' => $total_rows
        ];
    }
}