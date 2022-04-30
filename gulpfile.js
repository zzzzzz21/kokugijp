'use strict';

const { series } = require('gulp');
const html = require('./gulp/tasks/html');
const server = require('./gulp/tasks/server');
const image = require('./gulp/tasks/image');
const css = require('./gulp/tasks/css');
const script = require('./gulp/tasks/script');
const reload = require('./gulp/tasks/reload');
const observe = require('./gulp/tasks/observe');

module.exports = {
  default: series( html, image, css,  observe, server, reload, observe)
}
