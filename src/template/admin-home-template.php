<div class="page-container">
    <div class="content-container">
        <header class="page-header">
            <h1 class="big-title"><?php echo $template_params["title"]; ?></h1>
            <a class="red-btn go-to admin-logout" href="logout.php">Esci</a>
        </header>
        <div class="table-responsive">
            <table class="table table-striped caption-top">
                <caption>Ordini ricevuti in data odierna</caption>
                <thead>
                    <tr>
                        <th id="id-order" scope="col">Numero ordine</th>
                        <th id="username" scope="col">Nome utente</th>
                        <th id="total-price" scope="col">Prezzo totale</th>
                        <th id="products" scope="col">Cosa contiene l'ordine?</th>
                        <th id="address" scope="col">Indirizzo di spedizione</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($template_params["orders"] as $order) : ?>
                        <tr>
                            <td headers="id-order">#<?php echo $order["id_order"]; ?></td>
                            <td headers="username"><?php echo $order["username"]; ?></td>
                            <td headers="total-price">&euro;&nbsp;<?php echo $order["total_price"]; ?></td>
                            <td headers="products">
                                <?php $products_in_order = $db_helper->get_products_in_order($order["id_order"]); ?>
                                <?php foreach ($products_in_order as $product) : ?>
                                    <p>x<?php echo $product["quantity"]; ?>&nbsp;<?php echo $product["product_name"]; ?></p>
                                <?php endforeach; ?>
                            </td>
                            <td headers="address"><?php echo $order["shipping_address"]; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>