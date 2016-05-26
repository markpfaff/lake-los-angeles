module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		compass: {
			dist: {
				options: {
					sassDir: 'sass',
					cssDir: './'
				}
			}
		},
		php: {
		  	files: ['**/*.php'],
        	options: {
          		livereload: 35729
		  	}
		},
		watch:{
		  css: {
			files: '**/*.scss',
			tasks: ['compass'],
			options: {
			  livereload: false
			}
		  }
		}
	});
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.registerTask('default',['watch']);
};
