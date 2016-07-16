var gulp = require('gulp');
var concat = require('gulp-concat');

gulp.task('scripts', function() {
  return gulp.src('./js/src/*.js')
    .pipe(concat('uab.js'))
    .pipe(gulp.dest('./js/'));
});

gulp.task('default', ['scripts']);
