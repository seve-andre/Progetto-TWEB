<div class="page-container">
    <div class="content-container">
        <header class="page-header">
            <h1 class="big-title"><?php echo $template_params["title"]; ?></h1>
            <?php if (!empty($template_params["products"])) : ?>
                <p><span id="n_products"><?php echo count($template_params["products"]); ?></span><span>&nbsp;</span>articolo</p>
                <button id="remove-items" class="img-btn">
                    <img src="./img/icon/2d/normal/trash.svg" alt="rimuovi tutti gli articoli" />
                </button>
            <?php endif; ?>
        </header>

        <?php if (empty($template_params["products"])) : ?>
            <div class="empty-page">
                <div class="img-center">
                    <img class="empty-page-img" src="./img/icon/3d/illustrations/bag.png" alt="" />
                </div>
                <h2>Il carrello è vuoto</h2>
                <p>Sembra che tu non abbia ancora aggiunto nulla al carrello.</p>
                <a href="home.php" class="go-to">Compra ora</a>
            </div>
        <?php endif; ?>

        <div class="cards-container cart-cards<?php echo empty($template_params["products"]) ? " remove" : ""; ?>">
            <?php foreach ($template_params["products"] as $product) : ?>
                <div class="h-card" id="<?php echo $product["id_product"]; ?>">

                    <div class="img-center">
                        <img class="food" src="<?php echo PRODUCTS_DIR . strtolower($product["category_name"]) . "/" . $product["product_img"]; ?>" alt="" />
                    </div>

                    <div class="h-card-details">
                        <div class="h-card-header">
                            <h2 class="normal-text"><?php echo $product["product_name"]; ?></h2>
                            <button class="img-btn remove-card">
                                <img src="./img/icon/2d/normal/trash.svg" alt="rimuovi singolo articolo" />
                            </button>
                        </div>
                        <div class="product-price-quantity">
                            <p>&euro;&nbsp;<span><?php echo $product["price"]; ?></span></p>
                            <span>&nbsp;</span>
                            <div class="quantity-detail<?php if (intval($product["quantity"]) == 1) : ?>
                                        <?php echo ' hidden'; ?>
                                    <?php endif; ?>">
                                <span class="tiny-text quantity-text">
                                    <?php if (intval($product["quantity"]) > 1) : ?>
                                        <?php echo "x" . $product["quantity"]; ?>
                                    <?php endif; ?>
                                </span>
                            </div>
                        </div>
                        <div class="adder-container">
                            <div class="adder">
                                <button class="subtract-item adder-action">
                                    <img src="./img/icon/2d/normal/minus.svg" alt="" />
                                </button>
                                <label for="quantity" class="visually-hidden">Scegli una quantità a piacere compresa fra 1 e 9 per il prodotto <?php echo $product["product_name"]; ?></label>
                                <!-- readonly for now, but in the future it will let you change the quantity (1-9) -->
                                <input class="quantity" name="quantity" id="quantity" type="text" value="<?php echo $product["quantity"]; ?>" maxlength="1" autocomplete="off" readonly="readonly" />
                                <button class="add-item adder-action">
                                    <img src="./img/icon/2d/normal/plus.svg" alt="Aumenta quantità di 1" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php if (!empty($template_params["products"])) : ?>
            <div class="order-details">
                <div class="detail">
                    <p>Totale articoli:</p>
                    <p>&euro;&nbsp;
                        <span>
                            <?php $total_price = 0.0; ?>
                            <?php foreach ($template_params["products"] as $product) {
                                $total_price += floatval($product["price"]) * floatval($product["quantity"]);
                            } ?>
                            <?php echo number_format($total_price, 2); ?>
                        </span>
                    </p>
                </div>
                <div class="detail">
                    <p>Spedizione:</p>
                    <p>&euro;&nbsp;<span>2.00</span></p>
                </div>

                <hr class="solid" />

                <div class="detail total-price">
                    <p>Totale:</p>
                    <p>&euro;&nbsp;<span><?php echo number_format($total_price + 2, 2); ?></span></p>
                </div>
                <a class="go-to" href="payment.php">Vai al pagamento</a>
            </div>
        <?php endif; ?>
    </div>
</div>