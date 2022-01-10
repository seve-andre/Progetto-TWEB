<?php
class Category
{
    const PANINI = "Panini";
    const PIZZA = "Pizza";
    const HOT_DOG = "HotDog";
    const SNACKS = "Snacks";
    const DESSERTS = "Desserts";
    const DRINKS = "Drinks";

    public static $category_translation = array(
        "all" => "Tutto",
        self::PIZZA => "Pizza",
        self::PANINI => "Panini",
        self::HOT_DOG => "HotDog",
        self::SNACKS => "Snack",
        self::DESSERTS => "Dolci",
        self::DRINKS => "Bevande"
    );
}
