<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];
    $admin_code = $_POST['admin_code'];

    $correct_admin_code = "GHBADMIN123";

    if ($password != $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        if ($role == "admin" && $admin_code != $correct_admin_code) {
            $error = "Invalid admin code.";
        } else {
            $sql = "INSERT INTO users (first_name, last_name, email, password, role, loyalty_points)
                    VALUES ('$first_name', '$last_name', '$email', '$password', '$role', 0)";

            if (mysqli_query($conn, $sql)) {
                header("Location: login.php");
                exit();
            } else {
                $error = "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>

<?php include 'nav.php'; ?>

<section class="auth-page">
    <div class="auth-box">
        <h1>Create an Account</h1>
        <p class="auth-subtext">
            Join GHB to shop fresh local produce from trusted producers.
            Already have an account? <a href="login.php">Log In</a>
        </p>

        <?php if (isset($error)) { echo "<p class='error-message'>$error</p>"; } ?>

        <form action="" method="POST" class="auth-form">
            <input type="text" name="first_name" placeholder="First Name" required>
            <input type="text" name="last_name" placeholder="Last Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>

            <select name="role" id="role" required onchange="toggleAdminCode()">
                <option value="customer">Customer</option>
                <option value="admin">Admin</option>
            </select>

            <div id="admin-code-box" style="display: none;">
                <input type="text" name="admin_code" id="admin_code" placeholder="Enter Admin Code">
            </div>

            <button type="submit">Sign Up</button>
        </form>
    </div>
</section>
<?php include 'footer.php'; ?>

<script>
function toggleAdminCode() {
    const role = document.getElementById("role").value;
    const adminBox = document.getElementById("admin-code-box");
    const adminInput = document.getElementById("admin_code");

    if (role === "admin") {
        adminBox.style.display = "block";
        adminInput.required = true;
    } else {
        adminBox.style.display = "none";
        adminInput.required = false;
        adminInput.value = "";
    }
}
</script>

</body>
</html>