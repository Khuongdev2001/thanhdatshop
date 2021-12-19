const path = require('path');

module.exports = {
  entry: './public/source/js/src/index.js',
  output: {
    filename: 'app.js',
    path: path.resolve(__dirname, 'public/source/js/build'),
  },
};