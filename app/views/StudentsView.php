<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students - Student Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="<?php echo site_url('public/assets/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('public/assets/css/pagination-styles.css'); ?>" rel="stylesheet">
</head>
<body>
    <div class="dashboard-layout">
        <?php include('sidebar.php'); ?>
        <main class="main">
            <?php
            // Get user role from session
            $lava = lava_instance();
            $lava->call->library('session');
            $user_role = $lava->session->userdata('role');
            $is_admin = ($user_role === 'admin');
            ?>
            <h1 class="dashboard-title">
                LIST OF STUDENTS
                <?php if ($is_admin): ?>
                <a href="<?php echo site_url('students/add'); ?>" class="add-icon" title="Add New Student">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="8" x2="12" y2="16"/>
                        <line x1="8" y1="12" x2="16" y2="12"/>
                    </svg>
                </a>
                <?php endif; ?>
            </h1>
            
            <!-- Simple Search Bar -->
            <div class="search-container">
                <form action="<?php echo site_url('students/'); ?>" method="get" class="search-form">
                    <div class="search-input-container">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <input type="text" name="search" placeholder="Search students by name, course, or year..." class="search-input" value="<?php echo isset($search) ? htmlspecialchars($search) : ''; ?>">
                    </div>
                    <div class="entries-dropdown">
                        <label for="itemsPerPage">Show entries:</label>
                        <select name="show" id="itemsPerPage" class="items-per-page" onchange="this.form.submit()">
                            <option value="5" <?php echo ($records_per_page == 5) ? 'selected' : ''; ?>>5</option>
                            <option value="10" <?php echo ($records_per_page == 10) ? 'selected' : ''; ?>>10</option>
                            <option value="25" <?php echo ($records_per_page == 25) ? 'selected' : ''; ?>>25</option>
                            <option value="50" <?php echo ($records_per_page == 50) ? 'selected' : ''; ?>>50</option>
                            <option value="100" <?php echo ($records_per_page == 100) ? 'selected' : ''; ?>>100</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-search">Search</button>
                </form>
            </div>
                <?php if (!empty($students) && is_array($students)): ?>
                    <div class="table-container">
                        <table class="students-table">
                            <thead>
                                <tr>
                                    <th class="id-column">ID</th>
                                    <th class="name-column">NAME</th>
                                    <th class="course-column">COURSE</th>
                                    <th class="year-column">YEAR</th>
                                    <?php if ($is_admin): ?>
                                    <th class="action-column">ACTION</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($students as $student): ?>
                                    <tr>
                                        <td class="id-column"><?php echo htmlspecialchars($student['id']); ?></td>
                                        <td class="name-column"><?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?></td>
                                        <td class="course-column"><?php echo htmlspecialchars($student['course'] ?? 'N/A'); ?></td>
                                        <td class="year-column"><?php echo htmlspecialchars($student['year'] ?? 'N/A'); ?></td>
                                        <?php if ($is_admin): ?>
                                        <td class="action-cell">
                                            <a href="<?php echo site_url('students/edit/' . $student['id']); ?>" class="btn-edit">EDIT</a>
                                            <a href="javascript:void(0);" class="btn-delete" onclick="if(confirm('Are you sure you want to delete this student?')) window.location.href='<?php echo site_url('students/delete/' . $student['id']); ?>'">DELETE</a>
                                        </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Enhanced Pagination Controls -->
                    <div class="pagination-container">
                        <div class="pagination-info">
                            Showing <strong><?php echo $showing_start; ?></strong> to <strong><?php echo $showing_end; ?></strong> of <strong><?php echo $total_rows; ?></strong> entries
                        </div>
                        <div class="pagination-controls">
                            <?php echo $pagination; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="students-list">
                        <div class="list-header">
                            <p class="no-data">No students found. Click the "Add New Student" button to add your first student.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>