<?php
$conn = new mysqli("localhost", "root", "", "findit");

$search = "";
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $sql = "SELECT * FROM items WHERE title LIKE '%$search%' OR description LIKE '%$search%' ORDER BY date DESC";
} else {
    $sql = "SELECT * FROM items ORDER BY date DESC";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>FindIt: Search Lost & Found</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>🔍 Search Lost & Found Items</h2>

    <form method="GET" action="index.php">
        <input type="text" name="search" placeholder="Search by keyword..." value="<?= htmlspecialchars($search) ?>" style="padding:8px; width:250px;">
        <button type="submit" style="padding:8px;">Search</button>
    </form>

    <br>
    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse: collapse;">
        <tr style="background-color: #f0f0f0;">
            <th>ID</th>
            <th>Type</th>
            <th>Title</th>
            <th>Location</th>
            <th>Date</th>
            <th>Action</th>
        </tr>

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= ucfirst($row['type']) ?></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars($row['location']) ?></td>
                    <td><?= htmlspecialchars($row['date']) ?></td>
                    <td><a href="item_view.php?id=<?= $row['id'] ?>">View</a></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6">No items found.</td></tr>
        <?php endif; ?>
    </table>

    <br><br>
    <a href="dashboard.php">
        <button style="padding: 10px 20px; background-color: #007BFF; color: white; border: none; border-radius: 5px;">
            ⬅ Back to Dashboard
        </button>
    </a>
</div>
</body>
</html>
