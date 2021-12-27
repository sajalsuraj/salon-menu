<?php 
    $link = $_SERVER['REQUEST_URI'];
    $link_array = explode('/',$link);
    $page = end($link_array);
?>
<?php if($page !== "login"){ ?>
    <footer class="main-footer">
        Copyright &copy; <?php echo date('Y'); ?> <strong>Curls & Waves Salon</strong>
        All rights reserved.
        </div>
  </footer>
</div>
<?php } ?>
    
</body>
</html>