<main class="contenedor seccion">
        <h1>Mas sobre nosotros</h1>
        <?php include  'iconos.php' ?>
    </main>

    <section class="contenedor seccion">
        <h2>Casa y Depas en ventas</h2>
        <?php 
      
         include 'listado.php'; 
         ?>

        <div class="alinear-derecha">
            <a href="/propiedades" class="boton-verde">Ver Todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la case de tus sueños</h2>
        <p>llena el formulario de contacto y un asesor se pondra en contacto contigo a la brevedad</p>
        <a href="/contacto" class="boton-amarillo">contacnos</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuesto blog</h3>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image.jpg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="Texto entrada de blog">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>
                        <p class="informacion-meta">Escrito el: <span>20/10/2021</span>por: <span>Admin</span></p>
                        <p>
                            consejos para construir una Terraza en el techo de tu casa con los mejores materiales y
                            ahorrando dinero
                        </p>
                    </a>

                </div>

            </article>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image.jpg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="Texto entrada de blog">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.php">
                        <h4>Guia para la decoracion de tu hogar</h4>
                        <p class="informacion-meta">Escrito el: <span>20/10/2021</span>por: <span>Admin</span></p>
                        <p>
                            Maximizar el espacio de tu casa con esta guia, aprende a combinar muebles y colores para
                            darle vida a tu espacio
                        </p>
                    </a>

                </div>

            </article>

        </section>
        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente forma, muy buena atencion y la casa que me 
                    ofrecieron cumple con todas mis expetativas.
                </blockquote>
                <p>- Axel Reyes</p>
            </div>


        </section>

    </div>