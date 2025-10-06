<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Student Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="<?php echo site_url('public/assets/css/style.css'); ?>" rel="stylesheet">
</head>
<body>
    <div class="dashboard-layout">
        <?php include('sidebar.php'); ?>

        <main class="main-content">
            <h1 class="page-header">DASHBOARD</h1>
            
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-title">TOTAL STUDENTS</div>
                    <div class="stat-value"><?php echo isset($total_students) ? $total_students : 0; ?> <?php echo (isset($total_students) && $total_students == 1) ? 'Student' : 'Students'; ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">NEW STUDENTS</div>
                    <div class="stat-value"><?php echo isset($new_students_count) ? $new_students_count : 0; ?> <?php echo (isset($new_students_count) && $new_students_count == 1) ? 'Student' : 'Students'; ?></div>
                </div>
            </div>

            <div class="students-list">
                <div class="list-header">
                    <h2 class="list-title">LIST OF STUDENTS</h2>
                </div>
                <table class="students-table">
                    <thead>
                        <tr>
                            <th>NAME</th>
                            <th>COURSE</th>
                            <th>YEAR</th>
                            <th>SECTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($students)): ?>
                            <?php foreach ($students as $student): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?></td>
                                    <td><?php echo htmlspecialchars($student['course'] ?? 'N/A'); ?></td>
                                    <td><?php echo htmlspecialchars($student['year'] ?? 'N/A'); ?></td>
                                    <td><?php echo htmlspecialchars($student['section'] ?? 'N/A'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" style="text-align: center;">No students found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <?php if (isset($total_students) && $total_students > 5): ?>
                <div class="view-all-container">
                    <a href="<?php echo site_url('students'); ?>" class="view-all-btn">View All Students (<?php echo $total_students; ?>)</a>
                </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</body>
</html>
