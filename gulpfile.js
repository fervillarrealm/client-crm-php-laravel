var gulp = require('gulp');
var less = require('gulp-less');
var minify = require('gulp-minify-css');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var notify = require('gulp-notify');
var phpunit = require('gulp-phpunit');
var watch = require('gulp-watch'); 
var cache = require('gulp-cache');
var imagemin = require('gulp-imagemin');
var size = require('gulp-size');
var browserSync = require('browser-sync').create();
var livereload = require('gulp-livereload');

var paths = {  
    'dev': {
        'less': './resources/assets/less/',
        'css': './resources/assets/css/',
        'js': './resources/assets/js/',
        'vendor': './resources/assets/vendor/'
    },
    'production': {
        'css': './public/assets/css/',
        'js': './public/assets/js/',
        'fonts': './public/assets/fonts/',
        'img': './public/assets/img/'
    }
};


//-------------------- TASKS -----------------------//
//  LESS
gulp.task('less', function() {  
  return gulp.src(paths.dev.less+'app.less')
    .pipe(less())
    .pipe(gulp.dest(paths.production.css))
    .pipe(minify({keepSpecialComments:0}))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(paths.production.css));
});

//  CSS
gulp.task('css', function (){
  return gulp.src([
    paths.dev.vendor + 'bootstrap/dist/css/bootstrap.css',
    paths.dev.vendor + 'bootstrap/dist/css/bootstrap-theme.css',
    paths.dev.vendor + 'datatables/media/css/jquery.dataTables.css',
    paths.dev.vendor + 'datatables/media/css/dataTables.bootstrap.css',
    paths.dev.vendor + 'font-awesome/css/font-awesome.css',
    paths.dev.vendor + 'sweetalert2/dist/sweetalert2.css',
    paths.dev.vendor + 'toastr/toastr.css',
    paths.dev.vendor + 'AdminLTE/dist/css/AdminLTE.css',
    paths.dev.vendor + 'AdminLTE/dist/css/skins/skin-blue.css',
    paths.dev.css + 'site.css'
    ])
    .pipe(concat('main.css'))
    .pipe(minify({keppSpecialComments:0}))
    //.pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(paths.production.css))
    .pipe(browserSync.stream())
    .pipe(notify('Css Complete!'));
});

//  VALIDATE CSS
gulp.task('validate-css', function (){
  return gulp.src([
    paths.dev.vendor + 'js-validation/scss/validation.css'
  ])
  .pipe(concat('jsvalidation.css'))
  .pipe(minify({keepSpecialComments:0}))
  .pipe(gulp.dest(paths.production.css));
});

//  JS
gulp.task('js', function(){  
  return gulp.src([
      paths.dev.vendor+'jquery/dist/jquery.js',
      paths.dev.vendor+'bootstrap/dist/js/bootstrap.js',
      paths.dev.vendor+'datatables/media/js/jquery.dataTables.js',
      paths.dev.vendor+'datatables/media/js/dataTables.bootstrap.js',
      paths.dev.vendor+'sweetalert2/dist/sweetalert2.js',
      paths.dev.vendor+'toastr/toastr.js',
      paths.dev.vendor+'AdminLTE/dist/js/app.js',
      paths.dev.js+'js'
    ])
    .pipe(concat('main.js'))
    .pipe(uglify())
    .pipe(gulp.dest(paths.production.js))
    .pipe(browserSync.stream())
    .pipe(notify('Js Complete!'));
});


//  IMAGES
// Images
gulp.task('images', function () {
    return gulp.src([
        paths.dev.vendor+'AdminLTE/dist/img/*',
    		'app/images/**/*',
    		'app/lib/images/*'])
        .pipe(cache(imagemin({
            optimizationLevel: 3,
            progressive: true,
            interlaced: true
        })))
        .pipe(gulp.dest(paths.production.img))
        .pipe(size())
        .pipe(notify('Images Complete!'));
});


//  FONTS
gulp.task('fonts', function() {
    return gulp.src([
            paths.dev.vendor+'font-awesome/fonts/fontawesome-webfont.*'])
            .pipe(gulp.dest(paths.production.fonts))
            .pipe(notify('Fonts Complete!'));
});

//  PHP Unit
gulp.task('phpunit', function() {  
  var options = {debug: false, notify: true};
  return gulp.src('./tests/*.php')
    .pipe(phpunit('./vendor/bin/phpunit', options))

    .on('error', notify.onError({
      title: 'PHPUnit Failed',
      message: 'One or more tests failed.'
    }))

    .pipe(notify({
      title: 'PHPUnit Passed',
      message: 'All tests passed!'
    }));
});


//  SERVE
gulp.task('serve', ['less', 'css', 'js', 'fonts', 'images', 'validate-css', 'browserSync', 'watch'], function () {
  
  notify('Served!');
  
    
});

gulp.task('watch', function (){
  gulp.watch(paths.dev.css + '/*.css', ['css', 'browserSync']);
  gulp.watch(paths.dev.js + '/*.js', ['js']).on('change', browserSync.reload);
  gulp.watch(paths.dev.img + '/*', ['img']);
  gulp.watch('*.php', ['reload']);
});


/*
gulp.watch([paths.dev.css + '/*.css']).on('change', function (e) {
    watch('css');
    browserSync.reload();
    
    return gulp.src( e.path )
        .pipe( browserSync.stream() );
});
*/

gulp.task('reload', function(){
    browserSync.reload();
})

gulp.task('browserSync', function() {
  
  var files = [
            './**/*'
        ];
    browserSync.init({
        
        files : files,
        hostname: 'localhost:8081',
        proxy: 'http://cs-cloud-fvillarreal.c9users.io',
        port: 8080,
        ui: {
          port: 8082
        },
        watchOptions : {
            ignored : 'node_modules/*',
            ignoreInitial : true
        }
    }, function() {
      notify('Browser Reloaded');
    });
});





gulp.task('default', ['serve']);
//'phpunit', 



/*
// Static Server + watching scss/html files
gulp.task('serve', ['watch', 'less', 'css', 'js', 'fonts', 'images', 'validate-css'], function() {

    browserSync.init({
      server: {
        baseDir: './'
      },
      files: ["./assets/css/*.css"]
    });
    
    gulp.watch(paths.dev.css + '/*.css', ['css']);
    gulp.watch(paths.dev.js + '/*.js', ['js']);
    gulp.watch(paths.dev.img + '/*', ['img']);
    gulp.watch('./resources/views/pages/*.php', ['phpunit']).on('change', browserSync.reload);

    // Create LiveReload server
    livereload.listen();
    
    //gulp.watch("app/scss/*.scss", ['sass']);
    gulp.watch("*.html").on('change', browserSync.reload);
    gulp.watch("*.php").on('change', browserSync.reload);
});
*/