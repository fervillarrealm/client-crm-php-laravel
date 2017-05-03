var gulp = require('gulp');
var less = require('gulp-less');
var minify = require('gulp-minify-css');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var notify = require('gulp-notify');
var phpunit = require('gulp-phpunit');

var paths = {  
    'dev': {
        'less': './resources/assets/less/',
        'js': './resources/assets/js/',
        'vendor': './resources/assets/vendor/'
    },
    'production': {
        'css': './public/assets/css/',
        'js': './public/assets/js/'
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
    ])
    .pipe(concat('main.css'))
    .pipe(minify({keppSpecialComments:0}))
    //.pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(paths.production.css));
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
    .pipe(gulp.dest(paths.production.js));
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

//  WATCH
gulp.task('watch', function() {  
  gulp.watch(paths.dev.less + '/*.less', ['css']);
  gulp.watch(paths.dev.js + '/*.js', ['js']);
  gulp.watch(paths.dev.js + '/*.css', ['css']);
  gulp.watch('./tests/*.php', ['phpunit']);
});

gulp.task('default', ['less', 'css', 'js', 'validate-css', 'watch']);  
//'phpunit', 
