<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}
$u = $_SESSION['username'];
$a = ($u === 'admin');
?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
  <meta name="mobile-web-app-capable" content="yes" />
  <title>Panel — xObywatel</title>

  <!-- Wczytaj motyw przed renderowaniem (brak mignięcia) -->
  <script>
    (function () {
      try {
        var stored = localStorage.getItem("theme-preference");
        var prefersDark = window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches;
        var theme = stored || (prefersDark ? "dark" : "light");
        document.documentElement.setAttribute("data-theme", theme);
      } catch (e) {}
    })();
  </script>

  <style>
    body {
      margin: 0;
      opacity: 0;
      transition: opacity 0.15s;
      background-color: #f5f6fb;
    }
    body.loaded { opacity: 1; }
    .app-header {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 100;
      background: #fff;
      height: 60px;
      display: flex;
      align-items: center;
      padding: 0 20px;
      box-shadow: 0 1px 3px rgba(0,0,0,.1);
    }
    .panel-page { padding-top: 60px; }
  </style>

  <script src="js/dev-config.js"></script>
  <link rel="stylesheet" href="css/main.css" />
  <link rel="stylesheet" href="css/common.css" />
  <link rel="stylesheet" href="css/theme.css" />
  <link rel="stylesheet" href="css/pages/panel.css" />
  <script src="js/theme.js" defer></script>
  <script src="js/header.js" async></script>
</head>
<body class="panel-page">

  <!-- ══ NAGŁÓWEK ══════════════════════════════════════════════ -->
  <header class="app-header">
    <div class="header-left">
      <div id="inicjaly1">
        <img src="assets/icons/coi_common_ui_ic_mobywatel_logo.svg" alt="mObywatel" />
      </div>
      <span class="header-title">Panel</span>
    </div>
    <div class="header-right" style="display:flex;align-items:center;gap:8px;">
      <?php if ($a): ?>
        <a href="adminpanel/index.php" class="header-admin-btn">⚙ Admin</a>
      <?php endif; ?>
      <div id="dzwonek" aria-label="Powiadomienia" title="Powiadomienia">
        <svg class="notif-bell" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
          <path fill="currentColor" d="M12.75,2C12.75,1.586 12.414,1.25 12,1.25C11.586,1.25 11.25,1.586 11.25,2V3.038C7.736,3.412 4.999,6.386 4.999,9.998V12.617C4.999,13.107 4.82,13.58 4.494,13.946L2.962,15.67C1.816,16.959 2.731,18.998 4.457,18.998H11.55L11.559,18.998C11.853,18.997 12.15,18.997 12.444,18.998L12.453,18.998H19.546C21.271,18.998 22.187,16.959 21.041,15.67L19.505,13.942C19.179,13.576 18.999,13.103 18.999,12.613V12.25C18.999,11.836 18.664,11.5 18.249,11.5C17.835,11.5 17.499,11.836 17.499,12.25V12.613C17.499,13.47 17.814,14.298 18.383,14.938L19.92,16.666C20.206,16.989 19.977,17.498 19.546,17.498H12.453L12.45,17.498C12.152,17.497 11.851,17.497 11.553,17.498L11.55,17.498H4.457C4.026,17.498 3.797,16.989 4.083,16.666L5.615,14.943C6.185,14.302 6.499,13.475 6.499,12.617V9.998C6.499,6.961 8.962,4.498 11.999,4.498C12.398,4.498 12.75,4.195 12.75,3.796V2Z"/>
          <path fill="currentColor" d="M9.5,19H8V19.5C8,21.157 9.343,22.5 11,22.5H13C14.657,22.5 16,21.157 16,19.5V19H14.5V19.5C14.5,20.328 13.828,21 13,21H11C10.172,21 9.5,20.328 9.5,19.5V19Z"/>
          <path fill="#cd291c" d="M18,6m-4,0a4,4 0,1 1,8 0a4,4 0,1 1,-8 0"/>
        </svg>
      </div>
    </div>
  </header>

  <!-- ══ POWITANIE ══════════════════════════════════════════════ -->
  <h1 class="panel-section-title">
    Dzień dobry, <strong><?php echo htmlspecialchars($u); ?></strong> 👋
  </h1>
  <p class="panel-greeting-sub">
    Przegląd systemu · <?php echo date('j F Y'); ?>
  </p>

  <!-- ══ STATYSTYKI ═════════════════════════════════════════════ -->
  <div class="panel-stats">
    <div class="panel-stat">
      <div class="panel-stat__label">Instancje aktywne</div>
      <div class="panel-stat__value panel-stat__value--blue">24</div>
      <div class="panel-stat__delta"><span class="up">↑ +3</span> od wczoraj</div>
    </div>
    <div class="panel-stat">
      <div class="panel-stat__label">Dokumenty wydane</div>
      <div class="panel-stat__value panel-stat__value--green">148</div>
      <div class="panel-stat__delta"><span class="up">↑ +12</span> ten tydzień</div>
    </div>
    <div class="panel-stat">
      <div class="panel-stat__label">Oczekujące</div>
      <div class="panel-stat__value panel-stat__value--yellow">7</div>
      <div class="panel-stat__delta"><span class="dn">↓ −2</span> wymaga uwagi</div>
    </div>
    <div class="panel-stat">
      <div class="panel-stat__label">Błędy systemu</div>
      <div class="panel-stat__value panel-stat__value--red">2</div>
      <div class="panel-stat__delta"><span class="dn">↑ +2</span> ostatnie 24h</div>
    </div>
  </div>

  <!-- ══ CTA KREATOR ════════════════════════════════════════════ -->
  <div class="panel-cta">
    <div>
      <div class="panel-cta__title">Kreator instancji</div>
      <div class="panel-cta__sub">Utwórz nowy dokument w kilka sekund</div>
    </div>
    <a href="generator.php" class="panel-cta__btn">Start →</a>
  </div>

  <!-- ══ SZYBKI DOSTĘP ══════════════════════════════════════════ -->
  <div class="panel-section-head">
    <h3>Szybki dostęp</h3>
  </div>
  <div class="panel-links">
    <a href="documents.html" class="panel-link">
      <div class="panel-link__icon panel-link__icon--blue">
        <img src="assets/icons/if001_documents.svg" alt="" />
      </div>
      <div class="panel-link__text">
        <div class="panel-link__title">Dokumenty</div>
        <div class="panel-link__desc">Przeglądaj wszystkie dokumenty</div>
      </div>
      <span class="panel-link__arrow">›</span>
    </a>
    <a href="dowod.html" class="panel-link">
      <div class="panel-link__icon panel-link__icon--blue">
        <img src="assets/icons/mini_mdowod.svg" alt="" />
      </div>
      <div class="panel-link__text">
        <div class="panel-link__title">mDowód osobisty</div>
        <div class="panel-link__desc">Wyświetl lub wygeneruj dowód</div>
      </div>
      <span class="panel-link__arrow">›</span>
    </a>
    <a href="prawojazdy.html" class="panel-link">
      <div class="panel-link__icon panel-link__icon--green">
        <img src="assets/icons/uprawnienia_kierowcy.svg" alt="" />
      </div>
      <div class="panel-link__text">
        <div class="panel-link__title">Prawo jazdy</div>
        <div class="panel-link__desc">Wyświetl lub wygeneruj prawo jazdy</div>
      </div>
      <span class="panel-link__arrow">›</span>
    </a>
    <a href="qr.html" class="panel-link">
      <div class="panel-link__icon panel-link__icon--purple">
        <img src="assets/icons/if004_scan.svg" alt="" />
      </div>
      <div class="panel-link__text">
        <div class="panel-link__title">Kody QR</div>
        <div class="panel-link__desc">Generuj i skanuj kody QR</div>
      </div>
      <span class="panel-link__arrow">›</span>
    </a>
    <a href="services.html" class="panel-link">
      <div class="panel-link__icon panel-link__icon--green">
        <img src="assets/icons/if002_services.svg" alt="" />
      </div>
      <div class="panel-link__text">
        <div class="panel-link__title">Usługi</div>
        <div class="panel-link__desc">Dostępne usługi i serwisy</div>
      </div>
      <span class="panel-link__arrow">›</span>
    </a>
    <a href="api/logout.php" class="panel-link" style="border-color:rgba(220,38,38,.15);">
      <div class="panel-link__icon" style="background:rgba(220,38,38,.08);">
        <img src="assets/icons/ab019_logout.svg" alt="" />
      </div>
      <div class="panel-link__text">
        <div class="panel-link__title" style="color:#dc2626;">Wyloguj się</div>
        <div class="panel-link__desc">Zakończ sesję</div>
      </div>
      <span class="panel-link__arrow" style="color:#dc2626;">›</span>
    </a>
  </div>

  <!-- ══ OSTATNIA AKTYWNOŚĆ ═════════════════════════════════════ -->
  <div class="panel-section-head">
    <h3>Ostatnia aktywność</h3>
  </div>
  <div class="panel-activity" style="background:var(--surface);margin:0 16px 16px;border-radius:var(--radius);border:1px solid var(--border);padding:0 14px;">
    <div class="panel-activity-item">
      <div class="panel-activity-dot panel-activity-dot--ok"></div>
      <div class="panel-activity-text">
        <div class="panel-activity-name">Generowanie dowodu</div>
        <div class="panel-activity-user">jan.kowalski</div>
      </div>
      <div class="panel-activity-time">2 min temu</div>
    </div>
    <div class="panel-activity-item">
      <div class="panel-activity-dot panel-activity-dot--ok"></div>
      <div class="panel-activity-text">
        <div class="panel-activity-name">Logowanie do systemu</div>
        <div class="panel-activity-user"><?php echo htmlspecialchars($u); ?></div>
      </div>
      <div class="panel-activity-time">8 min temu</div>
    </div>
    <div class="panel-activity-item">
      <div class="panel-activity-dot panel-activity-dot--ok"></div>
      <div class="panel-activity-text">
        <div class="panel-activity-name">Eksport kodu QR</div>
        <div class="panel-activity-user">anna.nowak</div>
      </div>
      <div class="panel-activity-time">15 min temu</div>
    </div>
    <div class="panel-activity-item">
      <div class="panel-activity-dot panel-activity-dot--err"></div>
      <div class="panel-activity-text">
        <div class="panel-activity-name">Błąd API auth</div>
        <div class="panel-activity-user">system</div>
      </div>
      <div class="panel-activity-time">32 min temu</div>
    </div>
    <div class="panel-activity-item">
      <div class="panel-activity-dot panel-activity-dot--warn"></div>
      <div class="panel-activity-text">
        <div class="panel-activity-name">Aktualizacja danych</div>
        <div class="panel-activity-user">jan.kowalski</div>
      </div>
      <div class="panel-activity-time">1h temu</div>
    </div>
    <div class="panel-activity-item">
      <div class="panel-activity-dot panel-activity-dot--info"></div>
      <div class="panel-activity-text">
        <div class="panel-activity-name">Legitymacja studencka</div>
        <div class="panel-activity-user">p.zielinski</div>
      </div>
      <div class="panel-activity-time">3h temu</div>
    </div>
  </div>

  <!-- ══ STATUS USŁUG ═══════════════════════════════════════════ -->
  <div class="panel-section-head">
    <h3>Status usług</h3>
  </div>
  <div class="panel-services">
    <div class="panel-service">
      <div class="panel-service__head">
        <div class="panel-service__name">API Gateway</div>
        <span class="panel-badge panel-badge--ok">Online</span>
      </div>
      <div class="panel-service__bar-bg">
        <div class="panel-service__bar panel-service__bar--green" style="width:94%"></div>
      </div>
      <div class="panel-service__meta">Uptime 99.4% · 12 ms avg</div>
    </div>
    <div class="panel-service">
      <div class="panel-service__head">
        <div class="panel-service__name">Baza danych</div>
        <span class="panel-badge panel-badge--ok">Online</span>
      </div>
      <div class="panel-service__bar-bg">
        <div class="panel-service__bar panel-service__bar--blue" style="width:78%"></div>
      </div>
      <div class="panel-service__meta">78% pojemności · 4 ms avg</div>
    </div>
    <div class="panel-service">
      <div class="panel-service__head">
        <div class="panel-service__name">Generowanie PDF</div>
        <span class="panel-badge panel-badge--warn">Wolno</span>
      </div>
      <div class="panel-service__bar-bg">
        <div class="panel-service__bar panel-service__bar--yellow" style="width:55%"></div>
      </div>
      <div class="panel-service__meta">55% wydajności · 340 ms avg</div>
    </div>
  </div>

  <!-- ══ DOLNA NAWIGACJA ════════════════════════════════════════ -->
  <div class="bottom-nav">
    <div class="bottom-nav__tab bottom-nav__tab--active"
         onclick="window.location.href='panel.php'">
      <img src="assets/icons/if006_documents_fill.svg" alt="Panel" />
      <span class="bottom-nav__active-text">Panel</span>
    </div>
    <div class="bottom-nav__tab unfill"
         onclick="window.location.href='services.html'">
      <img src="assets/icons/if002_services.svg" alt="Usługi" />
      <span>Usługi</span>
    </div>
    <div class="bottom-nav__tab unfill"
         onclick="window.location.href='qr.html'">
      <img src="assets/icons/if004_scan.svg" alt="QR" />
      <span>Kod QR</span>
    </div>
    <div class="bottom-nav__tab unfill"
         onclick="window.location.href='more.html'">
      <img src="assets/icons/if005_more.svg" alt="Więcej" />
      <span>Więcej</span>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      document.body.classList.add("loaded");
    });
  </script>
</body>
</html>
