const imagemin = require('gulp-imagemin');
const { src, dest, task } = require('gulp');
const { srcDir, destDir } = require('../config');


function image() {
  return src(`${srcDir.image}/**/*.{jpg,jpeg,png,gif,svg}`)
    .pipe(
      imagemin([
        imagemin.gifsicle({
          interlaced: false,
        }),
        imagemin.mozjpeg(),
        imagemin.optipng(),
        imagemin.svgo()
      ])
    )
    .pipe(dest(destDir.image));
}

task(image);

module.exports = image;
