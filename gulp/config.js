const rootDir = './dist';
const srcDir = './src' 
const config = {
  rootDir,
  srcDir: {
    html: `${srcDir}/html`,
    image: `${srcDir}/images`,
    css: `${srcDir}/scss`,
    script: `${srcDir}/script/`
  },
  destDir: {
    html: rootDir,
    image: `${rootDir}/img`,
    css: `${rootDir}/css`,
    script: `${rootDir}/script`,
  }
};

module.exports = config;
