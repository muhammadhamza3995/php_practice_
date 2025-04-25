<?php
$services = [
  "Frontend Development", 
  "Vue.js Integration", 
  "PHP APIs", 
  "Responsive UI Design", 
  "Bug Fixing", 
  "Performance Optimization"
];

$projects = [
  ["title" => "Portfolio Website", "desc" => "A personal portfolio built with PHP and Tailwind.", "link" => "#", "code" => "#"],
  ["title" => "Blog CMS", "desc" => "Custom content management system with PHP.", "link" => "#", "code" => "#"],
  ["title" => "API Dashboard", "desc" => "Dynamic API dashboard using Vue + PHP.", "link" => "#", "code" => "#"]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Muhammad Hamza Jabbar | PHP & Frontend Developer</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    html { scroll-behavior: smooth; }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">

<header class="bg-white shadow sticky top-0 z-50">
  <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-blue-600">Muhammad Hamza Jabbar</h1>
    <nav class="space-x-6 text-lg">
      <a href="#services" class="text-blue-600 hover:underline">Services</a>
      <a href="#projects" class="text-blue-600 hover:underline">Projects</a>
      <a href="#contact" class="text-blue-600 hover:underline">Contact</a>
    </nav>
  </div>
</header>

<section class="bg-blue-700 text-white py-24">
  <div class="max-w-4xl mx-auto px-4 text-center">
    <h2 class="text-5xl font-extrabold mb-4">Hi, I'm Muhammad Hamza Jabbar</h2>
    <p class="text-2xl mb-6">Frontend Developer | PHP Developer | Vue.js Enthusiast</p>
    <a href="#contact" class="bg-white text-blue-700 px-8 py-3 rounded-full font-semibold hover:bg-blue-100 transition">Let's Talk</a>
  </div>
</section>

<section class="py-16" id="services">
  <div class="max-w-6xl mx-auto px-4">
    <h2 class="text-4xl font-bold mb-12 text-center text-blue-800">Services I Offer</h2>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <?php foreach ($services as $service): ?>
        <div class="bg-white p-8 rounded-2xl shadow-lg text-center hover:shadow-xl transition">
          <h3 class="text-2xl font-semibold text-blue-700"><?= $service ?></h3>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="py-16 bg-white" id="projects">
  <div class="max-w-6xl mx-auto px-4">
    <h2 class="text-4xl font-bold mb-12 text-center text-blue-800">Projects</h2>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <?php foreach ($projects as $project): ?>
        <div class="bg-gray-100 p-6 rounded-2xl shadow hover:shadow-xl transition">
          <h3 class="text-2xl font-bold text-gray-800 mb-2"><?= $project['title'] ?></h3>
          <p class="text-gray-600 mb-4 text-base"><?= $project['desc'] ?></p>
          <div class="space-x-4">
            <a href="<?= $project['link'] ?>" target="_blank" class="text-sm text-blue-600 hover:underline">Live Preview</a>
            <a href="<?= $project['code'] ?>" target="_blank" class="text-sm text-green-600 hover:underline">Code</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="py-16" id="contact">
  <div class="max-w-xl mx-auto px-4">
    <h2 class="text-3xl font-bold mb-8 text-center text-blue-800">Contact Me</h2>
    <form onsubmit="sendWhatsApp(event)" class="space-y-4">
      <input type="text" id="name" placeholder="Your Name" class="w-full p-4 border rounded-xl focus:ring-2 focus:ring-blue-600" required>
      <textarea id="message" placeholder="Your Message" class="w-full p-4 border rounded-xl focus:ring-2 focus:ring-blue-600" required></textarea>
      <button type="submit" class="w-full bg-blue-700 text-white px-8 py-3 rounded-xl hover:bg-blue-800 transition">Send on WhatsApp</button>
    </form>
  </div>
</section>

<footer class="bg-gray-200 text-center py-6 text-gray-600 mt-12">
  &copy; <?= date('Y') ?> Muhammad Hamza Jabbar. All rights reserved.
</footer>

<script>
  function sendWhatsApp(event) {
    event.preventDefault();
    const name = document.getElementById("name").value.trim();
    const message = document.getElementById("message").value.trim();
    const phoneNumber = "923215343995";
    const fullMessage = `Hello Hamza, I'm ${name}. ${message}`;
    const url = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(fullMessage)}`;
    window.open(url, '_blank');
  }
</script>

</body>
</html>
