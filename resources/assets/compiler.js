
//const { src, dest, watch, parallel } = require('gulp');
const gulp = require('gulp');
const concat = require('gulp-concat');
const minify = require('gulp-minify');
const minifyCSS = require('gulp-csso');
var sass = require('gulp-sass');

sass.compiler = require('node-sass');

// Scripts Task
gulp.task('scripts', function() {
    return gulp.src([
        './vendor/popper.min.js',
        './bootstrap/js/bootstrap.bundle.js',
        
        './vendor/accordion/jquery.dcjqaccordion.2.7.js',
        './vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
        './vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
        './vendor/bs-custom-file-input/js/bs-custom-file-input.min.js',
        './vendor/slimscroll/js/jquery.nicescroll.min.js',
        './vendor/slimscroll/js/jquery.slimscroll.js',

        './vendor/daterangepicker/moment.min.js',
        './vendor/daterangepicker/daterangepicker.js',
        './vendor/fontawesome-iconpicker-master/dist/js/fontawesome-iconpicker.js',
        './vendor/fullcalendar/fullcalendar.min.js',
        './vendor/ubilabs-geocomplete/jquery.geocomplete.js',
        './vendor/chartjs/js/utils.js',
        './vendor/chartjs/js/chart.bundle.js',

        './vendor/iEdit/iEdit.js',
        './vendor/tagify/tagify.min.js',
        './vendor/tagify/tagify.polyfills.min.js',
        './vendor/tagify/jquery.tagify.min.js',
        './vendor/custom.js'
    ])
    .pipe(concat('./scripts.js'))
    .pipe(minify())
    .pipe(gulp.dest('../../public/js/'));
});

// Styles Task
gulp.task('styles', function() {
    return gulp.src("./sass/styles.scss")
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(gulp.dest("../../public/css/"));
});

gulp.task('watch', function() {
	gulp.watch('./**/*.scss', gulp.series('styles'));
	gulp.watch('./vendor/**/*.js', gulp.series('scripts'));
});

// Default Task
gulp.task('default', gulp.parallel('styles', 'scripts', 'watch'));
