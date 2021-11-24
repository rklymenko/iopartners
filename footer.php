    <span class="scroll-fixed-stop"></span>
        <?php get_template_part( 'template-parts/blocks/contacts' ); ?>
        <?php get_template_part( 'template-parts/blocks/contact-form' ); ?>
    </main>
	<footer class="site-footer bg-blue-dark">
        <div class="site-footer-top">
            <div class="container d-md-flex flex-wrap align-items-center justify-content-between">
                <div class="logo mb-4 mb-lg-0">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>">
                        <svg class="img-responsive logo icon-svg"><use xlink:href="#logo"></use></svg>
                    </a>
                </div>
                <nav class="footer-navigation text-lg-right">
			        <?php
			        wp_nav_menu(
				        array(
					        'theme_location' => 'footer',
					        'menu_id'        => 'footer-menu',
					        'menu_class'     => 'list-unstyled mb-0',
				        )
			        );

			        $terms_and_conditions = get_field('terms_and_conditions', 'options');
			        ?>
                </nav>
            </div>
        </div>
        <div class="site-footer-bottom text-white">
            <div class="container">
                <div class="flex-column-reverse flex-md-row row">
                    <div class="col-12 col-md-6 col-lg-7 pr-lg-0">
                        <ul class="list-inline mb-0 d-lg-flex justify-content-between">
                            <li class="list-inline-item"><span class="copyright">&copy; <?php echo date('Y')?> I&O Partners Attorneys Ltd</span></li>
                            <li class="list-inline-item"><a href="https://sisaltomiikka.fi" target="_blank" rel="noopener noreferrer" title="Sisältö Miikka">Website made by Sisältö Miikka</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-6 col-lg-5 text-md-right">
                        <ul class="list-inline mb-md-0">
                            <li class="list-inline-item"><a href="<?php echo get_privacy_policy_url() ; ?>"><?php _e('Privacy Policy', 'textdomain'); ?></a></li>
	                        <?php if ($terms_and_conditions) {?>
                                <li class="list-inline-item"><a href="<?php echo get_the_permalink($terms_and_conditions->ID)?>"><?php echo $terms_and_conditions->post_title?></a></li>
	                        <?php }?>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
	</footer>
</div>

<?php wp_footer(); ?>
</body>
</html>
