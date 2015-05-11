//本体系
var g = require('gulp');
var gulpif = require('gulp-if');

//SCSS系
var scss = require('gulp-ruby-sass');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixCore = require('autoprefixer-core');
var autoprefix = require('gulp-autoprefixer');
var plumber = require('gulp-plumber');
var minCss = require('gulp-minify-css');

//Jade系
var jadeNormal = require('gulp-jade');
var jade = require('gulp-jade-php');

//js(dont use template)
var connect = require('gulp-connect');
var srcPath = './src/'
var destPath = '../'

g.task('sass',function(){
	var minCssFlg = false;
	console.log('gulp task sass ---------satar');
	return scss(srcPath+'assets/scss/',
		{
			style:'expanded',
			sourcemap:true
		}
	)
	.on('error',function(txt) {
		console.error('ERRor',txt.message);
	})
	.pipe(plumber())
	.pipe(autoprefix({
		browers:['Android 2.1','ie 8','ie 7'],
		cascade: false
	}))
	.pipe(sourcemaps.write('/map',{
		includeContent:false,
		sourceRoot:destPath+'public/assets/css/'
	}))
	.pipe(gulpif( minCssFlg,minCss(),console.log('minfy:'+minCssFlg) ))
	.pipe(g.dest(destPath+'public/assets/css/'))
	.pipe(g.dest('build/css/'));
})

g.task("jade",function(){
	var LOCAL = {};
	g.src(srcPath+'html/**/*.jade')
	.pipe(plumber())
	.pipe(jade({
		pretty:true
	}))
	.pipe(g.dest(destPath+'fuel/app/views/'))

})
g.task("jadeNormal",function(){
	var LOCAL = {};
	g.src(srcPath+'html/**/*.jade')
	.pipe(plumber())
	.pipe(jadeNormal({
		pretty:true
	}))
	.pipe(g.dest('./build/html/'))
})

g.task('copy',function(){
	g.src(srcPath+'assets/js/**/')
	.pipe(g.dest(destPath+'public/assets/js/'))
	.pipe(g.dest('./build/js/'))

	g.src(srcPath+'assets/img/**/')
	.pipe(g.dest(destPath+'public/assets/img/'))
	.pipe(g.dest('./build/img/'))

})

g.task('watch',['sass','jade','copy'],function(){
	g.watch(srcPath+'/**/*.jade',['jade']);
	g.watch(srcPath+'/**/*.jade',['jadeNormal']);
	g.watch(srcPath+'/**/scss/*.scss',['sass']);
	g.watch(srcPath+'/**/js/**/*.js',['copy']);
})

g.task('server',function(){
	connect.server({
		root:'./build'
		// port:8080,
		// host:'jadetest.local'
	});

})

g.task('default',['watch','server'])