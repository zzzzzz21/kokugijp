// server

const { watch } = require('gulp');
const css = require('./css');
const html = require('./html');
const reload = require('./reload');
const { srcDir,rootDir } = require('../config');
const script = require('./script');

const observe = (done) => {
  watch(`${srcDir.css}/**/*.scss`, css);
  watch(`${srcDir.script}/**/*.js`, script);
  watch(`${srcDir.html}/**/*.ejs`, html);
  watch(`${rootDir}/**/*.{html, css}`, reload);
  done();
}

module.exports = observe;