var gulp = require('gulp');
var useref = require('gulp-useref');
var uglify = require('gulp-uglify');
var cssnano = require('gulp-cssnano');
var gulpIf = require('gulp-if');
var imagemin = require('gulp-imagemin');
var cache = require('gulp-cache');
var del = require('del');
var critical = require('critical').stream;
var runSequence = require('run-sequence');

gulp.task('useref', function(){
    return gulp.src('src/*.php')
        .pipe(useref())
        .pipe(gulpIf('*.js', uglify()))
        .pipe(gulpIf('*.css', cssnano()))
        .pipe(gulp.dest('dist'))
});

gulp.task('images', function(){
    return gulp.src('src/images/**/*.+(png|jpg|jpeg|gif|svg)')
        .pipe(cache(imagemin({
            interlaced: true
        })))
        .pipe(gulp.dest('dist/images'))
});

gulp.task('clean:dist', function() {
    return del.sync('dist');
});

gulp.task('build', function (callback) {
    runSequence(['useref', 'images'],
        callback
    )
});