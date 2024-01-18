<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include('db.php');

// Hiển thị công việc
$sql = "SELECT * FROM jobs";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="dashboard.css">
    
        
</head>
<body>
    <header>
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    </header>

    <nav>
        <a href="#tab1" onclick="showTab('tab1')">仕事を探す</a>
        <a href="#tab2" onclick="showTab('tab2')">仕事を紹介する</a>
        <a href="logout.php">ログアウト</a>
    </nav>

    <section id="tab1">
        <div class='job_title'>
            <h2>仕事のリスト</h2>
            
        </div>
           
        </div>
        </div>

        <?php
       if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='job'>
                    <h3>名前:{$row['name']}</h3>
                    <br>
                    <p>時間: {$row['time_of_day']}</p>
                    <br>
                    <p>内容:{$row['description']}</p>
                    <br>
                    <p>場所:{$row['location']}</p>
                    <br>
                    <p>時給:{$row['salary']}</p>
                    <br>
                    <a href='#'></a>
                  </div>";
        }
        } else {
            echo "Không có công việc nào.";
        }
        ?>
    </section>

    <section id="tab2" style="display:none;">
    <h2>仕事の情報</h2>
    <form action="create_job.php" method="POST">
        <label for="name">仕事名:</label>
        <input type="text" name="name" required>
        <br>
        <label for="time_of_day">時間帯:</label>
        <select name="time_of_day" id="timeOfDay">
            <option value="午前">午前</option>
            <option value="午後">午後</option>
            <option value="夜間">夜間</option>
        </select>
        <br>
        <br>

        <label for="description">仕事の内容:</label>
        <textarea name="description" rows="4" required placeholder="仕分け、ホール..."></textarea>

        <label for="location">場所:</label>
        <input type="text" name="location" required>

        <label for="salary">時給:</label>
        <input type="text" name="salary" required>

       

        <button type="submit">提出する</button>
    </form>
</section>

    <script>
    
        function showTab(tabId) {
            var tabs = document.querySelectorAll('section');
            tabs.forEach(function(tab) {
                tab.style.display = 'none';
            });
            document.getElementById(tabId).style.display = 'block';
        }
    </script>

    <footer>
        <p>&copy;2023</p>
    </footer>
</body>
</html>
