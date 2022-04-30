// EJSの設定
// 初期設定(プラグインの読み込み)
const {src, dest, task } = require('gulp');
const autoprefixer = require('gulp-autoprefixer');
const plumber = require('gulp-plumber');
const sass = require('gulp-sass')(require('sass'));
const browserSync = require('browser-sync');
const sassGlob = require('gulp-sass-glob');
const notify = require('gulp-notify');
const { srcDir, destDir } = require('../config');


function css() {
  return src(`${srcDir.css}/**/*.scss`)
  .pipe(plumber({
      errorHandler: notify.onError("Error: <%= error.message %>")
  }))
  .pipe(sassGlob())
  .pipe(sass())
  .pipe(autoprefixer({
    cascade: false,
    grid: true
  }))
  .pipe(dest(destDir.css))
  .pipe(browserSync.stream());
}

task(css);

module.exports = css;