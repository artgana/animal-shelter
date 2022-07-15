const { src, dest, parallel, watch } = require('gulp');

const sass = require('gulp-sass')(require('sass'));
const cssimport = require("gulp-cssimport");
const cssimportOptions = {
    matchPattern: "*.css" // process only css
};
const cleanCSS = require('gulp-clean-css');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const rename = require('gulp-rename');
const autoprefixer = require('gulp-autoprefixer');
const plumber = require('gulp-plumber');
const browserSync = require('browser-sync').create();
const webp = require('gulp-webp');


function scss() {
    return src(['assets/scss/style.scss'])
        .pipe(plumber())
        .pipe(cssimport(cssimportOptions))
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({cascade: false}))
        .pipe(cleanCSS({compatibility: '*', level: {1: {specialComments: 0}}}))
        .pipe(concat('styles.min.css'))
        .pipe(dest('./assets/css/'))
        .pipe(browserSync.stream());
}
function css_editor() {
    return src(['assets/scss/editor.scss'])
        .pipe(plumber())
        .pipe(sass().on('error', sass.logError))
        .pipe(autoprefixer({cascade: false}))
        .pipe(cleanCSS({compatibility: '*'}))
        .pipe(concat('editor.min.css'))
        .pipe(dest('./assets/css/'));
}
function scripts() {
    return src(['assets/js/custom.js'])
        .pipe(plumber())
        .pipe(uglify().on('error', function(e){console.log(e);}))
        .pipe(rename({suffix: '.min'}))
        .pipe(dest('./assets/js/'));
}
function plugins() {
    return src(
        [
            './node_modules/mmenu-light/dist/mmenu-light.js',
        ]
    )
        .pipe(uglify())
        .pipe(concat('plugins.min.js'))
        .pipe(dest('./assets/js/'));
}
function convert_webp() {
    return src('assets/img/**/*.{jpg,png}')
        .pipe(webp())
        .pipe(dest('./assets/webp/'))
}


// BrowserSync
function browsersyncServe() {
    browserSync.init({
        proxy: "animalshelter.devlocal",
        browser: "opera", // "google chrome"
        // server: {
        //     baseDir: paths.build
        // },
        // notify: false,
    });
}
function browserReload() {
    return browserSync.reload;
}

// Watch with browser-sync
function watchFiles() {
    watch(['assets/scss/**/*.scss', '!assets/scss/editor.scss'], parallel(scss));
    watch(['assets/scss/editor.scss'], parallel(css_editor));
    watch('assets/js/custom.js', parallel(scripts)).on('change', browserReload());
    watch('assets/js/plugins/*.js', parallel(plugins)).on('change', browserReload());
    watch('**/*.php').on('change', browserReload());
}



// Tasks
exports.default = parallel(scss, css_editor, scripts, plugins);
exports.css = scss;
exports.css_editor = css_editor;
exports.js = scripts;
exports.plugins = plugins;
exports.webp = convert_webp;
exports.watch = parallel(scss, scripts, watchFiles, browsersyncServe);
