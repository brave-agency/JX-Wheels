// Require gulp packages
var gulp = require('gulp');
var sass = require('gulp-sass');
var js = require('gulp-uglify');
var imagemin = require('gulp-imagemin');
var browsersync = require('browser-sync');
var reload = browsersync.reload;

// Task 1 - Compile and minify Sass
gulp.task('sass', function () {
  return gulp.src('scss/*.scss')
    .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
    .pipe(gulp.dest('css'))
    .pipe(browsersync.stream());
});

// Task 2 - Minify JS
gulp.task('js', function () {
  return gulp.src('js/*.js')
    .pipe(js())
    .pipe(gulp.dest('js/min'))
    .pipe(browsersync.stream());
});

// Task 3 - Optimise images
gulp.task('imagemin', function () {
    gulp.src('images/*')
        .pipe(imagemin())
        .pipe(gulp.dest('images'))
});

// Task 4 - Set up Browsersync
gulp.task('browser-sync', function() {
  browsersync.init({
  injectChanges: true,
  proxy: 'http://dev.lmrwheels.builtbybrave.com/'
  });
});

gulp.task('reload', function () {
  browsersync.reload();
});

// Task 5 - Set up Watchers
gulp.task('watch', function() {
  gulp.watch('scss/*.scss', ['sass']);
  gulp.watch('js/*.js', ['js']);
  gulp.watch('images/*' , ['imagemin']);
  gulp.watch(['*.html', '*.php'], ['reload']);
});

// Default Gulp tasks
gulp.task('default', ['sass', 'js', 'imagemin', 'browser-sync', 'watch' ]);