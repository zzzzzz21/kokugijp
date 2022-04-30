// server

const browserSync = require('browser-sync');
const {task } = require('gulp');
const { rootDir } = require('../config');

const server = (done) => {
  browserSync({
    server: {
      baseDir: rootDir,
      index: 'index.html'
    },
    open: 'external',
    reloadOnRestart: true,
    port: 3000
  });
  done();
}

task(server);

module.exports = server;