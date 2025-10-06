<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archived Students - Student Management System</title>
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
            <h1 class="dashboard-title">ARCHIVED STUDENTS</h1>

            <?php flash_alert(); ?>

            <!-- Search Container -->
            <div class="search-container">
                <form action="<?php echo site_url('students/archived'); ?>" method="get" class="search-form">
                    <div class="search-input-container">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        <input type="text" name="search" placeholder="Search archived students..." class="search-input" value="<?php echo isset($search) ? htmlspecialchars($search) : ''; ?>">
                    </div>
                    <div class="entries-dropdown">
                        <label for="itemsPerPage">Show entries:</label>
                        <select name="show" id="itemsPerPage" class="items-per-page" onchange="this.form.submit()">
                            <option value="10" <?php echo (isset($records_per_page) && $records_per_page == 10) ? 'selected' : ''; ?>>10</option>
                            <option value="25" <?php echo (isset($records_per_page) && $records_per_page == 25) ? 'selected' : ''; ?>>25</option>
                            <option value="50" <?php echo (isset($records_per_page) && $records_per_page == 50) ? 'selected' : ''; ?>>50</option>
                            <option value="100" <?php echo (isset($records_per_page) && $records_per_page == 100) ? 'selected' : ''; ?>>100</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-search">Search</button>
                </form>
            </div>

            <!-- Students Table -->
            <div class="table-container">
                <table class="students-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>FIRST NAME</th>
                            <th>LAST NAME</th>
                            <th>COURSE</th>
                            <th>YEAR</th>
                            <th>SECTION</th>
                            <th>EMAIL</th>
                            <th>DELETED AT</th>
                            <?php if ($is_admin): ?>
                            <th>ACTION</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($students)): ?>
                            <?php foreach ($students as $student): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($student['id']); ?></td>
                                    <td><?php echo htmlspecialchars($student['first_name']); ?></td>
                                    <td><?php echo htmlspecialchars($student['last_name']); ?></td>
                                    <td><?php echo htmlspecialchars($student['course'] ?? 'N/A'); ?></td>
                                    <td><?php echo htmlspecialchars($student['year'] ?? 'N/A'); ?></td>
                                    <td><?php echo htmlspecialchars($student['section'] ?? 'N/A'); ?></td>
                                    <td><?php echo htmlspecialchars($student['email'] ?? 'N/A'); ?></td>
                                    <td>
                                        <?php 
                                        if (!empty($student['deleted_at'])) {
                                            // Convert to PH time for display
                                            $deleted_ph = date('M d, Y h:i A', strtotime($student['deleted_at'] . ' +8 hours'));
                                            echo htmlspecialchars($deleted_ph);
                                        } else {
                                            echo 'N/A';
                                        }
                                        ?>
                                    </td>
                                    <?php if ($is_admin): ?>
                                    <td>
                                        <a href="<?php echo site_url('students/restore/' . $student['id']); ?>" 
                                           class="btn-restore" 
                                           onclick="return confirm('Are you sure you want to restore this student?');"
                                           title="Restore student">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"></path>
                                                <path d="M21 3v5h-5"></path>
                                                <path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"></path>
                                                <path d="M3 21v-5h5"></path>
                                            </svg>
                                            Restore
                                        </a>
                                    </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="<?php echo $is_admin ? '9' : '8'; ?>" style="text-align: center; padding: 2rem;">
                                    <div style="color: rgba(255, 255, 255, 0.5);">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="margin-bottom: 1rem; opacity: 0.3;">
                                            <polyline points="21 8 21 21 3 21 3 8"></polyline>
                                            <rect x="1" y="3" width="22" height="5"></rect>
                                            <line x1="10" y1="12" x2="14" y2="12"></line>
                                        </svg>
                                        <p style="font-size: 1.1rem; margin: 0;">No archived students found</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if (!empty($students) && isset($pagination)): ?>
            <div class="pagination-container">
                <div class="pagination-info">
                    Showing <strong><?php echo $showing_start; ?></strong> to <strong><?php echo $showing_end; ?></strong> of <strong><?php echo $total_rows; ?></strong> entries
                </div>
                <div class="pagination-controls">
                    <?php echo $pagination; ?>
                </div>
            </div>
            <?php endif; ?>
        </main>
    </div>

    <style>
    .btn-restore {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 1rem;
        background: linear-gradient(135deg, rgba(74, 255, 136, 0.15), rgba(74, 255, 136, 0.08));
        color: var(--neon-green);
        border: 1px solid rgba(74, 255, 136, 0.3);
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-restore:hover {
        background: linear-gradient(135deg, rgba(74, 255, 136, 0.25), rgba(74, 255, 136, 0.15));
        border-color: var(--neon-green);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(74, 255, 136, 0.3);
    }

    .btn-restore svg {
        width: 16px;
        height: 16px;
    }
    </style>
</body>
</html>
