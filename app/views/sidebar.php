<?php
$current_page = basename($_SERVER['PHP_SELF']);
// Get user information from session
$lava = lava_instance();
$lava->call->library('session');
$username = $lava->session->userdata('username');
$user_role = $lava->session->userdata('role');
$is_admin = ($user_role === 'admin');
?>
<style>
.sidebar {
    background: linear-gradient(180deg, #1a1a1a 0%, #0d0d0d 100%);
    border-right: 1px solid rgba(74, 255, 136, 0.1);
}

.user-profile-card {
    background: linear-gradient(135deg, rgba(74, 255, 136, 0.1) 0%, rgba(74, 255, 136, 0.05) 100%);
    border: 1px solid rgba(74, 255, 136, 0.2);
    border-radius: 12px;
    padding: 1.25rem;
    margin: 1.5rem 1rem;
    position: relative;
    overflow: hidden;
}

.user-profile-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--neon-green), #3de673);
}

.user-avatar {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--neon-green), #3de673);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 0.75rem;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--dark-bg);
    box-shadow: 0 4px 12px rgba(74, 255, 136, 0.3);
}

.user-info-label {
    color: rgba(255, 255, 255, 0.5);
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.35rem;
    font-weight: 500;
}

.user-name {
    color: var(--neon-green);
    font-size: 1.1rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 0.75rem;
    text-shadow: 0 0 10px rgba(74, 255, 136, 0.3);
}

.role-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.5rem 1rem;
    background: #0d0d0d;
    color: var(--neon-green);
    font-size: 0.75rem;
    font-weight: 800;
    border-radius: 20px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: 1px solid rgba(74, 255, 136, 0.3);
    width: 100%;
    justify-content: center;
}

.role-badge svg {
    width: 14px;
    height: 14px;
}

.nav-links {
    padding: 0 1rem;
}

.nav-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.875rem 1rem;
    margin-bottom: 0.5rem;
    border-radius: 10px;
    transition: all 0.3s ease;
    font-weight: 600;
    font-size: 0.9rem;
    letter-spacing: 0.3px;
}

.nav-link svg {
    width: 20px;
    height: 20px;
    flex-shrink: 0;
}

.nav-link:hover {
    background: rgba(74, 255, 136, 0.1);
    transform: translateX(5px);
}

.nav-link.active {
    background: linear-gradient(90deg, rgba(74, 255, 136, 0.15), rgba(74, 255, 136, 0.05));
    border-left: 3px solid var(--neon-green);
    color: var(--neon-green);
}

.logout-link {
    margin-top: auto;
    background: rgba(255, 74, 74, 0.1);
    border: 1px solid rgba(255, 74, 74, 0.2);
}

.logout-link:hover {
    background: rgba(255, 74, 74, 0.2);
    transform: translateX(5px);
}

.nav-divider {
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(74, 255, 136, 0.2), transparent);
    margin: 1rem 1rem;
}
</style>

<aside class="sidebar">
    
    <!-- Enhanced User Profile Card -->
    <div class="user-profile-card">
        <div class="user-avatar">
            <?php echo strtoupper(substr($username, 0, 1)); ?>
        </div>
        <div class="user-name"><?php echo htmlspecialchars($username); ?></div>
        <div class="role-badge">
            <?php if ($is_admin): ?>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V9.99h7V3.66l5 2.5v3.83h-5v3z"/>
                </svg>
            <?php else: ?>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            <?php endif; ?>
            <?php echo htmlspecialchars($user_role); ?>
        </div>
    </div>
    
    <div class="nav-divider"></div>
    
    <nav class="nav-links">
        <a href="<?php echo site_url('dashboard'); ?>" class="nav-link <?php echo ($current_page === 'dashboard') ? 'active' : ''; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="7" height="7"></rect>
                <rect x="14" y="3" width="7" height="7"></rect>
                <rect x="14" y="14" width="7" height="7"></rect>
                <rect x="3" y="14" width="7" height="7"></rect>
            </svg>
            DASHBOARD
        </a>
        <a href="<?php echo site_url('students'); ?>" class="nav-link <?php echo ($current_page === 'students') ? 'active' : ''; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            STUDENTS
        </a>
        <?php if ($is_admin): ?>
        <a href="<?php echo site_url('students/archived'); ?>" class="nav-link <?php echo ($current_page === 'archived') ? 'active' : ''; ?>">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="21 8 21 21 3 21 3 8"></polyline>
                <rect x="1" y="3" width="22" height="5"></rect>
                <line x1="10" y1="12" x2="14" y2="12"></line>
            </svg>
            ARCHIVED STUDENTS
        </a>
        <?php endif; ?>
        
        <div class="nav-divider"></div>
        
        <a href="<?php echo site_url('auth/logout'); ?>" class="nav-link logout-link">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                <polyline points="16 17 21 12 16 7"></polyline>
                <line x1="21" y1="12" x2="9" y2="12"></line>
            </svg>
            LOGOUT
        </a>
    </nav>
</aside>
