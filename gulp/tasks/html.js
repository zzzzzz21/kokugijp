// EJSの設定
// 初期設定(プラグインの読み込み)
const {src, dest, task } = require('gulp');
const ejs = require('gulp-ejs');
const rename = require('gulp-rename');
const browserSync = require('browser-sync').create();
const { srcDir, destDir } = require('../config');


const html = (done) => {
  return src([`${srcDir.html}/**/*.ejs`, `!${srcDir.html}/**/_*.ejs`])
    .pipe(ejs())
    .pipe(rename({extname: '.html'}))
    .pipe(dest(destDir.html))
    .pipe(browserSync.stream())
    done();
}

task(html);

module.exports = html;
