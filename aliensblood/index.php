<!-- INDEX.PHP -->
<?php session_start(); ?> 
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>ALiENS BLooD</title>
  <link rel="stylesheet" href="assets/css/styles.css">
  <link rel="stylesheet" href="assets/css/index.css">
  <link rel="stylesheet" href="assets/css/cart.css">
  <link rel="stylesheet" href="assets/css/ciberpunk_button.css">
  <link rel="stylesheet" href="assets/css/test.css">
  <script src="assets/js/main.js" defer></script>
  <script src="assets/js/cookies.js" defer></script>
  <script src="assets/js/cart.js" defer></script>
</head>
<body>

<header>
  <h1 class="site-title">ALiENS BLooD</h1>
  <nav>
    <ul>
      <li><a href="index.php">Inicio</a></li>
      <li><a href="novedades.php">Novedades</a></li>
      <li><a href="gallery.php">Galería Pública</a></li>
      <li><a href="designers.php">Diseñadores</a></li>
      <li><a href="shop.php">Tienda</a></li>
      <li><a href="contact.php">Contacto</a></li>
      <li><a href="appointment.php">Citas</a></li>
      <li><a href="legal.php">Políticas</a></li>
      <?php if (isset($_SESSION['user_id'])): ?>
        <li><a href="users/profile.php">Perfil</a></li>
        <li><a href="users/logout.php">Cerrar sesión</a></li>
      <?php else: ?>
        <li><a href="users/login.php">Iniciar sesión</a></li>
        <li><a href="users/register.php">Registrarse</a></li>
      <?php endif; ?>
      <li class="cart-icon">
        <a href="cart.php">
          🛒 <span id="cart-count"><?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?></span>
        </a>
      </li>
    </ul>
  </nav>
</header>

<main>

<!-- Fondo principal estilo banner -->
<section class="hero-section">
  <div class="hero-container">
    <img src="assets/img/background.png" alt="background del index" class="hero-img">
    <div class="hero-overlay">
      <h1>Bienvenido a ALiENS BLooD</h1>
      <a href="contact.php" class="btn btn-hero">Contacta con Nosotros</a>
    </div>
  </div>
</section>

<!-- BOTONES PARA INTERACTUAR -->
<section class="intro-section">
  <p>Ofrecemos diseños únicos y productos de calidad.</p>
  <p><strong>DECORA TU PIEL O DECORA TU HABITACIÓN</strong></p>
  <a href="designers.php" class="btn">Ver Diseñadores</a>
  <a href="shop.php" class="btn">Ir a la Tienda</a>
</section>

<!-- OFRECE PÁGINA -->
<section class="features-section">
  <h2 class="features-title">¿Qué ofrecemos?</h2>
  <div class="features-container">
    <div class="feature-item">
      <h3>INFORMACIÓN</h3>
      <p>Podemos ofrecer información si existe alguna duda o cualquier consulta ¡SIN MIEDO!</p>
    </div>
    <div class="vertical-divider"></div>
    <div class="feature-item">
      <h3>FIDELIDAD</h3>
      <p>Atención al cliente y fidelidad a nuestras citas, solo tú puedes cambiarla.</p>
    </div>
    <div class="vertical-divider"></div>
    <div class="feature-item">
      <h3>DIVERSIÓN</h3>
      <p>Mira nuestros tipos de diseño y elige a tu tatuador favorito.</p>
    </div>
  </div>
</section>

<!-- TEST QUIZ -->
<?php
$estilo = '';
$descripcion = '';
$puntos_array = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['estetica'])) {
    $puntos = [
        'realista' => 0,
        'old_school' => 0,
        'neotradicional' => 0,
        'blackwork' => 0,
        'dotwork' => 0,
        'japones' => 0,
        'tribal' => 0,
        'acuarela' => 0,
        'geometrico' => 0,
        'minimalista' => 0,
    ];

    switch ($_POST['estetica']) {
        case 'detallado': $puntos['realista'] += 2; break;
        case 'retro': $puntos['old_school'] += 2; break;
        case 'moderno': $puntos['neotradicional'] += 2; break;
        case 'oscuro': $puntos['blackwork'] += 2; break;
        case 'puntos': $puntos['dotwork'] += 2; break;
        case 'tradicional': $puntos['japones'] += 2; break;
        case 'ancestral': $puntos['tribal'] += 2; break;
        case 'acuarela': $puntos['acuarela'] += 2; break;
        case 'lineas': $puntos['geometrico'] += 2; break;
        case 'simple': $puntos['minimalista'] += 2; break;
    }

    switch ($_POST['zona']) {
        case 'espalda': $puntos['japones'] += 1; $puntos['realista'] += 1; break;
        case 'brazo': $puntos['old_school'] += 1; $puntos['blackwork'] += 1; break;
        case 'muñeca': $puntos['minimalista'] += 1; $puntos['geometrico'] += 1; break;
        case 'pierna': $puntos['tribal'] += 1; $puntos['dotwork'] += 1; break;
    }

    switch ($_POST['mensaje']) {
        case 'emocion': $puntos['realista'] += 1; $puntos['acuarela'] += 1; break;
        case 'rebeldia': $puntos['blackwork'] += 1; $puntos['tribal'] += 1; break;
        case 'espiritualidad': $puntos['dotwork'] += 1; $puntos['geometrico'] += 1; break;
        case 'estetica': $puntos['minimalista'] += 1; $puntos['neotradicional'] += 1; break;
        case 'cultura': $puntos['japones'] += 1; $puntos['tribal'] += 1; break;
    }

    switch ($_POST['visual']) {
        case 'color': $puntos['acuarela'] += 2; $puntos['neotradicional'] += 1; break;
        case 'blanco_negro': $puntos['blackwork'] += 2; $puntos['minimalista'] += 1; break;
        case 'sombra': $puntos['realista'] += 2; $puntos['dotwork'] += 1; break;
        case 'lineas_definidas': $puntos['old_school'] += 2; $puntos['geometrico'] += 1; break;
    }
 
    arsort($puntos);
    $estilo_key = array_key_first($puntos);
    $puntos_array = $puntos;
    
    $nombres_estilos = [
        'realista' => 'Realista',
        'old_school' => 'Old School',
        'neotradicional' => 'Neotradicional',
        'blackwork' => 'Blackwork',
        'dotwork' => 'Dotwork',
        'japones' => 'Japonés',
        'tribal' => 'Tribal',
        'acuarela' => 'Acuarela',
        'geometrico' => 'Geométrico',
        'minimalista' => 'Minimalista',
    ];

    $descripciones_estilos = [
        'realista' => 'Te gustan los detalles precisos y las representaciones fieles a la realidad. Buscas tatuajes que reflejen exactamente lo que visualizas.',
        'old_school' => 'Prefieres lo clásico y atemporal con líneas gruesas y colores sólidos. Eres nostálgico y valoras la tradición.',
        'neotradicional' => 'Combinas lo tradicional con toques modernos y colores vibrantes. Eres innovador pero respetas la raíz.',
        'blackwork' => 'Te inclinas por lo dramático con diseños en negro sólido. Buscas impacto y misterio en tu piel.',
        'dotwork' => 'Aprecias la paciencia y precisión de los patrones punto por punto. Te gusta lo hipnotizante y geométrico.',
        'japones' => 'Te conectas con la tradición y el simbolismo oriental. Valoras la historia y la profundidad en los diseños.',
        'tribal' => 'Valoras las raíces ancestrales y la fuerza simbólica. Buscas conexión con tus orígenes.',
        'acuarela' => 'Eres creativo y te gustan los colores que fluyen. Buscas algo artístico y único.',
        'geometrico' => 'Aprecias la precisión y las formas geométricas. Te atrae el equilibrio y la simetría.',
        'minimalista' => 'Crees que menos es más con diseños simples pero impactantes. Buscas elegancia en la sencillez.',
    ];

    $estilo = $nombres_estilos[$estilo_key];
    $descripcion = $descripciones_estilos[$estilo_key];
}
?>

<div class="cyber-container">
  <div class="cyber-header">
    <h1 class="cyber-title">DESCUBRE TU ESTILO DE TATUAJE</h1>
    <p class="cyber-subtitle">Responde estas preguntas y encuentra el tatuaje perfecto para ti</p>
    <div class="cyber-line"></div>
  </div>

  <?php if (!$estilo): ?>
    <form method="POST" class="cyber-form">
      
      <div class="cyber-question">
        <div class="cyber-question-number">01</div>
        <h2 class="cyber-question-title">¿Qué estética te atrae más?</h2>
        <div class="cyber-options">
          <label class="cyber-option">
            <input type="radio" name="estetica" value="detallado" required>
            <span class="cyber-option-text">Realismo detallado</span>
          </label>
          <label class="cyber-option">
            <input type="radio" name="estetica" value="retro">
            <span class="cyber-option-text">Retro o clásico</span>
          </label>
          <label class="cyber-option">
            <input type="radio" name="estetica" value="moderno">
            <span class="cyber-option-text">Color moderno y sombreado</span>
          </label>
          <label class="cyber-option">
            <input type="radio" name="estetica" value="oscuro">
            <span class="cyber-option-text">Oscuro y sólido</span>
          </label>
          <label class="cyber-option">
            <input type="radio" name="estetica" value="puntos">
            <span class="cyber-option-text">A base de puntos</span>
          </label>
          <label class="cyber-option">
            <input type="radio" name="estetica" value="tradicional">
            <span class="cyber-option-text">Tradicional japonés</span>
          </label>
          <label class="cyber-option">
            <input type="radio" name="estetica" value="ancestral">
            <span class="cyber-option-text">Tribal y ancestral</span>
          </label>
          <label class="cyber-option">
            <input type="radio" name="estetica" value="acuarela">
            <span class="cyber-option-text">Acuarela artística</span>
          </label>
          <label class="cyber-option">
            <input type="radio" name="estetica" value="lineas">
            <span class="cyber-option-text">Líneas limpias y precisas</span>
          </label>
          <label class="cyber-option">
            <input type="radio" name="estetica" value="simple">
            <span class="cyber-option-text">Minimalismo puro</span>
          </label>
        </div>
      </div>

      <div class="cyber-question">
        <div class="cyber-question-number">02</div>
        <h2 class="cyber-question-title">¿En qué parte del cuerpo te harías el tatuaje?</h2>
        <div class="cyber-options">
          <label class="cyber-option">
            <input type="radio" name="zona" value="espalda" required>
            <span class="cyber-option-text">Espalda</span>
          </label>
          <label class="cyber-option">
            <input type="radio" name="zona" value="brazo">
            <span class="cyber-option-text">Brazo</span>
          </label>
          <label class="cyber-option">
            <input type="radio" name="zona" value="muñeca">
            <span class="cyber-option-text">Muñeca o tobillo</span>
          </label>
          <label class="cyber-option">
            <input type="radio" name="zona" value="pierna">
            <span class="cyber-option-text">Pierna</span>
          </label>
        </div>
      </div>

      <div class="cyber-question">
        <div class="cyber-question-number">03</div>
        <h2 class="cyber-question-title">¿Qué te gustaría transmitir con tu tatuaje?</h2>
        <div class="cyber-options">
          <label class="cyber-option">
            <input type="radio" name="mensaje" value="emocion" required>
            <span class="cyber-option-text">Emoción o recuerdo personal</span>
          </label>
          <label class="cyber-option">
            <input type="radio" name="mensaje" value="rebeldia">
            <span class="cyber-option-text">Rebeldía y actitud</span>
          </label>
          <label class="cyber-option">
            <input type="radio" name="mensaje" value="espiritualidad">
            <span class="cyber-option-text">Espiritualidad / conexión interna</span>
          </label>
          <label class="cyber-option">
            <input type="radio" name="mensaje" value="estetica">
            <span class="cyber-option-text">Estética y estilo</span>
          </label>
          <label class="cyber-option">
            <input type="radio" name="mensaje" value="cultura">
            <span class="cyber-option-text">Cultura y simbolismo</span>
          </label>
        </div>
      </div>

      <div class="cyber-question">
        <div class="cyber-question-number">04</div>
        <h2 class="cyber-question-title">¿Qué tipo de visual prefieres?</h2>
        <div class="cyber-options cyber-options-last">
          <label class="cyber-option">
            <input type="radio" name="visual" value="color" required>
            <span class="cyber-option-text">Colorido y vibrante</span>
          </label>
          <label class="cyber-option">
            <input type="radio" name="visual" value="blanco_negro">
            <span class="cyber-option-text">Blanco y negro</span>
          </label>
          <label class="cyber-option">
            <input type="radio" name="visual" value="sombra">
            <span class="cyber-option-text">Sombras y volumen</span>
          </label>
          <label class="cyber-option">
            <input type="radio" name="visual" value="lineas_definidas">
            <span class="cyber-option-text">Líneas definidas y fuertes</span>
          </label>
        </div>
      </div>

      <button type="submit" class="cyber-button cyber-button-submit">
        <span class="cyber-button-text">DESCUBRIR MI ESTILO</span>
        <span class="cyber-button-glow"></span>
      </button>
    </form>

  <?php else: ?>
    <div class="cyber-results">
      <div class="cyber-results-header">
        <h2 class="cyber-results-title">TU RESULTADO</h2>
        <div class="cyber-line-results"></div>
      </div>

      <div class="cyber-results-box">
        <p class="cyber-results-label">Tu estilo ideal es:</p>
        <h3 class="cyber-results-style">
          <span class="cyber-accent">&gt;&gt;</span>
          <?= $estilo ?>
          <span class="cyber-accent">&lt;&lt;</span>
        </h3>
        <p class="cyber-results-description"><?= $descripcion ?></p>
      </div>

      <div class="cyber-stats">
        <p class="cyber-stats-label">Puntuación por estilo:</p>
        <div class="cyber-stats-grid">
          <?php foreach ($puntos_array as $style => $points): ?>
            <div class="cyber-stat-item">
              <span class="cyber-stat-name"><?= ucfirst(str_replace('_', ' ', $style)) ?></span>
              <span class="cyber-stat-value"><?= $points ?> pts</span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <button onclick="window.location.href = location.pathname;" class="cyber-button cyber-button-repeat">
        <span class="cyber-button-text">REPETIR TEST</span>
        <span class="cyber-button-glow"></span>
      </button>
    </div>
  <?php endif; ?>



    <?php if ($estilo): ?>
      <div class="quiz-results-container">
        <h2 class="quiz-results-title">¡TU RESULTADO!</h2>
        <div class="quiz-results-content">
          <p class="quiz-results-label">Tu estilo ideal es:</p>
          <h3 class="quiz-results-style">
            <span class="quiz-results-style-name"><?= $estilo ?></span>
          </h3>
          <p class="quiz-results-description"><?= $descripcion ?></p>
        </div>
        <button onclick="window.location.href = location.pathname;" class="quiz-repeat-btn">
          🔄 REPETIR TEST
        </button>
      </div>
    <?php endif; ?>
  </div>
</div>




<!--BOTÓN CIBERPUNK PARA VER INFORMACIÓN -->
<br>
<br>
<div class="container">
  <br>
  <a href="appointment.php" class="cyberpunk-btn cyberpunk-btn-cyan">
    <span class="btn-content">Reserva tu cita</span>
    <span class="btn-glitch">Reserva tu cita</span>
  </a>

  <br>
  <a href="information.php" class="cyberpunk-btn cyberpunk-btn-fucsia">
    <span class="btn-content">Información tatuajes</span>
    <span class="btn-glitch">Información tatuajes</span>
  </a>
  <br>
  <br>
</div>

<!-- NOVEDADES -->
<section class="novedades-section">
  <div class="novedades-container">
    <div class="novedades-content">
      <div class="novedades-image-wrapper">
        <img src="assets/img/novedades.png" alt="Novedades ALiENS BLooD" class="novedades-image">
      </div>
      
      <div class="novedades-text">
        <h2 class="novedades-title">ESO NO ES TODO</h2>
        <p class="novedades-subtitle">¡QUÉDATE!</p>
        
        <div class="novedades-questions">
          <div class="novedades-question">
            <span class="question-icon">●</span>
            <p>¿Te dan miedo las agujas?</p>
          </div>
          <div class="novedades-question">
            <span class="question-icon">●</span>
            <p>¿No tienes suficiente dinero? (Nosotros igual)</p>
          </div>
          <div class="novedades-question">
            <span class="question-icon">●</span>
            <p>¿PERO TE GUSTA NUESTRO ARTE?</p>
          </div>
        </div>
        
        <p class="novedades-cta">ACCEDE A NUESTRAS NOVEDADES DONDE SUBIMOS HISTORIAS</p>
        
        <a href="/aliensblood/novedades.php" class="novedades-btn">
          <span class="btn-text">NOVEDADES</span>
          <span class="btn-glow"></span>
        </a>
      </div>
    </div>
  </div>
</section>


<!-- SUSCRIPCIONES-->
<section class="subscribe-section">
  <h2>Suscríbete y accede a contenido exclusivo</h2>
  <p>Por solo <strong>4,99€ al mes</strong>, podrás subir tus ideas, acceder a diseños únicos y recibir descuentos exclusivos.</p>
  <a href="/aliensblood/users/subscribe.php" class="btn">Suscribirse</a>
</section>

<!-- ANUNCIOS CON IMAGEN -->
<section class="benefits">
  <div class="benefit" style="background-image: url('assets/img/icon-designs.png');">
    <div class="overlay">
      <h4>Diseños Únicos</h4>
      <p>Arte exclusivo de nuestros diseñadores independientes.</p>
    </div>
  </div>
  <div class="benefit" style="background-image: url('assets/img/icon-security.png');">
    <div class="overlay">
      <h4>Compra Segura</h4>
      <p>Pagos protegidos y atención personalizada.</p>
    </div>
  </div>
  <div class="benefit" style="background-image: url('assets/img/icon-support.png');">
    <div class="overlay">
      <h4>Atención Personalizada</h4>
      <p>Te ayudamos en cada paso: desde la compra hasta la cita.</p>
    </div>
  </div>
</section>

<!-- CONTACTO RECORDATORIO -->
<section class="intro-contacto">
  <h1>Te recordamos nuestras redes y otras formas de contactos</h1>
  <a href="contact.php" class="btn">Ir a contactos</a>
  <h1>REDES SOCIALES</h1>
  <p><strong>INSTAGRAM:</strong> @tinyalienspiece</p>
  <p><strong>TIKTOK:</strong> @dark.alien182</p>
  <p><strong>EMAIL:</strong> gunterheronhatsu@gmail.com</p>
</section>

</main>

<footer>
  <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
</footer>

<!-- Banner de cookies -->
<div id="cookie-banner" class="cookie-banner">
  <p>
    🍪 Este sitio utiliza cookies para mejorar tu experiencia. 
    <a href="legal.php" style="color: #ffd700; text-decoration: underline;">Leer más</a>
  </p>
  <div class="cookie-actions">
    <button id="accept-cookies">Aceptar</button>
    <button id="ignore-cookies">Ignorar</button>
  </div>
</div>

</body>
</html>
