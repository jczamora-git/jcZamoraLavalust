<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student - Student Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="<?php echo site_url('public/assets/css/style.css'); ?>" rel="stylesheet">
</head>
<body>
    <div class="dashboard-layout">
        <?php include('sidebar.php'); ?>
        <main class="main">
            <h1 class="dashboard-title">EDIT STUDENT</h1>

            <div class="form-container">
                <form action="<?php echo site_url('students/edit/' . $student['id']); ?>" method="post">
                    <div class="form-group">
                        <label class="form-label">Firstname</label>
                        <input type="text" name="first_name" class="form-input" value="<?php echo isset($student['first_name']) ? htmlspecialchars($student['first_name']) : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Lastname</label>
                        <input type="text" name="last_name" class="form-input" value="<?php echo isset($student['last_name']) ? htmlspecialchars($student['last_name']) : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Course</label>
                        <input type="text" name="course" class="form-input" value="<?php echo isset($student['course']) ? htmlspecialchars($student['course']) : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Year</label>
                        <select name="year" class="form-input" required>
                            <option value="1st Year" <?php echo (isset($student['year']) && $student['year'] === '1st Year') ? 'selected' : ''; ?>>1st Year</option>
                            <option value="2nd Year" <?php echo (isset($student['year']) && $student['year'] === '2nd Year') ? 'selected' : ''; ?>>2nd Year</option>
                            <option value="3rd Year" <?php echo (isset($student['year']) && $student['year'] === '3rd Year') ? 'selected' : ''; ?>>3rd Year</option>
                            <option value="4th Year" <?php echo (isset($student['year']) && $student['year'] === '4th Year') ? 'selected' : ''; ?>>4th Year</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Section</label>
                        <input type="text" name="section" class="form-input" value="<?php echo isset($student['section']) ? htmlspecialchars($student['section']) : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-input" value="<?php echo isset($student['email']) ? htmlspecialchars($student['email']) : ''; ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Contact</label>
                        <input type="text" name="contact" class="form-input" value="<?php echo isset($student['contact']) ? htmlspecialchars($student['contact']) : ''; ?>" required>
                    </div>

                    <div class="buttons-container">
                        <button type="submit" class="btn btn-save">Save</button>
                        <a href="<?php echo site_url('students'); ?>" class="btn btn-cancel">Cancel</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>