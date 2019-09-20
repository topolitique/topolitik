const chokidar = require('chokidar');
const chalk = require('chalk');
const date = require('date-and-time');

const build = require('./build');

chokidar.watch('scss/').on('all', (event, path) => {
  let now = date.format(new Date(), 'DD MMMM YYYY H:mm:ss');  
  console.log(`\nRebuilding SCSS on`, chalk.blue.bold(now));
  build();
});