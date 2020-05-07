<footer>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <small>
                    <?php
                        $tanggal = new DateTime('now');
                        echo "Copyright &copy ";
                        echo $tanggal->format('Y');
                        echo "- Muhammad Fuad";
                    ?>
                </small>
            </div>
        </div>
    </div>
</footer>

<script src="js/jquery-3.3.1.js"></script>
<script src="js/popper.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/all.js"></script>

</body>

</html>