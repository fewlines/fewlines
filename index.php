<?php

/**
 * fewlines Framework (CMS)
 *
 *  - Copyright:  fewlines
 *  - Developers: Davide Perozzi
 *
 *  - inspired by Zend Framework (http://framework.zend.com/)
 *
 * -------------------------------------
 *
 * Note: We are searching for a (german) developer!
 * Feel free to contact us.
 *
 * Skills: PHP, JavaScript (Google closure), HTML, CSS, ...
 * ... and all skills a web developer needs.
 *
 * -------------------------------------
 *
 * If you find any bugs feel free to contact
 * a developer. Or became a developer and help
 * to improve fewlines ;)
 */

require_once __DIR__ . '/fl_init.php';

/**
 * Instantiate the application
 * It will be installed by itself
 *
 * -----------------------------------------
 *
 * To reactivate the installation,
 * please go to "ROOT_DIR/config/fewlines/"
 * and uncomment the file "Install.xml".
 * Just rename it to "_Install.xml", so the
 * application will ignore it and pretend
 * to be a uninstalled version of fewlines
 */

(new \Fewlines\Application\Application)

/**
 * Do not add config dirs which can overwrite
 * the core config files.
 */

->setConfig(getConfig())
->run();