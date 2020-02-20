<?php $socials = get_field('socials', 'option'); ?>
<?php $instafeed = get_field('instagram_section', ICL_LANGUAGE_CODE); ?>
		<?php if ( $instafeed['show_instafeed'] && is_front_page() ) { ?>
			<section class="insta-feed">
				<?php if ( $instafeed['link'] ) { ?>
					<a class="ots-btn insta-feed--cap" href="<?php echo $instafeed['link']['url']; ?>" target="<?php echo $instafeed['link']['target']; ?>">
						<?php echo $instafeed['link']['title']; ?>
					</a>
				<?php } ?>
				<?php if ( shortcode_exists( 'instagram-feed' ) ) { ?>
					<?php echo do_shortcode( '[instagram-feed]' ); ?>
				<?php } ?>
			</section>
		<?php } ?>

		</main>
		<footer class="ss-footer px-4">
			<div class="container-fluid p-0">
				<div class="row">

					<div class="col-md-6 col-lg-3 py-3 py-md-4">
						<div class="ss-footer--info d-flex flex-column h-100">
							<div class="mb-md-auto w-100">
								<div class="cl-muted">
									<svg class="pay-icon mr-2"><use xlink:href="#icon-paypal"></use></svg>
									<svg class="pay-icon mr-2"><use xlink:href="#icon-mastercard"></use></svg>
									<svg class="pay-icon mr-2"><use xlink:href="#icon-visa"></use></svg>
								</div>
							</div>
							<div class="w-100 mt-3">
								@ <?php the_field('company_year_of_establishment', 'option'); ?> — <?php echo date("Y"); ?>
								<?php the_field('footer_copyright_text', ICL_LANGUAGE_CODE ); ?>
								<br>
								<?php $author_link = get_field('footer_site_author', ICL_LANGUAGE_CODE ); ?>
								<?php $sa_link_url = $author_link['url'];
									$sa_link_title = $author_link['title'];
									$sa_link_target = $author_link['target'] ? $author_link['target'] : '_self'; ?>
								<?php echo __( 'Site by', 'wp-gulp' ); ?>
								<a class="link-underline" href="<?php echo esc_url($sa_link_url); ?>" target="<?php echo esc_attr($sa_link_target); ?>">
									<?php echo esc_html($sa_link_title); ?>
								</a>
							</div>
						</div>
					</div>

					<div class="d-none d-lg-block col-lg-3 py-lg-4">
						
					</div>

					<div class="col-md-3 py-3 py-md-4 pl-md-4 border-md-left">
						<div class="cl-muted mb-2 mb-md-4">
							<?php echo __( 'Help', 'wp-gulp' ); ?>
						</div>
						<?php wp_nav_menu(
							array(
								'theme_location'  => 'footer_1',
								'container'       => false,
								'menu_id'         => false,
								'menu_class'      => 'footer-nav list-reset',
								'depth'           => 1
							)
						); ?>
					</div>

					<div class="col-md-3 py-3 py-md-4 pl-md-4 border-md-left">
						<div class="cl-muted mb-2 mb-md-4">
							<?php echo __( 'Brand', 'wp-gulp' ); ?>
						</div>
						<?php wp_nav_menu(
							array(
								'theme_location'  => 'footer_2',
								'container'       => false,
								'menu_id'         => false,
								'menu_class'      => 'footer-nav list-reset mb-4',
								'depth'           => 1
							)
						); ?>

						<?php if ( $socials ) { ?>
							<nav class="footer-socials">
								<?php if ( $socials['instagram'] ) { ?>
									<a class="mr-2" href="<?php echo $socials['instagram']; ?>" target="_blank">
										<svg class="soc-icon"><use xlink:href="#icon-instagram"></use></svg>
									</a>
								<?php } ?>
								<?php if ( $socials['facebook'] ) { ?>
									<a class="mr-2" href="<?php echo $socials['facebook']; ?>" target="_blank">
										<svg class="soc-icon"><use xlink:href="#icon-facebook"></use></svg>
									</a>
								<?php } ?>
							</nav>
						<?php } ?>
					</div>

				</div>
			</div>
		</footer>
		
		<div class="d-none root-svgs">
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<defs>
					<symbol id="icon-arrow-left" viewBox="0 0 24 24">
						<g fill-rule="nonzero" fill="currentColor">
							<path d="M11.67 3.87L9.9 2.1 0 12l9.9 9.9 1.77-1.77L3.54 12z"/>
							<path fill="none" d="M0 0h24v24H0z"/>
						</g>
					</symbol>
					
					<symbol id="icon-arrow-right" viewBox="0 0 24 24">
						<g fill-rule="nonzero" fill="currentColor">
							<path d="M5.88 4.12L13.76 12l-7.88 7.88L8 22l10-10L8 2z"/>
							<path fill="none" d="M0 0h24v24H0z"/>
						</g>
					</symbol>

					<symbol id="icon-arrow-bottom" viewBox="0 0 24 24">
						<g fill-rule="nonzero" fill="currentColor">
							<path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/>
							<path fill="none" d="M0 0h24v24H0V0z"/>
						</g>
					</symbol>

					<symbol id="icon-arrow-top" viewBox="0 0 24 24">
						<g fill-rule="nonzero" fill="currentColor">
							<path d="M7.41 15.41L12 10.83l4.59 4.58L18 14l-6-6-6 6z"/>
							<path d="M0 0h24v24H0z" fill="none"/>
						</g>
					</symbol>

					<symbol id="icon-arrow-down" viewBox="0 0 24 24">
						<g fill-rule="nonzero" fill="currentColor">
							<path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/>
							<path fill="none" d="M0 0h24v24H0V0z"/>
						</g>
					</symbol>

					<symbol id="icon-search" viewBox="0 0 24 24">
						<g fill-rule="nonzero" fill="currentColor">
							<path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
  						<path d="M0 0h24v24H0z" fill="none"/>
						</g>
					</symbol>

          <symbol id="icon-close" viewBox="0 0 24 24">
            <g fill-rule="nonzero" fill="#000">
              <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
              <path d="M0 0h24v24H0z" fill="none"/>
            </g>
          </symbol>

					<symbol id="icon-bag" viewBox="0 0 14 14">
            <g fill-rule="nonzero" fill="currentColor">
							<path d="M2.3335 7.00004C2.15669 7.00004 1.98712 7.07028 1.86209 7.1953C1.73707 7.32033 1.66683 7.4899 1.66683 7.66671V9.66671C1.66683 10.374 1.94778 11.0522 2.44788 11.5523C2.94797 12.0524 3.62625 12.3334 4.3335 12.3334H9.66683C10.3741 12.3334 11.0524 12.0524 11.5524 11.5523C12.0525 11.0522 12.3335 10.374 12.3335 9.66671V7.66671C12.3335 7.4899 12.2633 7.32033 12.1382 7.1953C12.0132 7.07028 11.8436 7.00004 11.6668 7.00004H2.3335ZM3.66683 5.66671V3.66671C3.66683 2.78265 4.01802 1.93481 4.64314 1.30968C5.26826 0.684563 6.11611 0.333374 7.00016 0.333374C7.88422 0.333374 8.73206 0.684563 9.35719 1.30968C9.98231 1.93481 10.3335 2.78265 10.3335 3.66671V5.66671H11.6668C12.1973 5.66671 12.706 5.87742 13.081 6.25249C13.4561 6.62757 13.6668 7.13627 13.6668 7.66671V9.66671C13.6668 10.7276 13.2454 11.745 12.4953 12.4951C11.7451 13.2453 10.7277 13.6667 9.66683 13.6667H4.3335C3.27263 13.6667 2.25521 13.2453 1.50507 12.4951C0.754923 11.745 0.333496 10.7276 0.333496 9.66671V7.66671C0.333496 7.13627 0.54421 6.62757 0.919283 6.25249C1.29436 5.87742 1.80306 5.66671 2.3335 5.66671H3.66683ZM5.00016 5.66671H9.00016V3.66671C9.00016 3.13627 8.78945 2.62757 8.41438 2.25249C8.0393 1.87742 7.5306 1.66671 7.00016 1.66671C6.46973 1.66671 5.96102 1.87742 5.58595 2.25249C5.21088 2.62757 5.00016 3.13627 5.00016 3.66671V5.66671Z" fill="currentColor"/>
            </g>
          </symbol>

					<symbol id="icon-instagram" viewBox="0 0 24 24">
            <g fill-rule="nonzero" fill="currentColor">
							<path d="M12.0001 7.19298C9.33995 7.19298 7.19308 9.33986 7.19308 12C7.19308 14.6602 9.33995 16.807 12.0001 16.807C14.6603 16.807 16.8071 14.6602 16.8071 12C16.8071 9.33986 14.6603 7.19298 12.0001 7.19298ZM12.0001 15.1242C10.2798 15.1242 8.87589 13.7203 8.87589 12C8.87589 10.2797 10.2798 8.87579 12.0001 8.87579C13.7204 8.87579 15.1243 10.2797 15.1243 12C15.1243 13.7203 13.7204 15.1242 12.0001 15.1242ZM17.004 5.87579C16.3829 5.87579 15.8814 6.37736 15.8814 6.99845C15.8814 7.61954 16.3829 8.12111 17.004 8.12111C17.6251 8.12111 18.1267 7.62189 18.1267 6.99845C18.1269 6.85097 18.0979 6.7049 18.0416 6.56861C17.9852 6.43232 17.9026 6.30849 17.7983 6.2042C17.694 6.09992 17.5701 6.01723 17.4339 5.96088C17.2976 5.90452 17.1515 5.87561 17.004 5.87579ZM21.3704 12C21.3704 10.7063 21.3821 9.42423 21.3095 8.13283C21.2368 6.63283 20.8946 5.30158 19.7978 4.2047C18.6985 3.10548 17.3696 2.76564 15.8696 2.69298C14.5759 2.62033 13.2939 2.63204 12.0025 2.63204C10.7087 2.63204 9.42667 2.62033 8.13527 2.69298C6.63527 2.76564 5.30402 3.10783 4.20714 4.2047C3.10792 5.30392 2.76808 6.63283 2.69542 8.13283C2.62277 9.42658 2.63449 10.7086 2.63449 12C2.63449 13.2914 2.62277 14.5758 2.69542 15.8672C2.76808 17.3672 3.11027 18.6985 4.20714 19.7953C5.30636 20.8945 6.63527 21.2344 8.13527 21.307C9.42902 21.3797 10.711 21.368 12.0025 21.368C13.2962 21.368 14.5782 21.3797 15.8696 21.307C17.3696 21.2344 18.7009 20.8922 19.7978 19.7953C20.897 18.6961 21.2368 17.3672 21.3095 15.8672C21.3845 14.5758 21.3704 13.2938 21.3704 12ZM19.3079 17.5266C19.1368 17.9531 18.9306 18.2719 18.6001 18.6C18.2696 18.9305 17.9532 19.1367 17.5267 19.3078C16.2939 19.7977 13.3665 19.6875 12.0001 19.6875C10.6337 19.6875 7.70402 19.7977 6.47121 19.3102C6.04464 19.1391 5.72589 18.9328 5.39777 18.6024C5.0673 18.2719 4.86105 17.9555 4.68996 17.5289C4.20246 16.2938 4.31261 13.3664 4.31261 12C4.31261 10.6336 4.20246 7.70392 4.68996 6.47111C4.86105 6.04454 5.0673 5.72579 5.39777 5.39767C5.72824 5.06954 6.04464 4.86095 6.47121 4.68986C7.70402 4.20236 10.6337 4.31251 12.0001 4.31251C13.3665 4.31251 16.2962 4.20236 17.529 4.68986C17.9556 4.86095 18.2743 5.0672 18.6025 5.39767C18.9329 5.72814 19.1392 6.04454 19.3103 6.47111C19.7978 7.70392 19.6876 10.6336 19.6876 12C19.6876 13.3664 19.7978 16.2938 19.3079 17.5266Z" fill="currentColor"/>
            </g>
          </symbol>

					<symbol id="icon-facebook" viewBox="0 0 22 22">
            <g fill-rule="nonzero" fill="currentColor">
							<path d="M9.80388 8.19233V9.45458H8.87988V10.9973H9.80388V15.5834H11.7032V10.9973H12.9774C12.9774 10.9973 13.0975 10.2576 13.1552 9.44816H11.7105V8.394C11.7105 8.23541 11.9177 8.02366 12.123 8.02366H13.157V6.41675H11.75C9.75713 6.41675 9.80388 7.96133 9.80388 8.19233Z" fill="currentColor"/>
							<path d="M11.0002 18.3333C12.9451 18.3333 14.8103 17.5606 16.1856 16.1854C17.5609 14.8101 18.3335 12.9448 18.3335 10.9999C18.3335 9.055 17.5609 7.18974 16.1856 5.81447C14.8103 4.4392 12.9451 3.66659 11.0002 3.66659C9.05524 3.66659 7.18998 4.4392 5.81471 5.81447C4.43945 7.18974 3.66683 9.055 3.66683 10.9999C3.66683 12.9448 4.43945 14.8101 5.81471 16.1854C7.18998 17.5606 9.05524 18.3333 11.0002 18.3333ZM11.0002 20.1666C5.93741 20.1666 1.8335 16.0627 1.8335 10.9999C1.8335 5.93717 5.93741 1.83325 11.0002 1.83325C16.0629 1.83325 20.1668 5.93717 20.1668 10.9999C20.1668 16.0627 16.0629 20.1666 11.0002 20.1666Z" fill="currentColor"/>
            </g>
          </symbol>

					<symbol id="icon-paypal" viewBox="0 0 24 24">
            <g fill-rule="nonzero" fill="currentColor">
							<path d="M19.5539 9.488C19.6749 10.051 19.6599 10.734 19.5139 11.539C18.9319 14.517 17.0369 16.005 13.8309 16.005H13.3889C13.2255 16.004 13.0675 16.0631 12.9449 16.171C12.8178 16.2811 12.7333 16.4321 12.7059 16.598L12.6649 16.787L12.1119 20.266L12.0909 20.417C12.0623 20.584 11.9747 20.7352 11.8439 20.843C11.7205 20.9516 11.5613 21.0107 11.3969 21.009H8.87388C8.81073 21.0123 8.7477 21.0004 8.69011 20.9743C8.63251 20.9482 8.58202 20.9087 8.54288 20.859C8.50313 20.8083 8.47456 20.7497 8.45905 20.6871C8.44354 20.6246 8.44143 20.5594 8.45288 20.496C8.51388 20.123 8.60088 19.558 8.71988 18.807C8.83688 18.057 8.92588 17.493 8.98688 17.118C9.04788 16.743 9.13688 16.18 9.25888 15.433C9.37988 14.685 9.47088 14.123 9.52988 13.748C9.56288 13.5 9.70888 13.377 9.96288 13.377H11.2789C12.1719 13.39 12.9609 13.32 13.6539 13.166C14.8259 12.904 15.7879 12.422 16.5399 11.717C17.2249 11.08 17.7429 10.255 18.0999 9.244C18.2619 8.774 18.3769 8.327 18.4519 7.906C18.4579 7.865 18.4659 7.84 18.4769 7.832C18.4849 7.821 18.4989 7.818 18.5119 7.821C18.5336 7.83069 18.5544 7.84241 18.5739 7.856C19.0979 8.254 19.4279 8.797 19.5539 9.488ZM17.8259 6.652C17.8259 7.369 17.6719 8.16 17.3609 9.026C16.8239 10.588 15.8139 11.644 14.3239 12.194C13.5659 12.463 12.7219 12.602 11.7889 12.619C11.7889 12.625 11.4879 12.626 10.8849 12.626L9.98188 12.619C9.30988 12.619 8.91488 12.939 8.79488 13.583C8.78188 13.636 8.49688 15.413 7.93988 18.912C7.93188 18.978 7.89188 19.014 7.81888 19.014H4.85388C4.784 19.0155 4.71467 19.0014 4.65087 18.9729C4.58706 18.9444 4.53038 18.9021 4.48488 18.849C4.43768 18.7968 4.40283 18.7346 4.38292 18.6671C4.36301 18.5996 4.35855 18.5285 4.36988 18.459L6.70188 3.664C6.73175 3.47467 6.82993 3.30285 6.97788 3.181C7.12213 3.05684 7.30657 2.98932 7.49688 2.991H13.5109C13.7389 2.991 14.0659 3.035 14.4899 3.122C14.9179 3.206 15.2909 3.316 15.6129 3.443C16.3309 3.717 16.8789 4.131 17.2579 4.68C17.6369 5.232 17.8259 5.887 17.8259 6.652Z" fill="currentColor"/>
            </g>
          </symbol>

					<symbol id="icon-mastercard" viewBox="0 0 24 24">
            <g fill-rule="nonzero" fill="currentColor">
							<path d="M11.4538 17.021C11.5018 17.062 11.5538 17.103 11.6048 17.143C10.5912 17.8159 9.40136 18.1742 8.18477 18.173C7.37384 18.1737 6.57073 18.0145 5.82138 17.7045C5.07203 17.3946 4.39113 16.9399 3.81762 16.3666C3.24412 15.7933 2.78925 15.1125 2.47905 14.3633C2.16884 13.614 2.00937 12.811 2.00977 12C2.00966 10.8832 2.31247 9.78717 2.88596 8.82877C3.45945 7.87037 4.28213 7.08545 5.26641 6.55761C6.25068 6.02976 7.35969 5.77875 8.47533 5.8313C9.59097 5.88386 10.6715 6.23801 11.6018 6.85605C11.5518 6.89905 11.5018 6.93805 11.4638 6.98205C10.7429 7.60446 10.1646 8.3748 9.76807 9.24068C9.37153 10.1066 9.16611 11.0477 9.16577 12C9.16577 13.925 9.99877 15.755 11.4538 17.021ZM15.8148 5.82605C14.5992 5.82368 13.4104 6.18215 12.3988 6.85605C12.4478 6.89905 12.4978 6.93805 12.5358 6.98205C13.9978 8.24505 14.8348 10.076 14.8348 12C14.8348 13.924 13.9998 15.753 12.5468 17.021C12.4978 17.062 12.4458 17.103 12.3958 17.143C13.4085 17.8161 14.5978 18.1745 15.8138 18.173C16.6311 18.1835 17.4424 18.0316 18.2005 17.7261C18.9587 17.4205 19.6486 16.9675 20.2303 16.3933C20.812 15.819 21.2739 15.135 21.5891 14.3808C21.9044 13.6267 22.0668 12.8174 22.0668 12.0001C22.0669 11.1827 21.9047 10.3734 21.5895 9.61919C21.2744 8.86499 20.8126 8.18088 20.231 7.60654C19.6494 7.03219 18.9595 6.57906 18.2014 6.27342C17.4433 5.96778 16.6321 5.81571 15.8148 5.82605ZM11.9998 7.15005C11.2646 7.72651 10.6703 8.46284 10.2621 9.30318C9.8539 10.1435 9.64244 11.0658 9.64377 12C9.64183 12.9348 9.85301 13.8577 10.2613 14.6987C10.6695 15.5396 11.2641 16.2764 11.9998 16.853C12.7353 16.2761 13.3297 15.5393 13.7381 14.6985C14.1465 13.8576 14.3581 12.9348 14.3568 12C14.3581 11.0657 14.1466 10.1433 13.7382 9.30294C13.3298 8.46257 12.7353 7.72631 11.9998 7.15005Z" fill="currentColor"/>
            </g>
          </symbol>

					<symbol id="icon-visa" viewBox="0 0 24 24">
            <g fill-rule="nonzero" fill="currentColor">
							<path d="M17.6906 11.2281C17.6906 11.2281 17.9281 12.3906 17.9812 12.6344H16.9375C17.0406 12.3562 17.4375 11.275 17.4375 11.275C17.4312 11.2844 17.5406 10.9906 17.6031 10.8094L17.6906 11.2281ZM21 6.5V17.5C21 18.3281 20.3281 19 19.5 19H4.5C3.67188 19 3 18.3281 3 17.5V6.5C3 5.67188 3.67188 5 4.5 5H19.5C20.3281 5 21 5.67188 21 6.5ZM7.76562 14.35L9.74062 9.5H8.4125L7.18437 12.8125L7.05 12.1406L6.6125 9.90938C6.54062 9.6 6.31875 9.5125 6.04375 9.5H4.02188L4 9.59688C4.49375 9.72188 4.93437 9.90312 5.31875 10.1312L6.4375 14.35H7.76562ZM10.7156 14.3562L11.5031 9.5H10.2469L9.4625 14.3562H10.7156ZM15.0875 12.7688C15.0938 12.2156 14.7563 11.7938 14.0344 11.4469C13.5938 11.225 13.325 11.075 13.325 10.8469C13.3313 10.6406 13.5531 10.4281 14.0469 10.4281C14.4563 10.4187 14.7562 10.5156 14.9812 10.6125L15.0938 10.6656L15.2656 9.61562C15.0188 9.51875 14.625 9.40938 14.1406 9.40938C12.9 9.40938 12.0281 10.0719 12.0219 11.0156C12.0125 11.7125 12.6469 12.1 13.1219 12.3344C13.6062 12.5719 13.7719 12.7281 13.7719 12.9375C13.7656 13.2625 13.3781 13.4125 13.0188 13.4125C12.5188 13.4125 12.25 13.3344 11.8406 13.1531L11.675 13.075L11.5 14.1656C11.7937 14.3 12.3375 14.4187 12.9 14.425C14.2188 14.4281 15.0781 13.775 15.0875 12.7688ZM19.5 14.3562L18.4875 9.5H17.5156C17.2156 9.5 16.9875 9.5875 16.8594 9.90312L14.9937 14.3562H16.3125C16.3125 14.3562 16.5281 13.7563 16.575 13.6281H18.1875C18.225 13.8 18.3375 14.3562 18.3375 14.3562H19.5Z" fill="currentColor"/>
            </g>
          </symbol>
				</defs>
			</svg>
		</div>
		
	<?php wp_footer(); ?>

	</body>
</html>