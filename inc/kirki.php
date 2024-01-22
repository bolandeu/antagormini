<?php

new \Kirki\Panel(
	'panel_id',
	[
		'priority'    => 10,
		'title'       => esc_html__( 'Настроим', 'kirki' ),
		'description' => esc_html__( 'Все натсройки делаем здесь.', 'kirki' ),
	]
);

// Даные

new \Kirki\Section(
	'section_id',
	[
		'title'       => esc_html__( 'Данные', 'kirki' ),
		'description' => esc_html__( 'SEO, счетчики, пиксели дргуие api.', 'kirki' ),
		'panel'       => 'panel_id',
		'priority'    => 160,
	]
);

new \Kirki\Field\Text(
	[
		'settings' => 'seo_title',
		'label'    => esc_html__( 'SEO Title', 'kirki' ),
		'section'  => 'section_id',
		'default'  => esc_html__( "", 'kirki' ),
		'priority' => 10,
	]
);

new \Kirki\Field\Textarea(
	[
		'settings'    => 'seo_description',
		'label'       => esc_html__( 'SEO description', 'kirki' ),
		'section'     => 'section_id',
		'default'     => esc_html__( "", 'kirki' ),
	]
);



new \Kirki\Section(
	'section_id_2',
	[
		'title'       => esc_html__( 'Цвета и типографика', 'kirki' ),
		'description' => esc_html__( 'Устанавливаем шрифты, цвета и другие настройки.', 'kirki' ),
		'panel'       => 'panel_id',
		'priority'    => 160,
	]
);

new \Kirki\Field\Background(
	[
		'settings'    => 'background_setting',
		'label'       => esc_html__( 'Фон страницы', 'kirki' ),
		'description' => esc_html__( 'Комплексное управление фоном страницы', 'kirki' ),
		'section'     => 'section_id_2',
		'default'     => [
			'background-color'      => 'rgba(20,20,20,.8)',
			'background-image'      => '',
			'background-repeat'     => 'repeat',
			'background-position'   => 'center center',
			'background-size'       => 'cover',
			'background-attachment' => 'scroll',
		],
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => 'body',
			],
		],
	]
);


new \Kirki\Field\Background(
	[
		'settings'    => 'background_conatiner_setting',
		'label'       => esc_html__( 'Фон контейнера', 'kirki' ),
		'description' => esc_html__( 'Комплексное управление фоном страницы', 'kirki' ),
		'section'     => 'section_id_2',
		'default'     => [
			'background-color'      => '#FFF',
			'background-image'      => '',
			'background-repeat'     => 'repeat',
			'background-position'   => 'center center',
			'background-size'       => 'cover',
			'background-attachment' => 'scroll',
		],
		'transport'   => 'auto',
		'output'      => [
			[
				'element' => '.main_container',
			],
		],
	]
);



new \Kirki\Field\Typography(
	[
		'settings'    => 'typography_setting',
		'label'       => esc_html__( 'Шрифты', 'kirki' ),
		'description' => esc_html__( 'The full set of options.', 'kirki' ),
		'section'     => 'section_id_2',
		'priority'    => 10,
		'transport'   => 'auto',		
		'default'     => [
			'font-family'     => 'Roboto',
			'variant'         => 'regular',
			'font-style'      => 'normal',
			'color'           => '#333333',
			'font-size'       => '1.5em',
			'line-height'     => '1.5',
			'letter-spacing'  => '0',
			'text-transform'  => 'none',
			'text-decoration' => 'none',
			'text-align'      => 'left',
		],
		'output'      => [
			[
				'element' => 'body',
			],
		],
	]
);

new \Kirki\Field\Typography(
	[
		'settings'    => 'heading_typography_setting',
		'label'       => esc_html__( 'Заголовки', 'kirki' ),
		'description' => esc_html__( 'The full set of options.', 'kirki' ),
		'section'     => 'section_id_2',
		'priority'    => 10,
		'transport'   => 'auto',		
		'default'     => [
			'font-family'     => 'Roboto',
			'variant'         => '700',
			'font-style'      => 'normal',
			'color'           => '#333333',			
			'line-height'     => '1.5',
			'letter-spacing'  => '0',
			'text-transform'  => 'none',
			'text-decoration' => 'none',
			'text-align'      => 'left',
		],
		'output'      => [
			[ 'element' => 'h1, h2, h3, h4, h5, h6' ]			
		],
	]
);