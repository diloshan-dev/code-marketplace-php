<?php
// Product Data
$products = [
    [
        'id' => 1,
        'name' => 'Python Master Bundle',
        'lang' => 'python',
        'category' => 'Bundle',
        'price' => 4999,
        'original_price' => 8999,
        'rating' => 4.9,
        'sales' => 1240,
        'description' => 'Django, Flask, FastAPI, ML scripts සහ 500+ Python snippets. Production-ready code.',
        'files' => 48,
        'badge' => 'BEST SELLER',
        'badge_color' => '#f59e0b',
        'icon' => '🐍',
        'color' => '#3b82f6',
        'gradient' => 'linear-gradient(135deg, #1e3a5f, #2563eb)',
    ],
    [
        'id' => 2,
        'name' => 'HTML/CSS Pro Templates',
        'lang' => 'html',
        'category' => 'Templates',
        'price' => 2499,
        'original_price' => 4999,
        'rating' => 4.8,
        'sales' => 890,
        'description' => 'Landing pages, dashboards, portfolios - fully responsive modern designs.',
        'files' => 32,
        'badge' => 'HOT',
        'badge_color' => '#ef4444',
        'icon' => '🌐',
        'color' => '#f97316',
        'gradient' => 'linear-gradient(135deg, #7c2d12, #f97316)',
    ],
    [
        'id' => 3,
        'name' => 'JavaScript Complete Kit',
        'lang' => 'js',
        'category' => 'Bundle',
        'price' => 3499,
        'original_price' => 6999,
        'rating' => 4.7,
        'sales' => 760,
        'description' => 'React, Vue, Node.js, algorithms, DOM manipulation - 400+ scripts included.',
        'files' => 56,
        'badge' => 'NEW',
        'badge_color' => '#10b981',
        'icon' => '⚡',
        'color' => '#eab308',
        'gradient' => 'linear-gradient(135deg, #713f12, #eab308)',
    ],
    [
        'id' => 4,
        'name' => 'Java Enterprise Pack',
        'lang' => 'java',
        'category' => 'Enterprise',
        'price' => 5999,
        'original_price' => 9999,
        'rating' => 4.8,
        'sales' => 430,
        'description' => 'Spring Boot, microservices, design patterns, data structures - enterprise-grade.',
        'files' => 64,
        'badge' => 'PREMIUM',
        'badge_color' => '#8b5cf6',
        'icon' => '☕',
        'color' => '#ef4444',
        'gradient' => 'linear-gradient(135deg, #7f1d1d, #ef4444)',
    ],
    [
        'id' => 5,
        'name' => 'C/C++ Systems Bundle',
        'lang' => 'c',
        'category' => 'Systems',
        'price' => 3999,
        'original_price' => 7499,
        'rating' => 4.6,
        'sales' => 310,
        'description' => 'Algorithms, data structures, OS concepts, embedded systems code.',
        'files' => 38,
        'badge' => 'EXPERT',
        'badge_color' => '#06b6d4',
        'icon' => '⚙️',
        'color' => '#64748b',
        'gradient' => 'linear-gradient(135deg, #0f172a, #475569)',
    ],
    [
        'id' => 6,
        'name' => 'Full Stack Mega Bundle',
        'lang' => 'all',
        'category' => 'Mega Bundle',
        'price' => 9999,
        'original_price' => 24999,
        'rating' => 5.0,
        'sales' => 2100,
        'description' => 'ALL languages included! Python, JS, Java, C, HTML - everything you need.',
        'files' => 200,
        'badge' => '🔥 MEGA DEAL',
        'badge_color' => '#f59e0b',
        'icon' => '🚀',
        'color' => '#a855f7',
        'gradient' => 'linear-gradient(135deg, #3b0764, #a855f7)',
    ],
];

$filter = $_GET['filter'] ?? 'all';
$sort = $_GET['sort'] ?? 'popular';
$search = $_GET['search'] ?? '';

// Filter
$filtered = array_filter($products, function($p) use ($filter, $search) {
    $langMatch = $filter === 'all' || $p['lang'] === $filter;
    $searchMatch = empty($search) || stripos($p['name'], $search) !== false || stripos($p['description'], $search) !== false;
    return $langMatch && $searchMatch;
});

// Sort
usort($filtered, function($a, $b) use ($sort) {
    if ($sort === 'price_low') return $a['price'] - $b['price'];
    if ($sort === 'price_high') return $b['price'] - $a['price'];
    if ($sort === 'rating') return $b['rating'] <=> $a['rating'];
    return $b['sales'] - $a['sales']; // popular
});

$total_products = count($products);
$total_sales = array_sum(array_column($products, 'sales'));
?>
<!DOCTYPE html>
<html lang="si">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CodeVault — Premium Code Store</title>
<link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@400;600;700;800&display=swap" rel="stylesheet">
<style>
  :root {
    --bg: #060810;
    --surface: #0d1117;
    --surface2: #161b24;
    --border: #1e2733;
    --text: #e2e8f0;
    --muted: #64748b;
    --accent: #7c3aed;
    --accent2: #06b6d4;
    --glow: rgba(124,58,237,0.3);
  }

  * { margin: 0; padding: 0; box-sizing: border-box; }

  body {
    background: var(--bg);
    color: var(--text);
    font-family: 'Syne', sans-serif;
    min-height: 100vh;
    overflow-x: hidden;
  }

  /* Grid Background */
  body::before {
    content: '';
    position: fixed;
    inset: 0;
    background-image: 
      linear-gradient(rgba(124,58,237,0.03) 1px, transparent 1px),
      linear-gradient(90deg, rgba(124,58,237,0.03) 1px, transparent 1px);
    background-size: 60px 60px;
    pointer-events: none;
    z-index: 0;
  }

  /* NAV */
  nav {
    position: sticky;
    top: 0;
    z-index: 100;
    background: rgba(6,8,16,0.85);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid var(--border);
    padding: 0 2rem;
  }

  .nav-inner {
    max-width: 1400px;
    margin: 0 auto;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .logo {
    font-family: 'Space Mono', monospace;
    font-size: 1.4rem;
    font-weight: 700;
    color: #fff;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .logo span {
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .nav-cart {
    display: flex;
    align-items: center;
    gap: 1rem;
  }

  .cart-btn {
    background: var(--surface2);
    border: 1px solid var(--border);
    color: var(--text);
    padding: 8px 16px;
    border-radius: 8px;
    cursor: pointer;
    font-family: 'Space Mono', monospace;
    font-size: 0.8rem;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
  }

  .cart-btn:hover {
    border-color: var(--accent);
    background: rgba(124,58,237,0.1);
  }

  .cart-count {
    background: var(--accent);
    color: #fff;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.7rem;
    font-weight: 700;
  }

  /* HERO */
  .hero {
    position: relative;
    z-index: 1;
    text-align: center;
    padding: 80px 2rem 60px;
    max-width: 1400px;
    margin: 0 auto;
  }

  .hero-eyebrow {
    font-family: 'Space Mono', monospace;
    font-size: 0.75rem;
    color: var(--accent2);
    letter-spacing: 4px;
    text-transform: uppercase;
    margin-bottom: 16px;
  }

  .hero h1 {
    font-size: clamp(2.5rem, 6vw, 5rem);
    font-weight: 800;
    line-height: 1.05;
    margin-bottom: 16px;
  }

  .hero h1 .highlight {
    background: linear-gradient(135deg, var(--accent), var(--accent2));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .hero p {
    color: var(--muted);
    font-size: 1.1rem;
    max-width: 500px;
    margin: 0 auto 40px;
  }

  .stats-row {
    display: flex;
    justify-content: center;
    gap: 48px;
    flex-wrap: wrap;
  }

  .stat {
    text-align: center;
  }

  .stat-num {
    font-family: 'Space Mono', monospace;
    font-size: 2rem;
    font-weight: 700;
    color: #fff;
    display: block;
  }

  .stat-label {
    font-size: 0.75rem;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 2px;
  }

  /* FILTER BAR */
  .filter-bar {
    position: sticky;
    top: 64px;
    z-index: 50;
    background: rgba(6,8,16,0.9);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid var(--border);
    padding: 14px 2rem;
  }

  .filter-inner {
    max-width: 1400px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
  }

  .search-box {
    flex: 1;
    min-width: 200px;
    max-width: 300px;
    position: relative;
  }

  .search-box input {
    width: 100%;
    background: var(--surface2);
    border: 1px solid var(--border);
    color: var(--text);
    padding: 8px 12px 8px 36px;
    border-radius: 8px;
    font-family: 'Space Mono', monospace;
    font-size: 0.8rem;
    outline: none;
    transition: border-color 0.2s;
  }

  .search-box input:focus { border-color: var(--accent); }

  .search-icon {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--muted);
    font-size: 0.9rem;
  }

  .filter-tabs {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
  }

  .filter-tab {
    padding: 6px 14px;
    border-radius: 6px;
    border: 1px solid var(--border);
    background: transparent;
    color: var(--muted);
    font-family: 'Space Mono', monospace;
    font-size: 0.75rem;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .filter-tab:hover, .filter-tab.active {
    border-color: var(--accent);
    color: #fff;
    background: rgba(124,58,237,0.15);
  }

  .sort-select {
    margin-left: auto;
    background: var(--surface2);
    border: 1px solid var(--border);
    color: var(--text);
    padding: 8px 12px;
    border-radius: 8px;
    font-family: 'Space Mono', monospace;
    font-size: 0.75rem;
    outline: none;
    cursor: pointer;
  }

  /* PRODUCTS GRID */
  .main {
    position: relative;
    z-index: 1;
    max-width: 1400px;
    margin: 0 auto;
    padding: 40px 2rem;
  }

  .section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 28px;
  }

  .section-title {
    font-family: 'Space Mono', monospace;
    font-size: 0.85rem;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 2px;
  }

  .result-count {
    font-family: 'Space Mono', monospace;
    font-size: 0.8rem;
    color: var(--accent2);
  }

  .products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 20px;
  }

  .product-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 16px;
    overflow: hidden;
    transition: all 0.3s;
    position: relative;
    cursor: pointer;
  }

  .product-card:hover {
    border-color: rgba(124,58,237,0.5);
    transform: translateY(-4px);
    box-shadow: 0 20px 60px rgba(0,0,0,0.5), 0 0 0 1px rgba(124,58,237,0.2);
  }

  .card-header {
    height: 140px;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
  }

  .card-header::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, transparent 50%, var(--surface) 100%);
  }

  .card-icon {
    font-size: 3.5rem;
    position: relative;
    z-index: 1;
    filter: drop-shadow(0 0 20px rgba(255,255,255,0.2));
  }

  .card-badge {
    position: absolute;
    top: 12px;
    right: 12px;
    padding: 4px 10px;
    border-radius: 6px;
    font-family: 'Space Mono', monospace;
    font-size: 0.65rem;
    font-weight: 700;
    color: #000;
    z-index: 2;
    letter-spacing: 1px;
  }

  .card-body {
    padding: 20px;
  }

  .card-lang {
    font-family: 'Space Mono', monospace;
    font-size: 0.65rem;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 6px;
  }

  .card-name {
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 8px;
    line-height: 1.3;
  }

  .card-desc {
    color: var(--muted);
    font-size: 0.85rem;
    line-height: 1.5;
    margin-bottom: 14px;
  }

  .card-meta {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 16px;
    font-family: 'Space Mono', monospace;
    font-size: 0.72rem;
    color: var(--muted);
  }

  .rating { color: #f59e0b; }
  .files { color: var(--accent2); }

  .card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 14px;
    border-top: 1px solid var(--border);
  }

  .price-block {}

  .original-price {
    font-family: 'Space Mono', monospace;
    font-size: 0.75rem;
    color: var(--muted);
    text-decoration: line-through;
  }

  .price {
    font-family: 'Space Mono', monospace;
    font-size: 1.4rem;
    font-weight: 700;
    color: #fff;
  }

  .price span {
    font-size: 0.8rem;
    color: var(--muted);
  }

  .discount {
    font-family: 'Space Mono', monospace;
    font-size: 0.7rem;
    color: #10b981;
    background: rgba(16,185,129,0.1);
    padding: 2px 6px;
    border-radius: 4px;
    margin-left: 8px;
  }

  .add-btn {
    background: linear-gradient(135deg, var(--accent), #6d28d9);
    border: none;
    color: #fff;
    padding: 10px 20px;
    border-radius: 8px;
    font-family: 'Space Mono', monospace;
    font-size: 0.78rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s;
    letter-spacing: 1px;
  }

  .add-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 0 20px rgba(124,58,237,0.5);
  }

  .add-btn.added {
    background: linear-gradient(135deg, #10b981, #059669);
  }

  /* CART PANEL */
  .cart-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.6);
    z-index: 200;
    backdrop-filter: blur(4px);
  }

  .cart-overlay.open { display: block; }

  .cart-panel {
    position: fixed;
    right: 0;
    top: 0;
    bottom: 0;
    width: 380px;
    background: var(--surface);
    border-left: 1px solid var(--border);
    z-index: 201;
    display: flex;
    flex-direction: column;
    transform: translateX(100%);
    transition: transform 0.3s cubic-bezier(0.4,0,0.2,1);
  }

  .cart-panel.open { transform: translateX(0); }

  .cart-header {
    padding: 24px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .cart-title {
    font-family: 'Space Mono', monospace;
    font-size: 1rem;
    font-weight: 700;
  }

  .close-btn {
    background: none;
    border: 1px solid var(--border);
    color: var(--text);
    width: 32px;
    height: 32px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
  }

  .close-btn:hover { border-color: var(--accent); color: #fff; }

  .cart-items {
    flex: 1;
    overflow-y: auto;
    padding: 20px 24px;
  }

  .cart-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 0;
    border-bottom: 1px solid var(--border);
  }

  .cart-item-icon {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    flex-shrink: 0;
  }

  .cart-item-info { flex: 1; }

  .cart-item-name {
    font-size: 0.85rem;
    font-weight: 600;
    margin-bottom: 2px;
  }

  .cart-item-price {
    font-family: 'Space Mono', monospace;
    font-size: 0.8rem;
    color: var(--accent2);
  }

  .remove-item {
    background: none;
    border: none;
    color: var(--muted);
    cursor: pointer;
    font-size: 1rem;
    transition: color 0.2s;
  }

  .remove-item:hover { color: #ef4444; }

  .cart-footer {
    padding: 24px;
    border-top: 1px solid var(--border);
  }

  .cart-total {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
  }

  .total-label {
    font-family: 'Space Mono', monospace;
    font-size: 0.75rem;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 2px;
  }

  .total-amount {
    font-family: 'Space Mono', monospace;
    font-size: 1.5rem;
    font-weight: 700;
    color: #fff;
  }

  .checkout-btn {
    width: 100%;
    background: linear-gradient(135deg, var(--accent), #6d28d9);
    border: none;
    color: #fff;
    padding: 14px;
    border-radius: 10px;
    font-family: 'Space Mono', monospace;
    font-size: 0.9rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s;
    letter-spacing: 2px;
  }

  .checkout-btn:hover {
    box-shadow: 0 0 30px rgba(124,58,237,0.5);
    transform: translateY(-1px);
  }

  .empty-cart {
    text-align: center;
    color: var(--muted);
    padding: 48px 0;
    font-family: 'Space Mono', monospace;
    font-size: 0.8rem;
  }

  .empty-cart span { font-size: 2rem; display: block; margin-bottom: 12px; }

  /* FOOTER */
  footer {
    position: relative;
    z-index: 1;
    text-align: center;
    padding: 32px 2rem;
    border-top: 1px solid var(--border);
    color: var(--muted);
    font-family: 'Space Mono', monospace;
    font-size: 0.75rem;
  }

  /* Toast */
  .toast {
    position: fixed;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%) translateY(80px);
    background: var(--surface2);
    border: 1px solid #10b981;
    color: #10b981;
    padding: 12px 24px;
    border-radius: 10px;
    font-family: 'Space Mono', monospace;
    font-size: 0.8rem;
    z-index: 300;
    transition: transform 0.3s;
  }

  .toast.show { transform: translateX(-50%) translateY(0); }

  @media (max-width: 600px) {
    .products-grid { grid-template-columns: 1fr; }
    .cart-panel { width: 100%; }
    .stats-row { gap: 24px; }
  }
</style>
</head>
<body>

<!-- NAV -->
<nav>
  <div class="nav-inner">
    <a href="index.php" class="logo">
      &lt;<span>CodeVault</span>/&gt;
    </a>
    <div class="nav-cart">
      <button class="cart-btn" onclick="openCart()">
        🛒 Cart
        <div class="cart-count" id="cartCount">0</div>
      </button>
    </div>
  </div>
</nav>

<!-- HERO -->
<div class="hero">
  <p class="hero-eyebrow">// Premium Code Marketplace</p>
  <h1>
    Buy <span class="highlight">Production-Ready</span><br>
    Code Templates
  </h1>
  <p>Python, JavaScript, Java, C, HTML — professional code bundles for developers.</p>
  <div class="stats-row">
    <div class="stat">
      <span class="stat-num"><?= $total_products ?>+</span>
      <span class="stat-label">Bundles</span>
    </div>
    <div class="stat">
      <span class="stat-num"><?= number_format($total_sales) ?>+</span>
      <span class="stat-label">Happy Devs</span>
    </div>
    <div class="stat">
      <span class="stat-num">500+</span>
      <span class="stat-label">Code Files</span>
    </div>
    <div class="stat">
      <span class="stat-num">24/7</span>
      <span class="stat-label">Support</span>
    </div>
  </div>
</div>

<!-- FILTER BAR -->
<div class="filter-bar">
  <div class="filter-inner">
    <form method="GET" style="display:contents" id="filterForm">
      <div class="search-box">
        <span class="search-icon">🔍</span>
        <input type="text" name="search" placeholder="Search products..." 
               value="<?= htmlspecialchars($search) ?>"
               onchange="document.getElementById('filterForm').submit()">
      </div>

      <div class="filter-tabs">
        <?php
        $tabs = [
          'all' => '🌟 All',
          'python' => '🐍 Python',
          'html' => '🌐 HTML/CSS',
          'js' => '⚡ JavaScript',
          'java' => '☕ Java',
          'c' => '⚙️ C/C++',
        ];
        foreach ($tabs as $key => $label):
          $active = $filter === $key ? 'active' : '';
        ?>
        <a href="?filter=<?= $key ?>&sort=<?= $sort ?>&search=<?= urlencode($search) ?>" 
           class="filter-tab <?= $active ?>"><?= $label ?></a>
        <?php endforeach; ?>
      </div>

      <select name="sort" class="sort-select" onchange="document.getElementById('filterForm').submit()">
        <option value="popular" <?= $sort==='popular'?'selected':'' ?>>Most Popular</option>
        <option value="rating" <?= $sort==='rating'?'selected':'' ?>>Top Rated</option>
        <option value="price_low" <?= $sort==='price_low'?'selected':'' ?>>Price: Low</option>
        <option value="price_high" <?= $sort==='price_high'?'selected':'' ?>>Price: High</option>
      </select>

      <input type="hidden" name="filter" value="<?= $filter ?>">
    </form>
  </div>
</div>

<!-- PRODUCTS -->
<main class="main">
  <div class="section-header">
    <span class="section-title">// Products</span>
    <span class="result-count"><?= count($filtered) ?> results</span>
  </div>

  <div class="products-grid">
    <?php foreach ($filtered as $p): ?>
    <?php $disc = round((1 - $p['price']/$p['original_price'])*100); ?>
    <div class="product-card" id="card-<?= $p['id'] ?>">
      <div class="card-header" style="background: <?= $p['gradient'] ?>">
        <div class="card-icon"><?= $p['icon'] ?></div>
        <?php if ($p['badge']): ?>
        <div class="card-badge" style="background: <?= $p['badge_color'] ?>"><?= $p['badge'] ?></div>
        <?php endif; ?>
      </div>
      <div class="card-body">
        <div class="card-lang"><?= strtoupper($p['lang']) ?> · <?= $p['category'] ?></div>
        <div class="card-name"><?= $p['name'] ?></div>
        <div class="card-desc"><?= $p['description'] ?></div>
        <div class="card-meta">
          <span class="rating">★ <?= $p['rating'] ?></span>
          <span><?= number_format($p['sales']) ?> sold</span>
          <span class="files">📁 <?= $p['files'] ?> files</span>
        </div>
        <div class="card-footer">
          <div class="price-block">
            <div class="original-price">Rs. <?= number_format($p['original_price']) ?></div>
            <div class="price">Rs. <?= number_format($p['price']) ?><span>/once</span>
              <span class="discount">-<?= $disc ?>%</span>
            </div>
          </div>
          <button class="add-btn" id="btn-<?= $p['id'] ?>"
                  onclick="addToCart(<?= $p['id'] ?>, '<?= addslashes($p['name']) ?>', <?= $p['price'] ?>, '<?= $p['icon'] ?>')">
            + ADD
          </button>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</main>

<!-- CART PANEL -->
<div class="cart-overlay" id="cartOverlay" onclick="closeCart()"></div>
<div class="cart-panel" id="cartPanel">
  <div class="cart-header">
    <span class="cart-title">// Your Cart</span>
    <button class="close-btn" onclick="closeCart()">✕</button>
  </div>
  <div class="cart-items" id="cartItems">
    <div class="empty-cart"><span>🛒</span>Cart is empty</div>
  </div>
  <div class="cart-footer">
    <div class="cart-total">
      <span class="total-label">Total</span>
      <span class="total-amount" id="cartTotal">Rs. 0</span>
    </div>
    <button class="checkout-btn" onclick="checkout()">CHECKOUT →</button>
  </div>
</div>

<!-- Toast -->
<div class="toast" id="toast"></div>

<footer>
  &lt;CodeVault/&gt; — Premium Code Marketplace &nbsp;|&nbsp; © <?= date('Y') ?> &nbsp;|&nbsp; Built with ❤️ for Developers
</footer>

<script>
let cart = JSON.parse(localStorage.getItem('cv_cart') || '[]');
renderCart();

function addToCart(id, name, price, icon) {
  const existing = cart.find(i => i.id === id);
  if (!existing) {
    cart.push({id, name, price, icon});
    localStorage.setItem('cv_cart', JSON.stringify(cart));
    renderCart();
    const btn = document.getElementById('btn-'+id);
    btn.textContent = '✓ ADDED';
    btn.classList.add('added');
    setTimeout(() => { btn.textContent = '+ ADD'; btn.classList.remove('added'); }, 2000);
    showToast('✓ ' + name + ' added to cart!');
  } else {
    showToast('Already in cart!');
  }
}

function removeFromCart(id) {
  cart = cart.filter(i => i.id !== id);
  localStorage.setItem('cv_cart', JSON.stringify(cart));
  renderCart();
}

function renderCart() {
  const el = document.getElementById('cartItems');
  const countEl = document.getElementById('cartCount');
  const totalEl = document.getElementById('cartTotal');

  countEl.textContent = cart.length;

  if (cart.length === 0) {
    el.innerHTML = '<div class="empty-cart"><span>🛒</span>Cart is empty</div>';
    totalEl.textContent = 'Rs. 0';
    return;
  }

  let total = 0;
  el.innerHTML = cart.map(item => {
    total += item.price;
    return `
      <div class="cart-item">
        <div class="cart-item-icon" style="background: rgba(124,58,237,0.1)">${item.icon}</div>
        <div class="cart-item-info">
          <div class="cart-item-name">${item.name}</div>
          <div class="cart-item-price">Rs. ${item.price.toLocaleString()}</div>
        </div>
        <button class="remove-item" onclick="removeFromCart(${item.id})">✕</button>
      </div>`;
  }).join('');

  totalEl.textContent = 'Rs. ' + total.toLocaleString();
}

function openCart() {
  document.getElementById('cartOverlay').classList.add('open');
  document.getElementById('cartPanel').classList.add('open');
}

function closeCart() {
  document.getElementById('cartOverlay').classList.remove('open');
  document.getElementById('cartPanel').classList.remove('open');
}

function checkout() {
  if (cart.length === 0) { showToast('Cart is empty!'); return; }
  showToast('🎉 Order placed! Thank you!');
  cart = [];
  localStorage.setItem('cv_cart', JSON.stringify(cart));
  renderCart();
  closeCart();
}

function showToast(msg) {
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 3000);
}
</script>
</body>
</html>
