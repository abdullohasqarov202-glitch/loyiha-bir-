<?php
require_once __DIR__ . '/includes/session.php';
startSecureSession();

require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/csrf.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/icons.php';


/* =========================================================
   FOOD PHOTOS
   HAR BIR MAHSULOT UCHUN ID BO'YICHA TURFA RASM
   ========================================================= */

function food_photo(string $type, int $id = 0): string
{
    $photos = [

        // 🍔 BURGER
        'burger' => [
            'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1550547660-d9450f859349?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1571091718767-18b5b1457add?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1553979459-d2229ba7433b?auto=format&fit=crop&w=1000&q=90',
        ],

        // 🍕 PIZZA
        'pizza' => [
            'https://images.unsplash.com/photo-1574071318508-1cdbab80d002?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1579751626657-72bc17010498?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1593560708920-61dd98c46a4e?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1579751626657-72bc17010498?auto=format&fit=crop&w=1000&q=90',
        ],

        // 🍟 FRIES
        'fries' => [
            'https://images.unsplash.com/photo-1573080496219-bb080dd4f877?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1630384060421-cb20d0e0649d?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1541592106381-b31e9677c0e5?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1585109649139-366815a0d713?auto=format&fit=crop&w=1000&q=90',
        ],

        // 🥤 DRINK — COLA / KOLA / LIMONAD
        'drink' => [
            'https://images.unsplash.com/photo-1554866585-cd94860890b7?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1629203851122-3726ecdf080e?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1523677011781-c91d1bbe2f9e?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1499636136210-6f4ee915583e?auto=format&fit=crop&w=1000&q=90',
        ],

        // 🍗 CHICKEN
        'chicken' => [
            'https://images.unsplash.com/photo-1527477396000-e27163b481c2?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1562967916-eb82221dfb92?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1585325701956-60dd9c8553bc?auto=format&fit=crop&w=1000&q=90',
        ],

        // 🌭 HOTDOG
        'hotdog' => [
            'https://images.unsplash.com/photo-1612392062631-94dd858cba88?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1619740455993-9e612b1f9b8f?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1599599810694-57a3f0c7a5e7?auto=format&fit=crop&w=1000&q=90',
        ],

        // 🌮 TACO
        'taco' => [
            'https://images.unsplash.com/photo-1551504734-5ee1c4a1479b?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1565299585323-38d6b0865b47?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1552332386-f8dd00dc2f85?auto=format&fit=crop&w=1000&q=90',
        ],

        // 🍝 PASTA
        'pasta' => [
            'https://images.unsplash.com/photo-1551183053-bf91a1d81141?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1473093295043-cdd812d0e601?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1556761223-4c4282c73f77?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1563379926898-05f4575a45d8?auto=format&fit=crop&w=1000&q=90',
        ],

        // 🍰 DESSERT
        'dessert' => [
            'https://images.unsplash.com/photo-1551024506-0bccd828d307?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1578985545062-69928b1d9587?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1565958011703-44f9829ba187?auto=format&fit=crop&w=1000&q=90',
        ],

        // 🍩 DONUT
        'donut' => [
            'https://images.unsplash.com/photo-1551024601-bec78aea704b?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1556913396-7a94f636c0d9?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1533910534207-90f31029a78e?auto=format&fit=crop&w=1000&q=90',
        ],

        // 🥗 SALAD
        'salad' => [
            'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1540420773420-3366772f4999?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1551248429-40975aa4de74?auto=format&fit=crop&w=1000&q=90',
        ],

        // 🍨 ICE CREAM
        'icecream' => [
            'https://images.unsplash.com/photo-1563805042-7684c019e11a?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1497034825429-c343d7c6a68f?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1570197788417-0e82375c9371?auto=format&fit=crop&w=1000&q=90',
        ],

        // 🍹 COCKTAIL
        'cocktail' => [
            'https://images.unsplash.com/photo-1551024709-8f23befc6f87?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1556679343-c7306c1976bc?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?auto=format&fit=crop&w=1000&q=90',
        ],

        // ☕ COFFEE
        'coffee' => [
            'https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1512568400610-62da28bc8a13?auto=format&fit=crop&w=1000&q=90',
        ],

        // 🥪 SANDWICH
        'sandwich' => [
            'https://images.unsplash.com/photo-1528735602780-2552fd46c7af?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1553909489-cd47e0907980?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1481070414801-51fd732d7184?auto=format&fit=crop&w=1000&q=90',
        ],

        // 🍖 MEAT
        'meat' => [
            'https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1546833999-b9f581a1996d?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1558030006-450675393462?auto=format&fit=crop&w=1000&q=90',
        ],

        // 🍳 BREAKFAST
        'breakfast' => [
            'https://images.unsplash.com/photo-1533089860892-a7c6f0a88666?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1525351484163-7529414344d8?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1495214783159-3503fd1b572d?auto=format&fit=crop&w=1000&q=90',
        ],

        // 🧀 CHEESE
        'cheese' => [
            'https://images.unsplash.com/photo-1486297678162-eb2a19b0a32d?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1452195100486-9cc805987862?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1505576633757-0ac1084af824?auto=format&fit=crop&w=1000&q=90',
        ],

        // 🥞 PANCAKE
        'pancake' => [
            'https://images.unsplash.com/photo-1528207776546-365bb710ee93?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1554520735-0a6b8b6ce8b1?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1506084868230-bb9d95c24759?auto=format&fit=crop&w=1000&q=90',
        ],

        // 🍚 RICE
        'rice' => [
            'https://images.unsplash.com/photo-1512058564366-18510be2db19?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1603133872878-684f208fb84b?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1536304993881-ff6e9eefa2a6?auto=format&fit=crop&w=1000&q=90',
        ],

        // 🥩 STEAK
        'steak' => [
            'https://images.unsplash.com/photo-1600891964092-4316c288032e?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1546964124-0cce460f38ef?auto=format&fit=crop&w=1000&q=90',
            'https://images.unsplash.com/photo-1558030006-450675393462?auto=format&fit=crop&w=1000&q=90',
        ],
    ];

    $list = $photos[$type] ?? $photos['burger'];

    /*
     * Product ID asosida doim bir xil,
     * lekin boshqa mahsulotga boshqa rasm chiqadi.
     */
    $index = $id > 0
        ? ($id - 1) % count($list)
        : 0;

    return $list[$index];
}


/* =========================================================
   ADD TO CART
   ========================================================= */

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {

    if (csrf_verify()) {

        $productId = (int) $_POST['product_id'];

        cart_add($productId, 1);
    }

    header('Location: index.php#menu');
    exit;
}


/* =========================================================
   DATABASE
   ========================================================= */

$pdo = getPDO();

$categories = $pdo
    ->query("SELECT * FROM categories ORDER BY sort_order")
    ->fetchAll();

$products = $pdo
    ->query("SELECT * FROM products WHERE is_available = 1 ORDER BY category_id")
    ->fetchAll();

$byCategory = [];

foreach ($products as $p) {
    $byCategory[$p['category_id']][] = $p;
}

?>
<!DOCTYPE html>

<html lang="uz">

<head>

<meta charset="UTF-8">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover"
>

<title>SmashBite — tez va mazali</title>

<link rel="stylesheet" href="assets/style.css">

<script src="https://telegram.org/js/telegram-web-app.js"></script>

<script>
if (window.Telegram && window.Telegram.WebApp) {
    const tg = window.Telegram.WebApp;
    tg.ready();
    tg.expand();
}
</script>

<style>

/* =========================================================
   PREMIUM FOOD DESIGN
   ========================================================= */

:root {
    --flame: #ff5a1f;
    --flame-dark: #e84208;
    --dark: #151515;
    --text: #222;
    --muted: #777;
    --white: #ffffff;
    --soft: #fff7f2;
    --border: #eeeeee;
}


/* BODY */

body {
    background:
        radial-gradient(
            circle at top right,
            rgba(255,90,31,.08),
            transparent 35%
        ),
        #fff;
}


/* HEADER */

header {
    position: sticky;
    top: 0;
    z-index: 1000;
    background: rgba(255,255,255,.92);
    backdrop-filter: blur(18px);
    border-bottom: 1px solid rgba(0,0,0,.06);
}

.nav {
    min-height: 76px;
}

.brand {
    font-weight: 900;
    letter-spacing: -1px;
    font-size: 23px;
}

.flame-dot {
    display: inline-block;
    width: 13px;
    height: 13px;
    background: var(--flame);
    border-radius: 50%;
    margin-right: 8px;
    box-shadow:
        0 0 0 6px rgba(255,90,31,.10),
        0 0 20px rgba(255,90,31,.35);
}


/* NAV LINKS */

.nav-links a {
    transition: .25s ease;
}

.nav-links a:hover {
    color: var(--flame);
}


/* =========================================================
   HERO
   ========================================================= */

.hero {
    padding-top: 70px;
    padding-bottom: 80px;
}

.hero h1 {
    font-size: clamp(40px, 6vw, 76px);
    line-height: .98;
    letter-spacing: -4px;
    font-weight: 900;
}

.hero .hl {
    color: var(--flame);
    position: relative;
}

.hero p {
    max-width: 650px;
    font-size: 18px;
    line-height: 1.7;
    color: var(--muted);
}


/* HERO IMAGE */

.hero-photo {
    position: relative;
    overflow: hidden;
    border-radius: 35px;
    box-shadow:
        0 30px 80px rgba(0,0,0,.16);
}

.hero-photo img {
    width: 100%;
    display: block;
    aspect-ratio: 1 / .75;
    object-fit: cover;
    transition: transform .6s ease;
}

.hero-photo:hover img {
    transform: scale(1.05);
}

.hero-photo-badge {
    position: absolute;
    left: 20px;
    bottom: 20px;
    padding: 12px 18px;
    border-radius: 100px;
    background: rgba(20,20,20,.82);
    backdrop-filter: blur(10px);
    color: white;
    font-weight: 700;
}


/* BUTTONS */

.btn-flame {
    background: linear-gradient(
        135deg,
        #ff6b2c,
        #ef3e08
    );
    color: white !important;
    border: none;
    box-shadow:
        0 12px 25px rgba(255,90,31,.25);
    transition: .3s ease;
}

.btn-flame:hover {
    transform: translateY(-3px);
    box-shadow:
        0 18px 35px rgba(255,90,31,.35);
}

.btn-outline {
    transition: .3s ease;
}

.btn-outline:hover {
    transform: translateY(-3px);
}


/* CATEGORY */

.cat-tabs {
    display: flex;
    gap: 10px;
    overflow-x: auto;
    padding: 12px 0 25px;
    scrollbar-width: none;
}

.cat-tabs::-webkit-scrollbar {
    display: none;
}

.cat-tab {
    white-space: nowrap;
    border: 1px solid #eee;
    background: white;
    border-radius: 100px;
    padding: 12px 19px;
    cursor: pointer;
    font-weight: 700;
    transition: .25s ease;
}

.cat-tab:hover {
    border-color: var(--flame);
    color: var(--flame);
    transform: translateY(-2px);
}

.cat-tab.active {
    background: var(--flame);
    color: white;
    border-color: var(--flame);
    box-shadow:
        0 8px 20px rgba(255,90,31,.2);
}


/* MENU */

.menu-section {
    padding-bottom: 80px;
}

.menu-cat-title {
    font-size: 34px;
    font-weight: 900;
    letter-spacing: -1px;
    margin-top: 35px;
    margin-bottom: 25px;
}

.menu-grid {
    display: grid;
    grid-template-columns:
        repeat(auto-fill, minmax(240px, 1fr));
    gap: 22px;
}


/* PRODUCT CARD */

.item-card {
    background: white;
    border: 1px solid rgba(0,0,0,.06);
    border-radius: 25px;
    padding: 12px;
    overflow: hidden;
    box-shadow:
        0 8px 35px rgba(0,0,0,.055);
    transition:
        transform .3s ease,
        box-shadow .3s ease;
}

.item-card:hover {
    transform: translateY(-8px);
    box-shadow:
        0 25px 60px rgba(0,0,0,.13);
}


/* IMAGE */

.item-image {
    position: relative;
    overflow: hidden;
    border-radius: 19px;
    background: #f5f5f5;
}

.item-image img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    display: block;
    transition:
        transform .55s ease,
        filter .3s ease;
}

.item-card:hover .item-image img {
    transform: scale(1.08);
    filter: saturate(1.08);
}


/* IMAGE ICON */

.item-image-icon {
    position: absolute;
    right: 12px;
    top: 12px;
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255,255,255,.92);
    backdrop-filter: blur(10px);
    border-radius: 50%;
    box-shadow:
        0 8px 20px rgba(0,0,0,.12);
}


/* PRODUCT TITLE */

.item-card h3 {
    font-size: 20px;
    margin: 17px 5px 7px;
    font-weight: 900;
    letter-spacing: -.3px;
}

.item-card p {
    margin: 0 5px;
    color: #777;
    line-height: 1.55;
    font-size: 14px;
    min-height: 43px;
}


/* FOOT */

.item-foot {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 5px 5px;
}

.item-price {
    font-size: 19px;
    font-weight: 900;
    color: var(--flame);
}


/* ADD BUTTON */

.add-btn {
    width: 46px;
    height: 46px;
    border: none;
    border-radius: 15px;
    background: var(--dark);
    color: white;
    font-size: 28px;
    line-height: 1;
    cursor: pointer;
    transition: .25s ease;
}

.add-btn:hover {
    background: var(--flame);
    transform: rotate(90deg) scale(1.08);
}


/* ABOUT */

.about-sec {
    background:
        linear-gradient(
            135deg,
            #fff5ef,
            #fff
        );
    padding: 100px 0;
}

.about-grid {
    align-items: center;
}

.about-sec h2 {
    font-size: clamp(34px, 5vw, 55px);
    line-height: 1;
    letter-spacing: -2px;
    font-weight: 900;
}

.about-sec p {
    color: #666;
    line-height: 1.7;
}

.about-points {
    padding: 0;
    list-style: none;
}

.about-points li {
    margin: 14px 0;
    font-weight: 700;
}

.about-points .dot {
    width: 9px;
    height: 9px;
    display: inline-block;
    background: var(--flame);
    border-radius: 50%;
    margin-right: 8px;
}


/* ABOUT IMAGE */

.about-visual {
    position: relative;
}

.about-visual img {
    width: 100%;
    border-radius: 30px;
    box-shadow:
        0 25px 60px rgba(0,0,0,.14);
    transition: .5s ease;
}

.about-visual:hover img {
    transform: rotate(-1deg) scale(1.02);
}

.floating-card {
    position: absolute;
    bottom: 20px;
    left: 20px;
    background: rgba(20,20,20,.9);
    color: white;
    padding: 14px 20px;
    border-radius: 15px;
    font-weight: 800;
    backdrop-filter: blur(10px);
}


/* HIGHLIGHT */

.highlight-sec {
    padding-top: 100px;
    padding-bottom: 100px;
    align-items: center;
}

.highlight-visual {
    position: relative;
}

.highlight-visual img {
    width: 100%;
    border-radius: 30px;
    box-shadow:
        0 25px 70px rgba(0,0,0,.14);
}

.highlight-sticker {
    position: absolute;
    top: 20px;
    left: 20px;
    background: var(--flame);
    color: white;
    padding: 12px 17px;
    border-radius: 100px;
    font-weight: 900;
    box-shadow:
        0 10px 25px rgba(255,90,31,.3);
}

.highlight-sec h2 {
    font-size: clamp(32px, 4vw, 52px);
    line-height: 1.05;
    font-weight: 900;
    letter-spacing: -2px;
}


/* BOOKING */

.booking-teaser {
    padding: 100px 0;
    text-align: center;
    background: #151515;
    color: white;
}

.booking-teaser .sec-eyebrow {
    color: #ff7440;
}

.booking-teaser .sec-heading {
    font-size: clamp(35px, 5vw, 58px);
    font-weight: 900;
}

.booking-hours {
    display: flex;
    justify-content: center;
    gap: 60px;
    margin: 35px 0;
}

.day {
    color: #aaa;
    margin-bottom: 7px;
}

.time {
    font-size: 23px;
    font-weight: 900;
}

.booking-phone {
    font-size: 20px;
    font-weight: 800;
}


/* TESTIMONIAL */

.testi-sec {
    padding: 100px 0;
    background: #fff;
}

.sec-heading {
    font-size: clamp(34px, 5vw, 55px);
    font-weight: 900;
    letter-spacing: -2px;
}

.testi-grid {
    display: grid;
    grid-template-columns:
        repeat(3, 1fr);
    gap: 20px;
}

.testi-card {
    padding: 30px;
    background: #fafafa;
    border: 1px solid #eee;
    border-radius: 25px;
    transition: .3s ease;
}

.testi-card:hover {
    transform: translateY(-6px);
    box-shadow:
        0 20px 50px rgba(0,0,0,.08);
}

.testi-stars {
    color: #ffb400;
    letter-spacing: 3px;
    font-size: 18px;
}

.testi-card p {
    line-height: 1.7;
    color: #555;
}

.testi-name {
    font-weight: 900;
}


/* FAQ */

.faq-sec {
    padding: 100px 0;
    background: #fff7f2;
}

.faq-item {
    background: white;
    border-radius: 18px;
    margin: 12px 0;
    padding: 20px 24px;
    border: 1px solid #eee;
}

.faq-item summary {
    cursor: pointer;
    font-weight: 800;
}

.faq-item p {
    color: #666;
    line-height: 1.7;
}


/* FOOTER */

footer {
    background: #101010;
    color: white;
    padding: 70px 0 30px;
}

footer p {
    color: #999;
    line-height: 1.7;
}

footer h4 {
    margin-bottom: 18px;
}

footer ul {
    padding: 0;
    list-style: none;
}

footer li {
    margin: 10px 0;
    color: #aaa;
}

footer a {
    color: #aaa;
    transition: .2s;
}

footer a:hover {
    color: var(--flame);
}


/* =========================================================
   MOBILE
   MATN AVVAL, RASM KEYIN
   ========================================================= */

@media (max-width: 800px) {

    .nav {
        padding: 0 15px;
    }

    .nav-links {
        gap: 8px;
    }

    .nav-links > a:not(.cart-pill) {
        display: none;
    }


    /* HERO MOBILE */

    .hero {
        display: flex !important;
        flex-direction: column !important;
        align-items: stretch !important;
        gap: 28px !important;
        padding-top: 40px;
        padding-bottom: 50px;
    }

    .hero > div:first-child {
        width: 100% !important;
        order: 1 !important;
    }

    .hero-photo {
        width: 100% !important;
        order: 2 !important;
        margin-top: 0 !important;
        border-radius: 25px;
    }

    .hero h1 {
        font-size: 46px;
        letter-spacing: -2.5px;
        text-align: left;
    }

    .hero p {
        font-size: 16px;
        text-align: left;
    }

    .hero-actions {
        flex-wrap: wrap;
    }

    .hero-actions a {
        width: 100%;
        text-align: center;
    }

    .hero-photo img {
        aspect-ratio: 1 / .9;
    }


    /* MENU */

    .menu-grid {
        grid-template-columns:
            repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .item-card {
        border-radius: 19px;
        padding: 8px;
    }

    .item-image {
        border-radius: 14px;
    }

    .item-image img {
        height: 155px;
    }

    .item-card h3 {
        font-size: 16px;
        margin-top: 12px;
    }

    .item-card p {
        font-size: 12px;
        min-height: 38px;
    }

    .item-price {
        font-size: 15px;
    }

    .add-btn {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        font-size: 24px;
    }

    .item-image-icon {
        width: 35px;
        height: 35px;
        font-size: 15px;
    }

    .about-sec,
    .highlight-sec,
    .booking-teaser,
    .testi-sec,
    .faq-sec {
        padding: 65px 0;
    }

    .about-grid {
        gap: 35px;
    }

    .highlight-sec {
        gap: 35px;
    }

    .testi-grid {
        grid-template-columns: 1fr;
    }

    .booking-hours {
        flex-direction: column;
        gap: 25px;
    }
}


/* VERY SMALL PHONES */

@media (max-width: 380px) {

    .menu-grid {
        grid-template-columns: 1fr;
    }

    .item-image img {
        height: 220px;
    }

    .hero h1 {
        font-size: 40px;
    }
}


/* SMOOTH */

html {
    scroll-behavior: smooth;
}


/* SELECTION */

::selection {
    background: var(--flame);
    color: white;
}

</style>

</head>


<body>


<!-- =========================================================
     HEADER
     ========================================================= -->

<header>

    <div class="wrap nav">

        <a href="index.php" class="brand">

            <span class="flame-dot"></span>

            SmashBite

        </a>


        <nav class="nav-links">

            <a href="index.php#menu">
                Menyu
            </a>

            <a href="book-table.php">
                Joy band qilish
            </a>

            <a href="cart.php" class="cart-pill">

                🛒 Savat

                <span class="count">
                    <?= cart_total_items() ?>
                </span>

            </a>

        </nav>

    </div>

</header>



<!-- =========================================================
     HERO
     ========================================================= -->

<section class="wrap hero">

    <div>

        <h1>

            Zarba bilan pishirilgan,

            <br>

            <span class="hl">
                10 daqiqada
            </span>

            qo'lingizda.

        </h1>


        <p>

            Smash-burgerlar, issiq pitsalar va xrustall fri —
            uyingizga yetkazib beramiz yoki restoranda joy band
            qilib, o'zingiz kelib tatib ko'ring.

        </p>


        <div class="hero-actions">

            <a href="#menu" class="btn-flame">
                Menyuni ko'rish
            </a>

            <a href="book-table.php" class="btn-outline">
                Joy band qilish
            </a>

        </div>

    </div>


    <div class="hero-photo">

        <img
            src="<?= e(food_photo('burger', 1)) ?>"
            alt="SmashBite burger"
        >

        <div class="hero-photo-badge">

            🔥 Yangi • Issiq • Mazali

        </div>

    </div>

</section>



<!-- =========================================================
     MENU
     ========================================================= -->

<div class="wrap" id="menu">


    <!-- CATEGORIES -->

    <div class="cat-tabs" id="cat-tabs">

        <button
            class="cat-tab active"
            data-filter="all"
        >

            Barchasi

        </button>


        <?php foreach ($categories as $cat): ?>

            <button
                class="cat-tab"
                data-filter="cat-<?= $cat['id'] ?>"
            >

                <?= food_icon($cat['icon'], 18) ?>

                <?= e($cat['name']) ?>

            </button>

        <?php endforeach; ?>

    </div>



    <!-- MENU SECTION -->

    <div class="menu-section">


        <?php foreach ($categories as $cat): ?>

            <div
                class="menu-category-block"
                data-category="cat-<?= $cat['id'] ?>"
            >


                <h2 class="menu-cat-title">

                    <?= e($cat['name']) ?>

                </h2>


                <div class="menu-grid">


                    <?php foreach ($byCategory[$cat['id']] ?? [] as $p): ?>


                        <div class="item-card">


                            <!-- IMAGE -->

                            <div class="item-image">

                                <img
                                    src="<?= e(food_photo($p['icon'], (int) $p['id'])) ?>"
                                    alt="<?= e($p['name']) ?>"
                                    loading="lazy"
                                >


                                <span class="item-image-icon">

                                    <?= food_icon($p['icon'], 24) ?>

                                </span>

                            </div>



                            <!-- NAME -->

                            <h3>

                                <?= e($p['name']) ?>

                            </h3>



                            <!-- DESCRIPTION -->

                            <p>

                                <?= e($p['description']) ?>

                            </p>



                            <!-- PRICE -->

                            <div class="item-foot">


                                <span class="item-price">

                                    <?= money($p['price']) ?>

                                </span>


                                <form
                                    method="post"
                                    action="index.php"
                                >

                                    <?= csrf_field() ?>


                                    <input
                                        type="hidden"
                                        name="product_id"
                                        value="<?= $p['id'] ?>"
                                    >


                                    <button
                                        type="submit"
                                        name="add_to_cart"
                                        class="add-btn"
                                        title="Savatga qo'shish"
                                    >

                                        +

                                    </button>


                                </form>


                            </div>


                        </div>


                    <?php endforeach; ?>


                </div>


            </div>

        <?php endforeach; ?>


    </div>


</div>



<!-- =========================================================
     ABOUT
     ========================================================= -->

<section class="about-sec" id="about">

    <div class="wrap about-grid">


        <div>


            <p class="sec-eyebrow">

                Biz haqimizda

            </p>


            <h2>

                Tez tayyorlanadi,
                sekin unutiladi.

            </h2>


            <p>

                SmashBite — har bir burgerni mijoz kelgach,
                aynan o'sha zahoti presslab pishiradigan kichik
                jamoa. Muzlatilgan yarim tayyor mahsulot
                ishlatmaymiz — go'sht har kuni yangi keladi.

            </p>


            <ul class="about-points">

                <li>

                    <span class="dot"></span>

                    Buyurtmadan 10-15 daqiqada tayyor

                </li>


                <li>

                    <span class="dot"></span>

                    Har kuni yangi go'sht va sabzavot

                </li>


                <li>

                    <span class="dot"></span>

                    Shahar bo'ylab yetkazib berish

                </li>

            </ul>


        </div>


        <div class="about-visual">

            <img
                src="<?= e(food_photo('fries', 2)) ?>"
                alt="Xrustall fri kartoshkasi"
                loading="lazy"
            >


            <div class="floating-card">

                🍟 Har kuni yangi

            </div>

        </div>


    </div>

</section>



<!-- =========================================================
     HIGHLIGHT
     ========================================================= -->

<section class="highlight-sec wrap">


    <div class="highlight-visual">

        <img
            src="<?= e(food_photo('pizza', 1)) ?>"
            alt="Pepperoni pizza"
            loading="lazy"
        >


        <div class="highlight-sticker">

            ⭐ TOP TANLOV

        </div>

    </div>



    <div>

        <span class="tag">

            Bugungi tavsiya

        </span>


        <h2>

            Pepperoni pitsa —
            xamiri yupqa,
            ustki qismi mo'l-ko'l.

        </h2>


        <p>

            Har bir dilim qo'lda yoyilgan xamirga,
            mozarella va achchiq pepperoni bilan yopiladi.
            Pechda 300°C haroratda 6 daqiqada pishiriladi —
            qirralari xrustall, o'rtasi yumshoq.

        </p>


        <div
            class="hero-actions"
            style="margin-top:24px;"
        >

            <a
                href="#menu"
                class="btn-flame"
            >

                Menyudan buyurtma berish

            </a>

        </div>


    </div>


</section>



<!-- =========================================================
     BOOKING
     ========================================================= -->

<section class="booking-teaser">


    <div class="wrap">


        <p class="sec-eyebrow">

            Restoranda tatib ko'rish

        </p>


        <h2 class="sec-heading">

            Stol band qiling,
            biz kutib olamiz

        </h2>


        <div class="booking-hours">


            <div>

                <div class="day">

                    Dushanba – Payshanba

                </div>


                <div class="time">

                    9:00 – 22:00

                </div>

            </div>


            <div>

                <div class="day">

                    Juma – Yakshanba

                </div>


                <div class="time">

                    11:00 – 23:00

                </div>

            </div>


        </div>


        <div class="booking-phone">

            📞 +998 88 309 02 07

        </div>


        <div
            class="hero-actions"
            style="justify-content:center; margin-top:24px;"
        >

            <a
                href="book-table.php"
                class="btn-flame"
            >

                Joy band qilish

            </a>

        </div>


    </div>

</section>



<!-- =========================================================
     TESTIMONIALS
     ========================================================= -->

<section class="testi-sec">


    <div class="wrap">


        <p class="sec-eyebrow">

            Mijozlar fikri

        </p>


        <h2 class="sec-heading">

            Bizni shahar bo'ylab tanishadi

        </h2>


        <div class="testi-grid">


            <div class="testi-card">

                <div class="testi-stars">

                    ★★★★★

                </div>


                <p>

                    "Buyurtma berganimdan 12 daqiqa o'tib
                    eshik oldida edi. Burger hali issiq,
                    non xrustall edi."

                </p>


                <div class="testi-name">

                    — Diyor, Chilonzor

                </div>

            </div>



            <div class="testi-card">

                <div class="testi-stars">

                    ★★★★★

                </div>


                <p>

                    "Do'stlarim bilan stol band qildik,
                    xodimlar juda samimiy. Pitsa xamiri
                    boshqa joylardan farq qiladi."

                </p>


                <div class="testi-name">

                    — Madina, Yunusobod

                </div>

            </div>



            <div class="testi-card">

                <div class="testi-stars">

                    ★★★★☆

                </div>


                <p>

                    "Fri kartoshkasi eng yaxshisi —
                    sovuq kelmaydi, doim xrustall.
                    Narxi ham munosib."

                </p>


                <div class="testi-name">

                    — Sardor, Mirzo Ulug'bek

                </div>

            </div>


        </div>

    </div>

</section>



<!-- =========================================================
     FAQ
     ========================================================= -->

<section class="faq-sec">


    <div class="wrap">


        <p class="sec-eyebrow">

            Savol-javob

        </p>


        <h2 class="sec-heading">

            Tez-tez so'raladigan savollar

        </h2>


        <details class="faq-item">

            <summary>

                Yetkazib berish qancha vaqt oladi?

            </summary>


            <p>

                Odatda 15-25 daqiqa, shahar chekkasida
                trafikka qarab biroz uzoqroq bo'lishi mumkin.

            </p>

        </details>



        <details class="faq-item">

            <summary>

                Qanday to'lov usullari mavjud?

            </summary>


            <p>

                Hozircha naqd pul bilan to'lash mumkin.
                Karta orqali to'lov (Payme/Click)
                tez orada qo'shiladi.

            </p>

        </details>



        <details class="faq-item">

            <summary>

                Vegetarian taomlar bormi?

            </summary>


            <p>

                Ha, Margarita pitsa va ba'zi garnirlar
                go'shtsiz tayyorlanadi. Menyuda tarkibi
                ko'rsatilgan.

            </p>

        </details>



        <details class="faq-item">

            <summary>

                Stol band qilish uchun oldindan to'lov
                kerakmi?

            </summary>


            <p>

                Yo'q, joy band qilish bepul.
                Faqat kelganingizda buyurtma qilasiz.

            </p>

        </details>


    </div>

</section>



<!-- =========================================================
     FOOTER
     ========================================================= -->

<footer>


    <div class="wrap">


        <div class="footer-grid">


            <div>

                <div class="brand">

                    <span class="flame-dot"></span>

                    SmashBite

                </div>


                <p>

                    Tez tayyorlanadigan,
                    sekin unutiladigan burger
                    va pitsalar.
                    Har kuni yangi mahsulotlar bilan.

                </p>

            </div>



            <div>

                <h4>

                    Ish vaqti

                </h4>


                <ul>

                    <li>
                        Dush-Pay: 9:00 – 22:00
                    </li>

                    <li>
                        Juma-Yak: 11:00 – 23:00
                    </li>

                </ul>

            </div>



            <div>

                <h4>

                    Havolalar

                </h4>


                <ul>

                    <li>

                        <a href="index.php#menu">

                            Menyu

                        </a>

                    </li>

                    <li>

                        <a href="book-table.php">

                            Joy band qilish

                        </a>

                    </li>

                    <li>

                        <a href="cart.php">

                            Savat

                        </a>

                    </li>

                </ul>

            </div>



            <div>

                <h4>

                    Aloqa

                </h4>


                <ul>

                    <li>

                        +998 88 309 02 07

                    </li>

                    <li>

                        QOQON

                    </li>

                </ul>

            </div>


        </div>


        <div style="margin-top:35px;color:#777;">

            © 2026 SmashBite

        </div>


    </div>

</footer>



<!-- =========================================================
     CATEGORY FILTER
     ========================================================= -->

<script>

document
    .querySelectorAll('#cat-tabs .cat-tab')
    .forEach(function(tab) {

        tab.addEventListener('click', function() {


            document
                .querySelectorAll('#cat-tabs .cat-tab')
                .forEach(function(t) {

                    t.classList.remove('active');

                });


            this.classList.add('active');


            var filter = this.dataset.filter;


            document
                .querySelectorAll('.menu-category-block')
                .forEach(function(block) {


                    if (
                        filter === 'all' ||
                        block.dataset.category === filter
                    ) {

                        block.style.display = '';

                    } else {

                        block.style.display = 'none';

                    }

                });


        });

    });

</script>


</body>

</html>
