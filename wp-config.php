<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'veille' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost:3308' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'y&.X[$4&OsmZAS8R&jAQc9&,ar,I?wEkgbY>YJVWJN5x+3e)v!p)yI[Kr4GBKnV~' );
define( 'SECURE_AUTH_KEY',  'm;U/P|a!]DX-2GV^a{:zG|6r!eekZ?cd|CN|5X6u#E;ldos:e9l5c0@fzR<6]4/4' );
define( 'LOGGED_IN_KEY',    'l[_C%1q/MhwU#HC6Lp+,XM+S_ u{,HK:C*q?.:>STyci2-la3+,G:!DKw1Kkr7N^' );
define( 'NONCE_KEY',        'PJ$gLBk)7[1ESoQ,9dQ>@B,pqcm)El}L KHHqF9jDHg^rD 5/-[a.Pc7mXy)ObA?' );
define( 'AUTH_SALT',        'X8k]8BX?C]e$e;vML6?`CHJ{Pk9Gu!xfMaG,!yjaB{Yf|)zgw$<_g~pq@p=2Yv:z' );
define( 'SECURE_AUTH_SALT', '<sM)*#W69P~S7[clG!_IcS*!}_M68BJ(T0`XO&&v>a2X_#i30} Sa# c!R@Zk1/L' );
define( 'LOGGED_IN_SALT',   'TO+;6aw/gQG{ez{oBIUXWh>>*71W|S=|9e2e8AOjkBav2`s_6c77rGzHj<Z_OtB_' );
define( 'NONCE_SALT',       '}{`4Y(71-5[@5JkERiOsS)3RuHinZRc-Q*>O;>uXZZL&+O~g8Mh[z_IPwiwL w`h' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';
define('ALLOW_UNFILTERED_UPLOADS', true);

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
