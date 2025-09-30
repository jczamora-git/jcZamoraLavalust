<?php
/**
 * Simple .env file loader for LavaLust
 */
function load_env($file_path) {
    if (!file_exists($file_path)) {
        return false;
    }
    
    $lines = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue; // Skip comments
        }
        
        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);
        
        if (!array_key_exists($key, $_ENV)) {
            $_ENV[$key] = $value;
        }
    }
    
    return true;
}

function env($key, $default = null) {
    return isset($_ENV[$key]) ? $_ENV[$key] : $default;
}
?>