<?php

class Template {
    private $role;

    public function __construct($role) {
        $this->role = $role;
    }

    public function renderHeader() {
        // Include common header content
        include 'common_header.php';

        // Include role-specific header content
        if ($this->role === 'admin') {
            include 'admin_header.php';
        } else {
            include 'user_header.php';
        }
    }

    public function renderMenu() {
        // Include common menu content
        include 'common_menu.php';

        // Include role-specific menu content
        if ($this->role === 'admin') {
            include 'admin_menu.php';
        } else {
            include 'user_menu.php';
        }
    }

    public function renderFooter() {
        // Include common footer content
        include 'common_footer.php';

        // Include role-specific footer content
        if ($this->role === 'admin') {
            include 'admin_footer.php';
        } else {
            include 'user_footer.php';
        }
    }
}

?>