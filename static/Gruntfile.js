module.exports = function (grunt) {
    'use strict';
    grunt.initConfig({
        jshint: {
            options: {
                jshintrc: 'js/.jshintrc'
            },
            src: ['Gruntfile.js', 'app/module/**/*.js']
        },
        requirejs: {
            build: {
                options: {
                    baseUrl: "./jscript",
                    name: "jsmain",
                    out: "./jscript/dist/primary.bundle.js",
                    paths: {
                        base: "./base",
                    },
                    optimize: "none",
                    mainConfigFile: "./jscript/jsmain.js"
                }
            }
        }
    });

    // grunt.loadNpmTasks('grunt-contrib-jshint');
    //grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-requirejs');

    // grunt.registerTask('build', ['jshint', 'requirejs']);
    grunt.registerTask('build', ['requirejs:build']);
};
