const sass = require('node-sass');
const fs = require('fs');
const path = require('path');
const chalk = require('chalk');
const log = console.log;


function build() {
  let result = sass.render({
    file: path.join(__dirname, '../styles/main.scss'),
  }, (err, result) => {
    if (err) {
      log(chalk.white.bgRed.bold("Error, please fix!!"));
      log(chalk.red.bold(err));
    } else {
      log(chalk.green.bold("scss compilation : √ "));
      let outputFile = path.join(__dirname, "../style.css");
      fs.writeFileSync(outputFile, result.css);
      log(chalk.green.bold(`file saved at '${outputFile}' : √ `));
    }
  });
} 

/**
 * Build css
 * */
build();

/**
 * Export for server script
 */
module.exports = build;