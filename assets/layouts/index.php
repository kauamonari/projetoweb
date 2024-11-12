<?php include 'header.php'; ?>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <h1 class="card-title text-center">Descubra Seu Signo</h1>
                    <form action="show_zodiac_sign.php" method="post">
                        <div class="form-group">
                            <label for="data">Digite sua data de nascimento (dd/mm):</label>
                            <input type="text" id="data" name="data" class="form-control" placeholder="DD/MM" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Descobrir Signo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</div>

<?php include 'header.php'; ?>