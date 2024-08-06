<?php 
get_template_part('template-parts/bottom'); 
get_template_part('template-parts/quick-links'); 
?>

<footer class="footer text-center py-3 theme-bg-dark">
    <small>
        <?php echo get_bloginfo('name'); ?> © Copyright <?php echo date("Y"); ?> | Todos los derechos reservados
    </small>
    <?php dynamic_sidebar('footer-1'); ?>
</footer>
</div>

<?php wp_footer(); ?>

<!-- Bootstrap scripts -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
</body>

</html>