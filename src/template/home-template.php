<div class="page-container">
    <div class="content-container">
        <header class="page-header">
            <h1 class="big-title"><?php echo $template_params["title"]; ?></h1>
        </header>

        <div class="search-container">
            <img src="./img/icon/2d/normal/search.svg" alt="" />
            <label for="site-search" class="visually-hidden">Cerca prodotto:</label>
            <input type="search" id="site-search" placeholder="Ho voglia di..." autocomplete="off" />
        </div>

        <h2 class="big-title">Categorie</h2>

        <div class="carousel-container">
            <ul class="category-list">
                <li class="category-item">
                    <button class="v-card active-v-card">
                        <img src="./img/icon/3d/food/all.png" alt="" />
                        <span>Tutto</span>
                    </button>
                </li>

                <li class="category-item">
                    <button class="v-card">
                        <img src="./img/icon/3d/food/burger.png" alt="" />
                        <span>Panini</span>
                    </button>
                </li>

                <li class="category-item">
                    <button class="v-card">
                        <img src="./img/icon/3d/food/pizza.png" alt="" />
                        <span>Pizza</span>
                    </button>
                </li>

                <li class="category-item">
                    <button class="v-card">
                        <img src="./img/icon/3d/food/hot_dog.png" alt="" />
                        <span>HotDog</span>
                    </button>
                </li>

                <li class="category-item">
                    <button class="v-card">
                        <img src="./img/icon/3d/food/fries.png" alt="" />
                        <span>Snack</span>
                    </button>
                </li>

                <li class="category-item">
                    <button class="v-card">
                        <img src="./img/icon/3d/food/desserts.png" alt="" />
                        <span>Dolci</span>
                    </button>
                </li>

                <li class="category-item">
                    <button class="v-card">
                        <img src="./img/icon/3d/food/drinks.png" alt="" />
                        <span>Bevande</span>
                    </button>
                </li>
            </ul>
        </div>

        <div class="category-details">
            <h3>Tutto</h3>
            <p class="medium-text"><span id="n_products"></span>&nbsp;articoli</p>
        </div>
        <div class="food-container cards-container container">
            <div class="row">
            </div>
        </div>
        <div class="toast-insertion">
        </div>
    </div>
</div>