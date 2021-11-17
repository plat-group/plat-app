const mix = require('laravel-mix');
const glob = require('glob');
const path = require('path');

mix.options({
    processCssUrls : false
}).disableNotifications();

if (!mix.inProduction()) {
    mix.webpackConfig({
        devtool: 'inline-source-map'
    }).sourceMaps();
}

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
let resourcePath = 'resources/assets/';
let publicPath = 'public/static/';
/*
 |--------------------------------------------------------------------------
 | Web Controller Assets
 |--------------------------------------------------------------------------
 */
mix
    .js(resourcePath + 'web/js/vendor.js', publicPath + 'js/web')
    .js(resourcePath + 'web/js/app.js', publicPath + 'js/web')
    .sass(resourcePath + 'web/scss/vendor.scss', publicPath + '/css/web')
    .sass(resourcePath + 'web/scss/app.scss', publicPath + '/css/web')
    .version();

/*
 |--------------------------------------------------------------------------
 | Make file of single page
 |--------------------------------------------------------------------------
 */
['web'].forEach($path => {
    // Js pages (single page use)
    (glob.sync(resourcePath + $path + '/js/pages/!(_)*.js') || []).forEach(file => {
        let fileName = path.basename(file);
        mix.js(file, publicPath + '/js/'+ $path +'/pages/' + fileName).version();
    });
    // Css pages (single page use)
    (glob.sync(resourcePath + $path + '/scss/pages/!(_)*.scss') || []).forEach(file => {
        let fileName = path.basename(file.replace(/\.scss$/, '.css'));
        mix.sass(file, publicPath + '/css/'+ $path +'/pages/' + fileName).version();
    });
});
/*
 |--------------------------------------------------------------------------
 | Copy Fonts
 |--------------------------------------------------------------------------
 | Use logic so that you don't need to copy it if the font already exists
 */
let fontPath = 'public/static/fonts/';
let fontSources = [
    'node_modules/@fontsource/nunito-sans/files/',
];

let copiedFonts = []; // All fonts have been copied before
// Check font copied
(glob.sync(fontPath + '*.+(woff|woff2|eot|ttf)') || []).forEach(file => {
    copiedFonts.push(path.basename(file));
});
// Copy fonts to public
fontSources.forEach(fPath => {
    (glob.sync(fPath + '*.+(woff|woff2|eot|ttf)') || []).forEach(file => {
        let fileName = path.basename(file);

        if (copiedFonts.indexOf(fileName) === -1) {
            mix.copy(fPath + fileName, fontPath);
        }
    });
});
