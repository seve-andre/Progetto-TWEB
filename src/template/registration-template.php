<div class="page-container">

    <div class="login-container">

        <div class="login-form">
            <form action="registration.php" method="post">
                <header>
                    <h1 class="title">Registrati</h1>
                </header>

                <div class="input-container">
                    <div class="field-container">
                        <label for="name">Nome</label>
                        <div class="field">
                            <img src="./img/icon/2d/normal/user.svg" alt="" />
                            <input id="name" name="name" type="text" placeholder="Inserisci il tuo nome" autofocus />
                        </div>
                    </div>
                    <?php if (isset($template_params["errore_nome"])) : ?>
                        <p class="error">
                            <?php echo $template_params["errore_nome"]; ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div class="input-container">
                    <div class="field-container">
                        <label for="email">Email</label>
                        <div class="field">
                            <img src="./img/icon/2d/normal/email.svg" alt="" />
                            <input id="email" name="email" type="email" placeholder="Inserisci la tua email" />
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

                <div class="validation-container">
                    <div class="validation-requirement">
                        <input type="checkbox" id="min-length" name="min-length" tabindex="0" />
                        <label class="checkbox-label" for="min-length">Minimo 10 caratteri</label>
                    </div>
                    <div class="validation-requirement">
                        <input type="checkbox" id="uppercase-letter" name="uppercase-letter" tabindex="0" />
                        <label class="checkbox-label" for="uppercase-letter">Almeno una maiuscola</label>
                    </div>
                    <div class="validation-requirement">
                        <input type="checkbox" id="lowercase-letter" name="lowercase-letter" tabindex="0" />
                        <label class="checkbox-label" for="lowercase-letter">Almeno una minuscola</label>
                    </div>
                    <div class="validation-requirement">
                        <input type="checkbox" id="number" name="number" tabindex="0" />
                        <label class="checkbox-label" for="number">Almeno un numero</label>
                    </div>
                </div>

                <button class="btn">Registrati</button>

                <footer>
                    <p>Sei gi&agrave; registrato a Eat Up?&nbsp;<a class="bold-text" href=" login.php">Accedi ora</a></p>
                </footer>
            </form>
        </div>

        <div class="illustration">
            <img src="./img/icon/3d/illustrations/shopping.svg" alt="" />
            <h1>Eat Up</h1>
            <p>Eat Up è il miglior servizio di consegna cibo per gli universitari</p>
        </div>

    </div>
</div>