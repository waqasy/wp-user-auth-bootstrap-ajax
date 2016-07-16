var gulp = require('gulp');
var concat = require('gulp-concat');
var watch = require('gulp-watch');

gulp.task('scripts', function() {
  return gulp.src('./js/src/*.js')
    .pipe(concat('uab.js'))
    .pipe(gulp.dest('./js/'));
});

gulp.task('watch',['scripts'], function () {
    gulp.watch('./js/src/*.js' , ['scripts']);
});

gulp.task('default', ['scripts', 'watch']);
