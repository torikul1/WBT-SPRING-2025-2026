<?php
// ================================================================
// CONTROLLERS - request handling + role-based logic
// ================================================================

/* ============== Login ============== */
function loginCtrl($conn) {
    $error = '';
    $prefill = $_COOKIE['remember_user'] ?? '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $u = trim($_POST['username'] ?? '');
        $p = $_POST['password'] ?? '';
        $remember = isset($_POST['remember']);

        if ($u === '' || $p === '') {
            $error = 'Please fill in both fields.';
        } else {
            // Try admin first
            $admin = authAdmin($conn, $u, $p);
            if ($admin) {
                $_SESSION['user'] = [
                    'id' => $admin['id'], 'username' => $admin['username'],
                    'name' => 'Administrator', 'role' => 'admin'
                ];
                if ($remember) setcookie('remember_user', $u, time() + 86400 * 30, '/');
                else setcookie('remember_user', '', time() - 3600, '/');
                header('Location: index.php?page=admin');
                exit;
            }
            // Then librarian
            $lib = authLibrarian($conn, $u, $p);
            if ($lib) {
                $_SESSION['user'] = [
                    'id' => $lib['id'], 'username' => $lib['username'],
                    'name' => $lib['name'], 'role' => 'librarian'
                ];
                if ($remember) setcookie('remember_user', $u, time() + 86400 * 30, '/');
                else setcookie('remember_user', '', time() - 3600, '/');
                header('Location: index.php?page=librarian');
                exit;
            }
            $error = 'Invalid username or password.';
        }
    }

    require 'views/login.php';
}

/* ============== Register (librarian self-registration) ============== */
function registerCtrl($conn) {
    $error = $success = '';
    $old = ['name' => '', 'contact' => '', 'username' => ''];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name     = trim($_POST['name'] ?? '');
        $contact  = trim($_POST['contact'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm  = $_POST['confirm_password'] ?? '';
        $old = compact('name', 'contact', 'username');

        if ($name === '' || $contact === '' || $username === '' || $password === '') {
            $error = 'All fields are required.';
        } elseif (strlen($password) < 6) {
            $error = 'Password must be at least 6 characters.';
        } elseif ($password !== $confirm) {
            $error = 'Passwords do not match.';
        } elseif (librarianUsernameExists($conn, $username)) {
            $error = 'Username is already taken.';
        } else {
            if (addLibrarian($conn, $name, $contact, $username, $password)) {
                $success = 'Account created! You can now log in.';
                $old = ['name' => '', 'contact' => '', 'username' => ''];
            } else {
                $error = 'Registration failed. Try again.';
            }
        }
    }

    require 'views/register.php';
}

/* ============== Admin Dashboard (manages librarians) ============== */
function adminCtrl($conn) {
    $action = $_GET['action'] ?? 'list';
    $error = '';
    $editing = null;  // when set, view shows Edit form instead of Add form

    /* --- Add (POST) --- */
    if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $name     = trim($_POST['name'] ?? '');
        $contact  = trim($_POST['contact'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($name === '' || $contact === '' || $username === '' || $password === '') {
            $error = 'All fields are required.';
        } elseif (strlen($password) < 6) {
            $error = 'Password must be at least 6 characters.';
        } elseif (librarianUsernameExists($conn, $username)) {
            $error = 'Username is already taken.';
        } else {
            if (addLibrarian($conn, $name, $contact, $username, $password)) {
                header('Location: index.php?page=admin&msg=added');
                exit;
            }
            $error = 'Failed to add librarian.';
        }
    }

    /* --- Update (POST) --- */
    if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $id       = intval($_GET['id'] ?? 0);
        $name     = trim($_POST['name'] ?? '');
        $contact  = trim($_POST['contact'] ?? '');
        $username = trim($_POST['username'] ?? '');

        // ===== NULL VALIDATION on UPDATE =====
        if ($name === '' || $contact === '' || $username === '') {
            $error = 'No field can be empty (NULL). All fields are required.';
            $editing = ['id' => $id, 'name' => $name, 'contact' => $contact, 'username' => $username];
        } elseif (librarianUsernameExists($conn, $username, $id)) {
            $error = 'That username is used by another librarian.';
            $editing = ['id' => $id, 'name' => $name, 'contact' => $contact, 'username' => $username];
        } else {
            if (updateLibrarian($conn, $id, $name, $contact, $username)) {
                header('Location: index.php?page=admin&msg=updated');
                exit;
            }
            $error = 'Update failed.';
            $editing = ['id' => $id, 'name' => $name, 'contact' => $contact, 'username' => $username];
        }
    }

    /* --- Show edit form (GET) --- */
    if ($action === 'edit' && !$editing) {
        $id = intval($_GET['id'] ?? 0);
        $editing = getLibrarian($conn, $id);
    }

    /* --- Delete (GET) --- */
    if ($action === 'delete') {
        $id = intval($_GET['id'] ?? 0);
        if ($id > 0) deleteLibrarian($conn, $id);
        header('Location: index.php?page=admin&msg=deleted');
        exit;
    }

    $librarians = getLibrarians($conn);
    require 'views/admin.php';
}

/* ============== Librarian Dashboard (manages books) ============== */
function librarianCtrl($conn) {
    $action = $_GET['action'] ?? 'list';
    $error = '';
    $editing = null;

    /* --- Add (POST) --- */
    if ($action === 'add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $title    = trim($_POST['title'] ?? '');
        $author   = trim($_POST['author'] ?? '');
        $quantity = trim($_POST['quantity'] ?? '');
        $price    = trim($_POST['price'] ?? '');

        if ($title === '' || $author === '' || $quantity === '' || $price === '') {
            $error = 'All fields are required.';
        } elseif (!ctype_digit($quantity) || intval($quantity) < 0) {
            $error = 'Quantity must be a non-negative whole number.';
        } elseif (!is_numeric($price) || floatval($price) < 0) {
            $error = 'Price must be a non-negative number.';
        } else {
            $libId = $_SESSION['user']['id'];
            if (addBook($conn, $title, $author, intval($quantity), floatval($price), $libId)) {
                header('Location: index.php?page=librarian&msg=added');
                exit;
            }
            $error = 'Failed to add book.';
        }
    }

    /* --- Update (POST) --- */
    if ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $id       = intval($_GET['id'] ?? 0);
        $title    = trim($_POST['title'] ?? '');
        $author   = trim($_POST['author'] ?? '');
        $quantity = trim($_POST['quantity'] ?? '');
        $price    = trim($_POST['price'] ?? '');

        // ===== NULL VALIDATION on UPDATE =====
        if ($title === '' || $author === '' || $quantity === '' || $price === '') {
            $error = 'No field can be empty (NULL). All fields are required.';
            $editing = ['id' => $id, 'title' => $title, 'author' => $author,
                        'quantity' => $quantity, 'price' => $price];
        } elseif (!ctype_digit($quantity) || intval($quantity) < 0) {
            $error = 'Quantity must be a non-negative whole number.';
            $editing = ['id' => $id, 'title' => $title, 'author' => $author,
                        'quantity' => $quantity, 'price' => $price];
        } elseif (!is_numeric($price) || floatval($price) < 0) {
            $error = 'Price must be a non-negative number.';
            $editing = ['id' => $id, 'title' => $title, 'author' => $author,
                        'quantity' => $quantity, 'price' => $price];
        } else {
            if (updateBook($conn, $id, $title, $author, intval($quantity), floatval($price))) {
                header('Location: index.php?page=librarian&msg=updated');
                exit;
            }
            $error = 'Update failed.';
            $editing = ['id' => $id, 'title' => $title, 'author' => $author,
                        'quantity' => $quantity, 'price' => $price];
        }
    }

    /* --- Show edit form --- */
    if ($action === 'edit' && !$editing) {
        $id = intval($_GET['id'] ?? 0);
        $editing = getBook($conn, $id);
    }

    /* --- Delete --- */
    if ($action === 'delete') {
        $id = intval($_GET['id'] ?? 0);
        if ($id > 0) deleteBook($conn, $id);
        header('Location: index.php?page=librarian&msg=deleted');
        exit;
    }

    $books = getBooks($conn);
    require 'views/librarian.php';
}
?>
