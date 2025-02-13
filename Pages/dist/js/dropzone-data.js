/*Dropzone Init*/
$(function(){
	"use strict";
	Dropzone.options.myAwesomeDropzone = {
		addRemoveLinks: true,
		maxFiles:1,
		dictResponseError: 'Server not Configured',
		acceptedFiles: ".png,.jpg,.jpeg,.gif,.bmp,.zip",
		init: function() {
		      this.on("maxfilesexceeded", function(file) {
		            this.removeAllFiles();
		            this.addFile(file);
		      });
		}	
	};
});

