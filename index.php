<script src="https://cdn.tailwindcss.com"></script>
 

<?php

 require_once 'load.php';


$posts = Post::all(5);
$posts_count = Post::get_count();
$reaction = reaction::get_total_reactions();
$reactions_by_post= Reaction::reactions_top(5);
$admins = User::get_cast()['rows'];
$total_admins = User::get_cast()['total'];
$total_usres = User::get_cast()['users'];
$total_geust = User::get_cast()['guest'];
$total_moderator = User::get_cast()['moderator']


?>
 <title>Dashboard</title>


 <a href="/auth/logout.php" class="bg-red-500 text-white px-4 py-2 rounded">logout</a>
<body class="bg-gray-100 text-gray-800">
 <div class="container mx-auto p-6">
      <!-- TITLe -->
     <h1 class="text-4xl font-bold text-blue-600 mb-6">Dashboard</h1>
     
     <!-- Stats  -->
     <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
         <div class="bg-white shadow-md rounded-lg p-6">
             <h2 class="text-xl font-semibold mb-2">All Posts</h2>
             <p class="text-3xl font-bold text-blue-600">
             📝
             <?= $posts_count ?></p>
         </div>
         <div class="bg-white shadow-md rounded-lg p-6">
             <h2 class="text-xl font-semibold mb-2">All Reactions</h2>
             <p class="text-3xl font-bold text-green-600">
             👍<?= $reaction ?></p>
         </div>
         <div class="bg-white shadow-md rounded-lg p-6">
             <h2 class="text-xl font-semibold mb-2">All Admins </h2>
             <p class="text-3xl font-bold text-black">
             🔑<?= $total_admins ?></p>
         </div>
         <div class="bg-white shadow-md rounded-lg p-6">
             <h2 class="text-xl font-semibold mb-2">All users </h2>
             <p class="text-3xl font-bold text-black">
             👥<?= $total_usres ?></p>
         </div>
         <div class="bg-white shadow-md rounded-lg p-6">
             <h2 class="text-xl font-semibold mb-2">All geust </h2>
             <p class="text-3xl font-bold text-black">
             👤<?= $total_geust ?></p>
     </div>
     <div class="bg-white shadow-md rounded-lg p-6">
             <h2 class="text-xl font-semibold mb-2">All moderato </h2>
             <p class="text-3xl font-bold text-black">
             🧑‍💼<?= $total_moderator ?></p>
     </div>
     </div>

     <!-- Recent Posts  -->
     <h2 class="text-2xl font-bold mb-4">Recent Posts</h2>
     <div class="grid grid-cols-1 gap-4 mb-8">
         <?php foreach ($posts as $post): ?>
             <div class="bg-white shadow-md rounded-lg p-4">
                 <h4 class="text-lg font-semibold text-gray-700">
                     <a href="/post.php?id=<?=$post['user_id'] ?>" class="text-blue-600 hover:underline">
                         <?= $post['title']; ?>
                     </a>
                 </h4>
                 <p class="text-sm text-gray-500"><?= $post['body']; ?></p>
             </div>
         <?php endforeach; ?>
     </div>

     <!-- Admins  -->
     <h2 class="text-2xl font-bold mb-4"> All Admins</h2>
     <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
         <?php foreach ($admins as $admin): ?>
             <div class="bg-white shadow-md rounded-lg p-4 flex items-center">
                 <div class="flex-shrink-0 mr-4">
                     <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                         <span class="text-blue-600 font-bold text-lg"><?= strtoupper(substr($admin['name'], 0, 1)); ?></span>
                     </div>
                 </div>
                 <div>
                     <h4 class="font-semibold text-gray-700"><?= $admin['name']; ?></h4>
                     <p class="text-sm text-gray-500"><?= $admin['email']; ?></p>
                 </div>
             </div>
         <?php endforeach; ?>
     </div>
     <div class="grid grid-cols-1 gap-4 mb-8">

     <!-- Reactions to posts -->
     <h2 class="text-2xl font-bold mb-4">Top Reactions</h2>
 <?php foreach ($reactions_by_post as $reaction): ?>
     <div class="bg-white shadow-md rounded-lg p-4">
        <h1>  Name : <?= $reaction['name']; ?></h1>
         <h4 class="text-lg font-semibold text-gray-700"><?= $reaction['title']; ?></h4>
         <p class="text-sm text-gray-500">
             <span class="text-green-600 font-bold">
                 <?php 
                     if ($reaction['type'] === 'Love') {
                         echo '❤️';
                     } elseif ($reaction['type'] === 'Care') {
                         echo '🤗';
                     } elseif ($reaction['type'] === 'Sad') {
                         echo '😢';
                     } elseif ($reaction['type'] === 'Like') {
                         echo '👍';
                     } elseif ($reaction['type'] === 'Happy') {
                         echo '😄';
                     } elseif ($reaction['type'] === 'Laugh') {
                         echo '😂';
                     } else {
                         echo '❓';
                     }
                 ?>
                 
             </span> 
             <?= $reaction['total_reactions']; ?>
         </p>
     </div>
 <?php endforeach; ?>
</div>


     
 </div>
</body>
</html>   