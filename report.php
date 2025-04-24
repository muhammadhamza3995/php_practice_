<?php session_start(); 

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
      <h2 class="text-2xl font-bold mb-4 text-purple-700">PHP SuperGlobals Practice</h2>

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
    <section class="bg-white p-6 rounded-2xl shadow-xl mt-10">
        <h2 class="text-2xl font-bold mb-4 text-purple-700">Loops & Arrays Practice</h2>
        <?php
        $skills = ["HTML", "CSS", "JavaScript", "Vue", "PHP", "Laravel"];
        
        echo "<div class='mb-4'>";
        echo "<h3 class='text-lg font-semibold text-gray-700 mb-2'>My Skills (Indexed Array with foreach):</h3>";
        echo "<ul class='list-disc list-inside space-y-1'>";
        foreach ($skills as $skill) {
            echo "<li class='text-blue-600'>$skill</li>";
        }
        echo "</ul></div>";

        $profile = [
            "Name" => "Hamza Jabbar",
            "Age" => 22,
            "Location" => "Pakistan",
            "Learning" => "PHP"
        ];

        echo "<div class='mb-4'>";
        echo "<h3 class='text-lg font-semibold text-gray-700 mb-2'>My Profile (Associative Array with foreach):</h3>";
        echo "<ul class='list-disc list-inside space-y-1'>";
        foreach ($profile as $key => $value) {
            echo "<li><span class='font-medium text-gray-800'>$key:</span> <span class='text-green-700'>$value</span></li>";
        }
        echo "</ul></div>";

        echo "<div>";
        echo "<h3 class='text-lg font-semibold text-gray-700 mb-2'>Numbers (for loop):</h3>";
        for ($i = 1; $i <= 5; $i++) {
            echo "<span class='inline-block bg-gray-200 text-gray-800 px-3 py-1 rounded-full mr-2 mb-2'>$i</span>";
        }
        echo "</div>";
        ?>
    </section>
    <section class="bg-white p-6 rounded-2xl shadow-xl mt-10">
        <h2 class="text-2xl font-bold mb-4 text-purple-700">PHP Functions Practice</h2>

        <?php
        
        function calculateArea($length, $width) {
            return $length * $width;
        }

        
        function greetUser($name) {
            return "Welcome, <span class='text-blue-600 font-semibold'>" . htmlSpecialChars($name) . "</span>!";
        }

        $userName = "Hamza";
        $area = calculateArea(5, 8);
        ?>

        <div class="text-lg space-y-2">
        <p><?= greetUser($userName); ?></p>
        <p>The area of a 5 x 8 rectangle is: 
            <span class="text-green-700 font-semibold"><?= $area ?> square units</span></p>
        </div>
    </section>
    <section class="bg-white p-6 rounded-2xl shadow-xl mt-10">
        <h2 class="text-2xl font-bold mb-4 text-purple-700">PHP GET vs POST Method Demo</h2>

        <form method="GET" class="space-y-4 mb-6">
        <label class="block text-sm font-medium">Enter your city (GET method):</label>
        <input type="text" name="city" class="w-full border px-3 py-2 rounded-md" placeholder="e.g. Lahore">
        <button type="submit" class="bg-teal-600 text-white px-4 py-2 rounded-md">Submit via GET</button>
        </form>

        <form method="POST" class="space-y-4">
        <label class="block text-sm font-medium">Enter your profession (POST method):</label>
        <input type="text" name="profession" class="w-full border px-3 py-2 rounded-md" placeholder="e.g. Developer">
        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md">Submit via POST</button>
        </form>

        <div class="mt-6 bg-gray-100 p-4 rounded-md space-y-2">
        <?php
            if (isset($_GET['city'])) {
            $city = sanitize($_GET['city']);
            echo "<p class='text-blue-600'>You are from: <strong>$city</strong></p>";
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['profession'])) {
            $profession = sanitize($_POST['profession']);
            echo "<p class='text-purple-600'>Your profession is: <strong>$profession</strong></p>";
            }
        ?>
        </div>
    </section>
    <section class="bg-white p-6 rounded-2xl shadow-xl mt-10">
      <h2 class="text-2xl font-bold mb-4 text-purple-700">PHP Loops & Arrays</h2>

      <?php
        $technologies = ["HTML", "CSS", "Tailwind", "JavaScript", "Vue.js", "PHP", "Laravel"];
        $colors = ["text-red-500", "text-blue-500", "text-green-500", "text-yellow-600", "text-purple-600", "text-indigo-500", "text-pink-500"];
      ?>

      <p class="mb-2 font-medium text-gray-700">Technologies I've worked with:</p>
      <ul class="list-disc list-inside space-y-1 text-lg">
        <?php
          foreach ($technologies as $index => $tech) {
            echo "<li class='{$colors[$index]} font-semibold'>$tech</li>";
          }
        ?>
      </ul>

      <div class="mt-6">
        <p class="mb-2 font-medium text-gray-700">Counting from 1 to 5:</p>
        <div class="flex gap-3 text-lg font-bold text-white">
          <?php
            for ($i = 1; $i <= 5; $i++) {
              echo "<span class='bg-blue-600 px-3 py-1 rounded-full'>$i</span>";
            }
          ?>
        </div>
      </div>
    </section>
    <section class="bg-white p-6 rounded-2xl shadow-xl mt-10">
        <h2 class="text-2xl font-bold mb-4 text-purple-700">Associative Arrays Practice</h2>
        <?php
            $book = [
            'title' => 'Clean Code',
            'author' => 'Robert C. Martin',
            'year' => 2008,
            'publisher' => 'Prentice Hall'
            ];
        ?>
        <div class="grid grid-cols-2 gap-4 text-gray-800 text-lg">
            <div><strong>Title:</strong></div>
            <div class="text-blue-600"><?= $book['title'] ?></div>

            <div><strong>Author:</strong></div>
            <div class="text-green-600"><?= $book['author'] ?></div>

            <div><strong>Year:</strong></div>
            <div class="text-purple-600"><?= $book['year'] ?></div>

            <div><strong>Publisher:</strong></div>
            <div class="text-red-600"><?= $book['publisher'] ?></div>
        </div>
    </section>

    <section class="bg-white p-6 rounded-2xl shadow-xl mt-10">
        <h2 class="text-2xl font-bold mb-4 text-purple-700">Filtering Arrays</h2>

        <?php
            $books = [
            ['title' => 'Clean Code', 'author' => 'Robert C. Martin', 'releaseYear' => 2008],
            ['title' => 'The Pragmatic Programmer', 'author' => 'Andy Hunt', 'releaseYear' => 1999],
            ['title' => 'Atomic Habits', 'author' => 'James Clear', 'releaseYear' => 2018],
            ['title' => 'Refactoring', 'author' => 'Martin Fowler', 'releaseYear' => 1999],
            ];

            $filtered = array_filter($books, function ($book) {
            return $book['releaseYear'] >= 2000;
            });
        ?>

        <div class="text-gray-800 space-y-2">
            <p class="font-medium">Books Released After 2000:</p>
            <ul class="list-disc ml-6 space-y-1">
            <?php foreach ($filtered as $book): ?>
                <li>
                <span class="text-blue-600 font-semibold"><?= $book['title'] ?></span> 
                by <?= $book['author'] ?> (<?= $book['releaseYear'] ?>)
                </li>
            <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <section class="bg-white p-6 rounded-2xl shadow-xl mt-10">
        <h2 class="text-2xl font-bold mb-4 text-purple-700">Extracting Functions</h2>

        <?php
            if (!function_exists('greetUser')) {
            function greetUser($name) {
                return "Hello, " . ucfirst($name) . "! Welcome to PHP practice.";
            }
            }

            if (!function_exists('formatCurrency')) {
            function formatCurrency($amount) {
                return "$" . number_format($amount, 2);
            }
            }

            $userName = "hamza";
            $purchaseAmount = 77,501.01;
        ?>
        <div class="space-y-2 text-gray-800">
            <p><?= greetUser($userName); ?></p>
            <p>You have spent: <strong class="text-green-600"><?= formatCurrency($purchaseAmount); ?></strong></p>
        </div>
    </section>

    <section class="bg-white p-6 rounded-2xl shadow-xl mt-10">
        <h2 class="text-2xl font-bold mb-4 text-purple-700">Associative Arrays Practice</h2>

        <?php
            $book = [
            'title' => 'The Clean Coder',
            'author' => 'Robert C. Martin',
            'release_year' => 2011,
            'available' => true
            ];
        ?>

        <ul class="list-disc pl-5 space-y-1 text-gray-800">
            <li><strong>Title:</strong> <?= $book['title'] ?></li>
            <li><strong>Author:</strong> <?= $book['author'] ?></li>
            <li><strong>Release Year:</strong> <?= $book['release_year'] ?></li>
            <li>
            <strong>Status:</strong>
            <?= $book['available'] ? "<span class='text-green-600 font-semibold'>Available</span>" : "<span class='text-red-600 font-semibold'>Out of Stock ❌</span>" ?>
            </li>
        </ul>
    </section>

    <section class="bg-white p-6 rounded-2xl shadow-xl mt-10">
    <h2 class="text-2xl font-bold mb-4 text-purple-700">Refactor to a Function</h2>

    <?php
        $books = [
        ['title' => 'Clean Code', 'available' => true],
        ['title' => 'The Pragmatic Programmer', 'available' => false],
        ['title' => 'Refactoring', 'available' => true],
        ['title' => 'Code Complete', 'available' => false],
        ];

        function getAvailableBooks($books) {
        $availableBooks = [];
        foreach ($books as $book) {
            if ($book['available']) {
            $availableBooks[] = $book;
            }
        }
        return $availableBooks;
        }

        $availableBooks = getAvailableBooks($books);
    ?>

    <h3 class="text-xl font-semibold text-gray-800 mb-2">Available Books:</h3>
    <ul class="list-disc pl-5 text-gray-700">
        <?php foreach ($availableBooks as $book): ?>
        <li><?= $book['title'] ?></li>
        <?php endforeach; ?>
    </ul>
    </section>
    <section class="bg-white p-6 rounded-2xl shadow-xl mt-10">
    <h2 class="text-2xl font-bold mb-4 text-purple-700">Arrow Functions</h2>

    <?php
        $numbers = [1, 2, 3, 4, 5, 6];

        
        $evenNumbersOld = array_filter($numbers, function ($num) {
        return $num % 2 === 0;
        });

        $evenNumbers = array_filter($numbers, fn($num) => $num % 2 === 0);
    ?>

    <div class="mb-4">
        <h3 class="text-lg font-semibold text-gray-800">Even Numbers (Arrow Function):</h3>
        <p class="text-gray-700">
        <?= implode(', ', $evenNumbers) ?>
        </p>
    </div>

    <div>
        <h3 class="text-lg font-semibold text-gray-800">Original Numbers:</h3>
        <p class="text-gray-700"><?= implode(', ', $numbers) ?></p>
    </div>
    </section>
    <section class="bg-white p-6 rounded-2xl shadow-xl mt-10">
    <h2 class="text-2xl font-bold mb-4 text-purple-700">Filtering an Array</h2>

    <?php
        $posts = [
        ['title' => 'Learn PHP', 'published' => true],
        ['title' => 'Master JavaScript', 'published' => false],
        ['title' => 'Explore Laravel', 'published' => true],
        ];

        $publishedPosts = array_filter($posts, fn($post) => $post['published']);
    ?>

    <div>
        <h3 class="text-lg font-semibold text-gray-800">Published Posts:</h3>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
        <?php foreach ($publishedPosts as $post): ?>
            <li><?= htmlSpecialChars($post['title']) ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
    </section>
    <section class="bg-white p-6 rounded-2xl shadow-xl mt-10">
    <h2 class="text-2xl font-bold mb-4 text-purple-700">Associative Array Filtering</h2>

    <?php
        $books = [
        'book1' => ['title' => 'The Hobbit', 'available' => true],
        'book2' => ['title' => '1984', 'available' => false],
        'book3' => ['title' => 'Clean Code', 'available' => true],
        ];

        $availableBooks = array_filter($books, fn($book) => $book['available']);
    ?>

    <div>
        <h3 class="text-lg font-semibold text-gray-800">Available Books:</h3>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
        <?php foreach ($availableBooks as $key => $book): ?>
            <li><strong><?= htmlSpecialChars($key) ?></strong>: <?= htmlSpecialChars($book['title']) ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
    </section>
    <section class="bg-white p-6 rounded-2xl shadow-xl mt-10">
    <h2 class="text-2xl font-bold mb-4 text-purple-700">Extracting a Filter Function</h2>

    <?php
        $books = [
        ['title' => 'The Pragmatic Programmer', 'author' => 'Andrew Hunt', 'available' => true],
        ['title' => 'You Don’t Know JS', 'author' => 'Kyle Simpson', 'available' => false],
        ['title' => 'Refactoring', 'author' => 'Martin Fowler', 'available' => true],
        ];

        function filterByAvailability($items) {
        return array_filter($items, fn($item) => $item['available']);
        }

        $availableBooks = filterByAvailability($books);
    ?>

    <div>
        <h3 class="text-lg font-semibold text-gray-800">Books In Stock:</h3>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
        <?php foreach ($availableBooks as $book): ?>
            <li><strong><?= htmlSpecialChars($book['title']) ?></strong> by <?= htmlSpecialChars($book['author']) ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
    </section>
    <footer class="text-center text-sm text-gray-500 mt-10">
      All PHP tasks integrated in one report | Muhammad Hamza Jabbar | <?= date('Y') ?>
    </footer>
  </div>
</body>
</html>