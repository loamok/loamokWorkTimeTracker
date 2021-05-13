/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

/* global global */

// any CSS you import will output into a single css file (app.css in this case)
const $ = require('jquery');
global.$ = global.jQuery = $;

import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

require('bootstrap');

const routes = require('./js/fos_js_routes.json');
import Routing from '../public/bundles/fosjsrouting/js/router.min.js';

Routing.setRoutingData(routes);
global.routes = routes;
global.Routing = Routing;

import { showAlert, dissmissAlert } from './js/alerts';
global.showAlert = showAlert;
global.dissmissAlert = dissmissAlert;

import { smartEventDefine } from 'smartEvents';
global.smartEventDefine = smartEventDefine;

// Animations
import './interfaces_animations/wtt/interfaces_animations';