// reload

const browserSync = require('browser-sync');
const { task } = require('gulp');

const reload = (done) => {
  browserSync.reload();
  done();
}

task(reload);

module.exports = reload;