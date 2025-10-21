import path from 'path';
import { fileURLToPath } from 'url';
import gulp from 'gulp';
import * as dartSass from 'sass';
import gulpSass from 'gulp-sass';
import plumber from 'gulp-plumber';
import postcss from 'gulp-postcss';
import cssnano from 'cssnano';
import autoprefixer from 'autoprefixer';
import webpack from 'webpack-stream';
import wpConfig from './webpack.config.js';
import wpConfigDev from './webpack.dev.js';
import wpCompiler from 'webpack';
import { deleteAsync } from 'del';
import rename from 'gulp-rename';
import purgecss from '@fullhuman/postcss-purgecss';

const dest = {
    root: './dist/',
    css: './dist/css/',
    js: './dist/js/',
    jsDev: './src/js/',
    cssDev: './src/css/',
    fonts: './dist/fonts/',
    images: './dist/images/'
};
const src = {
    jsBsDev: './src/js/bootstrap.js',
    js: ['./src/js/main.js', './src/js/bootstrap.js'],
    jsMove: ['./src/js/*.min.js', './src/js/*.min.js.map', '!./src/js/bootstrap.bundle.min.js'],
    scss: './src/scss/style.scss',
    scssBs: './src/scss/custom.scss',
    css: './src/css/*.css',
    cssMove: ['./src/css/*.min.css', '!./src/css/bootstrap.min.css', '!./src/css/style.min.css'],
    fontsMove: './src/fonts/**',
    imagesMove: './src/images/**',
};

const sass = gulpSass(dartSass);
const __dirname = path.dirname(fileURLToPath(import.meta.url));

export const clean = async () => {
    await deleteAsync(['dist/**']);
}

export const move = () => {
    gulp.src(src.jsMove)
        .pipe(gulp.dest(dest.js));
    gulp.src(src.cssMove)
        .pipe(gulp.dest(dest.css));
    gulp.src(src.fontsMove, { encoding: false })
        .pipe(gulp.dest(dest.fonts));
    return gulp.src(src.imagesMove, { encoding: false })
        .pipe(gulp.dest(dest.images));
}

export const scssBs = () => {
    return gulp.src(src.scssBs)
        .pipe(plumber())
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(dest.cssDev));
};

export const scss = () => {
    return gulp.src(src.scss)
        .pipe(plumber())
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest(dest.cssDev));
};

export const postCss = () => {
    const plugins = [
        autoprefixer(),
        cssnano({ preset: ['default', { discardComments: { removeAll: true } }] }),
        purgecss({
            content: [
                '../views/**/*.php',
                '../widgets/**/*.php',
                '../widgets/**/*.js',
                './src/**/*.js',
                '!./src/js/bootstrap.bundle.min.js'
            ],
            safelist: ['tooltip', 'tooltip-arrow', 'bs-tooltip-auto', 'tooltip-inner'],
            variables: false
        })
    ];

    return gulp.src(src.css)
        .pipe(plumber())
        .pipe(rename(function (path) { path.basename += '.min' }))
        .pipe(postcss(plugins))
        .pipe(gulp.dest(dest.css));
};

export const wp = () => {
    return gulp.src(src.js)
        .pipe(plumber())
        .pipe(webpack(wpConfig, wpCompiler))
        .pipe(gulp.dest(dest.js));
};

export const wpDev = () => {
    return gulp.src(src.jsBsDev)
        .pipe(plumber())
        .pipe(webpack(wpConfigDev, wpCompiler))
        .pipe(gulp.dest(dest.jsDev));
};

export const watch = () => {
    gulp.watch(['./src/scss/bootstrap.scss', './src/scss/custom.scss', './src/scss/_vars.scss',], scssBs);
    gulp.watch(['./src/scss/*', '!./src/scss/bootstrap.scss', '!./src/scss/custom.scss'], scss);
    gulp.watch(['./src/js/bootstrap.js'], wpDev);
};

export const dev = gulp.series(gulp.parallel(scss, scssBs, wpDev), watch);
export const build = gulp.series(clean, gulp.parallel(scss, scssBs, wp), gulp.parallel(move, postCss), updateHtmlLinks);

export default dev;
