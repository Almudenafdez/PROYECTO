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

<!-- TEST LLAMATIVO Y GRANDE -->     
<?php
$estilo = '';
$descripcion = '';

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

    // Pregunta 1 - Estética
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

    // Pregunta 2 - Zona del cuerpo
    switch ($_POST['zona']) {
        case 'espalda': $puntos['japones'] += 1; $puntos['realista'] += 1; break;
        case 'brazo': $puntos['old_school'] += 1; $puntos['blackwork'] += 1; break;
        case 'muñeca': $puntos['minimalista'] += 1; $puntos['geometrico'] += 1; break;
        case 'pierna': $puntos['tribal'] += 1; $puntos['dotwork'] += 1; break;
    }

    // Pregunta 3 - Mensaje a transmitir
    switch ($_POST['mensaje']) {
        case 'emocion': $puntos['realista'] += 1; $puntos['acuarela'] += 1; break;
        case 'rebeldia': $puntos['blackwork'] += 1; $puntos['tribal'] += 1; break;
        case 'espiritualidad': $puntos['dotwork'] += 1; $puntos['geometrico'] += 1; break;
        case 'estetica': $puntos['minimalista'] += 1; $puntos['neotradicional'] += 1; break;
        case 'cultura': $puntos['japones'] += 1; $puntos['tribal'] += 1; break;
    }

    // Pregunta 4 - Tipo visual
    switch ($_POST['visual']) {
        case 'color': $puntos['acuarela'] += 2; $puntos['neotradicional'] += 1; break;
        case 'blanco_negro': $puntos['blackwork'] += 2; $puntos['minimalista'] += 1; break;
        case 'sombra': $puntos['realista'] += 2; $puntos['dotwork'] += 1; break;
        case 'lineas_definidas': $puntos['old_school'] += 2; $puntos['geometrico'] += 1; break;
    }

    // Encontrar el estilo ganador
    arsort($puntos);
    $estilo_key = array_key_first($puntos);
    
    $nombres_estilos = [
        'realista' => 'Realista',
        'old_school' => 'Old School',
        'neotradicional' => 'Neotradicional',
        'blackwork' => 'Blackwork',
        'dotwork' => 'Dotwork',
        'japones' => 'Japonés',
        'tribal' => 'Tribal',
        'acuarela' => 'Acuarela (Watercolor)',
        'geometrico' => 'Geométrico',
        'minimalista' => 'Minimalista',
    ];

    $descripciones_estilos = [
        'realista' => 'Te gustan los detalles precisos y las representaciones fieles a la realidad.',
        'old_school' => 'Prefieres lo clásico y atemporal con líneas gruesas y colores sólidos.',
        'neotradicional' => 'Combinas lo tradicional con toques modernos y colores vibrantes.',
        'blackwork' => 'Te inclinas por lo dramático con diseños en negro sólido.',
        'dotwork' => 'Aprecias la paciencia y precisión de los patrones punto por punto.',
        'japones' => 'Te conectas con la tradición y el simbolismo oriental.',
        'tribal' => 'Valoras las raíces ancestrales y la fuerza simbólica.',
        'acuarela' => 'Eres creativo y te gustan los colores que fluyen.',
        'geometrico' => 'Aprecias la precisión y las formas geométricas.',
        'minimalista' => 'Crees que menos es más con diseños simples pero impactantes.',
    ];

    $estilo = $nombres_estilos[$estilo_key];
    $descripcion = $descripciones_estilos[$estilo_key];
}
?>

<!-- TEST INLINE-->
<div style="background: linear-gradient(135deg,rgb(25, 26, 32) 0%,rgb(30, 22, 37) 100%); 
padding: 40px; margin: 0; 
width: 100%; min-height: 100vh; 
font-family: 'Arial', sans-serif; 
color: white; 
box-sizing: border-box;">

<div style="max-width: 900px; 
margin: 0 auto; 
text-align: center;">

<h1 style="color:rgb(16, 194, 185);
font-size: 42px;
margin-bottom: 15px;
font-weight: bold;
text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
text-transform: uppercase;
letter-spacing: 2px;">
 DESCUBRE TU ESTILO DE TATUAJE </h1>


<p style="color: #f0f0f0;
font-size: 20px;
margin-bottom: 40px;
font-weight: 300;">
Responde estas preguntas y encuentra el tatuaje perfecto para ti</p>
        

<form method="POST" style="text-align: left;">
  <!-- Pregunta 1 -->
    <div style="background: rgb(53, 53, 53);
    border-radius: 15px; 
    padding: 30px; 
    margin-bottom: 25px; 
    box-shadow: 0 8px 25px rgba(245, 244, 244, 0.34); 
    border-left: 6px solid rgb(0, 133, 151);">

    <h3 style="color: white; 
    font-size: 24px; 
    font-weight: bold; 
    margin-bottom: 20px; 
    display: flex; 
    align-items: center;">
    
    <span style="background: rgb(0, 133, 151);; 
    color: white;
    width: 35px; 
    height: 35px; 
    border-radius: 50%; 
    display: inline-flex; 
    align-items: center; 
    justify-content: center; 
    margin-right: 15px; 
    font-size: 18px;">1</span>
    ¿Qué estética te atrae más?</h3>
                
    <div style="display: grid; 
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); 
    gap: 15px;">
                    
    <label style="display: flex;
    align-items: center;
    font-size: 16px; color: #333; 
    padding: 15px;
    color: #333;
    background: rgb(255, 255, 255);; 
    border-radius: 10px; 
    cursor: pointer; 
    transition: all 0.3s; 
    border: 2px solid transparent;"
    onmouseover="this.style.background='#00b4d8';
    this.style.borderColor='rgb(51, 110, 177)';"
    onmouseout="this.style.background='white';
    this.style.borderColor='transparent';">  
    <input type="radio" name="estetica" value="detallado" required style="margin-right: 12px; transform: scale(1.3);"> 
    <strong>Realismo detallado</strong></label>
                    
    <label style="display: flex; 
    align-items: center; 
    font-size: 16px; 
    color: #333; 
    padding: 15px; 
    background: #f8f9fa; 
    border-radius: 10px; 
    cursor: pointer; 
    transition: all 0.3s; 
    border: 2px solid transparent;" 
    onmouseover="this.style.background='#00b4d8'; 
    this.style.borderColor='rgb(51, 110, 177)';" 
    onmouseout="this.style.background='white'; 
    this.style.borderColor='transparent';">
    <input type="radio" name="estetica" value="retro" style="margin-right: 12px; transform: scale(1.3);"> 
    <strong>Retro o clásico</strong></label>

    <label style="display: flex; 
    align-items: center; 
    font-size: 16px; 
    color: #333; 
    padding: 15px; 
    background: white; 
    border-radius: 10px; 
    cursor: pointer; 
    transition: all 0.3s; 
    border: 2px solid transparent;" 
    onmouseover="this.style.background='#00b4d8'; 
    this.style.borderColor='rgb(51, 110, 177)';" 
    onmouseout="this.style.background='#f8f9fa'; 
    this.style.borderColor='transparent';">
    <input type="radio" name="estetica" value="moderno" style="margin-right: 12px; transform: scale(1.3);"> 
    <strong>Color moderno y sombreado</strong></label>

    <label style="display: flex; 
    align-items: center; 
    font-size: 16px; 
    color: #333; 
    padding: 15px; 
    background: #f8f9fa; 
    border-radius: 10px; 
    cursor: pointer; 
    transition: all 0.3s; 
    border: 2px solid transparent;" 
    onmouseover="this.style.background='#00b4d8'; 
    this.style.borderColor='rgb(51, 110, 177)';" 
    onmouseout="this.style.background='#f8f9fa'; 
    this.style.borderColor='transparent';">
    <input type="radio" name="estetica" value="oscuro" style="margin-right: 12px; transform: scale(1.3);"> 
    <strong>Oscuro y sólido</strong></label>

    <label style="display: flex; 
    align-items: center; 
    font-size: 16px; 
    color: #333; 
    padding: 15px; 
    background: #f8f9fa; 
    border-radius: 10px; 
    cursor: pointer; 
    transition: all 0.3s; 
    border: 2px solid transparent;" 
    onmouseover="this.style.background='#00b4d8'; 
    this.style.borderColor='rgb(51, 110, 177)';" 
    onmouseout="this.style.background='#f8f9fa'; 
    this.style.borderColor='transparent';">
    <input type="radio" name="estetica" value="puntos" style="margin-right: 12px; transform: scale(1.3);"> 
    <strong>A base de puntos</strong></label>

    <label style="display: flex; 
    align-items: center; 
    font-size: 16px; 
    color: #333; 
    padding: 15px; 
    background: #f8f9fa; 
    border-radius: 10px; 
    cursor: pointer; 
    transition: all 0.3s; 
    border: 2px solid transparent;" 
    onmouseover="this.style.background='#00b4d8'; 
    this.style.borderColor='rgb(51, 110, 177)';"
    onmouseout="this.style.background='#f8f9fa'; 
    this.style.borderColor='transparent';">
    <input type="radio" name="estetica" value="tradicional" style="margin-right: 12px; transform: scale(1.3);"> 
    <strong>Tradicional japonés</strong></label>

    <label style="display: flex; 
    align-items: center; 
    font-size: 16px; 
    color: #333; 
    padding: 15px; 
    background: #f8f9fa; 
    border-radius: 10px; 
    cursor: pointer; 
    transition: all 0.3s; 
    border: 2px solid transparent;" 
    onmouseover="this.style.background='#00b4d8'; 
    this.style.borderColor='rgb(51, 110, 177)';" 
    onmouseout="this.style.background='#f8f9fa'; 
    this.style.borderColor='transparent';">
    <input type="radio" name="estetica" value="ancestral" style="margin-right: 12px; transform: scale(1.3);"> 
    <strong>Tribal y ancestral</strong></label>

    <label style="display: flex; 
    align-items: center; 
    font-size: 16px; 
    color: #333; 
    padding: 15px; 
    background: #f8f9fa; 
    border-radius: 10px; 
    cursor: pointer; 
    transition: all 0.3s; 
    border: 2px solid transparent;" 
    onmouseover="this.style.background='#00b4d8'; 
    this.style.borderColor='rgb(51, 110, 177)';" 
    onmouseout="this.style.background='#f8f9fa'; 
    this.style.borderColor='transparent';">
    <input type="radio" name="estetica" value="acuarela" style="margin-right: 12px; transform: scale(1.3);"> 
    <strong>Acuarela artística</strong></label>

    <label style="display: flex; 
    align-items: center; 
    font-size: 16px; 
    color: #333; 
    padding: 15px; 
    background: #f8f9fa; 
    border-radius: 10px; 
    cursor: pointer; 
    transition: all 0.3s; 
    border: 2px solid transparent;" 
    onmouseover="this.style.background='#00b4d8'; 
    this.style.borderColor='rgb(51, 110, 177)';" 
    onmouseout="this.style.background='#f8f9fa'; 
    this.style.borderColor='transparent';">
    <input type="radio" name="estetica" value="lineas" style="margin-right: 12px; transform: scale(1.3);"> 
    <strong>Líneas limpias y precisas</strong></label>

    <label style="display: flex; 
    align-items: center; 
    font-size: 16px; 
    color: #333; 
    padding: 15px; 
    background: #f8f9fa; 
    border-radius: 10px; 
    cursor: pointer; 
    transition: all 0.3s; 
    border: 2px solid transparent;" 
    onmouseover="this.style.background='#00b4d8'; 
    this.style.borderColor='rgb(51, 110, 177)';" 
    onmouseout="this.style.background='#f8f9fa'; 
    this.style.borderColor='transparent';">
    <input type="radio" name="estetica" value="simple" style="margin-right: 12px; transform: scale(1.3);"> 
    <strong>Minimalismo puro</strong></label>
                </div>
            </div>

  <!-- Pregunta 2 -->
  <div style="background: rgb(53, 53, 53);
    border-radius: 15px; 
    padding: 30px; 
    margin-bottom: 25px; 
    box-shadow: 0 8px 25px rgba(245, 244, 244, 0.34); 
    border-left: 6px solid rgb(0, 133, 151);">

    <h3 style="color: white; 
    font-size: 24px; 
    font-weight: bold; 
    margin-bottom: 20px; 
    display: flex; 
    align-items: center;">
    
    <span style="background: rgb(51, 162, 177); 
    color: white;
    width: 35px; 
    height: 35px; 
    border-radius: 50%; 
    display: inline-flex; 
    align-items: center; 
    justify-content: center; 
    margin-right: 15px; 
    font-size: 18px;">2</span>
    ¿En qué parte del cuerpo te harías el tatuaje?</h3>
                
    <div style="display: grid; 
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); 
    gap: 15px;">
  
  <label style="display: flex; 
  align-items: center; 
  font-size: 16px; 
  color: #333; 
  padding: 15px; 
  background: #f8f9fa; 
  border-radius: 10px; 
  cursor: pointer; 
  transition: all 0.3s; 
  border: 2px solid transparent;" 
  onmouseover="this.style.background='#219ebc'; 
  this.style.borderColor='rgb(51, 110, 177)';" 
  onmouseout="this.style.background='#f8f9fa'; 
  this.style.borderColor='transparent';">
  <input type="radio" name="zona" value="espalda" required style="margin-right: 12px; transform: scale(1.3);"> 
  <strong>Espalda</strong></label>
                    
  <label style="display: flex; 
  align-items: center; 
  font-size: 16px; color: #333; 
  padding: 15px; 
  background: #f8f9fa; 
  border-radius: 10px; 
  cursor: pointer; 
  transition: all 0.3s; 
  border: 2px solid transparent;" 
  onmouseover="this.style.background='#219ebc'; 
  this.style.borderColor='rgb(51, 110, 177)';" 
  onmouseout="this.style.background='#f8f9fa'; 
  this.style.borderColor='transparent';">
  <input type="radio" name="zona" value="brazo" style="margin-right: 12px; transform: scale(1.3);"> 
  <strong>Brazo</strong></label>

  <label style="display: flex; 
  align-items: center; 
  font-size: 16px; 
  color: #333; 
  padding: 15px; 
  background: #f8f9fa; 
  border-radius: 10px; 
  cursor: pointer; 
  transition: all 0.3s; 
  border: 2px solid transparent;" 
  onmouseover="this.style.background='#219ebc'; 
  this.style.borderColor='rgb(51, 110, 177)';" 
  onmouseout="this.style.background='#f8f9fa'; 
  this.style.borderColor='transparent';">
  <input type="radio" name="zona" value="muñeca" style="margin-right: 12px; transform: scale(1.3);"> 
  <strong>Muñeca o tobillo</strong></label>

  <label style="display: flex;
  align-items: center;
  font-size: 16px; 
  color: #333; 
  padding: 15px; 
  background: #f8f9fa; 
  border-radius: 10px; 
  cursor: pointer; 
  transition: all 0.3s; 
  border: 2px solid transparent;" 
  onmouseover="this.style.background='#219ebc'; 
  this.style.borderColor='rgb(51, 110, 177)';" 
  onmouseout="this.style.background='#f8f9fa'; 
  this.style.borderColor='transparent';">
  <input type="radio" name="zona" value="pierna" style="margin-right: 12px; transform: scale(1.3);"> 
  <strong>Pierna</strong></label>
                </div>
            </div>

            <!-- Pregunta 3 -->
            <div style="background: rgb(53, 53, 53);
            border-radius: 15px; 
            padding: 30px; margin-bottom: 
            25px; box-shadow: 0 8px 25px rgba(245, 244, 244, 0.34); 
            border-left: 6px solid rgb(0, 139, 109);">

            <h3 style="color: white; 
            font-size: 24px; 
            font-weight: bold; 
            margin-bottom: 20px; 
            display: flex; 
            align-items: center;">

            <span style="background:rgb(0, 139, 109); 
            color: white; 
            width: 35px;
            height: 35px; 
            border-radius: 50%; 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            margin-right: 15px; 
            font-size: 18px;">3</span>¿Qué te gustaría transmitir con tu tatuaje?</h3>
                
            <div style="display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); 
            gap: 15px;">

            <label style="display: flex; 
            align-items: center; 
            font-size: 16px; 
            color: #333; 
            padding: 15px; 
            background: #f8f9fa; 
            border-radius: 10px; 
            cursor: pointer; 
            transition: all 0.3s; 
            border: 2px solid transparent;" 
            onmouseover="this.style.background='rgb(27, 196, 159)'; 
            this.style.borderColor='rgb(18, 97, 80)';" 
            onmouseout="this.style.background='#f8f9fa'; 
            this.style.borderColor='transparent';">

            <input type="radio" name="mensaje" value="emocion" required style="margin-right: 12px; transform: scale(1.3);"> 
            <strong>Emoción o recuerdo personal</strong></label>

            <label style="display: flex; 
            align-items: center; 
            font-size: 16px; 
            color: #333; 
            padding: 15px; 
            background: #f8f9fa; 
            border-radius: 10px; 
            cursor: pointer; 
            transition: all 0.3s; 
            border: 2px solid transparent;" 
            onmouseover="this.style.background='rgb(27, 196, 159)'; 
            this.style.borderColor='rgb(18, 97, 80)';" 
            onmouseout="this.style.background='#f8f9fa'; 
            this.style.borderColor='transparent';">
            <input type="radio" name="mensaje" value="rebeldia" style="margin-right: 12px; transform: scale(1.3);"> 
            <strong>Rebeldía y actitud</strong></label>

            <label style="display: flex; 
            align-items: center; 
            font-size: 16px; 
            color: #333; 
            padding: 15px; 
            background: #f8f9fa; 
            border-radius: 10px; 
            cursor: pointer; 
            transition: all 0.3s; 
            border: 2px solid transparent;" 
            onmouseover="this.style.background='rgb(27, 196, 159)'; 
            this.style.borderColor='rgb(18, 97, 80)';" 
            onmouseout="this.style.background='#f8f9fa'; 
            this.style.borderColor='transparent';">

            <input type="radio" name="mensaje" value="espiritualidad" style="margin-right: 12px; transform: scale(1.3);"> 
            <strong>Espiritualidad / conexión interna</strong></label>

            <label style="display: flex; 
            align-items: center; 
            font-size: 16px; 
            color: #333; 
            padding: 15px; 
            background: #f8f9fa; 
            border-radius: 10px; 
            cursor: pointer; 
            transition: all 0.3s; 
            border: 2px solid transparent;" 
            onmouseover="this.style.background='rgb(27, 196, 159)'; 
            this.style.borderColor='rgb(18, 97, 80)';" 
            onmouseout="this.style.background='#f8f9fa'; 
            this.style.borderColor='transparent';">

            <input type="radio" name="mensaje" value="estetica" style="margin-right: 12px; transform: scale(1.3);"> 
            <strong>Estética y estilo</strong></label>

            <label style="display: flex; 
            align-items: center; 
            font-size: 16px; color: #333; 
            padding: 15px; 
            background: #f8f9fa; 
            border-radius: 10px; 
            cursor: pointer; 
            transition: all 0.3s; 
            border: 2px solid transparent;" 
            onmouseover="this.style.background='rgb(27, 196, 159)'; 
            this.style.borderColor='rgb(18, 97, 80)';" 
            onmouseout="this.style.background='#f8f9fa'; 
            this.style.borderColor='transparent';">
            <input type="radio" name="mensaje" value="cultura" style="margin-right: 12px; transform: scale(1.3);"> 
            <strong>Cultura y simbolismo</strong></label>
                </div>
            </div>

            <!-- Pregunta 4 -->
            <div style="background: rgb(53, 53, 53);
            border-radius: 15px; 
            padding: 30px; 
            margin-bottom: 30px; 
            box-shadow: 0 8px 25px rgba(245, 244, 244, 0.34); 
            border-left: 6px solid rgb(0, 78, 65);">

            <h3 style="color: white; 
            font-size: 24px; 
            font-weight: bold; 
            margin-bottom: 20px; 
            display: flex; 
            align-items: center;">

            <span style="background: rgb(0, 78, 65); 
            color: white; 
            width: 35px; 
            height: 35px; 
            border-radius: 50%; 
            display: inline-flex; 
            align-items: center; 
            justify-content: center; 
            margin-right: 15px; 
            font-size: 18px;">4</span>¿Qué tipo de visual prefieres?</h3>
                
            <div style="display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); 
            gap: 15px;">

            <label style="display: flex; 
            align-items: center; 
            font-size: 16px; 
            color: #333; 
            padding: 15px; 
            background: #f8f9fa; 
            border-radius: 10px; 
            cursor: pointer; 
            transition: all 0.3s; 
            border: 2px solid transparent;" 
            onmouseover="this.style.background='rgb(27, 128, 111)'; 
            this.style.borderColor='rgb(14, 63, 55)';" 
            onmouseout="this.style.background='#f8f9fa'; 
            this.style.borderColor='transparent';">

            <input type="radio" name="visual" value="color" required style="margin-right: 12px; transform: scale(1.3);">
            <strong>Colorido y vibrante</strong></label>
                    
            <label style="display: flex; 
            align-items: center; 
            font-size: 16px; 
            color: #333; 
            padding: 15px; 
            background: #f8f9fa; 
            border-radius: 10px; 
            cursor: pointer; 
            transition: all 0.3s; 
            border: 2px solid transparent;" 
            onmouseover="this.style.background='rgb(27, 128, 111)'; 
            this.style.borderColor='rgb(14, 63, 55)';" 
            onmouseout="this.style.background='#f8f9fa'; 
            this.style.borderColor='transparent';">

            <input type="radio" name="visual" value="blanco_negro" style="margin-right: 12px; transform: scale(1.3);"> 
            <strong>Blanco y negro</strong></label>

            <label style="display: flex; 
            align-items: center; 
            font-size: 16px; 
            color: #333; 
            padding: 15px; 
            background: #f8f9fa; 
            border-radius: 10px; 
            cursor: pointer; 
            transition: all 0.3s; 
            border: 2px solid transparent;" 
            onmouseover="this.style.background='rgb(27, 128, 111)'; 
            this.style.borderColor='rgb(14, 63, 55)';" 
            onmouseout="this.style.background='#f8f9fa'; 
            this.style.borderColor='transparent';">

            <input type="radio" name="visual" value="sombra" style="margin-right: 12px; transform: scale(1.3);"> 
            <strong>Sombras y volumen</strong></label>

            <label style="display: flex; 
            align-items: center; 
            font-size: 16px; 
            color: #333; 
            padding: 15px; 
            background: #f8f9fa; 
            border-radius: 10px; 
            cursor: pointer; 
            transition: all 0.3s; 
            border: 2px solid transparent;" 
            onmouseover="this.style.background='rgb(27, 128, 111)'; 
            this.style.borderColor='rgb(14, 63, 55)';" 
            onmouseout="this.style.background='#f8f9fa'; 
            this.style.borderColor='transparent';">

            <input type="radio" name="visual" value="lineas_definidas" style="margin-right: 12px; transform: scale(1.3);"> 
            <strong>Líneas definidas y fuertes</strong></label>
                </div>
            </div>

            <div style="text-align: center;">
                <button type="submit" style="background: linear-gradient(45deg,rgb(145, 23, 134),rgb(57, 0, 75)); 
                color: white; 
                padding: 20px 50px; 
                border: none; 
                font-size: 20px; 
                font-weight: bold; 
                cursor: pointer; 
                border-radius: 50px; 
                box-shadow: 0 8px 25px rgba(255,107,107,0.4); 
                text-transform: uppercase; 
                letter-spacing: 1px; 
                transition: all 0.3s;" onmouseover="this.style.transform='translateY(-3px)'; 
                this.style.boxShadow='0 12px 35px rgba(255,107,107,0.6)';" 
                onmouseout="this.style.transform='translateY(0)'; 
                this.style.boxShadow='0 8px 25px rgba(255,107,107,0.4)';">✨ DESCUBRIR MI ESTILO ✨</button>
            </div>
        </form>

        <?php if ($estilo): ?>
            <div style="margin-top: 40px; padding: 40px; background: linear-gradient(135deg,rgb(37, 39, 46) 0%,rgb(38, 32, 44) 100%); border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.2); text-align: center; border: 3px solid #fff;">
                <h2 style="color: #ffffff; font-size: 36px; margin-bottom: 20px; font-weight: bold; text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">🎉 ¡TU RESULTADO! 🎉</h2>
                <div style="background: rgba(255,255,255,0.95); padding: 30px; border-radius: 15px; margin: 20px 0;">
                    <h3 style="color: #333; font-size: 28px; margin-bottom: 15px; font-weight: bold;">Tu estilo ideal es: <span style="color:rgb(177, 17, 240);"><?= $estilo ?></span></h3>
                    <p style="font-size: 18px; color: #555; line-height: 1.6;"><?= $descripcion ?></p>
                </div>
                <button onclick="location.reload()" style="background: linear-gradient(45deg, #4ecdc4, #44a08d); color: white; padding: 15px 35px; border: none; font-size: 16px; font-weight: bold; cursor: pointer; border-radius: 25px; box-shadow: 0 6px 20px rgba(78,205,196,0.4); text-transform: uppercase; letter-spacing: 1px; margin-top: 20px;" onmouseover="this.style.transform='scale(1.05)';" onmouseout="this.style.transform='scale(1)';">
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


        
<!-- NOVEDADES-->
<section class="novedad-section">
  <br>
  <img src="assets/img/novedades.png"</img>
  <h2>ESO NO ES TODO. ¡QUÉDATE!</h2>
  <p>¿Te dan miedo las agujas?</p><br>
  <p>¿No tienes suficiente dinero? (Nosotros igual)</p><br>
  <p>¿PERO TE GUSTA NUESTRO ARTE?</p>
  <h2>ACCEDE A NUESTRAS NOVEDADES DONDE SUBIMOS HISTORIAS</h2>
  <a href="/aliensblood/novedades.php" alt="novedades" class="btn" >NOVEDADES</a>
</section>

      <!-- SUSCRPCIONES-->
<section class="subscribe-section">
  <h2>Suscríbete y accede a contenido exclusivo</h2>
  <p>Por solo <strong>4,99€ al mes</strong>, podrás subir tus ideas, acceder a diseños únicos y recibir descuentos exclusivos.</p>
  <a href="/aliensblood/users/subscribe.php" class="btn" >Suscribirse</a>
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
    <p><strong>TIKTOK: </strong>@dark.alien182</p>
    <p><strong>EMAIL: </strong>gunterheronhatsu@gmail.com</p>
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
