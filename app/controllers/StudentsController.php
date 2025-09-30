<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: StudentsController
 * 
 * Automatically generated via CLI.
 */
class StudentsController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->database();
        $this->call->model('StudentsModel');
        $this->call->library(['form_validation', 'auth']);
        $this->call->helper(['url', 'alert']);
    }

    public function home()
    {
        $this->call->view('home');
    }

    public function dashboard()
    {
        $this->check_auth();
        
        // Get latest 5 students for the table
        $data['students'] = $this->StudentsModel->getLatestStudents(5);
        // Get total count of all active students
        $data['total_students'] = count($this->StudentsModel->getAllStudents());
        // Get count of new students (added in the last 7 days)
        $data['new_students_count'] = $this->StudentsModel->getNewStudentsCount();
        $this->call->view('dashboard', $data);
    }

    public function index()
    {
        $this->check_auth();
        
        // Redirect to paginated students view
        redirect('students');
    }

    public function display($id){
        $this->check_auth();
        
        $student = $this->StudentsModel->getStudentById($id);
        if ($student) {
            $data['user'] = array($student);
        } else {
            $data['user'] = array();
        }
        $this->call->view('StudentsView', $data);
    }

    public function add() {
        $this->check_auth();
        
        // Check if the request is POST
        if ($this->io->method() === 'post') {
            $this->form_validation
                ->name('first_name')
                ->required()
                ->min_length(2);
                
            $this->form_validation
                ->name('last_name')
                ->required()
                ->min_length(2);

            $this->form_validation
                ->name('course')
                ->required();

            $this->form_validation
                ->name('year')
                ->required();

            $this->form_validation
                ->name('section')
                ->required();
                
            $this->form_validation
                ->name('email')
                ->required()
                ->valid_email();

            $this->form_validation
                ->name('contact');

            if ($this->form_validation->run()) {
                $first_name = $this->io->post('first_name');
                $last_name = $this->io->post('last_name');
                $course = $this->io->post('course');
                $year = $this->io->post('year');
                $section = $this->io->post('section');
                $email = $this->io->post('email');
                $contact = $this->io->post('contact');

                if ($this->StudentsModel->create($first_name, $last_name, $course, $year, $section, $email, $contact)) {
                    // success message
                    set_flash_alert('success', 'Student was added successfully!');
                    redirect('students/add');
                } else {
                    set_flash_alert('danger', 'Student was not added successfully.');
                    redirect('students/add');
                }
            } else {
                $errors = $this->form_validation->get_errors();
                $data['error'] = implode('<br>', $errors);
                $this->call->view('add_student', $data);
            }
        } else {
            // If GET request, just show the form
            $this->call->view('add_student');
        }
    }
    public function edit($id) {
        $this->check_auth();
        
        if ($this->io->method() === 'post') {
            $this->form_validation
                ->name('first_name')
                ->required()
                ->min_length(2);
                
            $this->form_validation
                ->name('last_name')
                ->required()
                ->min_length(2);
                
            $this->form_validation
                ->name('course')
                ->required();

            $this->form_validation
                ->name('year')
                ->required();

            $this->form_validation
                ->name('section')
                ->required();

            $this->form_validation
                ->name('email')
                ->required()
                ->valid_email();

            $this->form_validation
                ->name('contact')
                ->required();

            if ($this->form_validation->run()) {
                $data = array(
                    'first_name' => $this->io->post('first_name'),
                    'last_name'  => $this->io->post('last_name'),
                    'course'     => $this->io->post('course'),
                    'year'       => $this->io->post('year'),
                    'section'    => $this->io->post('section'),
                    'email'      => $this->io->post('email'),
                    'contact'    => $this->io->post('contact')
                );

                if ($this->StudentsModel->update($id, $data)) {
                    set_flash_alert('success', 'Student was updated successfully!');
                    redirect('students');
                } else {
                    set_flash_alert('danger', 'Failed to update student.');
                    redirect('students/edit/' . $id);
                }
            } else {
                $errors = $this->form_validation->get_errors();
                $data['error'] = implode('<br>', $errors);
                $data['student'] = $this->StudentsModel->getStudentById($id);
                $this->call->view('edit_student', $data);
            }
        } else {
            $data['student'] = $this->StudentsModel->getStudentById($id);
            if (!$data['student']) {
                set_flash_alert('danger', 'Student not found.');
                redirect('students');
            }
            $this->call->view('edit_student', $data);
        }
    }

    public function delete($id) {
        $this->check_auth();
        
        if ($this->StudentsModel->soft_delete($id)) {
            set_flash_alert('success', 'Student was deleted successfully!');
        } else {
            set_flash_alert('danger', 'Failed to delete student.');
        }
        redirect('students');
    }
    
    public function pagination_test() {
        $this->check_auth();
        
        // Get the current page number
        $page = 1;
        if(isset($_GET['page']) && !empty($_GET['page'])) {
            $page = (int)$this->io->get('page');
        }
        
        // Get search query if any
        $search = '';
        if(isset($_GET['search']) && !empty($_GET['search'])) {
            $search = trim($this->io->get('search'));
        }
        
        // Set records per page
        $records_per_page = 10;
        if(isset($_GET['show']) && !empty($_GET['show'])) {
            $records_per_page = (int) $this->io->get('show');
        }
        
        // Get students with pagination
        $result = $this->StudentsModel->getStudentsWithPagination($search, $records_per_page, $page);
        $data['students'] = $result['records'];
        $total_rows = $result['total_rows'];
        
        // Configure pagination
        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        
        // Set the theme and initialize
        $this->pagination->set_theme('bootstrap');
        $base_url = site_url('students/');  // Using the route we've confirmed exists
        $url_params = "?search=$search&show=$records_per_page";
        $this->pagination->initialize($total_rows, $records_per_page, $page, $base_url.$url_params);
        
        // Generate pagination links
        $data['pagination'] = $this->pagination->paginate();
        
        // Pass additional data to the view
        $data['search'] = $search;
        $data['records_per_page'] = $records_per_page;
        $data['total_rows'] = $total_rows;
        $data['current_page'] = $page;
        $data['showing_start'] = ($page - 1) * $records_per_page + 1;
        if($total_rows == 0) {
            $data['showing_start'] = 0;
        }
        $data['showing_end'] = min($page * $records_per_page, $total_rows);
        
        $this->call->view('StudentsView', $data);
    }

    // Authentication Methods
    public function register() {
        if ($this->io->method() === 'post') {
            $this->form_validation
                ->name('username')
                ->required()
                ->min_length(3);
                
            $this->form_validation
                ->name('password')
                ->required()
                ->min_length(6);

            $this->form_validation
                ->name('role')
                ->required();

            if ($this->form_validation->run()) {
                $username = $this->io->post('username');
                $password = $this->io->post('password');
                $role = $this->io->post('role');

                if ($this->auth->register($username, $password, $role)) {
                    set_flash_alert('success', 'Account created successfully! You can now login.');
                    redirect('auth/login');
                } else {
                    set_flash_alert('danger', 'Registration failed. Username might already exist.');
                    redirect('auth/register');
                }
            } else {
                $errors = $this->form_validation->get_errors();
                $data['error'] = implode('<br>', $errors);
                $this->call->view('register', $data);
            }
        } else {
            $this->call->view('register');
        }
    }

    public function login() {
        if ($this->io->method() === 'post') {
            $this->form_validation
                ->name('username')
                ->required();
                
            $this->form_validation
                ->name('password')
                ->required();

            if ($this->form_validation->run()) {
                $username = $this->io->post('username');
                $password = $this->io->post('password');

                if ($this->auth->login($username, $password)) {
                    redirect('dashboard');
                } else {
                    $data['error'] = 'Invalid username or password.';
                    $this->call->view('login', $data);
                }
            } else {
                $errors = $this->form_validation->get_errors();
                $data['error'] = implode('<br>', $errors);
                $this->call->view('login', $data);
            }
        } else {
            $this->call->view('login');
        }
    }

    public function check_auth() {
        if (!$this->auth->is_logged_in()) {
            redirect('auth/login');
        }
    }

    public function logout() {
        $this->auth->logout();
        redirect('auth/login');
    }
}