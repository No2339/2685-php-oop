<title>Posts</title>
<script src="https://cdn.tailwindcss.com"></script>

<body class="bg-gray-100 text-gray-900">
 <div class="container mx-auto px-6 py-12">
 <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">Posts</h1>

        <?php 
            require_once 'load.php';
            $post = Post::show($id);
        ?>

        <?php foreach ($posts as $post): ?>
                <div class="p-6">       
                    <h2 class="text-3xl font-semibold text-gray-800 mb-3"> ID: <?= $post['user_id']; ?></h2>
                   
                    <h3 class="text-2xl font-medium text-gray-800 mb-3"> The Name:  <?= $post['name']; ?></h3>

                   
                    <h4 class="text-lg text-gray-600 mb-4">created_at : <?=  $post['created_at']; ?> </h4>

                  
              
            
        <?php endforeach; ?>
    </div>
</body>
</html>
