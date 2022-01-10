<div class="page-container">
    <div class="login-container">

        <div class="illustration">
            <img src="./img/icon/3d/illustrations/shopping.svg" alt="" />
            <h1>Eat Up</h1>
            <p>Eat Up è il miglior servizio di consegna cibo per gli universitari</p>
        </div>

        <div class="login-form">
            <form action="login.php" method="post">
                <header>
                    <h1 class="title">Accedi</h1>
                </header>

                <div class="input-container">
                    <div class="field-container">
                        <label for="email">Email</label>
                        <div class="field">
                            <img src="./img/icon/2d/normal/email.svg" alt="" />
                            <input id="email" name="email" type="email" placeholder="Inserisci la tua email" autofocus="autofocus" />
                        </div>
                    </div>
                    <?php if (isset($template_params["errore_email"])) : ?>
                        <p class="error">
                            <?php echo $template_params["errore_email"]; ?>
                        </p>
                    <?php endif; ?>
                </div>


                <div class="input-container">
                    <div class="field-container">
                        <label for="pwd">Password</label>
                        <div class="field">
                            <img src="./img/icon/2d/normal/lock.svg" alt="" />
                            <input id="pwd" name="password" type="password" placeholder="Inserisci la tua password" />

                            <button id="eye-btn" class="img-btn" type="button">
                                <img id="eye" class="eye" src="./img/icon/2d/normal/eye.svg" alt="Mostra password" />
                            </button>
                        </div>
                    </div>
                    <?php if (isset($template_params["errore_pwd"])) : ?>
                        <p class="error">
                            <?php echo $template_params["errore_pwd"]; ?>
                        </p>
                    <?php endif; ?>
                </div>


                <button class="btn">Accedi</button>

                <footer>
                    <p>Non ancora registrato?&nbsp;<a class="bold-text" href="registration.php">Registrati ora</a></p>
                </footer>
            </form>

        </div>

    </div>
</div>