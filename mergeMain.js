const {log} = require('console');
var fs = require('fs');
var multistream = require('multistream');

const outputPath = 'js/main-combined.js';

const inputPathList = [
	'js/CookieMonster.js',
	'js/bootstrap.bundle.min.js',
	'js/fslightbox.js',
];

async function mergeFiles(inputPathList, outputPath) {
	var fd = fs.openSync(outputPath, 'w+');
	var output = fs.createWriteStream(outputPath);
	var inputList = inputPathList.map((path) => {
		return fs.createReadStream(path);
	});

	return new Promise((resolve, reject) => {
		var multiStream = new multistream(inputList);
		multiStream.pipe(output);

		multiStream.on('end', () => {
			fs.closeSync(fd);
			resolve(true);
		});
		multiStream.on('error', (error) => {
			console.log(error);

			fs.closeSync(fd);
			reject(false);
		});
	});
}

const status = mergeFiles(inputPathList, outputPath);
