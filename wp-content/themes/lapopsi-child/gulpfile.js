var { src, dest, watch } = require('gulp')

var rename = require('gulp-rename')
var rtlcss = require('gulp-rtlcss')

var { sass } = require('@mr-hope/gulp-sass')
sass.compiler = require('sass')

var postcss = require('gulp-postcss')
var csso = require('postcss-csso')
var autoprefixer = require('autoprefixer')

var lec = require('gulp-line-ending-corrector')

function baseCss() {
  return src('./scss/*.scss')
    .pipe(lec({ encoding: 'utf8', eolc: 'LF' }))
    .pipe(sass())
    .pipe(postcss([
      autoprefixer({ cascade: false })
    ]))
    .pipe(dest('./css/'))
    .pipe(rtlcss())
    .pipe(rename({ suffix: '-rtl' }))
    .pipe(dest('./css/'))
}

function optimizedCss() {
  return src('./scss/*.scss')
    .pipe(lec({ encoding: 'utf8', eolc: 'LF' }))
    .pipe(sass({ outputStyle: 'compressed' }))
    .pipe(postcss([
      csso(),
      autoprefixer({ cascade: false })
    ]))
    .pipe(dest('./css/'))
    .pipe(rtlcss())
    .pipe(rename({ suffix: '-rtl' }))
    .pipe(dest('./css/'))
}

exports.default = function () {
  watch('./scss/**/*.scss', { ignoreInitial: false, delay: 500 }, baseCss)
}

exports.build = optimizedCss
