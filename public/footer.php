

</div>
<footer class="bg-light py-4 footer mt-auto">
    <div class="conteiner">
    <?php if (TIME_DEBUG):?>
        La page est générée en <?= round(1000 *( microtime(true) - TIME_DEBUG ))?> ms
    <?php endif ?>
    </div>
</footer>
</body>
</html>