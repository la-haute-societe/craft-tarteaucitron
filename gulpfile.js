const { src, dest, task }  = require("gulp");
const minify = require("gulp-minify");

const js = function() {
    return src(['tarteaucitron.js/**/*.js'], {})
        .pipe(minify({ext: { min: '.js' }, noSource: true}))
        .pipe(dest('src/resources/tarteaucitron'))
}
task(js);

const css = function() {
    return src('tarteaucitron.js/**/*.css')
        .pipe(dest('src/resources/tarteaucitron'))
}
task(css);
