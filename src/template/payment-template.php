<div class="page-container">
    <div class="content-container">
        <form action="payment.php" method="post">

            <fieldset class="option-container">
                <legend class="big-title bold-text">Dove consegnare?</legend>

                <div class="form-check btn option active-option" tabindex="0">
                    <input class="form-check-input" type="radio" name="address" id="first-floor" checked="checked" autocomplete="off" value="first-floor" />
                    <label class="form-check-label details" for="first-floor">
                        <span>Via dell&apos;Universit&agrave; 50</span><br />
                        <span>Piano 1</span>
                    </label>
                </div>

                <div class="form-check btn option" tabindex="0">
                    <input class="form-check-input" type="radio" name="address" id="ground-floor" autocomplete="off" value="ground-floor" />
                    <label class="form-check-label details" for="ground-floor">
                        <span>Via Niccol&ograve; Machiavelli</span><br />
                        <span>Piano 0</span>
                    </label>
                </div>
            </fieldset>


            <fieldset class="option-container">
                <legend class="big-title bold-text">Come pagare?</legend>

                <div class="form-check btn option active-option" tabindex="0">
                    <input class="form-check-input" type="radio" name="payment" id="cash-on-delivery" checked="checked" autocomplete="off" value="consegna" />
                    <label class="form-check-label details" for="cash-on-delivery">
                        <span>Pagamento alla consegna</span>
                    </label>
                </div>

                <div class="form-check btn option" tabindex="0">
                    <input class="form-check-input" type="radio" name="payment" id="credit-card" autocomplete="off" value="carta" />
                    <label class="form-check-label details" for="credit-card">
                        <span>Pagamento con carta</span>
                    </label>
                </div>
            </fieldset>


            <div id="credit-card-form" class="payment-container remove">

                <div class="input-container">
                    <div class="field-container">
                        <label for="card-number">Numero carta</label>
                        <div class="field">
                            <img src="./img/icon/2d/normal/credit_card.svg" alt="" />
                            <input id="card-number" name="card-number" type="text" placeholder="XXXX XXXX XXXX XXXX" />
                        </div>
                    </div>
                    <?php if (isset($template_params["cc_number_error"])) : ?>
                        <p class="error">
                            <?php echo $template_params["cc_number_error"]; ?>
                        </p>
                    <?php endif; ?>
                </div>

                <div class="input-container">
                    <div class="field-container">
                        <label for="owner">Titolare</label>
                        <div class="field">
                            <img src="./img/icon/2d/normal/user.svg" alt="" />
                            <input id="owner" name="owner" type="text" placeholder="es. Mario Rossi" />
                        </div>
                    </div>
                </div>

                <div class="two-field-container">
                    <div class="input-container">
                        <div class="field-container">
                            <label for="expiration">Scadenza</label>
                            <div class="field">
                                <img src="./img/icon/2d/normal/calendar.svg" alt="" />
                                <input id="expiration" name="expiration" type="text" placeholder="mm/aa" autocomplete="off" />
                            </div>
                        </div>
                        <?php if (isset($template_params["expiration_error"])) : ?>
                            <p class="error">
                                <?php echo $template_params["expiration_error"]; ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <div class="input-container">
                        <div class="field-container">
                            <label for="code">CVC / CVV</label>
                            <div class="field">
                                <img src="./img/icon/2d/normal/lock.svg" alt="" />
                                <input id="code" name="code" type="password" placeholder="XXX" autocomplete="off" />
                            </div>
                        </div>
                        <p class="info">3 cifre poste sul retro della carta.</p>
                        <?php if (isset($template_params["code_error"])) : ?>
                            <p class="error">
                                <?php echo $template_params["code_error"]; ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
            <button class="order-btn">Ordina</button>
        </form>
    </div>
</div>