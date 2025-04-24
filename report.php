<?php
session_start();

$filePath = "user_data.txt";
$message = "";
$submitted = false;

function sanitize($data) {
  return htmlSpecialChars(trim($data));
}

function fileExistsMessage($filePath) {
  return file_exists($filePath) ? "File already created." : "File not found.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'] ?? '';
  $name = sanitize($_POST['name'] ?? '');
  $email = sanitize($_POST['email'] ?? '');

  if ($action === 'create') {
    if (file_exists($filePath)) {
      $message = "<span class='text-red-500'>File already created!</span>";
    } else {
      if (!empty($name) && !empty($email)) {
        file_put_contents($filePath, "$name | $email\n");
        $message = "<span class='text-green-600'>Data saved and file created!</span>";
        $submitted = true;
      }
    }
  } elseif ($action === 'delete') {
    if (file_exists($filePath) && fileSize($filePath) > 0) {
      unlink($filePath);
      $message = "<span class='text-red-600'>File deleted successfully.</span>";
    } else {
      $message = "<span class='text-yellow-500'>Nothing to delete!</span>";
    }
  }
}

$data = file_exists($filePath) ? file_get_contents($filePath) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PHP Report - Hamza Jabbar</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center p-10">
  <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-2xl">
    <h1 class="text-3xl font-bold text-purple-700 mb-6">Hamza Jabbar's PHP Practice Report</h1>

    <section class="mb-6">
      <h2 class="text-xl font-semibold mb-2 text-gray-800">Variable Practice</h2>
      <div class="text-lg space-y-1">
        <?php
          $myName = "Hamza Jabbar";
          $myAge = 22;
          $language = "PHP";
          echo "<p>Name: <strong class='text-blue-600'>$myName</strong></p>";
          echo "<p>Age: <strong class='text-green-600'>$myAge</strong></p>";
          echo "<p>Learning: <strong class='text-yellow-600'>$language</strong></p>";
        ?>
      </div>
    </section>

    <section class="mb-6">
      <h2 class="text-xl font-semibold mb-2 text-gray-800">Submit Info Form</h2>
      <form method="POST" class="space-y-4">
        <input type="text" name="name" placeholder="Your Name" class="w-full border p-2 rounded-md" required />
        <input type="email" name="email" placeholder="Your Email" class="w-full border p-2 rounded-md" required />
        <div class="flex gap-4">
          <button name="action" value="create" class="bg-blue-600 text-white px-4 py-2 rounded-md">Create</button>
          <button name="action" value="delete" class="bg-red-600 text-white px-4 py-2 rounded-md">Delete</button>
        </div>
        <p><?= $message ?></p>
      </form>
    </section>

    <?php if (!empty($data)): ?>
      <section class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Stored User Data</h2>
        <pre class="bg-gray-200 p-4 rounded-md whitespace-pre-wrap text-sm text-gray-700"><?= $data ?></pre>
      </section>
    <?php endif; ?>

    <section class="bg-white p-6 rounded-2xl shadow-xl mt-10">
      <h2 class="text-2xl font-bold mb-4 text-purple-700">PHP Conditionals Practice</h2>

      <form method="POST" class="space-y-4">
        <div>
          <label class="block mb-1 font-medium">Enter Your Age:</label>
          <input type="number" name="user_age" class="w-full border px-3 py-2 rounded-md" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Check Eligibility</button>
      </form>

      <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_age'])) {
          $age = (int)$_POST['user_age'];
          echo "<div class='mt-4 p-4 border rounded-lg'>";

          if ($age < 13) {
            echo "<p class='text-red-600 font-semibold'>You are too young to register.</p>";
          } elseif ($age >= 13 && $age < 18) {
            echo "<p class='text-yellow-600 font-semibold'>You can register with parental consent.</p>";
          } else {
            echo "<p class='text-green-600 font-semibold'>You are eligible to register.</p>";
          }

          echo "</div>";
        }
      ?>
    </section>

    <section class="mb-6 mt-10">
      <h2 class="text-xl font-semibold mb-2 text-gray-800">Loop Practice</h2>

      <div class="bg-gray-100 p-4 rounded-md space-y-2">
        <h3 class="text-lg font-bold text-indigo-600">For Loop: 1 to 5</h3>
        <ul class="list-disc list-inside">
          <?php
            for ($i = 1; $i <= 5; $i++) {
              echo "<li>Number: $i</li>";
            }
          ?>
        </ul>

        <h3 class="text-lg font-bold text-indigo-600 mt-4">While Loop: Countdown from 5</h3>
        <ul class="list-disc list-inside">
          <?php
            $x = 5;
            while ($x > 0) {
              echo "<li>Countdown: $x</li>";
              $x--;
            }
          ?>
        </ul>

        <h3 class="text-lg font-bold text-indigo-600 mt-4">Foreach Loop: Favorite Tools</h3>
        <ul class="list-disc list-inside">
          <?php
            $tools = ["VS Code", "Laragon", "Postman", "Git", "Figma"];
            foreach ($tools as $tool) {
              echo "<li>$tool</li>";
            }
          ?>
        </ul>
      </div>
    </section>

        <section class="bg-white p-6 rounded-2xl shadow-xl mt-10">
      <h2 class="text-2xl font-bold mb-4 text-purple-700">PHP Array Practice</h2>

      <?php
        $languages = ["PHP", "JavaScript", "Python"];
        echo "<h3 class='font-semibold text-lg mb-2 text-blue-700'>Indexed Array:</h3>";
        echo "<ul class='list-disc list-inside mb-4'>";
        foreach ($languages as $lang) {
          echo "<li>$lang</li>";
        }
        echo "</ul>";

        $person = [
          "name" => "Hamza Jabbar",
          "role" => "Frontend Developer",
          "language" => "PHP"
        ];
        echo "<h3 class='font-semibold text-lg mb-2 text-green-700'>Associative Array:</h3>";
        echo "<ul class='list-disc list-inside mb-4'>";
        foreach ($person as $key => $value) {
          echo "<li><strong>$key:</strong> $value</li>";
        }
        echo "</ul>";

        sort($languages);
        echo "<h3 class='font-semibold text-lg mb-2 text-purple-700'>Sorted Array:</h3>";
        echo "<ul class='list-disc list-inside'>";
        foreach ($languages as $lang) {
          echo "<li>$lang</li>";
        }
        echo "</ul>";
      ?>
    </section>

        <section class="bg-white p-6 rounded-2xl shadow-xl mt-10">
      <h2 class="text-2xl font-bold mb-4 text-purple-700">PHP Functions Practice</h2>

      <?php
        function greet($name) {
          return "Hello, $name!";
        }

        function add($a, $b) {
          return $a + $b;
        }

        function isEven($num) {
          return $num % 2 === 0 ? "Even" : "Odd";
        }

        $username = "Hamza";
        $sum = add(10, 15);
        $numberCheck = isEven(7);

        echo "<p><strong>Greeting:</strong> " . greet($username) . "</p>";
        echo "<p><strong>Addition (10 + 15):</strong> $sum</p>";
        echo "<p><strong>Is 7 even?</strong> $numberCheck</p>";
      ?>
    </section>

        <section class="bg-white p-6 rounded-2xl shadow-xl mt-10">
      <h2 class="text-2xl font-bold mb-4 text-purple-700">PHP Superglobals Practice</h2>

      <div class="text-sm text-gray-700 space-y-2">
        <p><strong>Current Script:</strong> <?= $_SERVER['PHP_SELF'] ?></p>
        <p><strong>Server Name:</strong> <?= $_SERVER['SERVER_NAME'] ?></p>
        <p><strong>Client IP:</strong> <?= $_SERVER['REMOTE_ADDR'] ?></p>
        <p><strong>User Agent:</strong> <?= $_SERVER['HTTP_USER_AGENT'] ?></p>
        <p><strong>Request Method:</strong> <?= $_SERVER['REQUEST_METHOD'] ?></p>
      </div>
    </section>

        <section class="bg-white p-6 rounded-2xl shadow-xl mt-10">
      <h2 class="text-2xl font-bold mb-4 text-purple-700">Sessions & Cookies</h2>

      <?php
        if (!isset($_COOKIE['user_visited'])) {
          setCookie("user_visited", "true", time() + 3600);
          $cookieMessage = "<p class='text-yellow-600'>Welcome! This is your first visit (cookie set).</p>";
        } else {
          $cookieMessage = "<p class='text-green-600'>Welcome back! Cookie detected.</p>";
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['session_name'])) {
          $_SESSION['session_name'] = sanitize($_POST['session_name']);
        }

        $sessionOutput = isset($_SESSION['session_name'])
          ? "<p class='text-blue-600'>Session Name: <strong>{$_SESSION['session_name']}</strong></p>"
          : "<p class='text-gray-600'>No session name stored yet.</p>";

        echo $cookieMessage;
        echo $sessionOutput;
      ?>

      <form method="POST" class="mt-4 space-y-3">
        <input type="text" name="session_name" placeholder="Set your session name" class="w-full border px-3 py-2 rounded-md" required />
        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700">Set Session</button>
      </form>
    </section>

    <footer class="text-center text-sm text-gray-500 mt-10">
      All PHP tasks integrated in one report | Hamza Jabbar | <?= date('Y') ?>
    </footer>
  </div>
</body>
</html>