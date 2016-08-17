var gulp = require('gulp'),
 watch = require('gulp-watch');
var browserify = require('gulp-browserify');

gulp.task('watch', function () {
    // Endless stream mode
    return watch('./js/**/*.js', function () {
        gulp.start('browserify');
    });
});

gulp.task('browserify', function () {
    return gulp.src(['./js/**/*.js'])
        .pipe(browserify())
        .pipe(gulp.dest('./public/js/'));
});