<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información sobre Tatuajes</title>
    <link rel="stylesheet" href="assets/css/ciberpunk.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<header>
    <h1 class="site-title">ALiENS BLooD</h1>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
      <li><a href="novedades.php">Novedades</a></li>
            <li><a href="gallery.php">Galería Pública</a></li>
            <li><a href="shop.php">Tienda</a></li>
            <li><a href="designers.php">Diseñadores</a></li>
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
        </ul>
    </nav>
</header>

<body>
    <?php
    
    // Array que contiene todos los estilos de tatuajes con su información
    // Cada elemento tiene: nombre, descripción y ruta de la imagen
    $tattooStyles = [
        [
            'name' => 'Realista',
            'description' => 'Tatuajes que replican fotografías con gran detalle y precisión, capturando sombras y texturas de forma hiperrealista.',
            'image' => 'assets/img/realista.png'
        ],
        [
            'name' => 'Old School',
            'description' => 'Estilo tradicional americano con líneas gruesas, colores sólidos y diseños icónicos como anclas, rosas y golondrinas.',
            'image' => 'assets/img/old_school.png'
        ],
        [
            'name' => 'Neotradicional',
            'description' => 'Evolución del old school con más detalles, sombreados complejos y una paleta de colores más amplia.',
            'image' => 'assets/img/neotradicional.png'
        ],
        [
            'name' => 'Blackwork',
            'description' => 'Tatuajes realizados completamente en tinta negra, con diseños geométricos, tribales o ilustraciones sólidas.',
            'image' => 'assets/img/blackwork.png'
        ],
        [
            'name' => 'Dotwork',
            'description' => 'Técnica que utiliza únicamente puntos para crear diseños, sombras y texturas con un efecto visual único.',
            'image' => 'assets/img/dotwork.png'
        ],
        [
            'name' => 'Japonés',
            'description' => 'Estilo tradicional japonés con dragones, carpas koi, flores de cerezo y olas, rico en simbolismo cultural.',
            'image' => 'assets/img/japones.png'
        ],
        [
            'name' => 'Tribal',
            'description' => 'Diseños inspirados en culturas indígenas con patrones negros sólidos y formas simétricas abstractas.',
            'image' => 'assets/img/tribal.png'
        ],
        [
            'name' => 'Acuarela',
            'description' => 'Estilo que imita las pinceladas y mezclas de colores de la pintura en acuarela, con efectos fluidos y vibrantes.',
            'image' => 'assets/img/acuarela.png'
        ],
        [
            'name' => 'Geométrico',
            'description' => 'Diseños basados en formas geométricas, líneas precisas y patrones matemáticos que crean composiciones simétricas.',
            'image' => 'assets/img/geometrico.png'
        ],
        [
            'name' => 'Minimalista',
            'description' => 'Tatuajes simples y delicados con líneas finas, diseños pequeños y conceptos reducidos a su esencia.',
            'image' => 'assets/img/minimalista.png'
        ]
    ];
    ?>

     <!--Contenedor principal de la página--> 
    <div class="page-container">
        <div class="bg-gradient"></div>
        <div class="bg-blur">
            <div class="blur-cyan"></div>
            <div class="blur-magenta"></div>
        </div>

         <!--Contenedor del contenido principal -->
        <div class="content-wrapper">
            <div class="header">
                <h1 class="main-title">Información sobre Tatuajes</h1>
                <div class="title-divider"></div>
            </div>

             <!--Sección de advertencias y cuidados importantes -->
            <div class="warning-section">
                <div class="card-content">
                    <h2 class="warning-title">
                        <span class="warning-icon">⚠️</span>
                        Cuidados y Consideraciones Importantes
                    </h2>
                    <div class="warning-text">
                        <p>
                            Antes de hacerte un tatuaje, es fundamental que consideres varios aspectos importantes para tu salud y
                            seguridad. Asegúrate de acudir a un estudio profesional que cumpla con todas las normas de higiene y
                            esterilización. Verifica que el tatuador utilice agujas desechables y equipo esterilizado para cada
                            cliente.
                        </p>
                        <p>
                            Durante el proceso de curación, que puede durar entre 2 y 4 semanas, deberás mantener el tatuaje limpio
                            y humectado siguiendo las instrucciones específicas de tu tatuador. Evita la exposición directa al sol,
                            no sumerjas el tatuaje en agua (piscinas, mar, bañeras) y no rasques ni arranques las costras que se
                            formen. Si tienes condiciones médicas preexistentes, alergias o estás tomando medicamentos, consulta con
                            tu médico antes de tatuarte. Recuerda que un tatuaje es permanente, así que tómate el tiempo necesario
                            para elegir un diseño que realmente te represente.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Encabezado de la sección de estilos -->
            <div class="styles-header">
                <h2 class="styles-title">Estilos de Tatuajes</h2>
                <p class="styles-subtitle">
                    Explora los diferentes estilos y encuentra el que mejor se adapte a tu personalidad
                </p>
            </div>

             <!-- Grid de tarjetas con los diferentes estilos de tatuajes -->
            <div class="styles-grid">
                <?php 
                // Recorremos el array de estilos y generamos una tarjeta para cada uno
                foreach ($tattooStyles as $style): 
                ?>
                    <div class="style-card">
                        <div class="style-image-container">
                            <img 
                                src="<?php echo htmlspecialchars($style['image']); ?>" 
                                alt="Estilo de tatuaje <?php echo htmlspecialchars($style['name']); ?>"
                                class="style-image"
                            >
                            <div class="image-overlay"></div>
                        </div>
                        <div class="style-content">
                            <h3 class="style-name"><?php echo htmlspecialchars($style['name']); ?></h3>
                            <p class="style-description"><?php echo htmlspecialchars($style['description']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    
        <!-- BOTÓN DE INICIO-->
<a href="index.php" style="position: fixed; bottom: 20px; right: 20px; background-color: #000; color: #fff; padding: 10px 15px; border-radius: 8px; text-decoration: none; z-index: 999;">
  Volver al Inicio
</a>


<footer>
    <p>&copy; <?= date("Y") ?> ALiENS BLooD. Todos los derechos reservados.</p>
</footer>

</body>
</html>
