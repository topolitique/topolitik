const sass = require('node-sass');
const fs = require('fs');
const chalk = require('chalk');
const log = console.log;


function build() {
  let result = sass.renderSync({
    file: 'scss/main.scss',
  });
  
  if (!result) {
    log(chalk.white.bgRed.bold("Error, please fix!!"));
    log(chalk.red.bold(err));
  
  } else {
    log(chalk.green.bold("scss compilation : √ "));
    let outputFile = "main.css";
    fs.writeFileSync(outputFile, result.css);
  }
} 

/**
 * Build css
 * */
build();

/**
 * Export for server script
 */
module.exports = build;