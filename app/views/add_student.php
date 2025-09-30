<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student - Student Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="<?php echo site_url('public/assets/css/style.css'); ?>" rel="stylesheet">


</head>
<body>
    <div class="dashboard-layout">
        <?php include('sidebar.php'); ?>
        <main class="main">
            <h1 class="dashboard-title">ADD STUDENT</h1>

            <div class="form-container">
                <?php flash_alert(); ?>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>

                <form action="<?php echo site_url('students/add'); ?>" method="post">
                    <div class="form-group">
                        <label class="form-label">Firstname</label>
                        <input type="text" name="first_name" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Lastname</label>
                        <input type="text" name="last_name" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Course</label>
                        <input type="text" name="course" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Year</label>
                        <select name="year" class="form-input" required>
                            <option value="1st Year">1st Year</option>
                            <option value="2nd Year">2nd Year</option>
                            <option value="3rd Year">3rd Year</option>
                            <option value="4th Year">4th Year</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Section</label>
                        <input type="text" name="section" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-input" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Contact</label>
                        <input type="text" name="contact" class="form-input" required>
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