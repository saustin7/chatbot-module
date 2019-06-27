const gulp = require('gulp');
const sass = require('gulp-sass');

const sassConfig = {
    inputDirectory: './scss/*.scss',
    outputDirectory: './css',
    options: {
        outputStyle: 'expanded'
    }
}

gulp.task('build-css', function() {
    return gulp
        .src(sassConfig.inputDirectory)
        .pipe(sass(sassConfig.options).on('error', sass.logError))
        .pipe(gulp.dest(sassConfig.outputDirectory));
});

gulp.task('watch', function() {
    gulp.watch('./*.scss', ['build-css']);
});
gulp.task('default', ['build-css']);
