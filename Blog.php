<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "blog_db";

$conn = new mysqli($host,$user,$pass,$db);
if($conn->connect_error){die("Connection failed: ".$conn->connect_error);}

if(isset($_POST['title']) && isset($_POST['content'])){
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $conn->query("INSERT INTO posts(title,content,created_at) VALUES('$title','$content',NOW())");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Blog</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<style>
body{font-family:'Roboto',sans-serif;background:#0a0a0a;color:#fff;margin:0;padding:20px;}
h1,h2{color:#9b59b6;text-shadow:0 0 10px #9b59b6;}
.post{background:rgba(52,152,219,0.1);padding:15px;margin:15px 0;border-radius:10px;box-shadow:0 0 15px rgba(52,152,219,0.3);}
form input, form textarea{width:100%;padding:10px;margin:5px 0;border-radius:8px;border:1px solid #3498db;background:rgba(0,0,0,0.3);color:#fff;}
form button{padding:10px 15px;background:#9b59b6;border:none;color:#fff;border-radius:8px;cursor:pointer;transition:0.3s;}
form button:hover{background:#8e44ad;transform:scale(1.05);}
</style>
</head>
<body>
<h1>Blog</h1>

<form method="post">
<input type="text" name="title" placeholder="Title" required>
<textarea name="content" rows="4" placeholder="Content" required></textarea>
<button type="submit">Add</button>
</form>

<?php
$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
while($row = $result->fetch_assoc()){
    echo "<div class='post'>";
    echo "<h2>".$row['title']."</h2>";
    echo "<p>".$row['content']."</p>";
    echo "<small>".$row['created_at']."</small>";
    echo "</div>";
}
$conn->close();
?>
</body>
</html>
