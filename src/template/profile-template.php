<div class="page-container">
    <div class="content-container">
        <header class="page-header">
            <h1 class="big-title"><?php echo $template_params["title"]; ?></h1>
        </header>

        <h2 class="normal-text">Informazioni sull'account</h2>

        <div class="input-container">
            <div class="field-container info-field">
                <label for="name">Nome</label>
                <div class="field">
                    <img src="./img/icon/2d/normal/user.svg" alt="" />
                    <input id="name" value="<?php echo $_SESSION["username"]; ?>" type="text" readonly="readonly" />
                </div>
            </div>
        </div>

        <div class="input-container">
            <div class="field-container info-field">
                <label for="email">Email</label>
                <div class="field">
                    <img src="./img/icon/2d/normal/email.svg" alt="" />
                    <input id="email" value="<?php echo $_SESSION["email"]; ?>" type="email" readonly="readonly" />
                </div>
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-striped caption-top">
                <caption>Ordini effettuati</caption>
                <thead>
                    <tr>
                        <th id="id-order" scope="col">Numero ordine</th>
                        <th id="total-price" scope="col">Prezzo totale</th>
                        <th id="order-date" scope="col">Data ordine</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($template_params["orders"] as $order) : ?>
                        <tr>
                            <td headers="id-order">#<?php echo $order["id_order"]; ?></td>
                            <td headers="total-price">&euro;&nbsp;<?php echo $order["total_price"]; ?></td>
                            <td headers="order-date"><?php echo $order["order_date"]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <a class="red-btn go-to" href="logout.php">Esci</a>
    </div>
</div>