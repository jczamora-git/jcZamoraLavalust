<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<aside class="sidebar">
    <a href="<?php echo site_url(''); ?>" class="logo-container">
        <img src="<?php echo base_url(); ?>/public/assets/images/logo.png" alt="Logo">
        <span class="brand">Student Management System</span>
    </a>
    <nav class="nav-links">
        <a href="<?php echo site_url('dashboard'); ?>" class="nav-link <?php echo ($current_page === 'dashboard') ? 'active' : ''; ?>">DASHBOARD</a>
        <a href="<?php echo site_url('students'); ?>" class="nav-link <?php echo ($current_page === 'students') ? 'active' : ''; ?>">STUDENTS</a>
        <a href="<?php echo site_url('auth/logout'); ?>" class="nav-link" style="margin-top: auto; color: var(--danger-color);">LOGOUT</a>
    </nav>
</aside>
