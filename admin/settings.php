<?php
ob_start();
include_once './includes/__heeader__.php';
include_once './includes/__navbar__.php';
include_once '../server/dbcon.php';

// Fetch existing settings data from the database
$stmt = $pdo->query("SELECT * FROM settings LIMIT 1");
$settings = $stmt->fetch(PDO::FETCH_ASSOC);

// Initialize variables for form fields
$name = $settings['name'] ?? '';
$description = $settings['description'] ?? '';
$about = $settings['about'] ?? '';
$facebook = $settings['facebook'] ?? '';
$twitter = $settings['twitter'] ?? '';
$instagram = $settings['instagram'] ?? '';
$linkedin = $settings['linkedin'] ?? '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $about = $_POST['about'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $instagram = $_POST['instagram'];
    $linkedin = $_POST['linkedin'];

    if ($settings) {
        // Update existing settings
        $stmt = $pdo->prepare("UPDATE settings SET name = ?, description = ?, about = ?, facebook = ?, twitter = ?, instagram = ?, linkedin = ? WHERE id = ?");
        $stmt->execute([$name, $description, $about, $facebook, $twitter, $instagram, $linkedin, $settings['id']]);
    } else {
        // Insert new settings
        $stmt = $pdo->prepare("INSERT INTO settings (name, description, about, facebook, twitter, instagram, linkedin) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $description, $about, $facebook, $twitter, $instagram, $linkedin]);
    }

    // Refresh the page to show updated data
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
?>

<div class="admin-container">
    <div class="settings-card">
        <h1 class="mb-4">Settings</h1>
        <form method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($name) ?>" placeholder="Enter your name">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="<?= htmlspecialchars($description) ?>" placeholder="Enter a description">
            </div>
            <div class="mb-3">
                <label for="about" class="form-label">About</label>
                <textarea class="form-control" id="about" name="about" rows="3" placeholder="Tell us about yourself"><?= htmlspecialchars($about) ?></textarea>
            </div>
            <div class="social-inputs">
                <div class="mb-3">
                    <label for="facebook" class="form-label"><i class="bi bi-facebook"></i> Facebook URL</label>
                    <input type="url" class="form-control" id="facebook" name="facebook" value="<?= htmlspecialchars($facebook) ?>" placeholder="Enter Facebook URL">
                </div>
                <div class="mb-3">
                    <label for="twitter" class="form-label"><i class="bi bi-twitter"></i> Twitter URL</label>
                    <input type="url" class="form-control" id="twitter" name="twitter" value="<?= htmlspecialchars($twitter) ?>" placeholder="Enter Twitter URL">
                </div>
                <div class="mb-3">
                    <label for="instagram" class="form-label"><i class="bi bi-instagram"></i> Instagram URL</label>
                    <input type="url" class="form-control" id="instagram" name="instagram" value="<?= htmlspecialchars($instagram) ?>" placeholder="Enter Instagram URL">
                </div>
                <div class="mb-3">
                    <label for="linkedin" class="form-label"><i class="bi bi-linkedin"></i> Linkedin URL</label>
                    <input type="url" class="form-control" id="linkedin" name="linkedin" value="<?= htmlspecialchars($linkedin) ?>" placeholder="Enter Linkedin URL">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</div>

<?php
include_once './includes/__footer__.php';
ob_end_flush();
?>
<style>
    .admin-container {
    max-width: 800px;
    margin: 40px auto;
    padding: 20px;
}

.settings-card {
    /* background: #fff; */
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(255, 250, 250, 0.45);
}

.settings-card h1 {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
}

.form-label {
    font-weight: 600;
    color: #333;
}

.form-control {
    border-radius: 8px;
}

.social-inputs i {
    font-size: 18px;
    margin-right: 8px;
}

.btn-primary {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    font-weight: bold;
}

@media (max-width: 768px) {
    .admin-container {
        width: 95%;
    }
}

</style>