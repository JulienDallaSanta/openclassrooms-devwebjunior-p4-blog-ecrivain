<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="/Public/js/main.js"></script>
<!-- TinyMCE -->
<script src="https://cdn.tiny.cloud/1/bewiwyu29uila75t62u43sybhhii6vp30c6dfg18ud1268c7/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="/Public/js/tinymce.js"></script>

<?php
    $rawPath = $_SERVER['REQUEST_URI'];
    $path = explode("/", $rawPath);
    array_shift($path);
    if($path[0] == 'home' || $path[0] == 'accueil' || $path[0] == ''){
        ?>
        <script src="/Public/js/home.js"></script>
        <script src="/Public/js/livres.js"></script>
    <?php
    }
    if($path[0] == 'chapitre' || $path[0] == 'chapter'){
    ?>
        <script src="/Public/js/chapitre.js"></script>
    <?php
    }
    if($path[0] == 'admin'){
    ?>
        <script src="/Public/js/admin.js"></script>
    <?php
    }
?>
