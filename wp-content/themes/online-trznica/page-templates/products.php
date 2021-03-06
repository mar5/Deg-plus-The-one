<?php /** Template name: products list */ ?>
<?php

the_post();
get_header();
$ps = new ProductsSearch();
if(isset($_REQUEST['category'])){
    $ps->setCategory($_REQUEST['category']);
}
if(isset($_REQUEST['opg'])){
    $ps->setOpg($_REQUEST['opg']);
}
$products = $ps->search();

$opgs = $ps->getOPGs();
$categories = ProductsSearch::getCategories();
?>
    <main class="main">
        <nav class="navigation">
            <?php get_partial('layout/user-navigation')?>
        </nav>
        <div class="horiz">
            <div class="filter">
                <form action="#" class="filter__form">
                    <select data-id="on-change" name="category">
                        <option value="0" selected>Kategorija</option>
                        <?php
                        foreach($categories as $category) {
                            echo '<option value="'.$category->slug.'">'.$category->name.'</option>';
                        }
                        ?>
                    </select>
                </form>
            </div>
            <div class="filter">
                <form action="#" class="filter__form">
                    <select data-id="on-change" name="opg">
                        <option value="0" selected>OPG</option>
                        <?php
                        foreach($opgs as $id => $name) {
                            echo '<option value="'.$id.'">'.$name.'</option>';
                        }
                        ?>
                    </select>
                </form>
            </div>
            <ul class="horiz__list">
                <?php
                    foreach ($products as $product){
                        get_partial('products/listing-item', ['data' => getProductData($product)]);
                    }
                ?>
            </ul>
            <div class="load-more">
                <a href="#" class="load-more__anchor btn btn-black">Učitaj više</a>
            </div>
        </div>
        <?php get_partial('layout/_footer'); ?>
    </main>

<?php
get_footer();